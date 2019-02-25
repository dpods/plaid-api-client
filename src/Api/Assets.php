<?php

namespace Plaid\Api;

use ArrayObject;

class Assets extends Api
{
    public function __construct($client)
    {
        parent::__construct($client);
    }

    //# Available Options for user object:
    //
    //Field     Type    Description
    //client_user_id    string  An identifier you determine and submit for the user
    //first_name    string     The user’s first name
    //middle_name   string    The user’s middle name
    //last_name     string      The user’s last name
    //ssn   string   The user’s social security number Format: "\d\d\d-\d\d-\d\d\d\d"
    //phone_number  string    The user’s phone number Format: “+{country_code}{area code and subscriber number}”, e.g. “+14155555555” (known as E.164 format)
    //email     string   The user’s email address

    public function create($accessTokens,
                        $daysRequested,
                        $clientReportId = null,
                        $webhook = null,
                        $user = null)
    {
        // This will map to a JSON object even if it's empty
        $optionsObj = new ArrayObject([]);

        if ($clientReportId) {
            $optionsObj['client_report_id'] = $clientReportId;
        }

        if ($webhook) {
            $optionsObj['webhook'] = $webhook;
        }

        if ($user) {
            $optionsObj['user'] = new ArrayObject($user);
        }

        return $this->client()->post('/asset_report/create', [
            'access_tokens' => $accessTokens,
            'days_requested' => $daysRequested,
            'options' => $optionsObj,
        ]);
    }

    public function getJson($assetReportToken, $includeInsights=false)
    {
        return $this->client()->post('/asset_report/get', [
            'asset_report_token' => $assetReportToken,
            'include_insights'   => $includeInsights,
        ]);
    }
}
