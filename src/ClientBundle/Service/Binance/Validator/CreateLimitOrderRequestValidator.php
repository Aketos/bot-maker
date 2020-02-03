<?php

namespace BotMaker\ClientBundle\Service\Binance\Validator;

use BotMaker\ClientBundle\Service\Validator\RequestValidator;

class CreateLimitOrderRequestValidator extends RequestValidator
{
    public const MANDATORY_FIELDS = ['lang'];

    public const FIELDS_PATTERN_RULES = [
        'lang' => '/^([a-z]{2})(-[A-Z]{2})?$/'
    ];
}