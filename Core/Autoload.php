<?php

class Autoload
{
	private static $root;

	public static function init(array $configuration)
	{
		if(empty($configuration['local']['root']))
		{
			throw new Exception('root path is not definrd');
		}
		self::$root = $configuration['local']['root'];

		/**
		 * composer autoloader
		 */
		require_once self::$root . 'vendor/autoload.php';
	}
}