<?php

namespace BotMaker\BotBundle\Exception;

use Exception;

class BotException extends Exception
{
    public const STRATEGY_NOT_FOUND = 'Unable to find the requested strategy';

}