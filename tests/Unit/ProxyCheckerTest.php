<?php

namespace Proxy\Unit;

use DI\NotFoundException;
use Metlar\Proxy\ProxyChecker;
use Metlar\Proxy\Services\Curl\SendRequests;
use Metlar\Proxy\Services\LoaderListProxy\LoadListProxy;
use Metlar\Proxy\Services\SavingFiles\FileCreator;
use PHPUnit\Framework\TestCase;

class ProxyCheckerTest extends TestCase
{
    /** @var ProxyChecker */
    private $proxyChecker;


    protected function setUp(): void
    {
        $fileCreator = $this->createMock(FileCreator::class);
        $loadListProxy = $this->createMock(LoadListProxy::class);
        $sendRequests = $this->createMock(SendRequests::class);

        $this->proxyChecker = new ProxyChecker($fileCreator, $loadListProxy, $sendRequests);
    }

    /**
     * @dataProvider goodArrayDataProvider
     * @param array $tested
     * @param array $expected
     * @throws NotFoundException
     */
    public function testGetResultArray(array $tested, array $expected): void
    {
        $this->proxyChecker->setArrayCheckedProxy($tested);

        $this->assertIsArray($this->proxyChecker->getResultArray());
        $this->assertEquals($this->proxyChecker->getResultArray(), $expected);
    }

    public function testSaveToFormat(): void
    {
        $this->assertInstanceOf(ProxyChecker::class, $this->proxyChecker->saveToFormat('txt'));
    }

    /**
     * @dataProvider goodArrayDataProvider
     * @param array $tested
     * @param array $expected
     * @throws NotFoundException
     */
    public function testCreateListProxy(array $tested, array $expected)
    {
        $this->proxyChecker->setProxy($tested);
        $this->assertEquals($this->proxyChecker->createListProxy(), $expected);
    }
    /**
     * @return array[]
     */
    public function goodArrayDataProvider(): array
    {
        return [
            [[1, 2, 3], [1, 2, 3]],
            [['1', '2', '3'], ['1', '2', '3']],
            [[1, 'test'], [1, 'test']],
            [['set', 'test'], ['set', 'test']],
            [['1', '', '3'], ['1', '', '3']],
            [['1', null, '3'], ['1', null, '3']],
        ];
    }
}
