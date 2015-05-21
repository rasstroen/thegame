<?php

namespace Classes;


class Configuration
{
	/**
	 * @var array
	 * @todo сделать приватным
	 */
	public $configuration = array();


	/**
	 * Возвращает конфигурацию роутинга из настроек роутинга
	 *
	 * @return array
	 */
	public function getRoutingMap()
	{
		return $this->configuration['routing']['map'];
	}

	public function getPageConfiguration($pageIndex)
	{
		if(!isset($this->configuration['routing']['pages'][$pageIndex]))
		{
			/**
			 * @todo 404
			 */
			throw new \Exception('no configuration for page with index ' . $pageIndex);
		}
		return $this->configuration['routing']['pages'][$pageIndex];
	}

	public function getLayouts()
	{
		return $this->configuration['routing']['layouts'];
	}

	public function __construct(array $configuration)
	{
		$this->configuration = $configuration;
		return $this;
	}
}