<?php

use pmill\RabbitRabbit\AbstractRule;
use pmill\RabbitRabbit\Conditions\CountBetween;
use pmill\RabbitRabbit\Conditions\CountEquals;
use pmill\RabbitRabbit\Conditions\GreaterThan;
use pmill\RabbitRabbit\ConsumerManager;
use pmill\RabbitRabbit\RabbitConfig;

require __DIR__ . '/../vendor/autoload.php';

class EchoRule extends AbstractRule
{
    protected $message;

    public function __construct(string $vHostName, string $queueName, string $message)
    {
        $this->message = $message;
        parent::__construct($vHostName, $queueName);
    }

    public function run(int $readyMessageCount): void
    {
        echo $this->message . PHP_EOL;
    }
}

$config = new RabbitConfig([
    'baseUrl' => 'localhost:15672',
    'username' => 'guest',
    'password' => 'guest',
]);

$manager = new ConsumerManager($config);
$vhostName = '/';
$queueName = 'messages';

$manager->addRule(
    new EchoRule($vhostName, $queueName, '-> Your queue is empty'),
    new CountEquals(0)
);

$manager->addRule(
    new EchoRule($vhostName, $queueName, '-> There are between 1 and 10 messages in your queue'),
    new CountBetween(1, 10, true)
);

$manager->addRule(
    new EchoRule($vhostName, $queueName, '-> There are greater than 10 messages in your queue'),
    new GreaterThan(10)
);

$manager->run();
