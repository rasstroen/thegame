<?php

namespace Application;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * ���-����������, �����������, ������������, ����� ����� � �������
 *
 * Class Web
 * @package Application
 */
class Web extends Base
{


	/**
	 * ��������, ������������ �� ����� �������� ���������� ����������
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
	 * ��������� ����������
	 */
	public function run()
	{
		$this->log('application started');
		/**
		 * ������ ����� ������������ ���������� ��������
		 */
		$this->controller->run();
		return $this;
	}



	/**
	 * �������� � �������
	 */
	public function response()
	{
	}
}