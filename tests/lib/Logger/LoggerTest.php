<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Logger;
	
	use PHPUnit\Framework\TestCase;
	
	class LoggerTest extends TestCase
	{
		private $reflection;
		
		public function setUp(): void
		{
			$this->reflection = new \ReflectionClass(Logger::class);
		}
		
		public function test_It_is_abstract(): void
		{
			$this->assertTrue($this->reflection->isAbstract());
		}
		
		
		public function testCreate()
		{
			$method = 'create';
			$this->assertTrue($this->reflection->hasMethod($method));
		}
		
		public function testLog()
		{
			$method = 'log';
			
			$this->assertTrue($this->reflection->hasMethod($method));
	
		}
		
		public function testInfo()
		{
			$method = 'info';
			
			$this->assertTrue($this->reflection->hasMethod($method));

		}

	}
