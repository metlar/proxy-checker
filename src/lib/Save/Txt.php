<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	class Txt implements TypeInterface
	{
		/**
		 * @var array
		 */
		private $data;
		
		/**
		 * Txt constructor.
		 *
		 * @param array $data
		 */
		public function __construct($data)
		{
			$this->data = $data;
		}
		
		/**
		 * @return string
		 */
		public function getDataType()
		{
			$result = '';
			$delimiter = "\t";
			if ($this->isEmptyArrayEnabled())
				foreach ($this->data['enabled']['full'] as $item)
					$result .= $item['url']. $delimiter .$item['date'].PHP_EOL;
					
			return $result;
		}
		
		/**
		 * Check result array in enable
		 *
		 * @return bool
		 */
		private function isEmptyArrayEnabled()
		{
			if (!empty($this->data) && !empty($this->data['enabled']) && !empty($this->data['enabled']['full'])) // return only enabled proxy
				return true;
			
			return false;
		}
		
	}