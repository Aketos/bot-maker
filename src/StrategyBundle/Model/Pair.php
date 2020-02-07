<?php

namespace BotMaker\StrategyBundle\Model;

class Pair implements TradableInterface
{
    protected string $coin;
    protected string $marketCoin;

    public function __construct(string $coin, string $marketCoin)
    {
        $this->coin = $coin;
        $this->marketCoin = $marketCoin;
    }

    /**
     * @return string
     */
    public function getCoin(): string
    {
        return $this->coin;
    }

    /**
     * @param string $coin
     * @return Pair
     */
    public function setCoin(string $coin): Pair
    {
        $this->coin = $coin;
        return $this;
    }

    /**
     * @return string
     */
    public function getMarketCoin(): string
    {
        return $this->marketCoin;
    }

    /**
     * @param string $marketCoin
     * @return Pair
     */
    public function setMarketCoin(string $marketCoin): Pair
    {
        $this->marketCoin = $marketCoin;
        return $this;
    }
}