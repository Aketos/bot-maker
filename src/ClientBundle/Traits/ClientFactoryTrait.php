<?php

namespace BotMaker\ClientBundle\Traits;

use GuzzleHttp\Client;

trait ClientFactoryTrait
{
    public function createClient(): Client
    {
        return new Client([
            'base_uri' => $this::BASE_URI,
            'timeout' => 20,
            'allow_redirects' => false,
        ]);
    }
}