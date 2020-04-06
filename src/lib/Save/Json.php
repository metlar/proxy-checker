<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	
	class Json implements TypeInterface
	{
		/**
		 * @var array
		 */
		private $data;
		
		/**
		 * Json constructor.
		 *
		 * @param array $data
		 */
		public function __construct($data)
		{
			$this->data = $data;
		}
		
		/**
		 * @return string|false
		 */
		public function getDataType()
		{
			return json_encode($this->data);
		}
		
	}