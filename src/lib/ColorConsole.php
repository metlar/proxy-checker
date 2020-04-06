<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib;
	
	class ColorConsole
	{
		const START_STR = "\033";
		const END_STR = "\033[0m";
		
		/**
		 * @var array
		 */
		public static $array_color
			= array(
				'disabled' => "[31m",
				'enabled' => "[32m",
			);
		
		/**
		 * Method st color text in console
		 *
		 * @param string $color color text in console
		 * @param string $str
		 *
		 * @return string
		 */
		static function color($color, $str)
		{
			if(empty(ColorConsole::$array_color[$color]))return $str;
			return ColorConsole::START_STR.ColorConsole::$array_color[$color]
				.$str.ColorConsole::END_STR;
		}
		
		/**
		 * @param string $color_code [31m red color code
		 * @param string $str
		 *
		 * @return string
		 */
		static function setColor($color_code, $str)
		{
			return ColorConsole::START_STR.$color_code.$str
				.ColorConsole::END_STR;
		}
	}