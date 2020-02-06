<?php

declare(strict_types=1);

namespace BotMaker\StrategyBundle\Model;


use BotMaker\StrategyBundle\StrategyConfigurationInterface;

class StrategyConfiguration implements StrategyConfigurationInterface
{
    protected string $clientName;

    /**
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     * @return StrategyConfiguration
     */
    public function setClientName(string $clientName): StrategyConfiguration
    {
        $this->clientName = $clientName;
        return $this;
    }
}