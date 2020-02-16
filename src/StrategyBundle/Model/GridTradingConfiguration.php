<?php

declare(strict_types=1);

namespace BotMaker\StrategyBundle\Model;

class GridTradingConfiguration extends StrategyConfiguration
{
    /* Configuration defined: GridTradingConfiguration
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

    protected Pair $pairToTrade;
    protected float $amountToTrade;
    protected float $amountAsMarket;
    protected float $minPriceExpected;
    protected float $maxPriceExpected;
    protected float $orderSize;
    protected int $grids;

    public function __construct(array $configuration)
    {
        foreach ($configuration as $parameter => $value) {
            if ($parameter === 'Pair') {
                $this->pairToTrade = new Pair($value['coin'], $value['marketCoin']);
            } else {
                $this->$parameter = $value;
            }
        }
    }

    /**
     * @return Pair
     */
    public function getPairToTrade(): Pair
    {
        return $this->pairToTrade;
    }

    /**
     * @param Pair $pairToTrade
     * @return GridTradingConfiguration
     */
    public function setPairToTrade(Pair $pairToTrade): GridTradingConfiguration
    {
        $this->pairToTrade = $pairToTrade;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountToTrade(): float
    {
        return $this->amountToTrade;
    }

    /**
     * @param float $amountToTrade
     * @return GridTradingConfiguration
     */
    public function setAmountToTrade(float $amountToTrade): GridTradingConfiguration
    {
        $this->amountToTrade = $amountToTrade;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmountAsMarket(): float
    {
        return $this->amountAsMarket;
    }

    /**
     * @param float $amountAsMarket
     * @return GridTradingConfiguration
     */
    public function setAmountAsMarket(float $amountAsMarket): GridTradingConfiguration
    {
        $this->amountAsMarket = $amountAsMarket;
        return $this;
    }

    /**
     * @return float
     */
    public function getMinPriceExpected(): float
    {
        return $this->minPriceExpected;
    }

    /**
     * @param float $minPriceExpected
     * @return GridTradingConfiguration
     */
    public function setMinPriceExpected(float $minPriceExpected): GridTradingConfiguration
    {
        $this->minPriceExpected = $minPriceExpected;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxPriceExpected(): float
    {
        return $this->maxPriceExpected;
    }

    /**
     * @param float $maxPriceExpected
     * @return GridTradingConfiguration
     */
    public function setMaxPriceExpected(float $maxPriceExpected): GridTradingConfiguration
    {
        $this->maxPriceExpected = $maxPriceExpected;
        return $this;
    }

    /**
     * @return float
     */
    public function getOrderSize(): float
    {
        return $this->orderSize;
    }

    /**
     * @param float $orderSize
     * @return GridTradingConfiguration
     */
    public function setOrderSize(float $orderSize): GridTradingConfiguration
    {
        $this->orderSize = $orderSize;
        return $this;
    }

    /**
     * @return int
     */
    public function getGrids(): int
    {
        return $this->grids;
    }

    /**
     * @param int $grids
     * @return GridTradingConfiguration
     */
    public function setGrids(int $grids): GridTradingConfiguration
    {
        $this->grids = $grids;
        return $this;
    }
}