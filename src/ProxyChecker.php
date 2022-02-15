<?php

namespace Metlar\Proxy;

use DI\DependencyException;
use DI\NotFoundException;
use Metlar\Proxy\Services\Curl\SendRequests;
use Metlar\Proxy\Services\LoaderListProxy\LoadListProxy;
use Metlar\Proxy\Services\SavingFiles\FileCreator;

class ProxyChecker
{
    /** @var array */
    private $proxy;

    /** @var array */
    private $arrayCheckedProxy;

    /** @var FileCreator */
    private $fileCreator;

    /** @var LoadListProxy */
    private $loadListProxy;

    /** @var SendRequests */
    private $sendRequests;

    /**
     * ProxyChecker constructor.
     * @param FileCreator $fileCreator
     * @param LoadListProxy $loadListProxy
     * @param SendRequests $sendRequests
     */
    public function __construct(FileCreator $fileCreator, LoadListProxy $loadListProxy, SendRequests $sendRequests)
    {
        $this->fileCreator = $fileCreator;
        $this->loadListProxy = $loadListProxy;
        $this->sendRequests = $sendRequests;
    }


    public function setProxy(array $proxy): ProxyChecker
    {
        $this->proxy = $proxy;

        return $this;
    }


    /**
     * @param string $format
     * @return ProxyChecker
     * @throws NotFoundException
     * @throws DependencyException
     */
    public function saveToFormat(string $format): ProxyChecker
    {
        $this->fileCreator->setArrayData($this->getResultArray());
        $this->fileCreator->setTypeFile($format);
        $this->fileCreator->saveToFile();

        return $this;
    }

    /**
     * Make array list proxy
     *
     * @return array
     * @throws NotFoundException
     */
    public function createListProxy(): array
    {
        return $this->proxy ?: $this->loadListProxy->getArrayList();
    }

    /**
     * @return array
     * @throws NotFoundException
     */
    public function getResultArray(): array
    {
        if(empty($this->arrayCheckedProxy)){
            $this->arrayCheckedProxy = $this->sendRequests
                ->setUrls($this->createListProxy())
                ->execute();
        }

        return $this->arrayCheckedProxy;
    }
}