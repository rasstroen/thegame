<?php

namespace Application;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Веб-приложение, запускается, отрабатывает, отдаёт ответ в браузер
 *
 * Class Web
 * @package Application
 */
class Web extends Base
{


	/**
	 * Действия, производимые во время создания экземпляра приложения
	 *
	 * @return $this
	 * @throws \Exception
	 */
	protected function init()
	{
		parent::init();


		return $this;
	}

	/**
	 * Запускаем приложение
	 */
	public function run()
	{
		$this->log('application started');
		/**
		 * Запрос будет обрабатывать контроллер страницы
		 */
		$this->controller->run();
		return $this;
	}



	/**
	 * Отвечаем в браузер
	 */
	public function response()
	{
	}
}