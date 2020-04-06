<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	use PHPUnit\Framework\TestCase;
	
	class JsonTest extends TestCase
	{
		private $class;
		
		public function setUp()
		{
			$this->class = new Json([3,4,4,4]);
		}
		public function testGetDataType()
		{
			$this->assertIsString($this->class->getDataType());
		}
	}
