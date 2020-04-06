<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	use Metlar\Proxy\ProxyCheckerParams;
	use PHPUnit\Framework\TestCase;
	
	class SaveAbstractTest extends TestCase
	{
		private $class;
		
		public function setUp(): void
		{
			$this->class = new \ReflectionClass(SaveAbstract::class);
		}
		
		public function test_It_is_abstract(): void
		{
			$this->assertTrue($this->class->isAbstract());
		}
		
		
		public function testCreate()
		{
			$method = 'create';
			$this->assertTrue($this->class->hasMethod($method));
			
			//$this->assertInstanceOf(TypeInterface::class, (new Save(new ProxyCheckerParams()))->create());
		}
		
		public function testGetFullNameFile()
		{
			$method = 'getFullNameFile';
			
			$this->assertTrue($this->class->hasMethod($method));
			
			/**
			 * @var \ReflectionNamedType|null
			 */
			$returnType = $this->class->getMethod($method)->getReturnType();
			
			$this->assertTrue(
				null === $returnType,
				'Method returns invalid type'
			);
		}
		
		public function testSaveToFile()
		{
			$method = 'saveToFile';
			
			$this->assertTrue($this->class->hasMethod($method));
			
			/**
			 * @var \ReflectionNamedType|null
			 */
			$returnType = $this->class->getMethod($method)->getReturnType();
			
			$this->assertTrue(
				null === $returnType,
				'Method returns invalid type'
			);
		}
	}
