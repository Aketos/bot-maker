<?php

namespace BotMaker\StrategyBundle\Service;

use BotMaker\StrategyBundle\Model\GridTradingConfiguration;
use BotMaker\StrategyBundle\Model\StrategyConfiguration;
use BotMaker\UserBundle\Model\User;

class GridTradingStrategy extends BaseStrategy
{
    public const NAME = 'GridTrading';

    private float $basePrice;
    private float $step;
    private float $amountPerBuy;

    public function initialize(User $user): bool
    {
        parent::initialize($user);
        $this->basePrice = $this->calculateBasePrice();
        $this->step = $this->calculateStepValue();
        $this->amountPerBuy = $this->calculateAmountPerBuy();

    }

    public function process(): void
    {
        // TODO: Implement process() method.
    }

    public function isReady(): bool
    {
        // TODO: Implement isReady() method.
    }

    public function isActive(): bool
    {
        // TODO: Implement isActive() method.
    }

    // Calculate steps between two orders
    private function calculateStepValue()
    {
        return ($this->getConfiguration()->getMaxPriceExpected() - $this->getConfiguration()->getMinPriceExpected())
            / $this->calculateNumberOfOrders();
    }

    // Calculate the basic price of the token according to the range set
    private function calculateBasePrice()
    {
        return (($this->getConfiguration()->getMaxPriceExpected() - $this->getConfiguration()->getMinPriceExpected()) / 2)
            + $this->getConfiguration()->getMinPriceExpected();
    }

    // Calculate the price to use on every buy order
    private function calculateAmountPerBuy()
    {
        return $this->calculateBasePrice() * $this->getConfiguration()->getOrderSize();

    }

    // Calculate the number of order of the same type (BUY/SELL) to generate
    private function calculateNumberOfOrders()
    {
        return $this->getConfiguration()->getGrids() / 2;
    }

    // Define all buys and sell orders
    private function defineOrdersList()
    {
        return array_merge($this->defineGridBuyOrders(), $this->defineGridSellOrders());
        //if ($this->areValidOrders(orders)) {
        //    return orders;
        //}
    }

    // Define the list of buy orders to generate
    private function defineGridBuyOrders(): array
    {
        $buyOrders = [];

        for ($i = $this->getConfiguration()->getMinPriceExpected(); $i < $this->basePrice; $i += $this->step) {
            $order['quantity'] = $this->amountPerBuy;
            $order['orderPrice'] = i;
            $order['order'] = 'BUY';
            $buyOrders[] = $order;
        }

        return $buyOrders;
    }

    // Define the list of sell orders to generate
    private function defineGridSellOrders(): array
    {
        $sellOrders = [];

        for ($i = $this->getConfiguration()->getMaxPriceExpected(); $i > $this->basePrice; $i -= $this->step) {
            $order['quantity'] = $this->orderSize;
            $order['orderPrice'] = i;
            $order['order'] = 'SELL';
            $sellOrders[] = $order;
        }

        return $sellOrders;
    }

    protected function getConfiguration(): GridTradingConfiguration
    {
        return parent::getConfiguration();
    }
}