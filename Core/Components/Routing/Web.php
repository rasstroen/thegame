<?php
namespace Components\Routing;

use Components\WebComponent;

class Web extends WebComponent
{
	public function getPageConfiguration()
	{
		/**
		 * Получаем текущий url
		 */
		$requestUri = $this->getApp()->request->getRequestUrl();
		/**
		 * Получаем индекс страницы и список переменных url
		 */
		var_dump($this->getPageKeyAndVariables($requestUri));
	}

	public function getPageKeyAndVariables($requestUri)
	{
		$map        = $this->getApp()->configuration->getRoutingMap();
		$parameters = '';
		if(strpos($requestUri, '?'))
		{
			list($requestUri, $parameters) = explode('?', $requestUri, 2);
			if($parameters)
			{
				$parameters = '?' . $parameters;
			}
		}
		$requestUriArray         = explode('/', $requestUri);
		$preparedRequestUriArray = array();
		foreach($requestUriArray as $uriPart)
		{
			if(trim($uriPart) !== '')
			{
				$preparedRequestUriArray[] = $uriPart;
			}
		}

		list($idealRequestUriParts, $pageKey, $uriVariables) = $this->findPageKey($map, $preparedRequestUriArray);

		if($pageKey)
		{
			$idealUrl = '/' . implode('/', $idealRequestUriParts) . $parameters;
		}
		else
		{
			$idealUrl = '/';
		}
		/**
		 * URL неправильный
		 */
		if($idealUrl !== $this->getApp()->request->getRequestUrl())
		{

			if($pageKey && ($pageKey !== 'index'))
			{
				$this->getApp()->request->redirect($idealUrl);
				$this->getApp()->end();
			}
			else
			{
				throw new \Exception(404);
			}

			return;
		}
		if($pageKey == '')
		{
			$pageKey = 'index';
		}


		return array($pageKey, $uriVariables);
	}

	private function findPageKey($map, $requestArray, $currentIndex = 0, &$idealRequestUriParts = array(), &$variables = array())
	{

		$currentUriPart = isset($requestArray[$currentIndex]) ? $requestArray[$currentIndex] : false;
		if(isset($map['_var']))
		{
			$variables[$map['_var']] = $requestArray[$currentIndex - 1];
			unset($map['_var']);
		}
		foreach($map as $key => $value)
		{
			if((string) $key === (string) $currentUriPart)
			{
				/**
				 * точное совпадение
				 */
				if($currentUriPart)
				{
					$idealRequestUriParts[] = $currentUriPart;
				}

				if(is_array($value))
				{
					return $this->findPageKey($value, $requestArray, $currentIndex + 1, $idealRequestUriParts, $variables);
				}
				else
				{
					return array($idealRequestUriParts, $value, $variables);
				}
			}
			elseif(($key == '%d') && is_numeric($currentUriPart))
			{
				/**
				 * цифра
				 */
				$idealRequestUriParts[] = $currentUriPart;

				if(is_array($value))
				{
					return $this->findPageKey($value, $requestArray, $currentIndex + 1, $idealRequestUriParts, $variables);
				}
				else
				{
					return array($idealRequestUriParts, $value, $variables);
				}
			}
			elseif($key == '%s' && $currentUriPart)
			{
				$idealRequestUriParts[] = $currentUriPart;

				if(is_array($value))
				{
					return $this->findPageKey($value, $requestArray, $currentIndex + 1, $idealRequestUriParts, $variables);
				}
				else
				{
					return array($idealRequestUriParts, $value, $variables);
				}
			}
		}

		if(isset($map['']) && !is_array($map['']))
		{
			return array($idealRequestUriParts, $map[''], $variables);
		}

		return array($idealRequestUriParts, false, $variables);
	}
}