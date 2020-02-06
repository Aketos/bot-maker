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

    private bool $enabled = false;
    private string $clientName = '';
    private StrategyConfiguration $configuration;

    public function initialize(User $user): bool
    {
        $this->configuration = $this->createConfiguration($this->getName(), $user->getConfiguration($this->getName()));
        $this->setClientName($this->getConfiguration()->getClientName());
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
        return $this->configuration;
    }

    /**
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     * @return BaseStrategy
     */
    public function setClientName(string $clientName): BaseStrategy
    {
        $this->clientName = $clientName;
        return $this;
    }

    abstract public function process(): void;

    abstract public function isReady(): bool;

    abstract public function isActive(): bool;
}