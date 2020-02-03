<?php

use BotMaker\BotBundle\BotBundle;
use BotMaker\ClientBundle\ClientBundle;
use BotMaker\StrategyBundle\StrategyBundle;

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    BotBundle::class => ['all' => true],
    ClientBundle::class => ['all' => true],
    StrategyBundle::class => ['all' => true],
];
