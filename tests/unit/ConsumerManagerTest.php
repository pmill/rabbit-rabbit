<?php
namespace Tests\Unit\Conditions;

use BadMethodCallException;
use Mockery;
use PHPUnit\Framework\TestCase;
use pmill\RabbitRabbit\AbstractRule;
use pmill\RabbitRabbit\Conditions\GreaterThan;
use pmill\RabbitRabbit\Conditions\LessThan;
use pmill\RabbitRabbit\ConsumerManager;
use pmill\RabbitRabbit\Exceptions\RabbitResponseException;
use pmill\RabbitRabbit\RabbitConfig;
use RabbitMq\ManagementApi\Api\Queue;
use RabbitMq\ManagementApi\Client;

class ConsumerManagerTest extends TestCase
{
    public function testRunWithoutSettingRabbitClient()
    {
        $this->expectException(BadMethodCallException::class);

        $manager = new ConsumerManager();
        $manager->run();
    }

    public function testAddedRulesAreRun()
    {
        $queueCount = 11;
        $vhostName = '/';
        $queueName = 'messages';

        $queueManager = Mockery::mock(Queue::class);
        $queueManager
            ->shouldReceive('get')
            ->once()
            ->andReturn(['messages_ready' => $queueCount]);

        $rabbitClient = Mockery::mock(Client::class);
        $rabbitClient
            ->shouldReceive('queues')
            ->once()
            ->andReturn($queueManager);

        $rule1 = Mockery::mock(AbstractRule::class)
            ->shouldAllowMockingProtectedMethods();

        $rule1->shouldReceive('run')->once();
        $rule1->shouldReceive('getVHostName')->andReturn($vhostName);
        $rule1->shouldReceive('getQueueName')->andReturn($queueName);

        $rule2 = Mockery::mock(AbstractRule::class)
            ->shouldAllowMockingProtectedMethods();

        $rule2->shouldNotReceive('run');
        $rule2->shouldReceive('getVHostName')->andReturn($vhostName);
        $rule2->shouldReceive('getQueueName')->andReturn($queueName);

        $manager = new ConsumerManager();
        $manager->setRabbitClient($rabbitClient);

        $manager->addRule(
           $rule1,
           new GreaterThan(10)
        );
        $manager->addRule(
            $rule2,
            new LessThan(10, true)
        );

        $manager->run();
    }

    public function testAnExceptionIsThrownWhenRabbitMQReturnsAnError()
    {
        $this->expectException(RabbitResponseException::class);

        $vhostName = '/';
        $queueName = 'messages';

        $queueManager = Mockery::mock(Queue::class);
        $queueManager
            ->shouldReceive('get')
            ->once()
            ->andReturn(['error' => 'this is my error']);

        $rabbitClient = Mockery::mock(Client::class);
        $rabbitClient
            ->shouldReceive('queues')
            ->once()
            ->andReturn($queueManager);

        $rule1 = Mockery::mock(AbstractRule::class)
            ->shouldAllowMockingProtectedMethods();

        $rule1->shouldReceive('getVHostName')->andReturn($vhostName);
        $rule1->shouldReceive('getQueueName')->andReturn($queueName);

        $manager = new ConsumerManager();
        $manager->setRabbitClient($rabbitClient);

        $manager->addRule(
            $rule1,
            new GreaterThan(10)
        );

        $manager->run();
    }

    public function testConstructorConfigCreatesRabbitClient()
    {
        $config = new RabbitConfig([
            'baseUrl' => 'http://example.org:15672',
            'username' => 'boris',
            'password' => 'my.password',
        ]);

        $manager = new ConsumerManager($config);
        $manager->run();

        $this->assertTrue(true);
    }

    public function tearDown()
    {
        parent::tearDown();

        if ($container = Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        Mockery::close();
    }
}
