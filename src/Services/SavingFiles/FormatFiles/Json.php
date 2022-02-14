<?php

namespace Metlar\Proxy\Services\SavingFiles\FormatFiles;

use JsonException;
use Psr\Log\LoggerInterface;
use Metlar\Proxy\Services\SavingFiles\FileTypeInterface;

class Json implements FileTypeInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Json constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getDataType(): string
    {
        try {
            return json_encode($this->data, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $this->logger->error('Error: ' . $e);
            return '';
        }
    }

}