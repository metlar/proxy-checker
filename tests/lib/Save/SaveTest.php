<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	use Metlar\Proxy\ProxyCheckerParams;
	use PHPUnit\Framework\TestCase;
	
	class SaveTest extends TestCase
	{
		private $reflection;
		private $params;
		private $class;
		
		public function setUp(): void
		{
			$this->reflection = new \ReflectionClass(Save::class);
			$this->params = new ProxyCheckerParams();
			$this->class = new Save($this->params);
			
		}
		
		public function testCreate()
		{
			$this->assertInstanceOf(
				TypeInterface::class,
				$this->class->create()
			);
		}
		
		public function testGetParams()
		{
			$this->assertInstanceOf(
				ProxyCheckerParams::class,
				$this->class->getParams()
			);
		}
	}
