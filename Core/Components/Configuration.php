<?php

namespace Components;


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

	public function __construct(array $configuration)
	{
		$this->configuration = $configuration;
		return $this;
	}
}