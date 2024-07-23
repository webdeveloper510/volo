<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\PowerBiReport;

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
    }

    public function getPowerBiReportDetails($user)
    {
        $accessToken = $this->generateAccessToken();
        $reportDetails = $this->fetchReportDetails($accessToken);
        $embedToken = $this->generateEmbedToken($accessToken, $reportDetails);

        // Store report details in the database
        $this->storeReportDetails($reportDetails, $embedToken);

        return [
            'embedToken' => $embedToken,
            'embedUrl' => $reportDetails['embedUrl'],
        ];
    }

    protected function generateAccessToken()
    {
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
        return $data['access_token'];
    }

    protected function fetchReportDetails($accessToken)
    {
        // Fetch the list of groups (workspaces)
        $response = $this->httpClient->get("https://api.powerbi.com/v1.0/myorg/groups", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $groupsData = json_decode($response->getBody(), true);

        // Assuming the first group in the list is the one you need
        if (count($groupsData['value']) > 0) {
            $groupId = $groupsData['value'][0]['id'];
        } else {
            throw new \Exception('No groups found.');
        }

        // Fetch the list of reports in the specified group
        $response = $this->httpClient->get("https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/reports", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $reportsData = json_decode($response->getBody(), true);

        // Assuming the first report in the list is the one you need
        if (count($reportsData['value']) > 0) {
            $report = $reportsData['value'][0];
            return [
                'groupId' => $groupId,
                'reportId' => $report['id'],
                'datasetId' => $report['datasetId'],
                'embedUrl' => $report['embedUrl'],
            ];
        } else {
            throw new \Exception('No reports found in the specified group.');
        }
    }

    protected function generateEmbedToken($accessToken, $reportDetails)
    {
        $response = $this->httpClient->post("https://api.powerbi.com/v1.0/myorg/groups/{$reportDetails['groupId']}/reports/{$reportDetails['reportId']}/GenerateToken", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'datasets' => [
                    [
                        'id' => $reportDetails['datasetId'],
                    ],
                ],
                'reports' => [
                    [
                        'id' => $reportDetails['reportId'],
                    ],
                ],
                'targetWorkspaces' => [
                    [
                        'id' => $reportDetails['groupId'],
                    ],
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['token'];
    }

    protected function storeReportDetails($reportDetails, $embedToken)
    {
        PowerBiReport::create([
            'PBI_group_id' => $reportDetails['groupId'],
            'PBI_report_id' => $reportDetails['reportId'],
            'PBI_dataset_id' => $reportDetails['datasetId'],
            'PBI_embed_url' => $reportDetails['embedUrl'],
            'report_name' => 'Test report',
            'is_rls_enabled' => 1,
        ]);
    }
}
