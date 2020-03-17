<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	
	class Json implements TypeInterface
	{
		private $data;
		
		public function __construct($data)
		{
			$this->data = $data;
		}
		
		public function getData()
		{
			return json_encode($this->data);
		}
		
	}