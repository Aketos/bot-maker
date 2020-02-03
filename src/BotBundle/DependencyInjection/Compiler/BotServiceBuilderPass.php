<?php

declare(strict_types=1);

namespace BotMaker\BotBundle\DependencyInjection\Compiler;

use BotMaker\BotBundle\Service\BotServiceInterface;
use BotMaker\StrategyBundle\StrategyInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class BotServiceBuilderPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $availableStrategies = $this->collectAvailableStrategies($container);

        $manager = $container->getDefinition(BotServiceInterface::class);
        $manager->setArgument(0, $availableStrategies);
    }

    private function findExtensionTaggedServiceIds(ContainerBuilder $container, string $tag): array
    {
        return array_keys($container->findTaggedServiceIds($container->getParameter('alias') . '.' . $tag));
    }

    private function collectAvailableStrategies(ContainerBuilder $container): array
    {
        $availableDrivers = [];

        /** @var StrategyInterface|string $strategyId */
        foreach ($this->findExtensionTaggedServiceIds($container, $container->getParameter('tag_strategy')) as $strategyId) {
            $availableDrivers[$strategyId] = new Reference($strategyId);
        }

        return $availableDrivers;
    }
}