<?php

namespace common\components;

use nizsheanez\JsonRpc\Client;

class ClientApi extends Client
{
    public function __construct($url = null)
    {
        if (!$url) {
            $this->url = 'http://localhost:3000';
        }
    }
}