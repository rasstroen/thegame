<?php
namespace Application;

use Components\AbstractComponent;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Базовый класс для приложения. Содержит свойства и методы, общия для Web приложения и
 * для консольного приложения
 *
 *
 * Class Base
 * @package Application
 *
 *
 */
abstract class Base
{
	/**
	 * @var array
	 */
	protected $configuration = array();

	/**
	 * @var AbstractComponent[]
	 */
	protected $components;

	/**
	 * @var Logger
	 */
	private $logger;

	abstract public function run();

	/**
	 * Создаем экземпляр приложения
	 *
	 * @param array $configuration
	 *
	 * @throws \Exception
	 */
	public function __construct(array $configuration)
	{
		$this->configuration = $configuration;
		$this->init();

		return $this;
	}

	/**
	 * Компоненты доступны через геттер приложения, описаны в конфигурации
	 * компонентов (config/components.php)
	 *
	 * @param $componentName
	 */
	public function __get($componentName)
	{
		if(empty($this->configuration['components'][$componentName]))
		{
			throw new \Exception('missed component ' . $componentName . ' configuration');
		}

		if(!isset($this->components[$componentName]))
		{
			$componentClassName               = $this->configuration['components'][$componentName];
			$this->components[$componentName] = new $componentClassName($this);
		}

		return $this->components[$componentName];
	}

	/**
	 * Логгируем. Используется для всего приложения как умолчательный лог
	 *
	 * @param     $message
	 * @param int $level
	 *
	 * @return $this
	 */
	public function log($message, $level = Logger::INFO)
	{
		$this->logger->log($level, $message);

		return $this;
	}

	protected function init()
	{
		/**
		 * Создаем логгер, который будет использоваться для записи логов в файл
		 */
		$this->logger = new Logger('application');

		if(empty($this->configuration['local']['logs']['path_to_debug_log']))
		{
			throw new \Exception('path to debug log is undefined');
		}
		/**
		 * Устанавливаем логгеру настройку "писать в файл" и указываем минимальный уровень лога для записи в файл
		 *
		 * @todo минимальный уровень лога брать из настроек
		 */
		$this->logger->pushHandler(
			new StreamHandler($this->configuration['local']['logs']['path_to_debug_log'], Logger::DEBUG)
		);
	}
}