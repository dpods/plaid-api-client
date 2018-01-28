<?php

namespace Plaid\Api;

use ArrayObject;

class Institutions extends Api
{
    public function get($count, $offset = 0)
    {
        return $this->client()->post('/institutions/get', [
            'count' => $count,
            'offset' => $offset
        ]);
    }

    public function getById($institutionId, $options = [])
    {
        // This will map to a JSON object even if it's empty
        $optionsObj = new ArrayObject($options);

        return $this->client()->postPublicKey('/institutions/get_by_id', [
            'institution_id' => $institutionId,
            'options' => $optionsObj
        ]);
    }

    public function search($query, $options = [], $products = null)
    {
        // This will map to a JSON object even if it's empty
        $optionsObj = new ArrayObject($options);

        return $this->client()->postPublicKey('/institutions/search', [
            'query' => $query,
            'options' => $optionsObj,
            'products' => $products
        ]);
    }
}
