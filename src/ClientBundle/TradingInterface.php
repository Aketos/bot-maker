<?php

namespace BotMaker\ClientBundle;

use BotMaker\StrategyBundle\Model\Order;
use BotMaker\StrategyBundle\Model\Pair;

interface TradingInterface
{
    public const ACTION_CREATE_ORDER = 'createOrder';
    public const ACTION_CREATE_LIMIT_ORDER  = 'createLimitOrder';
    public const ACTION_FETCH_PRICE = 'fetchPrice';

    /**
     * Create an order at market current price
     */
    public function createOrder(Order $order): Order;

    /**
     * Create an order at a specific price
     */
    public function createLimitOrder(Order $order): Order;

    public function fetchPrice(Pair $pair);

    public function getName(): string;
}