<?php

namespace Plaid\Api;

use ArrayObject;

class Transactions extends Api
{
    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function get($accessToken,
                        $startDate,
                        $endDate,
                        $options = [],
                        $accountIds = null,
                        $count = null,
                        $offset = null)
    {
        // This will map to a JSON object even if it's empty
        $optionsObj = new ArrayObject($options);

        if ($accountIds) {
            $optionsObj['account_ids'] = $accountIds;
        }

        if ($count) {
            $optionsObj['count'] = $count;
        }

        if ($offset) {
            $optionsObj['offset'] = $offset;
        }

        return $this->client()->post('/transactions/get', [
            'access_token' => $accessToken,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'options' => $optionsObj,
        ]);
    }

}
