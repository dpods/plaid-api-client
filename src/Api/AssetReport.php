<?php

namespace Plaid\Api;

/**
 * @link https://plaid.com/docs/#assets
 */
class AssetReport extends Api
{
    /**
     * Creates an Asset Report with all accounts linked to each Item associated with passed accessTokens.
     *
     * @link https://plaid.com/docs/#create-asset-report-request
     *
     * @param array $accessTokens An array of access tokens, one token for each Item to be included in the Asset Report.
     * @param int $daysRequested Days of transaction history requested to be included in the Asset Report.
     * @param object $options Optional. See docs for list of options.
     */
    public function create($accessTokens, $daysRequested, $options = [])
    {
        return $this->client()->post('/asset_report/create', [
            'access_tokens' => $accessTokens,
            'days_requested' => $daysRequested,
            'options' => $options,
        ]);
    }

    /**
     * Retrieves an Asset Report that has been previously created.
     *
     * @param string $assetReportToken The token returned in create or filter response.
     * @param bool $includeInsights Requires activation of feature by Plaid.
     */
    public function get($assetReportToken, $includeInsights = false)
    {
        $data = [
            'asset_report_token' => $assetReportToken,
        ];

        if ($includeInsights) {
            $data['include_insights'] = $includeInsights;
        }

        return $this->client->post('/asset_report/get', $data);
    }

    /**
     * Retrieves an Asset Report that has been previously created.
     *
     * @param string $assetReportToken The token returned in create or filter response.
     * @param bool $includeInsights Requires activation of feature by Plaid.
     *
     * @return binary The PDF output to be saved into a file.
     */
    public function getPdf($assetReportToken, $includeInsights = false)
    {
        $data = [
            'asset_report_token' => $assetReportToken,
        ];

        if ($includeInsights) {
            $data['include_insights'] = $includeInsights;
        }

        return $this->client->post('/asset_report/pdf/get', $data, false);
    }

    /**
     * Create an Asset Report that excludes accounts identified by passed accountIdsToExclude.
     *
     * @link https://plaid.com/docs/#specifying-which-accounts-appear-in-the-asset-report
     *
     * @param string $assetReportToken The token returned in create request.
     * @param array $accountIdsToExclude The list of ids to exclude from new report.
     */
    public function filter($assetReportToken, $accountIdsToExclude)
    {
        return $this->client->post('/asset_report/filter', [
            'asset_report_token' => $assetReportToken,
            'account_ids_to_exclude' => $accountIdsToExclude,
        ]);
    }

    /**
     * Refresh a previously created Asset Report.
     *
     * @link https://plaid.com/docs/#refreshing-an-asset-report
     *
     * @param string $assetReportToken The token returned in create or filter response.
     * @param int $daysRequested Override the days_requested on previously created/filtered report.
     * @param array $options Override the options array on previously created/filtered report.
     */
    public function refresh($assetReportToken, $daysRequested = null, $options = [])
    {
        $data = ['asset_report_token' => $assetReportToken];

        if (!is_null($daysRequested)) {
            $data['days_requested'] = $daysRequested;
        }

        if (!empty($options)) {
            $data['options'] = $options;
        }

        return $this->client()->post('/asset_report/refresh', $data);
    }

    /**
     * Remove a previously created Asset Report.
     *
     * @param string $assetReportToken The token returned in create or filter response.
     */
    public function remove($assetReportToken)
    {
        return $this->client->post('/asset_report/remove', [
            'asset_report_token' => $assetReportToken,
        ]);
    }
}
