<?php

namespace Components;

use Application\Base;
use Monolog\Logger;

class AbstractComponent
{

	/**
	 * @var Base
	 */
	private $application;

	public function __construct(Base $application)
	{
		$this->application = $application;
		$this->application->log('constructing ' . get_called_class() . ' component', Logger::DEBUG);
	}
}