<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy;
	
	use Metlar\Proxy\lib\Load;
	use Metlar\Proxy\lib\ProxyCurl;
	use Metlar\Proxy\lib\Save\Save;
	
	class ProxyChecker
	{
		private $check_url = 'http://httpbin.org/get';
		private $logging = false;
		private $array_proxy;
		private $thread = 15;
		private $shuffle = false;
		private $proxy_array_result = array();
		private $type = false;
		private $get_array_result = false;
		
		
		/**
		 * @param bool $get_array_result
		 *
		 * @return $this
		 */
		public function setGetArrayResult($get_array_result)
		{
			$this->get_array_result = $get_array_result;
			
			return $this;
		}
		
		/**
		 * Set type save file
		 *
		 * @param string $type
		 *
		 * @return $this
		 */
		public function saveFile($type)
		{
			$this->type = $type;
			
			return $this;
		}
		
		/**
		 * Shuffle array proxy
		 *
		 * @param int $shuffle
		 *
		 * @return $this
		 */
		public function shuffle($shuffle)
		{
			$this->shuffle = $shuffle;
			
			return $this;
		}
		
		/**
		 * Set num threads
		 *
		 * @param int $thread
		 *
		 * @return $this
		 */
		public function thread($thread)
		{
			$this->thread = $thread;
			
			return $this;
		}
		
		/**
		 * Run scan proxy
		 *
		 * @return mixed
		 */
		public function execute()
		{
			$this->loadProxyList();
			$this->scan();
			if ($this->get_array_result) {
				return $this->proxy_array_result;
			}
		}
		
		/**
		 * Enable logging
		 *
		 * @param $logging bool
		 *
		 * @return $this
		 */
		public function logging($logging)
		{
			$this->logging = $logging;
			
			return $this;
		}
		
		/**
		 * Load proxy list
		 */
		public function loadProxyList($file_name = null)
		{
			$file = new Load($file_name);
			$this->array_proxy = $file->getData();
			if ($this->shuffle) {
				shuffle($this->array_proxy);
			}
			
			return $this;
		}
		
		
		/**
		 * Set check url
		 *
		 * @param string $check_url
		 *
		 * @return $this
		 */
		public function checkUrl(string $check_url)
		{
			$this->check_url = $check_url;
			
			return $this;
		}
		
		/**
		 * Scan proxy list
		 */
		protected function scan()
		{
			
			$proxy_curl = new ProxyCurl();
			
			$this->array_proxy = array_chunk($this->array_proxy, $this->thread);
			
			foreach ($this->array_proxy as $arrayproxy) {
				$query_result = $proxy_curl->setLogging($this->logging)
					->getMultiResult(
						$this->check_url,
						$arrayproxy
					);
				$this->proxy_array_result = array_merge($this->proxy_array_result, $query_result);
			}
			
			if ($this->type) {
				$this->saveToFile();
			}
		}
		
		/**
		 * Save to file
		 */
		protected function saveToFile()
		{
			$save = new Save();
			$save->setType($this->type)
				->setData($this->proxy_array_result)
				->saveToFile();
			
		}
		
		
	}

