<?php

namespace BotMaker\ClientBundle\Service\Binance;

use BotMaker\ClientBundle\Service\BaseClient;
use BotMaker\StrategyBundle\Model\Order;
use BotMaker\StrategyBundle\Model\Pair;

class BinanceClientService extends BaseClient
{
   public const NAME = 'Binance';
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
        var_dump($order->getType() . ': ' . $order->getPair()->getCoin() . '/' . $order->getPair()->getMarketCoin() . ' ' . $order->getQuantity() . ' @ ' . $order->getPrice());
        // TODO: Implement createLimitOrder() method.
        return new Order();
    }

    public function fetchPrice(Pair $pair)
    {
        // TODO: Implement fetchPrice() method.
    }
}