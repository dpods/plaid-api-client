<?php

namespace Plaid\Api;

class CreditDetails extends Api
{
    public function get($accessToken)
    {
        return $this->client()->post('/credit_details/get', [
            'access_token' => $accessToken,
        ]);
    }
}
