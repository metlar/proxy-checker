<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	require_once __DIR__.'/../vendor/autoload.php';
	
	use Metlar\Proxy\ProxyChecker;
	
	$proxy = new ProxyChecker();
	
	$proxy->thread(25); // set 25 queries at the same time
	$proxy->saveFile('txt'); // format save results
	$proxy->execute();

	