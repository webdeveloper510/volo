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
}
