<?php

namespace Plaid;

require_once __DIR__ . '/Api.php';
require_once __DIR__ . '/PublicToken.php';

use Plaid\PublicToken;
use Plaid\Api;

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
