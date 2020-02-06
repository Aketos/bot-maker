<?php

namespace BotMaker\StrategyBundle;

use BotMaker\UserBundle\Model\User;

interface StrategyInterface
{
    public function initialize(User $user): ?array;

    public function process(): array;

    public function isReady(): bool;

    public function isActive(): bool;

    public function isEnabled(): bool;

    public function enable(): void;

    public function disable(): void;

    public function getName(): string;
}