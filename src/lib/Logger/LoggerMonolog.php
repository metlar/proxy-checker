<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	
	namespace Metlar\Proxy\lib\Logger;
	
	use Metlar\Proxy\ProxyCheckerParams;
	use Monolog\Handler\StreamHandler;
	use Monolog\Logger;
	use Psr\Log\LoggerInterface;
	
	class LoggerMonolog extends \Metlar\Proxy\lib\Logger\Logger implements
		LoggerInterface
	{
		/**
		 * @var LoggerInterface
		 */
		protected $logger;
		
		/**
		 * @var ProxyCheckerParams
		 */
		protected $params;
		
		/**
		 * LoggerMonolog constructor.
		 */
		public function __construct(ProxyCheckerParams $params)
		{
			$this->params = $params;
			$this->create();
		}
		
		public function create(): LoggerInterface
		{
			$logger = new Logger($this->params->getLoggerName());
			$logger->pushHandler(
				new StreamHandler(
					$this->params->getLoggerPath(),
					Logger::INFO
				)
			);
			$this->logger = $logger;
			
			return $logger;
		}
		
		public function log($level, $message, array $context = []): void
		{
			$this->logger->log($level, $message, $context);
		}
		
		public function info($message, array $context = []): void
		{
			$this->logger->info($message, $context);
		}
		
		public function emergency($message, array $context = array())
		{
			// TODO: Implement emergency() method.
		}
		
		public function alert($message, array $context = array())
		{
			// TODO: Implement alert() method.
		}
		
		public function critical($message, array $context = array())
		{
			// TODO: Implement critical() method.
		}
		
		public function error($message, array $context = array())
		{
			// TODO: Implement error() method.
		}
		
		public function warning($message, array $context = array())
		{
			// TODO: Implement warning() method.
		}
		
		public function notice($message, array $context = array())
		{
			// TODO: Implement notice() method.
		}
		
		public function debug($message, array $context = array())
		{
			// TODO: Implement debug() method.
		}
		
	}