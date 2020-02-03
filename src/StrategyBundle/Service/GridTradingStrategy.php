<?php

namespace BotMaker\StrategyBundle\Service;

class GridTradingStrategy extends BaseStrategy
{

    /* Configuration to define
     * -----------------------------------------------------------------------
     *  pairAToken: Token to trade (ex: VET)
     *  pairABalance: Amount of token to trade (ex: 1000)
     *  pairBToken: Token used as market (includes fiat - USD)
     *  pairBBalance: Max price to set on grid
     *  minPriceExpected: Min value of the grid
     *  maxPriceExpected: Max value of the grid
     *  orderSize: Number of tokens to trade per order
     *  grids: Number of grids
     */

    public function initialize(): bool
    {
        // TODO: Implement initialize() method.
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
}