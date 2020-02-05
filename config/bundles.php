<?php

use BotMaker\BotBundle\BotBundle;
use BotMaker\ClientBundle\ClientBundle;
use BotMaker\StrategyBundle\StrategyBundle;
use BotMaker\UserBundle\UserBundle;

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    BotBundle::class => ['all' => true],
    ClientBundle::class => ['all' => true],
    StrategyBundle::class => ['all' => true],
    UserBundle::class => ['all' => true],
];
