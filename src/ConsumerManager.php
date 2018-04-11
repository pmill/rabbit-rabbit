<?php
namespace pmill\RabbitRabbit;

use BadMethodCallException;
use pmill\RabbitRabbit\Conditions\ConditionInterface;
use pmill\RabbitRabbit\Exceptions\RabbitResponseException;
use RabbitMq\ManagementApi\Client as RabbitClient;

class ConsumerManager
{
    /**
     * @var RabbitClient
     */
    protected $rabbitClient;

    /**
     * @var array
     */
    protected $rules;

    /**
     * ConsumerManager constructor.
     *
     * @param RabbitConfig $config
     */
    public function __construct(RabbitConfig $config = null)
    {
        if ($config) {
            $this->rabbitClient = new RabbitClient(
                null,
                $config->getBaseUrl(),
                $config->getUsername(),
                $config->getPassword()
            );
        }
    }

    /**
     * @param RuleInterface $rule
     * @param ConditionInterface $condition
     */
    public function addRule(RuleInterface $rule, ConditionInterface $condition): void
    {
        $this->rules[] = [
            'rule' => $rule,
            'condition' => $condition,
        ];
    }

    /**
     * @throws RabbitResponseException
     */
    public function run(): void
    {
        if (!$this->rabbitClient) {
            throw new BadMethodCallException('A rabbit client is required before running this method');
        }

        $arrayCache = [];

        foreach ($this->rules as $ruleData) {
            /** @var RuleInterface $rule */
            $rule = $ruleData['rule'];
            /** @var ConditionInterface $condition */
            $condition = $ruleData['condition'];

            $readyMessageCount = $this->getQueueReadyMessagesCount(
                $rule->getVHostName(),
                $rule->getQueueName(),
                $arrayCache
            );

            if ($condition->shouldRun($readyMessageCount)) {
                $rule->run($readyMessageCount);
            }
        }
    }

    /**
     * @param RabbitClient $rabbitClient
     */
    public function setRabbitClient(RabbitClient $rabbitClient): void
    {
        $this->rabbitClient = $rabbitClient;
    }

    /**
     * @param string $vhostName
     * @param string $queueName
     * @param array $arrayCache
     *
     * @return int
     * @throws RabbitResponseException
     */
    protected function getQueueReadyMessagesCount($vhostName, $queueName, array &$arrayCache): int
    {
        $cacheKey = $vhostName . '/' . $queueName;

        if (!isset($arrayCache[$cacheKey])) {
            $queueData = $this->rabbitClient->queues()->get($vhostName, $queueName);
            
            if (isset($queueData['error']) && $queueData['error']) {
                throw new RabbitResponseException($queueData);
            }

            $arrayCache[$cacheKey] = (int)$queueData['messages_ready'];
        }

        return $arrayCache[$cacheKey];
    }
}
