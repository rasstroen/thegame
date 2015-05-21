<?php
namespace Classes;

use Classes\Util\UtilArray;

class PageConfiguration
{
	/**
	 * @var string
	 */
	private $pageKey;

	/**
	 * @var array
	 */
	private $variables;

	/**
	 * @var array
	 */
	private $page;

	public function __construct($configuration)
	{
		$this->pageKey   = $configuration[0];
		$this->variables = $configuration[1];
	}

	/**
	 * @return string
	 */
	public function getPageKey()
	{
		return $this->pageKey;
	}

	public function setPage(array $page, array $layouts)
	{
		if($page['layout'])
		{
			if(isset($layouts[$page['layout']]))
			{
				$page = UtilArray::mergeArray(
					array(
						$page,
						$layouts[$page['layout']]
					),
					true
				);
			}
		}
		$this->page = $page;
	}

	public function getBlocks()
	{
		return $this->page['blocks'];
	}
}