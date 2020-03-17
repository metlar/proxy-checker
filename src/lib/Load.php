<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib;
	
	
	class Load
	{
		private $file_name = 'proxylist';
		private $fileData;
		
		public function __construct($file_name)
		{
			if ($file_name) {
				$this->file_name = $file_name;
			}
		}
		
		/**
		 * Load files
		 *
		 * @return $this
		 */
		public function loadFile()
		{
			$file = __DIR__.'/../../source/'.$this->file_name;
			$this->fileData = file_get_contents($file);
			
			return $this;
		}
		
		/**
		 * Explode data and trim
		 */
		public function addToArray()
		{
			$array_proxy = explode("\n", $this->fileData);
			$this->fileData = array_map('trim', $array_proxy);
		}
		
		/**
		 * @param $fileName
		 *
		 * @return $this
		 */
		public function setFileName($file_name)
		{
			$this->file_name = $file_name;
			
			return $this;
		}
		
		/**
		 * @return array
		 */
		public function getData()
		{
			if ($this->file_name) {
				$this->loadFile()->addToArray();
				
				return $this->fileData;
			}
			
			return [];
		}
		
		
	}