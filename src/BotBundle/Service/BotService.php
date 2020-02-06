<?php

namespace BotMaker\BotBundle\Service;

use BotMaker\BotBundle\Exception\BotException;
use BotMaker\ClientBundle\Model\TradingExecution;
use BotMaker\ClientBundle\TradingInterface;
use BotMaker\StrategyBundle\StrategyInterface;
use BotMaker\UserBundle\Service\UserService;

class BotService implements BotServiceInterface
{
    /** @var StrategyInterface[] */
    protected array $strategies;

    /** @var TradingInterface[] */
    protected array $clients;

    protected UserService $userService;

    protected array $enabledStrategies = [];

    protected bool $active;

    public function __construct(UserService $userService, array $strategies, array $clients)
    {
        $this->strategies = $strategies;
        $this->clients = $clients;
        $this->userService = $userService;
    }

    protected function initialize(): bool
    {
        /** @var StrategyInterface $strategy */
        foreach ($this->getStrategies() as $strategy) {
            $this->process($strategy->initialize($this->userService->getUserById()));
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
                    $this->process($strategy->process());
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
            $this->setEnabledStrategies();
        }

        return $this->enabledStrategies;
    }

    public function setEnabledStrategies(): BotService
    {
        $this->enabledStrategies = array_filter(
            $this->getStrategies(),
            static function (StrategyInterface $strategy) {
                return $strategy->isEnabled();
            }
        );

        return $this;
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

        throw new BotException(BotException::STRATEGY_NOT_FOUND);
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


    /**
     * @param TradingExecution[] $tradingExecutions
     */
    public function process(array $tradingExecutions)
    {
        foreach ($tradingExecutions as $tradingExecution) {

        }
    }
}