<?php

namespace Proxy\Unit;

use Metlar\Proxy\ProxyChecker;
use Metlar\Proxy\ProxyCheckerOperations;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ProxyCheckerTest extends TestCase
{
    /** @var ProxyChecker */
    private $proxyChecker;
    /** @var MockObject|ProxyCheckerOperations */
    private $checkerOperations;

    protected function setUp(): void
    {
        $this->checkerOperations = $this->createMock(ProxyCheckerOperations::class);
        $this->proxyChecker = new ProxyChecker($this->checkerOperations);
    }

    public function testSaveFormat(): void
    {
        $this->assertInstanceOf(ProxyChecker::class, $this->proxyChecker->saveFormat('test'));
    }

    public function testGetArray(): void
    {
        $this->assertIsArray($this->proxyChecker->getArray());
    }
}
