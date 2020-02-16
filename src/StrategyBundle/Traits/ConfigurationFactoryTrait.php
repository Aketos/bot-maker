<?php

declare(strict_types=1);

namespace BotMaker\StrategyBundle\Traits;

use BotMaker\StrategyBundle\Model\StrategyConfiguration;

trait ConfigurationFactoryTrait
{
    public function createConfiguration(string $strategyName, array $configuration): StrategyConfiguration
    {
        $specificConfiguration = 'BotMaker\StrategyBundle\Model\\' . $strategyName . 'Configuration';

        return new $specificConfiguration($configuration);
    }
}