<?php

namespace BotMaker\StrategyBundle\Service;

use BotMaker\ClientBundle\Model\TradingExecution;
use BotMaker\ClientBundle\TradingInterface;
use BotMaker\StrategyBundle\Model\GridTradingConfiguration;
use BotMaker\StrategyBundle\Model\Order;
use BotMaker\StrategyBundle\Model\Pair;
use BotMaker\StrategyBundle\Model\TradableInterface;
use BotMaker\UserBundle\Model\User;

class GridTradingStrategy extends BaseStrategy
{
    public const NAME = 'GridTrading';

    private float $basePrice;
    private float $step;
    private float $amountPerBuy;

    /**
     * @param User $user
     * @return TradingExecution[]
     */
    public function initialize(User $user): ?array
    {
        parent::initialize($user);
        $this->basePrice = $this->calculateBasePrice();
        $this->step = $this->calculateStepValue();
        $this->amountPerBuy = $this->calculateAmountPerBuy();

        return array_map(
            function (TradableInterface $tradable) {
                return $this->tradeBuilder->forgeTradingExecution(
                    TradingInterface::ACTION_CREATE_LIMIT_ORDER,
                    $this->getConfiguration()->getClientName(),
                    $tradable
                );
            },
            $this->defineOrdersList()
        );
    }

    public function process(): array
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
            / $this->getConfiguration()->getGrids();
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
    private function defineOrdersList(): array
    {
        return array_merge($this->defineGridBuyOrders(), $this->defineGridSellOrders());
    }

    // Define the list of buy orders to generate
    private function defineGridBuyOrders(): array
    {
        $buyOrders = [];
        $orderNumber = 0;
        $quantity = $this->getConfiguration()->getAmountToTrade() / $this->calculateNumberOfOrders();

        while ($orderNumber < $this->calculateNumberOfOrders()) {
            $buyOrders[] = (new Order())
                ->setPair($this->getConfiguration()->getPairToTrade())
                ->setPrice($this->getConfiguration()->getMinPriceExpected() + ($this->step * $orderNumber++))
                ->setType(Order::TYPE_BUY)
                ->setQuantity($quantity);
        }

        return $buyOrders;
    }

    // Define the list of sell orders to generate
    private function defineGridSellOrders(): array
    {
        $sellOrders = [];
        $quantity = $this->getConfiguration()->getAmountToTrade() / $this->calculateNumberOfOrders();
        $orderNumber = 0;

        while ($orderNumber < $this->calculateNumberOfOrders()) {
            $sellOrders[] = (new Order())
                ->setPair($this->getConfiguration()->getPairToTrade())
                ->setPrice($this->getConfiguration()->getMaxPriceExpected() - ($this->step * $orderNumber++))
                ->setType(Order::TYPE_SELL)
                ->setQuantity($quantity);

        }

        return $sellOrders;
    }

    protected function getConfiguration(): GridTradingConfiguration
    {
        return parent::getConfiguration();
    }
}