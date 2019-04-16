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

The module supports only a select few Plaid API endpoints at the moment. For complete information about
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

### Asset Reports

There are multiple steps to retrieving an Asset Report.

1. [Create](#create-an-asset-report) the report
2. [Filter](#filter-an-asset-report) unwanted accounts out of report
3. [Retrieve](#retrieve-an-asset-report) the report as JSON or PDF
4. [Refresh](#refresh-an-asset-report) a previously created or filtered report
5. [Remove](#remove-an-asset-report) a report

## Create an Asset Report

```php
// an array of previously generated access_tokens
$accessTokens = ['<access_token(s) returned from exchange token call(s)>'];
$daysRequested = 180;
// all of these are optional
$options = [
  'client_report_id' => '<user supplied id for reference',
  'webhook' => 'https://your-application.io/webhook',
  'user' => [
    'client_user_id' => '<user supplied id>',
    'first_name' => 'Testynthia',
    'middle_name' => 'T.',
    'last_name' => 'Tertestdez',
    'ssn' => '123-45-6789',
    'phone_number' => '555-555-1234',
    'email' => 'test@test.com'
  ]
];
$response = $this->client->assetReport()->create($accessTokens, $daysRequested, $options);
```

#### Create Asset Report Response

```json
{
  "asset_report_id": "<asset_report guid>",
  "asset_report_token": "<assets-sandbox-guid>",
  "request_id": "<request_id>"
}
```

### Filter an Asset Report

```php
$assetReportToken = '<returned in asset report creation call>';
$accountIdsToExclude = ['<credit_card_id>', '<401k_account_id>'];
$response = $this->client->assetReport()->filter($assetReportToken, $accountIdsToExclude);
```

#### Filter Asset Report Repsonse

```json
{
  "asset_report_id": "<asset_report guid>",
  "asset_report_token": "<assets-sandbox-guid>",
  "request_id": "<request_id>"
}
```

### Retrieve an Asset Report

```php
// retrieve the report in JSON format
$response = $this->client->assetReport()->get($accessReportToken);

// retrieve the report in PDF format
$response = $this->client->assetReport()->getPdf($accessReportToken);
file_put_contents('asset-report.pdf', $response);
```

#### Retrieve Asset Report Response

The JSON results of an asset report can be reviewed in [plaid's documentation][5].

The /asset_report/pdf/get endpoint returns binary PDF data, which can be saved into a local file.

### Refresh an Asset Report

```php
// $daysRequested is optional and only needed if you want to override the value sent when report was created
// $options is optional, only required for overrides to previous values
$response = $this->client->assetReport()->refresh($assetReportToken, $daysRequested, $options);
```

#### Refresh Asset Report Response

```json
{
  "asset_report_id": "<asset_report guid>",
  "asset_report_token": "<assets-sandbox-guid>",
  "request_id": "<request_id>"
}
```

### Remove an Asset Report

```php
$response = $this->client->assetReport()->remove($assetReportToken);
```

#### Remove Asset Report Response

```json
{
  "removed": true,
  "request_id": "<request_id>"
}
```

## License

[MIT][6]

[1]: https://plaid.com
[2]: https://github.com/plaid/plaid-python
[3]: https://plaid.com/docs/api
[4]: https://github.com/plaid/link
[5]: https://plaid.com/docs/#assets
[6]: https://github.com/dpods/plaid-api-php-client/blob/master/LICENSE
