<?php

namespace Metlar\Proxy\Services\SavingFiles\FormatFiles;

use Metlar\Proxy\Services\SavingFiles\FileTypeInterface;

class Txt implements FileTypeInterface
{
    /** @var array */
    private $data;

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /** @return string */
    public function getDataType(): string
    {
        $result = '';

        foreach ($this->data as $proxy) {
            $result .= implode("\t", array_values($proxy)) . PHP_EOL;
        }

        return $result ?? '';
    }
}