<?php

declare(strict_types=1);

namespace BotMaker\StrategyBundle\Service;

use BotMaker\ClientBundle\Service\TradeBuilder;
use BotMaker\StrategyBundle\Model\StrategyConfiguration;
use BotMaker\StrategyBundle\StrategyInterface;
use BotMaker\StrategyBundle\Traits\ConfigurationFactoryTrait;
use BotMaker\UserBundle\Model\User;

abstract class BaseStrategy implements StrategyInterface
{
    use ConfigurationFactoryTrait;

    protected const NAME = 'Unkown';

    public TradeBuilder $tradeBuilder;

    private bool $enabled = false;
    private StrategyConfiguration $configuration;

    public function __construct(TradeBuilder $tradeBuilder)
    {
        $this->tradeBuilder = $tradeBuilder;
    }

    public function initialize(User $user): ?array
    {
        $this->configuration = $this->createConfiguration($this->getName(), $user->getConfiguration($this->getName()));
        return null;
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
}