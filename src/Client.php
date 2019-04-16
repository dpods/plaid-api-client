<?php

namespace Plaid;

use Plaid\Api\Accounts;
use Plaid\Api\AssetReport;
use Plaid\Api\Auth;
use Plaid\Api\Balance;
use Plaid\Api\Categories;
use Plaid\Api\CreditDetails;
use Plaid\Api\Identity;
use Plaid\Api\Income;
use Plaid\Api\Institutions;
use Plaid\Api\Item;
use Plaid\Api\Transactions;

class Client
{
    const VERSION = '0.4.1';

    const DEFAULT_TIMEOUT = 600; // 10 minutes

    const DEFAULT_API_VERSION = '2018-05-22'; // starting api version

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
    public function __construct($clientId, $secret, $publicKey, $env, $apiVersion = null, $suppressWarnings = false, $timeout = self::DEFAULT_TIMEOUT)
    {
        $this->clientId = $clientId;
        $this->secret = $secret;
        $this->publicKey = $publicKey;
        $this->env = $env;
        $this->suppressWarnings = $suppressWarnings;
        $this->timeout = $timeout;
        $this->apiVersion = $apiVersion;

        $this->requester = new Requester();

        $this->accounts = new Accounts($this);
        $this->assetReport = new AssetReport($this);
        $this->auth = new Auth($this);
        $this->balance = new Balance($this);
        $this->categories = new Categories($this);
        $this->creditDetails = new CreditDetails($this);
        $this->identity = new Identity($this);
        $this->income = new Income($this);
        $this->institutions = new Institutions($this);
        $this->item = new Item($this);
        $this->transactions = new Transactions($this);
    }

    public function accounts()
    {
        return $this->accounts;
    }

    public function assetReport()
    {
        return $this->assetReport;
    }

    public function auth()
    {
        return $this->auth;
    }

    public function balance()
    {
        return $this->balance;
    }

    public function categories()
    {
        return $this->categories;
    }

    public function creditDetails()
    {
        return $this->creditDetails;
    }

    public function identity()
    {
        return $this->identity;
    }

    public function income()
    {
        return $this->income;
    }

    public function institutions()
    {
        return $this->institutions;
    }

    public function item()
    {
        return $this->item;
    }

    public function transactions()
    {
        return $this->transactions;
    }

    public function post($path, $data, $autoDecode = true)
    {
        $postData = array_merge($data, [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
        ]);

        return $this->_post($path, $postData, $autoDecode);
    }

    public function postPublic($path, $data)
    {
        return $this->_post($path, $data);
    }

    public function postPublicKey($path, $data)
    {
        $postData = array_merge($data, [
            'public_key' => $this->publicKey,
        ]);

        return $this->_post($path, $postData);
    }

    private function _post($path, $data, $autoDecode = true)
    {
        return $this->requester()->postRequest(
            implode(['https://', $this->env, '.plaid.com', $path]),
            $data,
            $this->timeout,
            $this->apiVersion,
            $autoDecode
        );
    }

    private function requester()
    {
        return $this->requester;
    }

}
