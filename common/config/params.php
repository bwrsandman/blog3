<?php

Yii::setAlias('common', __DIR__ . '/../');
Yii::setAlias('frontend', __DIR__ . '/../../frontend');
Yii::setAlias('backend', __DIR__ . '/../../backend');

return array(
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',

    'components.cache' => array(
        'class' => 'yii\caching\FileCache',
    ),
    'components.sphinxDb' => array(
        'class' => 'nizsheanez\sphinx\Connection',
        'dsn' => 'mysql:host=localhost;port=9306;dbname=rt',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ),
);
