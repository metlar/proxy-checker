<?php

namespace Metlar\Proxy\Services\SavingFiles;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;

abstract class FileCreatorAbstract
{
    /** @var string */
    protected $typeFile;

    /** @var Container */
    protected $container;

    /** @return FileTypeInterface */
    abstract public function create(): FileTypeInterface;

    /**
     * Saving data to file.
     *
     * @return $this
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function saveToFile(): self
    {
        $dataFile = $this->create();
        file_put_contents($this->getFullNameFile(), $dataFile->getDataType());

        return $this;
    }

    /**
     * Creating full path and name file.
     *
     * @return string
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function getFullNameFile(): string
    {
        return __DIR__ .
            $this->container->get('proxy_checker')['log_results']['path_results'] .
            $this->container->get('proxy_checker')['log_results']['filename_results'] . '.' .
            $this->typeFile;
    }
}