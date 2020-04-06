<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy;
	
	use PHPUnit\Framework\TestCase;
	
	class ProxyCheckerTest extends TestCase
	{
		private $class;
		private $proxy_checker;
		
		
		protected function setUp(): void
		{
			$this->class = new \ReflectionClass(ProxyChecker::class);
			$this->proxy_checker = new ProxyChecker();
			
		}
		
		protected function tearDown()
		{
			parent::tearDown(); // TODO: Change the autogenerated stub
		}
		
		public function testLog()
		{
			
			$method = 'log';
			$this->assertTrue($this->class->hasMethod($method));
			
			$this->assertIsBool($this->proxy_checker->getParams()->isLog());
		}
		
		/**
		 * @dataProvider booleanProvider
		 */
		public function testBoolLog($bool1, $bool2)
		{
			$this->proxy_checker->log($bool1);
			$this->assertEquals(
				$bool2,
				$this->proxy_checker->getParams()->isLog()
			);
		}
		
		public function testThread()
		{
			$method = 'thread';
			$this->assertTrue($this->class->hasMethod($method));
			
			$this->assertIsInt($this->proxy_checker->getParams()->getThread());
		}
		
		public function booleanProvider()
		{
			return [
				
				'1' => [1, true],
				'0' => [0, false],
				'str' => ['0', false],
				'str1' => ['w', true],
				'null' => ['', false],
				'null1' => ["", false],
				'true' => [true, true],
				'false' => [false, false],
			];
		}
		
		public function intProvider()
		{
			return [
				'1' => [0, 0],
				'2' => [1, 1],
				'3' => [777, 777],
			];
		}
		
		public function stringProvider()
		{
			return [
				'1' => ['0', '0'],
				'2' => ['w', 'w'],
				'3' => ['', ''],
				'4' => ["", ""],
			];
		}
		
		/**
		 * @dataProvider intProvider
		 */
		public function testNumThread($first_int, $last_int)
		{
			$this->proxy_checker->thread($first_int);
			$this->assertEquals(
				$last_int,
				$this->proxy_checker->getParams()->getThread()
			);
		}
		
		public function testUrl()
		{
			$method = 'url';
			$this->assertTrue($this->class->hasMethod($method));
			
			$this->assertIsString($this->proxy_checker->getParams()->getUrl());
		}
		
		/**
		 * @dataProvider stringProvider
		 */
		public function testStringUrl($str1, $str2)
		{
			$this->proxy_checker->url($str1);
			$this->assertEquals(
				$str2,
				$this->proxy_checker->getParams()->getUrl()
			);
		}
		
		public function test__construct()
		{
			$property = 'params';
			$this->assertTrue($this->class->hasProperty($property));
			
			$this->assertInstanceOf(
				ProxyCheckerParams::class,
				$this->proxy_checker->getParams()
			);
		}
		
		public function testShuffle()
		{
			$method = 'shuffle';
			$this->assertTrue($this->class->hasMethod($method));
			
			$this->assertIsBool($this->proxy_checker->getParams()->isShuffle());
		}
		
		/**
		 * @dataProvider booleanProvider
		 */
		public function testCheckBoolShuffle($first_bool, $last_bool)
		{
			$this->proxy_checker->shuffle($first_bool);
			$this->assertEquals(
				$last_bool,
				$this->proxy_checker->getParams()->isShuffle()
			);
		}
		
		
		public function testExecute()
		{
			$method = 'execute';
			$this->assertTrue($this->class->hasMethod($method));
			
		}
		
		public function testArrayLoad()
		{
			$method = 'load';
			$this->assertTrue($this->class->hasMethod($method));
			
			$test_array = [
				'119.29.135.226:80',
				'36.66.232.157:8080',
				'95.211.216.20:36650',
				'95.211.216.20:36335',
			];
			$this->proxy_checker->load($test_array);
			$this->assertEquals(
				$test_array,
				$this->proxy_checker->getParams()->getLoad()
			);
			$this->assertIsArray($this->proxy_checker->getParams()->getLoad());
			
		}
		
		/**
		 * @dataProvider stringProvider
		 */
		public function testStringLoad($str1, $str2)
		{
			$this->proxy_checker->load($str1);
			$this->assertEquals(
				$str2,
				$this->proxy_checker->getParams()->getLoad()
			);
			$this->assertIsString($this->proxy_checker->getParams()->getLoad());
		}
		
		public function testIsArrayGetArrayResult()
		{
			$method = 'getArrayResult';
			$this->assertTrue($this->class->hasMethod($method));
			
			$this->assertIsArray($this->proxy_checker->getArrayResult());
		}
		
		public function testEmptyGetArrayResult()
		{
			$method = 'getArrayResult';
			$this->assertTrue($this->class->hasMethod($method));
			
			$this->assertEmpty($this->proxy_checker->getArrayResult());
		}
		
		public function testSave()
		{
			$method = 'save';
			$this->assertTrue($this->class->hasMethod($method));
			
			$this->assertIsString($this->proxy_checker->getParams()->getSave());
		}
		
		/**
		 * @dataProvider stringProvider
		 */
		public function testStringSave($str1, $str2)
		{
			$this->proxy_checker->save($str1);
			$this->assertEquals(
				$str2,
				$this->proxy_checker->getParams()->getSave()
			);
		}
	}
