<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	
	class Txt implements TypeInterface
	{
		private $data;
		
		public function __construct($data)
		{
			$this->data = $data;
		}
		
		public function getData()
		{
			if (!empty($this->data['enabled']['short'])) // возвращаем только если есть активные(enabled) proxy
			{
				return implode(
						PHP_EOL,
						array_values($this->data['enabled']['short'])
					).PHP_EOL;
			}
		}
		
	}