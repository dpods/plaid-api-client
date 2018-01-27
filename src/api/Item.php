<?php

namespace DGlass;

require_once __DIR__ . '/Api.php';
require_once __DIR__ . '/PublicToken.php';

use DGlass\PublicToken;
use DGlass\Api;

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
