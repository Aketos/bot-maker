<?php

namespace BotMaker\Client\Service\Binance;

use BotMaker\Client\TradingInterface;
use BotMaker\Client\Traits\ClientFactoryTrait;
use BotMaker\Strategy\Model\Order;
use BotMaker\Strategy\Model\Pair;
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