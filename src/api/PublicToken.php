<?php

namespace Plaid\Api;

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
