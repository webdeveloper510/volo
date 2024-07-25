<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class PowerBiService
{
    protected $httpClient;
    protected $clientId;
    protected $clientSecret;
    protected $username;
    protected $password;
    protected $aadAuthUrl;

    public function __construct()
    {
        $this->httpClient = new Client();
        $this->clientId = env('POWERBI_CLIENT_ID');
        $this->clientSecret = env('POWERBI_CLIENT_SECRET');
        $this->username = env('POWERBI_USERNAME');
        $this->password = env('POWERBI_PASSWORD');
        $this->aadAuthUrl = env('POWERBI_AAD_AUTH_URL');

        if (empty($this->aadAuthUrl) || empty($this->clientId) || empty($this->clientSecret) || empty($this->username) || empty($this->password)) {
            throw new \InvalidArgumentException('Power BI configuration parameters are missing.');
        }
    }

    public function getAccessToken()
    {
        try {
            $response = $this->httpClient->post($this->aadAuthUrl, [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'resource' => 'https://analysis.windows.net/powerbi/api',
                    'username' => $this->username,
                    'password' => $this->password,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['access_token'])) {
                return $data['access_token'];
            } else {
                throw new \RuntimeException('Access token not found in response.');
            }
        } catch (RequestException $e) {
            // Log error details
            Log::error('Failed to get access token from Power BI API', [
                'status_code' => $e->getResponse()->getStatusCode(),
                'response_body' => $e->getResponse()->getBody()->getContents(),
                'error_message' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to get access token: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Log other exceptions
            Log::error('An error occurred while getting access token from Power BI API', [
                'error_message' => $e->getMessage(),
            ]);
            throw new \RuntimeException('An error occurred: ' . $e->getMessage());
        }
    }
}
