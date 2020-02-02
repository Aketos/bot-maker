<?php

namespace BotMaker\Command;

use BotMaker\Client\Service\Binance\BinanceClientService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{

    public $client;

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'bot:test';

    public function __construct(BinanceClientService $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        var_dump($this->client);
        return 0;
    }
}