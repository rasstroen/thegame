<?php

namespace Components;

use Application\Web;

class WebComponent extends AbstractComponent
{

	/**
	 * @var Web
	 */
	protected $application;

	/**
	 * @return Web
	 */
	protected function getApp()
	{
		return $this->application;
	}
}