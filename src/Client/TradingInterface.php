<?php

namespace BotMaker\Client;

interface TradingInterface
{

    public function createOrder(Order $order);

    /**
     * Create a buy order at market current price
     */
    public function buy(Pair $pair, float $quantity);

    /**
     * Create a sell order at market current price
     */
    public function sell(Pair $pair, float $quantity);

    /**
     * Create a limit order at market current price
     */
    public function createLimitOrder();

}