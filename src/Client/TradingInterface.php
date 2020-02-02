<?php

namespace BotMaker\Client;

use BotMaker\Strategy\Model\Order;
use BotMaker\Strategy\Model\Pair;

interface TradingInterface
{
    /**
     * Create an order at market current price
     */
    public function createOrder(Order $order): Order;

    /**
     * Create an order at a specific price
     */
    public function createLimitOrder(Order $order): Order;

    public function fetchPrice(Pair $pair);
}