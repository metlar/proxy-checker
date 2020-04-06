<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy;
	
	use Metlar\Proxy\lib\Load;
	use Metlar\Proxy\lib\Logger\LoggerMonolog;
	use Metlar\Proxy\lib\ProxyCurl;
	use Metlar\Proxy\lib\Save\Save;
	
	class ProxyCheckerOperations
	{
		/**
		 * @var ProxyCheckerParams
		 */
		private $params;
		
		/**
		 * ProxyCheckerOperations constructor.
		 *
		 * @param ProxyCheckerParams $params
		 */
		public function __construct(ProxyCheckerParams $params)
		{
			$this->params = $params;
			$this->setLogger();
			$this->createListProxy();
		
		}
		
		/**
		 * Run curl
		 */
		public function operation(): void
		{
			$proxy_curl = new ProxyCurl($this->params);
			$proxy_curl->execute();
			$this->saveToFile();
		}
		
		/**
		 * Save result to file
		 */
		public function saveToFile(): void
		{
			$save = new Save($this->params);
			$save->saveToFile();
		}
		
		public function setLogger() : void
		{
			$logger = new LoggerMonolog($this->params);
			if($this->params->isLog())
				$this->params->setLogger($logger);
		}
		
		/**
		 * Make array list proxy
		 */
		public function createListProxy() : void
		{
			$load = new Load($this->params);
			$array_list = $load->getData();
			$array_list = $this->prepareArray($array_list);
			$this->params->setListProxy($array_list);
		}
		
		/**
		 * Prepare array list proxy
		 * @param array $array_list
		 *
		 * @return array
		 */
		public function prepareArray($array_list) : array
		{
			if ($this->params->isShuffle())
				shuffle($array_list);
			//Breaks array for threads
			$array_list = array_chunk($array_list, $this->params->getThread());
			return $array_list;
		}
		
	}