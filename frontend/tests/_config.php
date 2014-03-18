<?php
/**
 * application configurations shared by all test types
 */
return [
	'components' => [
//		'user' => [
//			'class' => '\frontend\tests\unit\mocks\User',
//            'identityClass' => '\frontend\tests\unit\mocks\UserIdentity',
//        ],
        'session' => [
            'class' => '\frontend\tests\unit\mocks\Session',
        ]
    ]
];
