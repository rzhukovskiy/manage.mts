<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),

			'db'=>require(dirname(__FILE__).'/database-test.php'),

			'authManager'=>array(
				'class'=>'PhpAuthManager',
				'defaultRoles' => array('guest'),
			),
		),
	)
);
