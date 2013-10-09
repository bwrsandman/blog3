<?php
return array(
    'databases' => array(
        'mysql' => array(
            'dsn' => 'mysql:host=127.0.0.1;dbname=blog3',
            'username' => 'travis',
            'password' => '',
            'fixture' => __DIR__ . '/mysql.sql',
        ),
    ),
);