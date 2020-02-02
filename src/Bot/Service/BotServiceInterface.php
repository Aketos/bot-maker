<?php


namespace BotMaker\Strategy\Service;


use BotMaker\Strategy\StrategyInterface;
use BotMaker\Client\Service\ClientServiceInterface;

interface BotServiceInterface
{
    public function start();

    public function stop();

    public function getClient(): ClientServiceInterface;

    public function getStrategies(): array;

    public function getStrategyForClass(string $strategyClass): StrategyInterface;
}