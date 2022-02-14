<?php

namespace Metlar\Proxy;

use DI\NotFoundException;
use Metlar\Proxy\Services\Curl\SendRequests;
use Metlar\Proxy\Services\LoaderListProxy\LoadListProxy;
use Metlar\Proxy\Services\SavingFiles\FileCreator;

class ProxyCheckerOperations
{
    /**
     * @var string
     */
    private $format;
    /**
     * @var array
     */
    private $listProxy;
    /**
     * @var integer
     */
    private $thread;

    /**
     * @var array
     */
    private $proxy = [];

    /**
     * @var FileCreator
     */
    private $fileCreator;
    /**
     * @var LoadListProxy
     */
    private $loadListProxy;

    /**
     * @var SendRequests
     */
    private $sendRequests;

    /**
     * ProxyCheckerOperations constructor.
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

    /**
     * @param mixed $proxy
     * @return ProxyCheckerOperations
     */
    public function setProxy($proxy): ProxyCheckerOperations
    {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * @param mixed $format
     * @return ProxyCheckerOperations
     */
    public function setFormat($format): ProxyCheckerOperations
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @param mixed $thread
     * @return ProxyCheckerOperations
     */
    public function setThread($thread): ProxyCheckerOperations
    {
        $this->thread = $thread;

        return $this;
    }

    public function operation(): void
    {
        $this->saveToFile($this->getResultArray());
    }


    /**
     * Save result to file
     * @param array $arrayData
     */
    public function saveToFile(array $arrayData): void
    {
        $this->fileCreator->setArrayData($arrayData);
        $this->fileCreator->setTypeFile($this->format);
        $this->fileCreator->saveToFile();
    }


    /**
     * Make array list proxy
     *
     * @return array
     * @throws NotFoundException
     */
    public function createListProxy(): array
    {
        if(!empty($this->proxy))
        {
            $this->listProxy = $this->prepareArray($this->proxy);

            return $this->listProxy;
        }

        $arrayList = $this->loadListProxy->getArrayList();
        $this->listProxy = $this->prepareArray($arrayList);

        return $this->listProxy;
    }

    /**
     * @param array $arrayList
     * @return array
     */
    public function prepareArray(array $arrayList): array
    {
        return array_chunk($arrayList, $this->thread);
    }

    public function getResultArray(): array
    {
        $this->createListProxy();
        $this->sendRequests->setUrls($this->listProxy);

        return $this->sendRequests->execute();
    }

}