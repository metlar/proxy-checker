<?php

namespace Metlar\Proxy\Services\Curl;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Metlar\Proxy\Services\Console\ConsoleWriter;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class SendRequests
{
    /**
     * @var array
     */
    private $channels = array();

    /**
     * @var array
     */
    private $result = array();

    /**
     * @var LoggerInterface
     */
    public $logger;

    /**
     * @var array
     */
    private $urls;
    /**
     * @var Container
     */
    private $container;
    /**
     * @var false|mixed
     */
    private $multi;
    /**
     * @var ConsoleWriter
     */
    private $consoleWriter;

    public const STATUS_PROXY = [
        0 => 'disabled',
        1 => 'enabled',
    ];

    /**
     * SendRequests constructor.
     * @param Container $container
     * @param LoggerInterface $logger
     * @param ConsoleWriter $consoleWriter
     */
    public function __construct(Container $container, LoggerInterface $logger, ConsoleWriter $consoleWriter)
    {
        $this->container = $container;
        $this->logger = $logger;
        $this->consoleWriter = $consoleWriter;
    }

    public function setUrls(array $urls): void
    {
        $this->urls = $urls;
    }

    /**
     * Start threads
     */
    public function execute(): array
    {
        $query_result[] = array();
        foreach ($this->urls as $chunkArrayProxy) {
            $query_result[] = $this->getMultiResult($chunkArrayProxy);
        }
        $this->result = array_merge($this->result, ...$query_result);
        $this->processingResult();

        return $this->result;
    }

    /**
     * Sending querys curl
     *
     * @param array $arrayProxy
     *
     * @return array
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getMultiResult(array $arrayProxy): array
    {
        $this->multi = curl_multi_init();

        foreach ($arrayProxy as $proxy) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->container->get('checkpoint_url'));
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 9);
            curl_multi_add_handle($this->multi, $ch);// @phpstan-ignore-line
            $this->channels[$proxy] = $ch;
        }

        $this->multiProcessingCurl();
        $this->mappingResult();

        return $this->result;
    }


    public function multiProcessingCurl(): void
    {
        $active = null;
        do {
            $mrc = curl_multi_exec($this->multi, $active);
        } while ($mrc === CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc === CURLM_OK) {
            if (curl_multi_select($this->multi) === -1) {
                continue;
            }
            do {
                $mrc = curl_multi_exec($this->multi, $active);
            } while ($mrc === CURLM_CALL_MULTI_PERFORM);
        }
    }

    public function mappingResult(): void
    {
        foreach ($this->channels as $proxy => $channel) {
            $curlInfo = curl_getinfo($channel);
            $status = (200 === $curlInfo['http_code']) ? 1 : 0;
            //$proxy = $curlInfo['primary_ip'].':'.$curlInfo['primary_port'];
            $proxyData = ['proxy' => $proxy, 'available' => $status, 'ping' => $curlInfo['connect_time'], 'speed' => $curlInfo['speed_download']];
            $this->result[$proxy] = $proxyData;
            curl_multi_remove_handle($this->multi, $channel);
        }

        $this->channels = array();
        curl_multi_close($this->multi);
    }

    private function processingResult(): void
    {
        foreach ($this->result as $proxy)
        {
            $this->consoleWriter->write($proxy);
            $this->logger->log(LogLevel::INFO, 'Log', $proxy);
        }
    }


}

