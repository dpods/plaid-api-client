<?php

namespace Plaid\Api;

class AccessToken extends Api
{
    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function invalidate($accessToken)
    {
        return $this->client()->post('/item/access_token/invalidate', [
            'access_token' => $accessToken
        ]);
    }

    public function updateVersion($accessToken)
    {
        return $this->client()->post('/item/access_token/update_version', [
            'access_token' => $accessToken
        ]);
    }
}
