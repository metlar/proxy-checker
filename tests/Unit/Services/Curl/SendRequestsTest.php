<?php

namespace Proxy\Unit\Services\Curl;

use Metlar\Proxy\Services\Curl\SendRequests;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SendRequestsTest extends TestCase
{
    /**
     * @var MockObject|SendRequests
     */
    private $sendRequests;

    protected function setUp(): void
    {

        $this->sendRequests = $this->getMockBuilder(SendRequests::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @dataProvider goodArrayDataProvider
     * @param array $tested
     * @param array $expected
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function testGetMultiResult(array $tested, array $expected): void
    {
        $this->sendRequests
            ->method('getMultiResult')
            ->willReturn($tested);
        $this->assertEquals($this->sendRequests->getMultiResult([]), $expected);
    }

    /**
     * @dataProvider goodArrayDataProvider
     * @param array $tested
     * @param array $expected
     */
    public function testExecute(array $tested, array $expected): void
    {
        $this->sendRequests
            ->method('execute')
            ->willReturn($tested);
        $this->assertEquals($this->sendRequests->execute(), $expected);
    }

    /**
     * @return array[]
     */
    public function goodArrayDataProvider(): array
    {
        return [
            [[1, 2, 3], [1, 2, 3]],
            [['1', '2', '3'], ['1', '2', '3']]
        ];
    }
}
