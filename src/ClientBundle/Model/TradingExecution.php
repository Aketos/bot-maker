<?php

declare(strict_types=1);

namespace BotMaker\ClientBundle\Model;

use BotMaker\StrategyBundle\Model\Order;
use BotMaker\StrategyBundle\Model\Pair;

class TradingExecution
{
    protected string $execution;

    /** @var Order|Pair */
    protected $argument;
}