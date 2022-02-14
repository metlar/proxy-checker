<?php

namespace Metlar\Proxy\Services\Console;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;

class ConsoleWriter
{
    /**
     * @var Container
     */
    private $container;

    public const COLOR_PATTERN = [
        0 => "\033[31m %s \033[0m",
        1 => "\033[32m %s \033[0m"
    ];

    /**
     * ConsoleWriter constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $proxy
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function write(array $proxy): void
    {
        if (!$this->container->get('show_result_in_console')) {
            return;
        }
        echo sprintf(self::COLOR_PATTERN[$proxy['available']], implode("\t", $proxy)) . PHP_EOL;
    }
}