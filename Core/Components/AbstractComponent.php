<?php

namespace Components;

use Application\Base;
use Monolog\Logger;

class AbstractComponent
{

	/**
	 * @var Base
	 */
	protected $application;

	public function __construct(Base $application)
	{
		$this->application = $application;
		$this->application->log('constructing ' . get_called_class() . ' component', Logger::DEBUG);
		$this->init();
	}

	protected function init()
	{
		return $this;
	}

	/**
	 * @return Base
	 */
	protected function getApp()
	{
		return $this->application;
	}
}