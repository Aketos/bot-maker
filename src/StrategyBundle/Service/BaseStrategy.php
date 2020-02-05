<?php

declare(strict_types=1);

namespace BotMaker\StrategyBundle\Service;

use BotMaker\StrategyBundle\Model\StrategyConfiguration;
use BotMaker\StrategyBundle\StrategyInterface;
use BotMaker\StrategyBundle\Traits\ConfigurationFactoryTrait;
use BotMaker\UserBundle\Model\User;

abstract class BaseStrategy implements StrategyInterface
{
    use ConfigurationFactoryTrait;

    protected const NAME = 'Unkown';

    protected bool $enabled = false;
    protected array $configuration = [];

    public function initialize(User $user): bool
    {
        $this->configuration = $user->getConfiguration($this->getName());
    }

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

    public function getName(): string
    {
        return $this::NAME;
    }

    protected function getConfiguration(): StrategyConfiguration
    {
        return $this->createConfiguration($this->configuration);
    }

    abstract public function process(): void;

    abstract public function isReady(): bool;

    abstract public function isActive(): bool;
}