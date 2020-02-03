<?php

namespace BotMaker\Bot\Service;

use BotMaker\Bot\Exception\BotException;
use BotMaker\Strategy\StrategyInterface;

class BotService implements BotServiceInterface
{
    /** @var StrategyInterface[] */
    protected array $strategies;

    protected array $enabledStrategies = [];

    protected bool $active;

    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    protected function initialize(): bool
    {
        // get user config
        /** @var StrategyInterface $strategy */
        foreach ($this->getStrategies() as $strategy) {
            $strategy->enable(/** true if strategy is selected in user config */);
        }

        /** @var StrategyInterface $strategy */
        foreach ($this->getEnabledStrategies() as $strategy) {
            $strategy->initialize();
        }

        foreach ($this->getEnabledStrategies() as $strategy) {
            if (!$strategy->isReady()) {
                return false;
            }
        }

        return !($this->getEnabledStrategies() === []);
    }

    public function start(): ?bool
    {
        if (!$this->initialize()) {
            return false;
        }

        while ($this->isAStrategyRunning()) {
            /** @var StrategyInterface $strategy */
            foreach ($this->getEnabledStrategies() as $strategy) {
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
     * @return StrategyInterface[]
     */
    public function getEnabledStrategies(): array
    {
        if ($this->enabledStrategies === []) {
            $this->enabledStrategies = array_filter(
                $this->getStrategies(),
                static function (StrategyInterface $strategy) {
                    return $strategy->isEnabled();
                }
            );
        }

        return $this->enabledStrategies;
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
        foreach ($this->getEnabledStrategies() as $strategy) {
            if ($strategy->isActive()) {
                return true;
            }
        }

        return false;
    }
}