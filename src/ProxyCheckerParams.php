<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	
	namespace Metlar\Proxy;
	
	use Metlar\Proxy\lib\Logger\Logger;
	
	class ProxyCheckerParams
	{
		/**
		 * @var string Url service for checking proxies
		 */
		private $url = 'http://httpbin.org/get';
		
		/**
		 * @var string Saved format file
		 */
		private $save = 'txt';
		
		/**
		 * @var string Name file, proxy list
		 */
		private $load = 'proxylist';
		
		/**
		 * @var string Path file proxy list
		 */
		private $loadPathFile = __DIR__.'/../source/';
		
		/**
		 * @var int Thread
		 */
		private $thread = 15;
		
		/**
		 * @var bool
		 */
		private $shuffle = false;
		
		/**
		 * @var bool Enable logging
		 */
		private $log = false;
		
		/**
		 * @var Logger object
		 */
		private $logger;
		
		/**
		 * @var string Logger name
		 */
		private $loggerName = 'proxy-log';
		
		/**
		 * @var string Logger path
		 */
		private $loggerPath = __DIR__.'/../logs/result-scan.log';
		
		/**
		 * @var string Path for logger file
		 */
		private $resultPathFile = __DIR__.'/../logs/';
		
		/**
		 * @var array List proxy for check
		 */
		private $listProxy = array();
		
		/**
		 * @var array Result check proxy
		 */
		private $resultArray = array();
		
		/**
		 * @var string
		 */
		private $resultFileName = 'result';
		
		/**
		 * @var bool Enable show result scan in console
		 */
		private $consoleShow = false;
		
		/**
		 * @return string
		 */
		public function getUrl()
		{
			return $this->url;
		}
		
		/**
		 * @param string $url
		 */
		public function setUrl($url) : void
		{
			$this->url = $url;
		}
		
		/**
		 * @return string
		 */
		public function getSave()
		{
			return $this->save;
		}
		
		/**
		 * @param string $save
		 */
		public function setSave($save) : void
		{
			$this->save = $save;
		}
		
		/**
		 * @return mixed
		 */
		public function getLoad()
		{
			return $this->load;
		}
		
		/**
		 * @param mixed $load
		 */
		public function setLoad($load) : void
		{
			$this->load = $load;
		}
		
		/**
		 * @return int
		 */
		public function getThread()
		{
			return $this->thread;
		}
		
		/**
		 * @param int $thread
		 */
		public function setThread($thread) : void
		{
			$this->thread = $thread;
		}
		
		/**
		 * @return bool
		 */
		public function isShuffle()
		{
			return $this->shuffle;
		}
		
		/**
		 * @param bool $shuffle
		 */
		public function setShuffle($shuffle) : void
		{
			$this->shuffle = $shuffle;
		}
		
		/**
		 * @return bool
		 */
		public function isLog()
		{
			return $this->log;
		}
		
		/**
		 * @param bool $log
		 */
		public function setLog($log) : void
		{
			$this->log = $log;
		}
		
		/**
		 * @return array
		 */
		public function getResultArray()
		{
			return $this->resultArray;
		}
		
		/**
		 * @param array $resultArray
		 */
		public function setResultArray($resultArray) : void
		{
			$this->resultArray = $resultArray;
		}
		
		/**
		 * @return array
		 */
		public function getListProxy()
		{
			return $this->listProxy;
		}
		
		/**
		 * @param array $listProxy
		 */
		public function setListProxy($listProxy) : void
		{
			$this->listProxy = $listProxy;
		}
		
		/**
		 * @return mixed
		 */
		public function getLogger()
		{
			return $this->logger;
		}
		
		/**
		 * @param mixed $logger
		 */
		public function setLogger($logger) : void
		{
			$this->logger = $logger;
		}
		
		/**
		 * @return string
		 */
		public function getResultPathFile()
		{
			return $this->resultPathFile;
		}
		
		/**
		 * @param string $resultPathFile
		 */
		public function setResultPathFile($resultPathFile) : void
		{
			$this->resultPathFile = $resultPathFile;
		}
		
		/**
		 * @return string
		 */
		public function getResultFileName()
		{
			return $this->resultFileName;
		}
		
		/**
		 * @param string $resultFileName
		 */
		public function setResultFileName($resultFileName) : void
		{
			$this->resultFileName = $resultFileName;
		}
		
		/**
		 * @return string
		 */
		public function getLoggerName()
		{
			return $this->loggerName;
		}
		
		/**
		 * @param string $loggerName
		 */
		public function setLoggerName($loggerName) : void
		{
			$this->loggerName = $loggerName;
		}
		
		/**
		 * @return string
		 */
		public function getLoggerPath()
		{
			return $this->loggerPath;
		}
		
		/**
		 * @param string $loggerPath
		 */
		public function setLoggerPath($loggerPath) : void
		{
			$this->loggerPath = $loggerPath;
		}
		
		/**
		 * @return string
		 */
		public function getLoadPathFile()
		{
			return $this->loadPathFile;
		}
		
		/**
		 * @param string $loadPathFile
		 */
		public function setLoadPathFile($loadPathFile) : void
		{
			$this->loadPathFile = $loadPathFile;
		}
		
		/**
		 * @return bool
		 */
		public function isConsoleShow(): bool
		{
			return $this->consoleShow;
		}
		
		/**
		 * @param bool $consoleShow
		 */
		public function setConsoleShow(bool $consoleShow): void
		{
			$this->consoleShow = $consoleShow;
		}
		
		
	}