<?php

declare(strict_types=1);

namespace BotMaker\ClientBundle\Service;

use BotMaker\ClientBundle\Exception\TradingException;
use BotMaker\ClientBundle\Model\TradingExecution;

class TradeBuilder
{
    protected array $actions = [];
    protected array $clients = [];

    public function __construct(array $actions, array $clients)
    {
        $this->actions = $actions;
        $this->clients = $clients;
    }

    public function forgeTradingAction(string $action, string $clientName, $argument): TradingExecution
    {
        $this->validateAction($action);
        $this->validateClientName($clientName);

        return new TradingExecution(
            $clientName,
            $action,
            $argument
        );
    }

    protected function validateAction(string $action): bool
    {
        if (!in_array($action, $this->actions, true)) {
            throw new TradingException(
                sprintf('Action %s required not found. Actions available are: %s',
                    $action,
                    implode(' ', $this->actions)
                )
            );
        }
    }

    protected function validateClientName(string $client): bool
    {
        if (!in_array($client, $this->clients, true)) {
            throw new TradingException(
                sprintf('Client %s required not found. Clients available are: %s',
                    $client,
                    implode(' ', $this->clients)
                )
            );
        }
    }
}