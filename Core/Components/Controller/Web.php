<?php

namespace Components\Controller;

use Components\WebComponent;

class Web extends WebComponent
{
	/**
	 * Запускаем контроллер
	 */
	public function run()
	{
		/**
		 * Определяем, какую страницу нужно обрабатывать,
		 * какие переменные содержаться в url
		 */
		$pageConfiguration = $this->getApp()->routing->getPageConfiguration();

		/**
		 * Получаем список модулей, находящихся на странице
		 */

		/**
		 * Выполянем каждый модуль
		 */
	}

	/**
	 * Отрисовываем ответ
	 */
	public function response()
	{

	}
}