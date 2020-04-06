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
			if ($this->isEmptyArrayEnabled())
			{
				return implode(
						PHP_EOL,
						array_values($this->data['enabled']['short'])
					).PHP_EOL;
			}
			return PHP_EOL;
		}
		
		/**
		 * Check result array in enable
		 * @return bool
		 */
		protected function isEmptyArrayEnabled(){
			if (!empty($this->data) && !empty($this->data['enabled']) && !empty($this->data['enabled']['short'])) // return only enabled proxy
				return true;
			return false;
		}
		
	}