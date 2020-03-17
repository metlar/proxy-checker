<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	require_once __DIR__.'/../vendor/autoload.php';
	
	use Metlar\Proxy\ProxyChecker;
	
	$proxy = new ProxyChecker();

	var_dump(
		$proxy
			->thread(5)
			->saveFile('txt')
			->logging(true)
			->shuffle(true)
			->loadProxyList(null)
			->checkUrl('http://httpbin.org/get')
			->setGetArrayResult(true) // returns array result
			->execute()
	);
	