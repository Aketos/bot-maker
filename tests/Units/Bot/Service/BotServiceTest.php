<?php

namespace BotMaker\Tests\Units\Bot\Service;

use BotMaker\Bot\Service\BotService;
use BotMaker\Bot\Exception\BotException;
use BotMaker\Strategy\StrategyInterface;
use PHPUnit\Framework\TestCase;

class BotServiceTest extends TestCase
{
    public function setUp(): void
    {
    }

    public function testStart(): void
    {
        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();
        $strategyMock->method('isReady')
            ->willReturn(false);

        $bot = new BotService([$strategyMock]);

        $this->assertFalse($bot->start());

        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();
        $strategyMock->method('isReady')
            ->willReturn(true);
        $strategyMock->method('isActive')
            ->willReturn(false);
        $strategyMock->method('isEnabled')
            ->willReturn(true);

        $bot = new BotService([$strategyMock]);

        $this->assertTrue($bot->start());
    }

    public function testGetStrategies(): void
    {
        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();

        $bot = new BotService([$strategyMock]);

        $this->assertCount(1, $bot->getStrategies());
        $this->assertInstanceOf(StrategyInterface::class, $bot->getStrategies()[0]);
    }

    public function testGetStrategyForClassSuccess(): void
    {
        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();

        $bot = new BotService([$strategyMock]);

        $this->assertEquals($strategyMock, $bot->getStrategyForClass(get_class($strategyMock)));
    }

    public function testGetStrategyForClassFailure(): void
    {
        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();

        $bot = new BotService([$strategyMock]);

        $this->expectException(BotException::class);
        $this->expectExceptionMessage('Unable to find the requested strategy');
        $bot->getStrategyForClass(self::class);
    }
}