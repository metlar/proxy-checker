<?php

use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(false);


$dependencies = require __DIR__."/dependencies.php";

$builder->addDefinitions(require __DIR__."/dependencies.php");

return $builder->build();