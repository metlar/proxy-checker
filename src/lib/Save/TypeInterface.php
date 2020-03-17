<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	interface TypeInterface
	{
		/**
		 * Реавлизация метода типа данных
		 *
		 * @return string
		 */
		public function getData();
	}