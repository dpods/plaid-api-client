<?php

namespace Plaid\Api;

class Income extends Api
{
    public function get($accessToken)
    {
        return $this->client()->post('/income/get', [
            'access_token' => $accessToken,
        ]);
    }

}
