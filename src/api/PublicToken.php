<?php

namespace Plaid;

require_once __DIR__ . '/Api.php';

use Plaid\Api;

class PublicToken extends Api
{
    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function exchange($publicToken)
    {
        return $this->client()->post('/item/public_token/exchange', [
            'public_token' => $publicToken
        ]);
    }
}
