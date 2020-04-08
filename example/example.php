<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	require_once __DIR__.'/../vendor/autoload.php';
	use \Metlar\Proxy\ProxyChecker;
	
	$proxy = new ProxyChecker();
	$proxy
		->save('txt')
		->log(true)
		->thread(30)
		->shuffle(true)
		->load('proxylist')
		//->load(['119.29.135.226:80', '36.66.232.157:8080', '95.211.216.20:36650', '95.211.216.20:36335'])
		->url('http://httpbin.org/get')
		->consoleShow(false)
		->execute();
	
	//Get array result in console
	//var_dump($proxy->getArrayResult());
