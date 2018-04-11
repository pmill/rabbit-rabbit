<?php
namespace pmill\RabbitRabbit\Exceptions;

class RabbitResponseException extends \Exception
{
    /**
     * @var array
     */
    protected $rabbitResponse;

    /**
     * RabbitResponseException constructor.
     *
     * @param array $rabbitResponse
     */
    public function __construct(array $rabbitResponse)
    {
        $this->rabbitResponse = $rabbitResponse;
        parent::__construct(json_encode($rabbitResponse));
    }

    /**
     * @return array
     */
    public function getRabbitResponse(): array
    {
        return $this->rabbitResponse;
    }
}
