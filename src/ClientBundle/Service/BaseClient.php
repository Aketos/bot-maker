<?php

declare(strict_types=1);

namespace BotMaker\ClientBundle\Service;

use BotMaker\ClientBundle\Model\TradingExecution;
use BotMaker\ClientBundle\TradingInterface;
use BotMaker\ClientBundle\Traits\ClientFactoryTrait;
use GuzzleHttp\Client;

abstract class BaseClient implements TradingInterface
{
    use ClientFactoryTrait;

    protected Client $client;

    public function __construct()
    {
        $this->client = $this->createClient();
    }

    public function execute(TradingExecution $tradingExecution): bool
    {

    }

    public function getName(): string
    {
        return $this::NAME;
    }
}