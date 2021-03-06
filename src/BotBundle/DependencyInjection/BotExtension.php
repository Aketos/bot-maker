<?php

declare(strict_types=1);

namespace BotMaker\BotBundle\DependencyInjection;

use BotMaker\BotBundle\Service\BotServiceInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class BotExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.yaml');

        $container
            ->registerForAutoconfiguration(BotServiceInterface::class)
            ->addTag($container->getParameter('alias') . '.' . $container->getParameter('tag_strategy'));
    }
}