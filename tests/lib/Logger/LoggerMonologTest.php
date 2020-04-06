<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Logger;
	
	use Metlar\Proxy\ProxyCheckerParams;
	use PHPUnit\Framework\TestCase;
	use Psr\Log\LoggerInterface;
	
	class LoggerMonologTest extends TestCase
	{
		private $reflection;
		private $params;
		private $class;
		
		public function setUp(): void
		{
			$this->reflection = new \ReflectionClass(LoggerMonolog::class);
			$this->params = new ProxyCheckerParams();
			$this->class = new LoggerMonolog($this->params);
			
		}
		public function testCreate()
		{
			$this->assertInstanceOf(LoggerInterface::class, $this->class->create());
		}
	
		
		public function testInfo()
		{

			$method = 'info';
			
			$this->assertTrue($this->reflection->hasMethod($method));
		
		}
		
		public function testLog()
		{
			$method = 'log';
			
			$this->assertTrue($this->reflection->hasMethod($method));

		}
	}
