<?php
/**
 * application configurations shared by all test types
 */
return [
	'components' => [
		'user' => [
			'identityClass' => 'frontend\tests\unit\mocks\User',
		]
	]
];
