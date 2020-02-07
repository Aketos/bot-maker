<?php

declare(strict_types=1);

namespace BotMaker\ClientBundle\DependencyInjection\Compiler;

use BotMaker\ClientBundle\Service\TradeBuilder;
use BotMaker\ClientBundle\TradingInterface;
use ReflectionClass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TradeBuilderPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $manager = $container->getDefinition(TradeBuilder::class);
        $manager->setArgument(0, $this->collectAvailableTradingActions());
        $manager->setArgument(1, $this->collectAvailableClientNames($container));
    }

    private function findExtensionTaggedServiceIds(ContainerBuilder $container, string $tag): array
    {
        return array_keys($container->findTaggedServiceIds($container->getParameter('alias') . '.' . $tag));
    }

    private function collectAvailableClientNames(ContainerBuilder $container): array
    {
        $availableDrivers = [];

        /** @var TradingInterface|string $clientId */
        foreach ($this->findExtensionTaggedServiceIds($container, $container->getParameter('tag_client')) as $clientId) {
            $availableDrivers[] = $container->get($clientId)->getName();
        }

        return $availableDrivers;
    }

    private function collectAvailableTradingActions(): array
    {
        return array_values((new ReflectionClass(TradingInterface::class))->getConstants());
    }
}