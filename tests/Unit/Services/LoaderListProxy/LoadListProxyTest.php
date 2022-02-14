<?php

namespace Proxy\Unit\Services\LoaderListProxy;

use DI\NotFoundException;
use Metlar\Proxy\Services\LoaderListProxy\LoadListProxy;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LoadListProxyTest extends TestCase
{

    /**
     * @var MockObject|LoadListProxy
     */
    private $loadListProxy;

    protected function setUp(): void
    {

        $this->loadListProxy = $this->getMockBuilder(LoadListProxy::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @dataProvider goodArrayDataProvider
     * @param array $tested
     * @param array $expected
     * @throws NotFoundException
     */
    public function testGetArrayList(array $tested, array $expected): void
    {
        $this->loadListProxy
            ->method('getArrayList')
            ->willReturn($tested);

        $this->assertEquals($this->loadListProxy->getArrayList(), $expected);
    }

    /**
     * @dataProvider goodStringDataProvider
     * @param string $tested
     * @param string $expected
     * @throws NotFoundException
     */
    public function testLoadFile(string $tested, string $expected): void
    {
        $this->loadListProxy
            ->method('loadFile')
            ->willReturn($tested);

        $this->assertEquals($this->loadListProxy->loadFile(), $expected);
    }

    /**
     * @dataProvider goodStringDataProvider
     * @param string $tested
     * @param string $expected
     * @throws NotFoundException
     */
    public function testGetFullPathFile(string $tested, string $expected): void
    {
        $this->loadListProxy
            ->method('getFullPathFile')
            ->willReturn($tested);

        $this->assertEquals($this->loadListProxy->getFullPathFile(), $expected);
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

    /**
     * @return array[]
     */
    public function goodStringDataProvider(): array
    {
        return [
            ['1rr', '1rr'],
            ['222', '222']
        ];

    }
}
