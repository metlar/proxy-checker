<?php

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

return [

    LoggerInterface::class => DI\factory(function () {
        $logger = new Logger('ProxyCheck');

        $fileHandler = new StreamHandler(__DIR__ .'/../../logs/result-scan.log', Logger::DEBUG);
        $fileHandler->setFormatter(new LineFormatter());
        $logger->pushHandler($fileHandler);

        return $logger;
    })
];