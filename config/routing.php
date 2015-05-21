<?php

$modules = array(
	'test' => array(
		'className' => '\Module\Test\Test',
		'template'  => 'test',
		'action'    => 'show',
		'mode'      => 'test'
	),
);

return array(
	'map'     => array(
		''     => 'index',
		'test' => array(
			'_var'  => 'testVar1',
			'hello' => array(
				''     => 'test', // /test/hello
				'_var' => 'testVar4',
			),
			'%s'    => array(
				''     => 'test', // /test/any_string
				'_var' => 'testVar2',
			),
			'%d'    => array(
				''     => 'test', // /test/any_number
				'_var' => 'testVar3',
			),
		)
	),
	'pages'   => array(
		/**
		 * Главный фрейм
		 */
		'test' => array(
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
				'test'  => '/css/test.css',
			),
			'blocks' => array(
				'testBlock' => array(
					'testModule' => $modules['test']
				)
			)
		),
	)
);