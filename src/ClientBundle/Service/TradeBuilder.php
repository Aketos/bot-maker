<?php

declare(strict_types=1);

namespace BotMaker\ClientBundle\Service;

class TradeBuilder
{
    protected array $actions = [];
    protected array $clients = [];

    public function __construct(array $actions, array $clients)
    {
        $this->actions = $actions;
        $this->clients = $clients;
    }

    public function forgeTradingAction(string $action, string $clientName, $argument)
    {

    }
}