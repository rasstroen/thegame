<?php
return array(
	/**
	 * Настройки, специфичные для сервера, хранятся в файле local.php
	 */
	'local'      => require_once 'local.php',
	'components' => require_once 'components.php',
	'routing'    => require_once 'routing.php'
);