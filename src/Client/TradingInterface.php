<?php

namespace BotMaker\Client;

use BotMaker\Bot\Model\Order;
use BotMaker\Bot\Model\Pair;

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