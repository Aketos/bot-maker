<?php

namespace BotMaker\StrategyBundle\Service;

use BotMaker\UserBundle\Model\User;

class GridTradingStrategy extends BaseStrategy
{
    public const NAME = 'GridTrading';

    public function initialize(User $user): bool
    {
        parent::initialize($user);

    }

    public function process(): void
    {
        // TODO: Implement process() method.
    }

    public function isReady(): bool
    {
        // TODO: Implement isReady() method.
    }

    public function isActive(): bool
    {
        // TODO: Implement isActive() method.
    }
}