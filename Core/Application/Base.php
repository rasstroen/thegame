<?php
namespace Application;

use Components\AbstractComponent;
use Components\Configuration;
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
 * @property Configuration $configuration
 *
 *
 */
abstract class Base
{
	/**
	 * @var AbstractComponent[]
	 */
	protected $components;

	/**
	 * @var Logger
	 */
	private $logger;

	/**
	 * @var \Classes\Configuration
	 */
	public $configuration;

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
		/**
		 * Т.к. создание компонентов происходит из конфига, а компонента конфига ещё нет, создаем его сразу руками
		 */

		$this->configuration = $this->components['configuration'] = new \Classes\Configuration($configuration);

		$this->init();

		return $this;
	}

	/**
	 * Компоненты доступны через геттер приложения, описаны в конфигурации
	 * компонентов (config/components.php)
	 *
	 * @param $componentName
	 *
	 * @return AbstractComponent
	 * @throws \Exception
	 */
	public function __get($componentName)
	{
		if(empty($this->configuration->configuration['components'][$componentName]))
		{
			throw new \Exception('missed component ' . $componentName . ' configuration');
		}

		if(!isset($this->components[$componentName]))
		{
			$componentClassName               = $this->configuration->configuration['components'][$componentName];
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
		if(empty($this->logger))
		{
			$this->initLogger();
		}
		$this->logger->log($level, $message);

		return $this;
	}

	protected function initLogger()
	{
		if(empty($this->configuration->configuration['local']['logs']['path_to_debug_log']))
		{
			throw new \Exception('path to debug log is undefined');
		}

		$this->logger = new Logger('application');
		/**
		 * Устанавливаем логгеру настройку "писать в файл" и указываем минимальный уровень лога для записи в файл
		 *
		 * @todo минимальный уровень лога брать из настроек
		 */
		$this->logger->pushHandler(
			new StreamHandler($this->configuration->configuration['local']['logs']['path_to_debug_log'], Logger::DEBUG)
		);

		return $this;
	}

	protected function init()
	{
	}
}