<?php

namespace Components\Controller;

use Classes\PageConfiguration;
use Components\WebComponent;

class Web extends WebComponent
{
	/**
	 * @var PageConfiguration
	 */
	private $pageConfiguration;

	/**
	 * Запускаем контроллер
	 */
	public function run()
	{
		/**
		 * Определяем, какую страницу нужно обрабатывать,
		 * какие переменные содержаться в url
		 */
		$this->pageConfiguration = $this->getApp()->routing->getPageConfiguration();

		/***
		 * Загружаем конфигурацию страницы из роутинга
		 */
		$this->pageConfiguration->setPage(
			$this->getApp()->configuration->getPageConfiguration(
				$this->pageConfiguration->getPageKey()
			),
			$this->getApp()->configuration->getLayouts()
		);
		/**
		 * Выполняем модули
		 */
		foreach($this->pageConfiguration->getBlocks() as $blockName => $modules)
		{
			$this->getApp()->log('processing block ' . $blockName);
			foreach($modules as $moduleName => $module)
			{
				$this->getApp()->log('running module ' . $moduleName . ' ' .print_r($module, 1));
			}
		}
	}

	/**
	 * Отрисовываем ответ
	 */
	public function response()
	{
	}
}