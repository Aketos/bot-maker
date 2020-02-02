<?php

namespace BotMaker\Bot\Service;

use BotMaker\Bot\Exception\BotException;
use BotMaker\Strategy\StrategyInterface;

class BotService implements BotServiceInterface
{
    /** @var StrategyInterface[] */
    protected array $strategies;

    protected bool $active;

    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    protected function initialize()
    {
        /** @var StrategyInterface $strategy */
        foreach ($this->getStrategies() as $strategy) {
            $strategy->initialize();
        }

        foreach ($this->getStrategies() as $strategy) {
            if (!$strategy->isReady()) {
                return false;
            }
        }

        return true;
    }

    public function start(): ?bool
    {
        if (!$this->initialize()) {
            return false;
        }

        while ($this->isAStrategyRunning()) {
            /** @var StrategyInterface $strategy */
            foreach ($this->getStrategies() as $strategy) {
                if ($strategy->isActive()) {
                    $strategy->process();
                }
            }
        }

        return true;
    }

    public function stop()
    {

    }

    /**
     * @return StrategyInterface[]
     */
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
            if (get_class($strategy) === $strategyClass) {
                return $strategy;
            }
        }

        throw new BotException('Unable to find the requested strategy');
    }

    public function isAStrategyRunning(): bool
    {
        foreach ($this->getStrategies() as $strategy) {
            if ($strategy->isActive()) {
                return true;
            }
        }

        return false;
    }
}