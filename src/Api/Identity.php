<?php

namespace Plaid\Api;

class Identity extends Api
{
    public function get($accessToken)
    {
        return $this->client()->post('/identity/get', [
            'access_token' => $accessToken,
        ]);
    }

}
