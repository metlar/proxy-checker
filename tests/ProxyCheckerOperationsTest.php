<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy;
	
	use PHPUnit\Framework\TestCase;
	
	class ProxyCheckerOperationsTest extends TestCase
	{
		private $params;
		private $class;
		private $reflection;
		
		public function setUp()
		{
			$this->params = new ProxyCheckerParams();
			$this->class = new ProxyCheckerOperations($this->params);
			$this->reflection = new \ReflectionClass(ProxyCheckerOperations::class);
		}
		
		
		public function testPrepareArray()
		{
			$array_test = [
				'45.76.43.163:8080',
				'44.76.43.163:8080',
				'43.76.43.163:8080',
				'42.76.43.163:8080',
				'41.76.43.163:8080',
				'40.76.43.163:8080',
			];
			$array_result = [
				[
					'45.76.43.163:8080',
					'44.76.43.163:8080',
				],
				[
					'43.76.43.163:8080',
					'42.76.43.163:8080',
				],
				[
					'41.76.43.163:8080',
					'40.76.43.163:8080',
				],
			];
			$this->params->setThread(2);
			$this->assertEquals($array_result, $this->class->prepareArray($array_test));
			$this->params->setShuffle(1);
			$this->assertNotEquals($array_result, $this->class->prepareArray($array_test));
			
		}

		public function testHasOperation()
		{
			$method= 'operation';
			$this->assertTrue($this->reflection->hasMethod($method));
		}
		
		public function testHasPrepareArray()
		{
			$method= 'prepareArray';
			$this->assertTrue($this->reflection->hasMethod($method));
		}
		
		public function testHasSaveToFile()
		{
			$method= 'saveToFile';
			$this->assertTrue($this->reflection->hasMethod($method));
		}
		
		public function testHasCreateListProxy()
		{
			$method= 'createListProxy';
			$this->assertTrue($this->reflection->hasMethod($method));
		}
		
		public function testHasSetLogger()
		{
			$method= 'setLogger';
			$this->assertTrue($this->reflection->hasMethod($method));
		}
	}
