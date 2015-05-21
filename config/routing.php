<?php

$modules = array(
	'test'  => array(
		'className' => '\Module\Test\Test',
		'template'  => 'test',
		'action'    => 'show',
		'mode'      => 'test'
	),
);

return array(
	'map'     => array(
		''          => 'index',
		'test'    => array(
			'%s' => array(
				'' => 'test'
			),
			'%d' => array(
				'' => 'test',
			),
			'hello' => array(
				'' => 'test'
			)
		)
	),
	'pages'   => array(
		/**
		 * Главный фрейм
		 */
		'test'     => array(
			'layout' => 'test',
			'title'  => 'тест'
		),
	),
	/**
	 * Умолчания для лайаутов
	 */
	'layouts' => array(
		/**
		 * Умолчания для админки
		 */
		'test' => array(
			'css'    => array(
				'reset' => '/css/reset.css',
				'test' => '/css/test.css',
			),
			'blocks' => array(
				'content' => array(
					'test' => $modules['test']
				)
			)
		),
	)
);