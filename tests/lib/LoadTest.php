<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib;
	
	use Metlar\Proxy\ProxyCheckerParams;
	use PHPUnit\Framework\TestCase;
	
	class LoadTest extends TestCase
	{
		private $params;
		private $class;
		
		public function setUp()
		{
			$this->params = new ProxyCheckerParams();
			$this->class = new Load($this->params);
		}
		public function testLoadFile()
		{
			$this->assertIsString($this->class->loadFile());
		}
		
		public function testAddToArray()
		{
			$this->assertIsArray($this->class->addToArray('127'));
		}
		
		public function testGetData()
		{
			$this->assertIsArray($this->class->getData());
		}
	}
