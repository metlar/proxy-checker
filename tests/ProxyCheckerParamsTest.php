<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy;
	
	use PHPUnit\Framework\TestCase;
	
	class ProxyCheckerParamsTest extends TestCase
	{
		private $class;
		
		protected function setUp(): void
		{
			$this->class = new ProxyCheckerParams();
			
		}
		
		public function testSetResultArray()
		{
			$value = [1,2,3,4,5,6];
			$this->class->setResultArray($value);
			$this->assertEquals($value, $this->class->getResultArray());
		}
		
		public function testSetThread()
		{
			$value = 5;
			$this->class->setThread($value);
			$this->assertEquals($value, $this->class->getThread());
		}
		
		public function testSetLoadPathFile()
		{
			$value = 'text';
			$this->class->setLoadPathFile($value);
			$this->assertEquals($value, $this->class->getLoadPathFile());
		}
		
		public function testSetResultFileName()
		{
			$value = 'text';
			$this->class->setResultFileName($value);
			$this->assertEquals($value, $this->class->getResultFileName());
		}
		
		public function testSetLoggerName()
		{
			$value = 'text';
			$this->class->setLoggerName($value);
			$this->assertEquals($value, $this->class->getLoggerName());
		}
		
		public function testStringSetLoad()
		{
			$value = 'text';
			$this->class->setLoad($value);
			$this->assertEquals($value, $this->class->getLoad());
		}
		
		public function testArraySetLoad()
		{
			$value = ['w','1',true, null, 1, 0];
			$this->class->setLoad($value);
			$this->assertEquals($value, $this->class->getLoad());
		}
		
		public function testStringSetLogger()
		{
			$value = 'text';
			$this->class->setLogger($value);
			$this->assertEquals($value, $this->class->getLogger());
		}
		public function testArraySetLoggerd()
		{
			$value = ['w','1',true, null, 1, 0];
			$this->class->setLogger($value);
			$this->assertEquals($value, $this->class->getLogger());
		}
		
		public function testSetUrl()
		{
			$value = 'text';
			$this->class->setUrl($value);
			$this->assertEquals($value, $this->class->getUrl());
		}
		
		public function testSetListProxy()
		{
			$value = ['w','1',true, null, 1, 0];
			$this->class->setListProxy($value);
			$this->assertEquals($value, $this->class->getListProxy());
		}
		
		public function testSetLoggerPath()
		{
			$value = 'text';
			$this->class->setLoggerPath($value);
			$this->assertEquals($value, $this->class->getLoggerPath());
		}
		
		public function testSetResultPathFile()
		{
			$value = 'text';
			$this->class->setResultPathFile($value);
			$this->assertEquals($value, $this->class->getResultPathFile());
		}
		
		public function testSetShuffle()
		{
			$value = true;
			$this->class->setShuffle($value);
			$this->assertEquals($value, $this->class->isShuffle());
		}
		
		public function testSetSave()
		{
			$value = 'text';
			$this->class->setSave($value);
			$this->assertEquals($value, $this->class->getSave());
		}
		
		public function testSetLog()
		{
			$value = true;
			$this->class->setLog($value);
			$this->assertEquals($value, $this->class->isLog());
		}
	}
