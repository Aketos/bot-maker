<?php

declare(strict_types=1);

namespace BotMaker\ClientBundle\Service;

use BotMaker\ClientBundle\Model\TradingExecution;
use BotMaker\ClientBundle\TradingInterface;
use BotMaker\ClientBundle\Traits\ClientFactoryTrait;
use BotMaker\StrategyBundle\Model\Order;
use GuzzleHttp\Client;

abstract class BaseClient implements TradingInterface
{
    use ClientFactoryTrait;

    protected Client $client;

    public function __construct()
    {
        $this->client = $this->createClient();
    }

    public function execute(TradingExecution $tradingExecution): Order
    {
        return $this->{$tradingExecution->getExecution()}($tradingExecution->getArgument());
    }

    public function getName(): string
    {
        return $this::NAME;
    }
}