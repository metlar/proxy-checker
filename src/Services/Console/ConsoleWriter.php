<?php

namespace Metlar\Proxy\Services\Console;

class ConsoleWriter
{
    public const COLOR_PATTERN = [
        0 => "\033[31m %s \033[0m",
        1 => "\033[32m %s \033[0m"
    ];

    /**
     * @param array $proxy
     */
    public function write(array $proxy): void
    {
        $colorLine = self::COLOR_PATTERN[$proxy['available'] ?? 0];
        echo sprintf($colorLine, implode("\t", $proxy)) . PHP_EOL;
    }
}