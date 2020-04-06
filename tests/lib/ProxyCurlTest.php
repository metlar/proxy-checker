<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib;
	
	use PHPUnit\Framework\TestCase;
	use Metlar\Proxy\ProxyCheckerParams;
	
	class ProxyCurlTest extends TestCase
	{
		private $params;
		private $class;
		private $reflection;
		
		public function setUp()
		{
			$this->params = new ProxyCheckerParams();
			$this->class = new ProxyCurl($this->params);
			$this->reflection = new \ReflectionClass(ProxyCurl::class);
		}
		
		public function testHasGetMultiResult()
		{
			$method= 'getMultiResult';
			$this->assertTrue($this->reflection->hasMethod($method));
		}
		
		public function testHasLogging()
		{
			$method= 'logging';
			$this->assertTrue($this->reflection->hasMethod($method));
		}
		
		/**
		 * @dataProvider statusProvider
		 */
		public function testArrayMapping($expected,$status)
		{
			$this->expectOutputString(ColorConsole::START_STR.ColorConsole::$array_color[$expected]
				."$expected \t"."127.0.0.1:8080"."\n".ColorConsole::END_STR);
			$result = $this->class->arrayMapping('127.0.0.1:8080', $status);
			
			$this->assertArrayHasKey($expected, $result);
		}
		
		public function testExecute()
		{
			$method= 'execute';
			$this->assertTrue($this->reflection->hasMethod($method));
		}
		
		public function statusProvider()
		{
			return [
				'enabled' => ['enabled', 1],
				'disabled' => ['disabled', 0],
			];
		}
	}
