<?php
namespace Tests\Unit\Conditions;

use PHPUnit\Framework\TestCase;
use pmill\RabbitRabbit\RabbitConfig;

class RabbitConfigTest extends TestCase
{
    public function testFromArray()
    {
        $array = [
            'baseUrl' => 'http://example.org:15672',
            'username' => 'boris',
            'password' => 'my.password',
        ];

        $config = new RabbitConfig();
        $config->fromArray($array);

        $this->assertEquals($array['baseUrl'], $config->getBaseUrl());
        $this->assertEquals($array['username'], $config->getUsername());
        $this->assertEquals($array['password'], $config->getPassword());
    }
}
