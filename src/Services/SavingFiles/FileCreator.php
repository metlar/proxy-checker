<?php

namespace Metlar\Proxy\Services\SavingFiles;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use InvalidArgumentException;

class FileCreator extends FileCreatorAbstract
{
    /** @var array */
    private $arrayData;

    /**
     * SaveAbstract constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param mixed $typeFile
     * @return FileCreator
     */
    public function setTypeFile($typeFile): FileCreator
    {
        $this->typeFile = $typeFile;

        return $this;
    }

    /**
     * @param mixed $arrayData
     * @return FileCreator
     */
    public function setArrayData($arrayData): FileCreator
    {
        $this->arrayData = $arrayData;

        return $this;
    }

    /**
     * Factory method
     *
     * @return FileTypeInterface
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function create(): FileTypeInterface
    {
        $nameClass = __NAMESPACE__ . '\\FormatFiles\\' . ucfirst($this->typeFile);
        if (!$this->container->has($nameClass)) {
            throw new InvalidArgumentException("Type not found");
        }

        $fileClass = $this->container->get($nameClass);
        $fileClass->setData($this->arrayData);

        return $fileClass;
    }
}