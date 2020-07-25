<?php

namespace BotMaker\BotBundle\Service;

use BotMaker\StrategyBundle\StrategyInterface;

interface BotServiceInterface
{
    public function start(): bool;

    public function stop(): bool;

    public function getStrategies(): array;

    public function getEnabledStrategies(): array;

    public function getStrategyForClass(string $strategyClass): StrategyInterface;
}