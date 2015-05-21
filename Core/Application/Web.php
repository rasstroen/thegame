<?php

namespace Application;

/**
 * Веб-приложение, запускается, отрабатывает, отдаёт ответ в браузер
 *
 * Class Web
 * @package Application
 *
 *
 * @property \Components\Controller\Web $controller
 * @property \Components\Request\Web    $request
 * @property \Components\Routing\Web    $routing
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
		$this->controller->response();
	}
}