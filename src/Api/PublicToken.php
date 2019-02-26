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

    public function create($accessToken)
    {
        return $this->client->post('/item/public_token/create', [
            'access_token' => $accessToken
        ]);
    }
}
