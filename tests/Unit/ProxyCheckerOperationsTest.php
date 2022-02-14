<?php

namespace Proxy\Unit;

use Metlar\Proxy\ProxyCheckerOperations;
use Metlar\Proxy\Services\Curl\SendRequests;
use Metlar\Proxy\Services\LoaderListProxy\LoadListProxy;
use Metlar\Proxy\Services\SavingFiles\FileCreator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ProxyCheckerOperationsTest extends TestCase
{
    /**
     * @var ProxyCheckerOperations
     */
    private $proxyCheckerOperations;
    /**
     * @var MockObject|LoadListProxy
     */
    private $loadListProxy;

    /**
     * @var MockObject|SendRequests
     */
    private $sendRequests;

    /**
     * @var MockObject|FileCreator
     */
    private $fileCreator;


    protected function setUp()
    {
        $this->loadListProxy = $this->createMock(LoadListProxy::class);
        $this->sendRequests = $this->createMock(SendRequests::class);
        $this->fileCreator = $this->createMock(FileCreator::class);
        $this->proxyCheckerOperations = new ProxyCheckerOperations($this->fileCreator,$this->loadListProxy, $this->sendRequests);
        $this->proxyCheckerOperations->setThread(5);

    }

    public function testCreateListProxy()
    {
        $this->assertIsArray($this->proxyCheckerOperations->createListProxy());
    }

    public function testPrepareArray()
    {
        $this->assertIsArray($this->proxyCheckerOperations->prepareArray(['test']));
    }

    public function testGetResultArray()
    {
        $this->assertIsArray($this->proxyCheckerOperations->getResultArray());
    }
}
