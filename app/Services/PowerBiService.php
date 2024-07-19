<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PowerBiService
{
    protected $authUrl;
    protected $clientId;
    protected $clientSecret;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->authUrl = env('POWERBI_AAD_AUTH_URL');
        $this->clientId = env('POWERBI_CLIENT_ID');
        $this->clientSecret = env('POWERBI_CLIENT_SECRET');
        $this->username = env('POWERBI_USERNAME');
        $this->password = env('POWERBI_PASSWORD');
    }

    public function getAccessToken()
    {
        $client = new Client();

        $formParams = [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'resource' => 'https://analysis.windows.net/powerbi/api',
            'username' => $this->username,
            'password' => $this->password,
            'scope' => 'openid',
        ];

        try {
            $response = $client->post($this->authUrl, [
                'form_params' => $formParams,
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
            ]);

            $body = json_decode($response->getBody()->getContents(), true);
            return $body['access_token'];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error_description'] ?? 'An error occurred while generating the access token.');
            }
            throw new \Exception('An error occurred while generating the access token.');
        }
    }

    public function createGroup()
    {
        $accessToken = $this->getAccessToken();
        $client = new Client();

        $url = 'https://api.powerbi.com/v1.0/myorg/groups';

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'name' => 'Sample Group3',
                ],
            ]);

            $group = json_decode($response->getBody()->getContents(), true);
            $groupId = $group['id'];
            return $groupId;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error']['message'] ?? 'An error occurred while creating the group.');
            }
            throw new \Exception('An error occurred while creating the group.');
        }
    }

    public function getReports($groupId)
    {
        $accessToken = $this->getAccessToken();
        $client = new Client();

        $url = "https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/reports";

        try {
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
            ]);

            $reports = json_decode($response->getBody()->getContents(), true);
            return $reports;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error']['message'] ?? 'An error occurred while fetching the reports.');
            }
            throw new \Exception('An error occurred while fetching the reports.');
        }
    }
}
