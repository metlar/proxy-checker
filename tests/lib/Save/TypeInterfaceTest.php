<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	use PHPUnit\Framework\TestCase;
	
	class TypeInterfaceTest extends TestCase
	{
		private $class;
		
		public function setUp(): void
		{
			$this->class = new \ReflectionClass(TypeInterface::class);
		}
		
		public function test_It_is_interface(): void
		{
			$this->assertTrue($this->class->isInterface());
		}
		
		public function testGetDataType()
		{
			$method = 'getDataType';
			
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
