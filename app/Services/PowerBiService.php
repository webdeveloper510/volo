<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;

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

    public function createGroup($accessToken, $groupName)
    {
        $client = new Client();
        $url = "https://api.powerbi.com/v1.0/myorg/groups";

        $body = [
            'name' => $groupName,
        ];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error']['message'] ?? 'An error occurred while creating the group.');
            }
            throw new \Exception('An error occurred while creating the group.');
        }
    }

    public function createReport($accessToken, $groupId, $reportName, $isRlsEnabled)
    {
        $client = new Client();
        $url = "https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/reports";

        // Create a dataset and get its ID
        $datasetId = $this->createDataset($accessToken, $groupId, 'dataset1');

        $body = [
            'name' => $reportName,
            'datasetId' => $datasetId,
            'isRlsEnabled' => $isRlsEnabled,
        ];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);

            $reportData = json_decode($response->getBody()->getContents(), true);
            $reportId = $reportData['id'];

            // Retrieve the embed URL
            $embedUrl = $this->getEmbedToken($accessToken, $groupId, $reportId, $datasetId);

            // Store details in the database
            DB::table('powerbi_reports')->insert([
                'PBI_group_id' => $groupId,
                'PBI_report_id' => $reportId,
                'PBI_dataset_id' => $datasetId,
                'PBI_embed_url' => $embedUrl,
                'report_name' => $reportName,
                'is_rls_enabled' => $isRlsEnabled,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $reportData;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error']['message'] ?? 'An error occurred while creating the report.');
            }
            throw new \Exception('An error occurred while creating the report.');
        }
    }

    public function getGroups($accessToken)
    {
        $client = new Client();
        $url = "https://api.powerbi.com/v1.0/myorg/groups";

        try {
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true)['value'];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error']['message'] ?? 'An error occurred while fetching groups.');
            }
            throw new \Exception('An error occurred while fetching groups.');
        }
    }

    public function getReports($accessToken, $groupId)
    {
        $client = new Client();
        $url = "https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/reports";

        try {
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true)['value'];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error']['message'] ?? 'An error occurred while fetching reports.');
            }
            throw new \Exception('An error occurred while fetching reports.');
        }
    }

    public function getDatasets($accessToken, $groupId)
    {
        $client = new Client();
        $url = "https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/datasets";

        try {
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true)['value'];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error']['message'] ?? 'An error occurred while fetching datasets.');
            }
            throw new \Exception('An error occurred while fetching datasets.');
        }
    }

    public function getEmbedToken($accessToken, $groupId, $reportId, $datasetId, $isEffectiveIdentityRolesRequired = false, $isEffectiveIdentityRequired = false)
    {
        $client = new Client();
        $url = "https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/reports/{$reportId}/GenerateToken";

        $body = [
            'datasets' => [
                [
                    'id' => $datasetId,
                ],
            ],
            'reports' => [
                [
                    'id' => $reportId,
                ],
            ],
            'targetWorkspaces' => [
                [
                    'id' => $groupId,
                ],
            ],
            'accessLevel' => 'View',
            'allowSaveAs' => 'false',
            'effectiveIdentityRolesRequired' => $isEffectiveIdentityRolesRequired,
            'effectiveIdentityRequired' => $isEffectiveIdentityRequired,
        ];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);

            return json_decode($response->getBody()->getContents(), true)['token'];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error']['message'] ?? 'An error occurred while generating the embed token.');
            }
            throw new \Exception('An error occurred while generating the embed token.');
        }
    }

    protected function createDataset($accessToken, $groupId, $datasetName)
    {
        $client = new Client();
        $url = "https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/datasets";

        $body = [
            'name' => $datasetName,
            'defaultMode' => 'Push',
            'tables' => [
                [
                    'name' => 'Table1',
                    'columns' => [
                        [
                            'name' => 'Column1',
                            'dataType' => 'Int64',
                        ],
                        [
                            'name' => 'Column2',
                            'dataType' => 'String',
                        ],
                    ],
                ],
            ],
        ];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);

            return json_decode($response->getBody()->getContents(), true)['id'];
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = json_decode($response->getBody()->getContents(), true);
                throw new \Exception($responseBody['error']['message'] ?? 'An error occurred while creating the dataset.');
            }
            throw new \Exception('An error occurred while creating the dataset.');
        }
    }
}
