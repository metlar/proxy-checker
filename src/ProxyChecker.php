<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	
	namespace Metlar\Proxy;
	
	class ProxyChecker
		//implements ProxyCheckerInterface
	{
		/**
		 * @var ProxyCheckerParams
		 */
		protected $params;
		
		/**
		 * ProxyCheckeBuilder constructor.
		 */
		public function __construct()
		{
			$this->params = new ProxyCheckerParams();
		}
		
		/**
		 * @return ProxyCheckerParams
		 */
		public function getParams()
		{
			return $this->params;
		}
		
		/**
		 * @param int $thread
		 *
		 * @return ProxyChecker
		 */
		public function thread(int $thread) : ProxyChecker
		{
			$this->params->setThread($thread);
			return $this;
		}
		
		/**
		 * @param string $extension
		 *
		 * @return ProxyChecker
		 */
		public function save(string $extension) : ProxyChecker
		{
			$this->params->setSave($extension);
			return $this;
		}
		
		/**
		 * @param bool $shuffle
		 *
		 * @return ProxyChecker
		 */
		public function shuffle(bool $shuffle) : ProxyChecker
		{
			$this->params->setShuffle($shuffle);
			return $this;
		}
		
		/**
		 * @param bool $log
		 *
		 * @return ProxyChecker
		 */
		public function log(bool $log) : ProxyChecker
		{
			$this->params->setLog($log);
			return $this;
		}
		
		/**
		 * @param mixed $load
		 *
		 * @return ProxyChecker
		 */
		public function load($load) : ProxyChecker
		{
			$this->params->setLoad($load);
			return $this;
		}
		
		/**
		 * @param string $url
		 *
		 * @return ProxyChecker
		 */
		public function url(string $url) : ProxyChecker
		{
			$this->params->setUrl($url);
			return $this;
		}
		
		/**
		 * Start operation
		 */
		public function execute(): void
		{
			$result = new ProxyCheckerOperations($this->params);
			
			$result->operation();
		}
		
		/**
		 * Get array result
		 * @return array
		 */
		public function getArrayResult() : array
		{
			return $this->params->getResultArray();
		}
		
	}