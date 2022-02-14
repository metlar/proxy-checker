<?php

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

$files = array_merge(
    glob(__DIR__ . '/../../config/dependencies/*.{yaml,yml,php}' ?: [], GLOB_BRACE),
    glob(__DIR__ . '/../../config/settings/*.{yaml,yml,php}' ?: [], GLOB_BRACE),
);

$config = array_map(function ($file) {

    try {
        return Yaml::parseFile($file,Yaml::PARSE_CUSTOM_TAGS);
    } catch (ParseException $e) {
        return require $file;
    }
}, $files);

return array_merge_recursive(...$config);