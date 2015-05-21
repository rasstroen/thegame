<?php

namespace Components\Request;

use Components\WebComponent;

class Web extends WebComponent
{
	private $variables = array();

	/**
	 * @return string $_SERVER['REQUEST_URI']
	 */
	public function getRequestUrl()
	{
		return $this->getServerParam('REQUEST_URI');
	}

	/**
	 * Добавляем загловки для редиректа
	 *
	 * @param     $url
	 * @param int $httpCode
	 *
	 * @return $this
	 */
	public function redirect($url, $httpCode = 302)
	{
		header('Location: '. $url, true, $httpCode);
		return $this;
	}

	/**
	 * Возвращает значение из массивы $_SERVER по ключу $fieldName
	 *
	 * @param      $fieldName
	 * @param null $default
	 *
	 * @return null
	 */
	public function getServerParam($fieldName, $default = null)
	{
		return isset($this->variables['server'][$fieldName]) ? $this->variables['server'][$fieldName] : $default;
	}

	protected function init()
	{
		$this->processRequest();
		return $this;
	}

	/**
	 * Все переменные запроса сохраняем в свойства класса и ансетим глобальные переменные
	 * $_POST, $_GET, $_SERVER
	 */
	private function processRequest()
	{
		$this->variables['get']    = !empty($_GET) ? $_GET : null;
		$this->variables['post']   = !empty($_POST) ? $_POST : null;
		$this->variables['server'] = !empty($_SERVER) ? $_SERVER : null;
		unset($_GET);
		unset($_POST);
		unset($_SERVER);
	}
}