<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	interface TypeInterface
	{
		/**
		 * Get type data
		 *
		 * @return string|false
		 */
		public function getDataType();
	}