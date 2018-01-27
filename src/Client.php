<?php

namespace Plaid;

require_once __DIR__ . '/Requester.php';
require_once __DIR__ . '/api/Transactions.php';
require_once __DIR__ . '/api/Item.php';

use Plaid\Item;
use Plaid\Transactions;
use Plaid\Requester;

class Client
{
    const VERSION = '0.1.0';

    const DEFAULT_TIMEOUT = 600; // 10 minutes

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $env;

    /**
     * Plaid constructor.
     * @param $clientId
     * @param $secret
     */
    public function __construct($clientId, $secret, $publicKey, $env, $timeout = self::DEFAULT_TIMEOUT)
    {
        $this->clientId = $clientId;
        $this->secret = $secret;
        $this->publicKey = $publicKey;
        $this->env = $env;
        $this->timeout = $timeout;

        $this->requester = new Requester();

        $this->transactions = new Transactions($this);
        $this->item = new Item($this);
    }

    public function item()
    {
        return $this->item;
    }

    public function transactions()
    {
        return $this->transactions;
    }

    public function post($path, $data)
    {
        $postData = array_merge($data, [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
        ]);

        return $this->_post($path, $postData);
    }

    private function _post($path, $data)
    {
        return $this->requester()->postRequest(
            implode(['https://', $this->env, '.plaid.com', $path]),
            $data,
            $this->timeout
        );
    }

    private function requester()
    {
        return $this->requester;
    }

}
