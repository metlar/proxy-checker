<?php

namespace Metlar\Proxy\Services\SavingFiles;

interface FileTypeInterface
{
    /** @return string */
    public function getDataType(): string;

    public function setData(array $data) : void;
}