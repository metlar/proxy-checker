<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	
	namespace Metlar\Proxy\lib\Logger;
	
	use Psr\Log\LoggerInterface;
	
	abstract class Logger
	{
		/**
		 * @var LoggerInterface
		 */
		protected $logger;
		
		abstract public function create() : LoggerInterface;
		
		/**
		 * @param int   $level
		 * @param string $message
		 * @param array $context
		 * @return void
		 */
		public function log($level, $message, array $context = [])
		{
			$this->logger->log($level, $message, $context);
		}
		
		/**
		 * @param string $message
		 * @param array $context
		 * @return void
		 */
		public function info($message, array $context = [])
		{
			$this->logger->info($message, $context);
		}
	}