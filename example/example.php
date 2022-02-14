<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \Metlar\Proxy\ProxyChecker;

$container = require __DIR__ . '/../config/bootstrap/container.php';

$proxy = $container->get(ProxyChecker::class);
$proxy
    ->thread(5)
    ->setProxy(["176.9.63.62:3128", "176.9.75.42:3128"])
    //->saveFormat('json')
    ->getArray();