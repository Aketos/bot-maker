<?php

namespace BotMaker\Bot\Service;

use BotMaker\Strategy\StrategyInterface;

interface BotServiceInterface
{
    public function start();

    public function stop();

    public function getStrategies(): array;

    public function getStrategyForClass(string $strategyClass): StrategyInterface;
}