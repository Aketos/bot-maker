<?php

declare(strict_types=1);

namespace BotMaker\UserBundle\Model;

use BotMaker\ClientBundle\Service\Binance\BinanceClientService;
use BotMaker\StrategyBundle\Model\GridTradingConfiguration;

class User
{
    protected array $configurations = [];

    public function getConfigurations(): array
    {
        return $this->configurations;
    }

    public function getConfiguration(string $strategyName): array
    {
        // 0,00003000
        return [
            'clientName' => BinanceClientService::NAME,
            'Pair' => ['coin' => 'VET', 'marketCoin' => 'ETH'],
            'amountToTrade' => 100000,
            'amountAsMarket' => 100,
            'minPriceExpected' => 2.5,
            'maxPriceExpected' => 3.5,
            'orderSize' => 10000,
            'grids' => 40
        ];

        return $this->configurations[$strategyName];
    }
}