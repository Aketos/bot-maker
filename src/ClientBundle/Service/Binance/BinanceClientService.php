<?php

namespace BotMaker\ClientBundle\Service\Binance;

use BotMaker\ClientBundle\TradingInterface;
use BotMaker\ClientBundle\Traits\ClientFactoryTrait;
use BotMaker\StrategyBundle\Model\Order;
use BotMaker\StrategyBundle\Model\Pair;
use GuzzleHttp\Client;

class BinanceClientService implements TradingInterface
{
    use ClientFactoryTrait;

    protected const BASE_URI = 'https://api.binance.com';

    protected Client $client;

    public function __construct()
    {
        $this->client = $this->createClient();
    }

    /**
     * @inheritDoc
     */
    public function createOrder(Order $order): Order
    {
        // TODO: Implement createOrder() method.
    }

    /**
     * @inheritDoc
     */
    public function createLimitOrder(Order $order): Order
    {
        // TODO: Implement createLimitOrder() method.
    }

    public function fetchPrice(Pair $pair)
    {
        // TODO: Implement fetchPrice() method.
    }
}