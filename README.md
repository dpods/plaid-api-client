# plaid-api-php-client
 
[![GitHub release](https://img.shields.io/github/release/dpods/plaid-api-php-client.svg)](https://github.com/dpods/plaid-api-php-client) [![GitHub license](https://img.shields.io/github/license/dpods/plaid-api-php-client.svg)](https://github.com/dpods/plaid-api-php-client/blob/master/LICENSE)
 
PHP Client for the [plaid.com][1] API

This is a PHP port of the official [python client][2] library for the Plaid API


## Table of Contents

- [Install](#install)
- [Documentation](#documentation)
- [Examples](#examples)

## Install
```console
$ composer require dpods/plaid-api-php-client
```

## Documentation

The module supports only a select few Plaid API endpoints at the moment.  For complete information about
the Plaid.com API, head to the [Plaid Documentation][3].

## Examples

### Exchange a public token for an access token
Exchange a `public_token` from [Plaid Link][4] for a Plaid access token:
```php
$clientId = '*****';
$secret = '*****';
$publicKey = '*****';
$publicToken = '<public_token from Plaid Link>';

// Available environments are 'sandbox', 'development', and 'production'
$client = new Client($clientId, $secret, $publicKey, 'sandbox');
$response = $client->item()->publicToken()->exchange($publicToken);
$accessToken = $response['access_token'];
```

### Retrieve Transactions
```php
$response = $client->transactions()->get($accessToken, '2018-01-01', '2018-01-31');
$transactions = $response['transactions'];
```

## License
[MIT][5]

[1]: https://plaid.com
[2]: https://github.com/plaid/plaid-python
[3]: https://plaid.com/docs/api
[4]: https://github.com/plaid/link
[5]: https://github.com/dpods/plaid-api-php-client/blob/master/LICENSE
