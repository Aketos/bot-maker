<?php

declare(strict_types=1);

namespace BotMaker\StrategyBundle\Service;

use BotMaker\StrategyBundle\StrategyInterface;

abstract class BaseStrategy implements StrategyInterface
{
    protected bool $enabled = false;

    abstract public function initialize(): bool;

    abstract public function process(): void;

    abstract public function isReady(): bool;

    abstract public function isActive(): bool;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }
}