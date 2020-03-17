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
		
		public static $array_color
			= array(
				'disabled' => "[31m",
				'enabled' => "[32m",
			);
		
		/**
		 * Method st color text in console
		 *
		 * @param $color color text in console
		 * @param $str   text
		 *
		 * @return string
		 */
		static function color($color, $str)
		{
			return ColorConsole::START_STR.ColorConsole::$array_color[$color]
				.$str.ColorConsole::END_STR;
		}
		
		/**
		 * @param $color_code [31m red color code
		 * @param $str        text
		 *
		 * @return string
		 */
		static function setColor($color_code, $str)
		{
			return ColorConsole::START_STR.$color_code.$str
				.ColorConsole::END_STR;
		}
	}