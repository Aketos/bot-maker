<?php

declare(strict_types=1);

namespace BotMaker\UserBundle\Model;

class User
{
    protected array $configurations = [];

    public function getConfigurations(): array
    {
        return $this->configurations;
    }

    public function getConfiguration(string $strategyName): array
    {
        return $this->configurations[$strategyName];
    }
}