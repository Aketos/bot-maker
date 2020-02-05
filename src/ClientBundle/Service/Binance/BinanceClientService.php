<?php

namespace BotMaker\ClientBundle\Service\Binance;

use BotMaker\ClientBundle\Service\BaseClient;
use BotMaker\StrategyBundle\Model\Order;
use BotMaker\StrategyBundle\Model\Pair;

class BinanceClientService extends BaseClient
{
   protected const BASE_URI = 'https://api.binance.com';

    public function __construct()
    {
        parent::__construct();
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