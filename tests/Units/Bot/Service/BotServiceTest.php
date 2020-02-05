<?php

namespace BotMaker\Tests\Units\Bot\Service;

use BotMaker\BotBundle\Exception\BotException;
use BotMaker\BotBundle\Service\BotService;
use BotMaker\ClientBundle\TradingInterface;
use BotMaker\StrategyBundle\StrategyInterface;
use BotMaker\UserBundle\Service\UserService;
use PHPUnit\Framework\TestCase;

class BotServiceTest extends TestCase
{
    public function setUp(): void
    {
    }

    public function testStart(): void
    {
        $userServiceMock = $this->getMockBuilder(UserService::class)->getMock();
        $clientMock = $this->getMockBuilder(TradingInterface::class)->getMock();
        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();
        $strategyMock->method('isReady')
            ->willReturn(false);

        $bot = new BotService($userServiceMock, [$strategyMock], [$clientMock]);

        $this->assertFalse($bot->start());

        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();
        $strategyMock->method('isReady')
            ->willReturn(true);
        $strategyMock->method('isActive')
            ->willReturn(false);
        $strategyMock->method('isEnabled')
            ->willReturn(true);

        $bot = new BotService($userServiceMock, [$strategyMock], [$clientMock]);

        $this->assertTrue($bot->start());
    }

    public function testGetStrategies(): void
    {
        $userServiceMock = $this->getMockBuilder(UserService::class)->getMock();
        $clientMock = $this->getMockBuilder(TradingInterface::class)->getMock();
        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();

        $bot = new BotService($userServiceMock, [$strategyMock], [$clientMock]);

        $this->assertCount(1, $bot->getStrategies());
        $this->assertInstanceOf(StrategyInterface::class, $bot->getStrategies()[0]);
    }

    public function testGetStrategyForClassSuccess(): void
    {
        $userServiceMock = $this->getMockBuilder(UserService::class)->getMock();
        $clientMock = $this->getMockBuilder(TradingInterface::class)->getMock();
        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();

        $bot = new BotService($userServiceMock, [$strategyMock], [$clientMock]);

        $this->assertEquals($strategyMock, $bot->getStrategyForClass(get_class($strategyMock)));
    }

    public function testGetStrategyForClassFailure(): void
    {
        $this->expectException(BotException::class);
        $this->expectExceptionMessage('Unable to find the requested strategy');

        $userServiceMock = $this->getMockBuilder(UserService::class)->getMock();
        $clientMock = $this->getMockBuilder(TradingInterface::class)->getMock();
        $strategyMock = $this->getMockBuilder(StrategyInterface::class)->getMock();

        $bot = new BotService($userServiceMock, [$strategyMock], [$clientMock]);

        $bot->getStrategyForClass(self::class);
    }
}