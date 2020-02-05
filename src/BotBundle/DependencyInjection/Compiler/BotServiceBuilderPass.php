<?php

declare(strict_types=1);

namespace BotMaker\BotBundle\DependencyInjection\Compiler;

use BotMaker\BotBundle\Service\BotServiceInterface;
use BotMaker\ClientBundle\TradingInterface;
use BotMaker\StrategyBundle\StrategyInterface;
use BotMaker\UserBundle\Service\UserService;
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
        $availableClients = $this->collectAvailableClients($container);

        $manager = $container->getDefinition(BotServiceInterface::class);
        $manager->setArgument(0, $container->getDefinition(UserService::class));
        $manager->setArgument(1, $availableStrategies);
        $manager->setArgument(2, $availableClients);
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

    private function collectAvailableClients(ContainerBuilder $container): array
    {
        $availableDrivers = [];

        /** @var TradingInterface|string $clientId */
        foreach ($this->findExtensionTaggedServiceIds($container, $container->getParameter('tag_client')) as $clientId) {
            $availableDrivers[$clientId] = new Reference($clientId);
        }

        return $availableDrivers;
    }
}