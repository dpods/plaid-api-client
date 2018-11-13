<?php

namespace Plaid\Api;

use ArrayObject;

class Categories extends Api
{
    public function get()
    {
        return $this->client()->postPublic('/categories/get', new ArrayObject());
    }
}
