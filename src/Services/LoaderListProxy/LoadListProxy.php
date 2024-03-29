<?php

namespace Metlar\Proxy\Services\LoaderListProxy;

use DI\Container;
use DI\NotFoundException;
use Psr\Log\LoggerInterface;
use Throwable;


class LoadListProxy
{
    /** @var Container */
    private $container;

    /** @var LoggerInterface */
    private $logger;

    /** @var array */
    private $config;

    /**
     * LoadListProxy constructor.
     * @param LoggerInterface $logger
     * @param Container $container
     */
    public function __construct(LoggerInterface $logger, Container $container)
    {
        $this->logger = $logger;
        $this->container = $container;
        $this->config = $container->get('proxy_checker');
    }

    /**
     * @return string
     * @throws NotFoundException
     */
    public function getFullPathFile(): string
    {
        try {
            $fullPathFile = __DIR__ . $this->config['proxy-list']['path'] . $this->config['proxy-list']['filename'];

        } catch (Throwable $e) {
            $this->logger->error('Not found settings proxy lists.', ['error' => $e]);
            throw new NotFoundException('Not found settings proxy lists.');

        }
        return $fullPathFile;
    }

    /**
     * Load file
     *
     * @return string
     * @throws NotFoundException
     */
    public function loadFile(): string
    {
        if (false === ($listProxy = file_get_contents($this->getFullPathFile()))) {
            $this->logger->error('Not found file proxy lists.');
            throw new NotFoundException('Not found proxy list.');
        }

        return $listProxy;
    }

    /**
     * @return array
     * @throws NotFoundException
     */
    public function getArrayList(): array
    {
        $array_proxy = explode("\n", $this->loadFile());

        return array_map('trim', $array_proxy);
    }
}