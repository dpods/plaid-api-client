# plaid-api-php-client
 
[![GitHub release](https://img.shields.io/github/release/dpods/plaid-api-php-client.svg)](https://github.com/dpods/plaid-api-php-client) [![GitHub license](https://img.shields.io/github/license/dpods/plaid-api-php-client.svg)](https://github.com/dpods/plaid-api-php-client/blob/master/LICENSE)
 
PHP Client for the Plaid.com API

This is a PHP port of the official [python client](https://github.com/plaid/plaid-python) library for the Plaid API


## Table of Contents

- [Install](#install)

## Install
```console
$ composer require dpods/plaid-api-php-client
```

## Examples

### Exchange a public token for an access token
Exchange a `publictoken` from [Plaid Link][4] for a Plaid access token:
```php
$clientId = '*****';
$secret = '*****';
$publicKey = '*****';
$publicToken = '<public_token from Plaid Link>';

$client = new Client($clientId, $secret, $publicKey, 'sandbox');
$response = $client->item()->publicToken()->exchange($publicToken);
$accessToken = $response['access_token'];
```

### Retrieve Transactions
```php
$response = $client->transactions()->get($accessToken, '2018-01-01', '2018-01-31');
$transactions = $response['transactions'];
```