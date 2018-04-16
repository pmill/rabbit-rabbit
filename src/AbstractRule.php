<?php
namespace pmill\RabbitRabbit;

abstract class AbstractRule implements RuleInterface
{
    /**
     * @var string
     */
    protected $vHostName;

    /**
     * @var string
     */
    protected $queueName;

    /**
     * AbstractRule constructor.
     *
     * @param string $vHostName
     * @param string $queueName
     */
    public function __construct(string $vHostName, string $queueName)
    {
        $this->vHostName = $vHostName;
        $this->queueName = $queueName;
    }

    /**
     * @return string
     */
    public function getVHostName(): string
    {
        return $this->vHostName;
    }

    /**
     * @param string $vHostName
     */
    public function setVHostName(string $vHostName): void
    {
        $this->vHostName = $vHostName;
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->queueName;
    }

    /**
     * @param string $queueName
     */
    public function setQueueName(string $queueName): void
    {
        $this->queueName = $queueName;
    }
}
