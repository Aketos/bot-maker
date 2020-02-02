<?php

namespace BotMaker\Strategy;

interface StrategyInterface
{
    public function initialize(): bool;

    public function process();

    public function isReady(): bool;

    public function isActive(): bool;

    public function isEnabled(): bool;

    public function enable(bool $enable = false);
}