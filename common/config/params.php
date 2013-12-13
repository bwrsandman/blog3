<?php

Yii::setAlias('common', realpath(__DIR__ . '/../'));
Yii::setAlias('frontend', realpath(__DIR__ . '/../../frontend'));
Yii::setAlias('backend', realpath(__DIR__ . '/../../backend'));
Yii::setAlias('console', realpath(__DIR__ . '/../../console'));

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
