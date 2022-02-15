<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \Metlar\Proxy\ProxyChecker;

$container = require __DIR__ . '/../config/bootstrap/container.php';

$proxy = $container->get(ProxyChecker::class);
$proxy
    //->setProxy(["176.9.63.62:3128", "176.9.75.42:3128","47.243.228.222:59394","20.105.253.176:8080","117.127.16.205:8080"])
    ->saveToFormat('json')
    ->getResultArray();