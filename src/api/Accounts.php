<?php

namespace Plaid\Api;

use ArrayObject;

class Accounts extends Api
{
    public function get($accessToken, $options = [], $accountIds = null)
    {
        // This will map to a JSON object even if it's empty
        $optionsObj = new ArrayObject($options);

        if ($accountIds) {
            $optionsObj['account_ids'] = $accountIds;
        }

        return $this->client()->post('/accounts/get', [
            'access_token' => $accessToken,
            'options' => $optionsObj
        ]);
    }
}
