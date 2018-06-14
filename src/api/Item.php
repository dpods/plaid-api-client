<?php

namespace Plaid\Api;

class Item extends Api
{
    /**
     * @var PublicToken
     */
    protected $publicToken;

    /**
     * @var AccessToken
     */
    protected $accessToken;

    public function __construct($client)
    {
        parent::__construct($client);

        $this->publicToken = new PublicToken($client);
        $this->accessToken = new AccessToken($client);
    }

    public function publicToken()
    {
        return $this->publicToken;
    }

    public function accessToken()
    {
        return $this->accessToken;
    }

    public function get($accessToken)
    {
        return $this->client()->post('/item/get', [
            'access_token' => $accessToken
        ]);
    }

    public function delete($accessToken)
    {
        return $this->client()->post('/item/delete', [
            'access_token' => $accessToken
        ]);
    }
}
