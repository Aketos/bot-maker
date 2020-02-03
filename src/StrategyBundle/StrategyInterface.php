<?php

namespace BotMaker\StrategyBundle;

interface StrategyInterface
{
    public function initialize(): bool;

    public function process(): void;

    public function isReady(): bool;

    public function isActive(): bool;

    public function isEnabled(): bool;

    public function enable(): void;
    public function disable(): void;
}