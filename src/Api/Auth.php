<?php

namespace Plaid\Api;

use ArrayObject;

class Auth extends Api
{
    public function get($accessToken, $options = [], $accountIds = null)
    {
        // This will map to a JSON object even if it's empty
        $optionsObj = new ArrayObject($options);

        if ($accountIds) {
            $optionsObj['account_ids'] = $accountIds;
        }

        return $this->client()->post('/auth/get', [
            'access_token' => $accessToken,
            'options' => $optionsObj
        ]);
    }
}
