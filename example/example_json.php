<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	require_once __DIR__.'/../vendor/autoload.php';
	
	use Metlar\Proxy\ProxyChecker;
	
	$proxy = new ProxyChecker();
	
	$proxy->logging(true); // enable logging
	$proxy->saveFile('json');// save json format
	$proxy->execute();

	