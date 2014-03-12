<?php

return array(
    'adminEmail'          => 'admin@example.com',
    'supportEmail'        => 'support@example.com',

    'components.cache'    => [
        'class' => 'yii\caching\FileCache',
    ],

    'components.mail'     => [
        'class' => 'yii\swiftmailer\Mailer',
    ],

    'components.sphinxDb' => array(
        'class'    => 'nizsheanez\sphinx\Connection',
        'dsn'      => 'mysql:host=localhost;port=9306;dbname=rt',
        'username' => 'root',
        'password' => '',
        'charset'  => 'utf8',
    ),
);
