<?php


namespace BotMaker\Bot\Service;


use BotMaker\Bot\StrategyInterface;
use BotMaker\Client\Service\ClientServiceInterface;

interface BotServiceInterface
{
    public function start(): bool;

    public function stop(): bool;

    public function getClient(): ClientServiceInterface;

    public function getStrategies(): array;

    public function getStrategyForClass(string $strategyClass): StrategyInterface;
}