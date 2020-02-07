<?php

declare(strict_types=1);

namespace BotMaker\ClientBundle\Model;

use BotMaker\StrategyBundle\Model\Order;
use BotMaker\StrategyBundle\Model\Pair;

class TradingExecution
{
    protected string $clientName;

    protected string $execution;

    /** @var Order|Pair */
    protected $argument;

    public function __construct(string $clientName, string $execution, $argument)
    {
        $this->clientName = $clientName;
        $this->execution = $execution;
        $this->argument = $argument;
    }

    /**
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     * @return TradingExecution
     */
    public function setClientName(string $clientName): TradingExecution
    {
        $this->clientName = $clientName;
        return $this;
    }

    /**
     * @return string
     */
    public function getExecution(): string
    {
        return $this->execution;
    }

    /**
     * @param string $execution
     * @return TradingExecution
     */
    public function setExecution(string $execution): TradingExecution
    {
        $this->execution = $execution;
        return $this;
    }

    /**
     * @return Order|Pair
     */
    public function getArgument()
    {
        return $this->argument;
    }

    /**
     * @param Order|Pair $argument
     * @return TradingExecution
     */
    public function setArgument($argument): TradingExecution
    {
        $this->argument = $argument;
        return $this;
    }
}