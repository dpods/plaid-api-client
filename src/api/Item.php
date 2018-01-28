<?php

namespace Plaid\Api;

class Item extends Api
{
    public function __construct($client)
    {
        parent::__construct($client);

        $this->publicToken = new PublicToken($client);
    }

    public function publicToken()
    {
        return $this->publicToken;
    }
}
