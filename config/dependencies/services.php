<?php
use Metlar\Proxy\ProxyChecker;
use function DI\autowire;

return array(
    ProxyChecker::class => autowire(),
);
