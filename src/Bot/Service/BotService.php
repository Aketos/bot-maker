<?php

namespace BotMaker\Strategy\Service;

use BotMaker\Strategy\Exception\BotException;
use BotMaker\Strategy\StrategyInterface;
use BotMaker\Client\Service\ClientServiceInterface;

class BotService implements BotServiceInterface
{
    /** @var StrategyInterface[] */
    protected array $strategies;

    protected ClientServiceInterface $client;

    public function __construct(ClientServiceInterface $client, array $strategies)
    {

    }

    public function start()
    {

    }

    public function stop()
    {

    }

    public function getClient(): ClientServiceInterface
    {
        return $this->client;
    }

    public function getStrategies(): array
    {
        return $this->strategies;
    }

    /**
     * @throws BotException
     */
    public function getStrategyForClass(string $strategyClass): StrategyInterface
    {
        /** @var StrategyInterface $strategy */
        foreach ($this->strategies as $strategy) {
            if ($strategy->getName() === $strategyClass) {
                return $strategy;
            }
        }

        throw new BotException('Unable to find the requested strategy');
    }
}