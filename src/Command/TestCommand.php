<?php

namespace BotMaker\Command;

use BotMaker\BotBundle\Service\BotService;
use BotMaker\BotBundle\Service\BotServiceInterface;
use BotMaker\ClientBundle\Service\Binance\BinanceClientService;
use BotMaker\ClientBundle\Service\TradeBuilder;
use BotMaker\StrategyBundle\Service\GridTradingStrategy;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{

    public $client;
    public $bot;
    public $tradeBuilder;

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'bot:test';

    public function __construct(BinanceClientService $client, BotServiceInterface $bot, TradeBuilder $tradeBuilder)
    {
        $this->client = $client;
        $this->bot = $bot;
        $this->tradeBuilder = $tradeBuilder;
        parent::__construct();
    }

    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        var_dump($this->bot->getStrategies()[GridTradingStrategy::class]->tradeBuilder);
        return 0;
    }
}