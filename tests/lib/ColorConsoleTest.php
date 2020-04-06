<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib;
	
	use PHPUnit\Framework\TestCase;
	
	class ColorConsoleTest extends TestCase
	{
		
		public function testNullColor()
		{
			$val = 'string test';
			$this->assertEquals($val, ColorConsole::color(null,$val));
		}
		
		public function colorProvider()
		{
			return [
				'disabled' => ['disabled'],
				'enabled' => ['enabled'],
			];
		}
		
		/**
		 * @dataProvider colorProvider
		 */
		public function testListColor($color)
		{
			$val = 'string test';
			$str = ColorConsole::START_STR.ColorConsole::$array_color[$color]
				.$val.ColorConsole::END_STR;
			$this->assertEquals($str, ColorConsole::color($color,$val));
		}
		
		public function testSetColor()
		{
			$val = 'test str';
			$color_code = '[31m';
			$str = ColorConsole::START_STR.$color_code.$val
						.ColorConsole::END_STR;
			$this->assertEquals($str, ColorConsole::setColor($color_code,$val));
		}
	}
