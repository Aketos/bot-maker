<?php

declare(strict_types=1);

namespace BotMaker\StrategyBundle\Model;

class GridTradingConfiguration
{
    /* Configuration to define: GridTradingConfiguration
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

    public function __construct(array $configuration)
    {

    }
}