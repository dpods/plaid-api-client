<?php

namespace Plaid;

class Requester
{
    public function postRequest($url, $data, $timeout, $apiVersion = null, $autoDecode = true)
    {
        try {
            $jsonResponse = $this->httpRequest('POST', $url, $data, $timeout, $apiVersion);
            $response = ($autoDecode) ? json_decode($jsonResponse, true) : $jsonResponse;
        } catch (\Exception $e) {
            throw PlaidException::fromResponse([
                'error_message' => $e->getMessage(),
                'error_type' => 'API_ERROR',
                'error_code' => 'INTERNAL_SERVER_ERROR',
                'display_message' => null,
            ]);
        }

        if (array_key_exists('error_type', $response)) {
            throw PlaidException::fromResponse($response);
        }

        return $response;
    }

    private function httpRequest($method, $url, $data, $timeout, $apiVersion = null)
    {
        $jsonStr = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonStr),
            'User-Agent: Plaid PHP v' . Client::VERSION,
            'Plaid-Version: ' . ($apiVersion ? $apiVersion : Client::DEFAULT_API_VERSION),
        ]
        );

        $result = curl_exec($ch);

        return $result;
    }

}
