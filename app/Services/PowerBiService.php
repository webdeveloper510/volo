<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

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

    // CREATE POWER BI REPORT
    public function createPowerBiReport($data)
    {
        $accessToken = $this->generateAccessToken();
        $groupId = $this->createGroup($data['groupName'], $accessToken);
        $datasetId = $this->createDataset($accessToken, $groupId);

        // Fetch data rows from your Laravel model
        $rows = $this->fetchLeadData();
        $this->addRowsToDataset($accessToken, $groupId, $datasetId, 'LeadsData', $rows);
        $reportDetails = $this->createReport($data['reportName'], $groupId, $accessToken, $datasetId);

        if (isset($reportDetails['error'])) {
            return $reportDetails;
        }

        $embedToken = $this->generateEmbedToken($accessToken, $reportDetails);

        return [
            'success' => true,
            'groupId' => $groupId,
            'reportId' => $reportDetails['reportId'],
            'datasetId' => $datasetId,
            'embedUrl' => $reportDetails['embedUrl'],
            'embedToken' => $embedToken,
        ];
    }

    // GENERATE ACCESS TOKEN
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

    // CREATE GROUP
    protected function createGroup($groupName, $accessToken)
    {
        $response = $this->httpClient->post('https://api.powerbi.com/v1.0/myorg/groups', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'name' => $groupName,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['id'];
    }

    // CREATE REPORT
    protected function createReport($reportName, $groupId, $accessToken)
    {
        $pbixFilePath = storage_path('app/public/report.pbix');

        if (!file_exists($pbixFilePath)) {
            return ['error' => 'The PBIX file does not exist.'];
        }

        $fileContent = file_get_contents($pbixFilePath);

        if (!$fileContent) {
            return ['error' => 'The PBIX file is empty or not found.'];
        }

        // Print the first few bytes of the file content for debugging
        echo "PBIX File Content (first 100 bytes): " . substr($fileContent, 0, 100) . "\n";

        // Check if a report with the same name already exists
        $reports = $this->fetchReports($groupId, $accessToken);
        foreach ($reports as $report) {
            if ($report['name'] === $reportName) {
                return ['error' => 'A report with this name already exists.'];
            }
        }

        try {
            echo "Sending POST request to create report...\n";
            echo "Group ID: $groupId\n";
            echo "Report Name: $reportName\n";

            $response = $this->httpClient->post("https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/imports?datasetDisplayName={$reportName}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/octet-stream',
                ],
                'body' => $fileContent,
            ]);

            $data = json_decode($response->getBody(), true);
            if (!isset($data['id'])) {
                throw new \Exception('Invalid response format from Power BI API.');
            }

            $importId = $data['id'];
            $importStatus = $this->pollImportStatus($groupId, $importId, $accessToken);

            if ($importStatus === 'Succeeded') {
                // Fetch the report details
                $reports = $this->fetchReports($groupId, $accessToken);
                foreach ($reports as $report) {
                    if ($report['name'] === $reportName) {
                        return [
                            'reportId' => $report['id'],
                            'datasetId' => $report['datasetId'],
                            'embedUrl' => $report['embedUrl'],
                        ];
                    }
                }
                throw new \Exception('Created report not found.');
            } else {
                throw new \Exception('Import failed or is not completed.');
            }
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // FETCH REPORTS
    protected function fetchReports($groupId, $accessToken)
    {
        try {
            $response = $this->httpClient->get("https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/reports", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['value'] ?? [];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // POLL IMPORT STATUS 
    protected function pollImportStatus($groupId, $importId, $accessToken)
    {
        $status = 'NotStarted';
        while ($status !== 'Succeeded' && $status !== 'Failed') {
            $response = $this->httpClient->get("https://api.powerbi.com/v1.0/myorg/groups/{$groupId}/imports/{$importId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            $status = $data['status'];

            if ($status === 'Failed') {
                throw new \Exception('Import failed.');
            }

            sleep(5);
        }

        return $status;
    }

    // GENERATE EMBED TOKEN
    protected function generateEmbedToken($accessToken, $reportDetails)
    {
        $response = $this->httpClient->post("https://api.powerbi.com/v1.0/myorg/groups/{$reportDetails['groupId']}/reports/{$reportDetails['reportId']}/GenerateToken", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'accessLevel' => 'view'
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['token'];
    }

    // DEFINE DATASET SCHEMA
    protected function defineDatasetSchema()
    {
        return [
            'name' => 'SalesDataset',
            'tables' => [
                [
                    'name' => 'SalesData',
                    'columns' => [
                        ['name' => 'Product', 'dataType' => 'string'],
                        ['name' => 'Sales', 'dataType' => 'Int64'],
                        ['name' => 'Date', 'dataType' => 'DateTime'],
                    ],
                ],
            ],
        ];
    }

    // CREATE DATASET
    protected function createDataset($accessToken, $groupId)
    {
        $url = "https://api.powerbi.com/v1.0/myorg/groups/$groupId/datasets";

        $body = [
            'name' => 'LeadsDataset',
            'defaultMode' => 'Push',
            'tables' => [
                [
                    'name' => 'LeadsData',
                    'columns' => [
                        ['name' => 'ID', 'dataType' => 'Int64'],
                        ['name' => 'User ID', 'dataType' => 'Int64'],
                        ['name' => 'Opportunity Name', 'dataType' => 'string'],
                        ['name' => 'Primary Name', 'dataType' => 'string'],
                        ['name' => 'Primary Email', 'dataType' => 'string'],
                        ['name' => 'Primary Contact', 'dataType' => 'string'],
                        ['name' => 'Primary Address', 'dataType' => 'string'],
                        ['name' => 'Primary Organization', 'dataType' => 'string'],
                        ['name' => 'Secondary Name', 'dataType' => 'string'],
                        ['name' => 'Secondary Email', 'dataType' => 'string'],
                        ['name' => 'Secondary Address', 'dataType' => 'string'],
                        ['name' => 'Secondary Designation', 'dataType' => 'string'],
                        ['name' => 'Region', 'dataType' => 'string'],
                        ['name' => 'Secondary Contact', 'dataType' => 'string'],
                        ['name' => 'Company Name', 'dataType' => 'string'],
                        ['name' => 'Value of Opportunity', 'dataType' => 'Int64'],
                        ['name' => 'Type', 'dataType' => 'string'],
                        ['name' => 'Sales Stage', 'dataType' => 'string'],
                        ['name' => 'Proposal Status', 'dataType' => 'string'],
                        ['name' => 'Status', 'dataType' => 'string'],
                        ['name' => 'Lead Status', 'dataType' => 'string'],
                        ['name' => 'Deal Length', 'dataType' => 'string'],
                        ['name' => 'Difficult Level', 'dataType' => 'string'],
                        ['name' => 'Assigned User', 'dataType' => 'Int64'],
                        ['name' => 'Currency', 'dataType' => 'string'],
                        ['name' => 'Timing Close', 'dataType' => 'string'],                       
                        ['name' => 'Probability to Close', 'dataType' => 'Int64'],
                        ['name' => 'Category', 'dataType' => 'string'],
                        ['name' => 'Sales Subcategory', 'dataType' => 'string'],
                        ['name' => 'Competitor', 'dataType' => 'string'],
                        ['name' => 'Products', 'dataType' => 'string'],
                        ['name' => 'Hardware One Time', 'dataType' => 'Int64'],
                        ['name' => 'Hardware Maintenance', 'dataType' => 'Int64'],
                        ['name' => 'Software Recurring', 'dataType' => 'Int64'],
                        ['name' => 'Software One Time', 'dataType' => 'Int64'],
                        ['name' => 'Systems Integrations', 'dataType' => 'Int64'],
                        ['name' => 'Subscriptions', 'dataType' => 'Int64'],
                        ['name' => 'Tech Deployment Volume Based', 'dataType' => 'Int64'],
                        ['name' => 'Is NDA Signed', 'dataType' => 'bool'],
                        ['name' => 'Created By', 'dataType' => 'Int64'],                        
                    ]
                ]
            ]
        ];

        try {
            $response = $this->httpClient->post($url, [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);

            $data = json_decode($response->getBody(), true);
            if (isset($data['id'])) {
                return $data['id'];
            } else {
                throw new \Exception('Error creating dataset: ' . $response->getBody());
            }
        } catch (RequestException $e) {
            throw new \Exception('Error creating dataset: ' . $e->getMessage());
        }
    }

    // ADD ROWS TO DATASET
    public function addRowsToDataset($accessToken, $groupId, $datasetId, $tableName, $rows)
    {
        $url = "https://api.powerbi.com/v1.0/myorg/groups/$groupId/datasets/$datasetId/tables/$tableName/rows";

        $headers = [
            'Authorization' => "Bearer $accessToken",
            'Content-Type' => 'application/json',
        ];

        $body = [
            'rows' => $rows
        ];

        try {
            $response = $this->httpClient->post($url, [
                'headers' => $headers,
                'json' => $body,
            ]);

            if ($response->getStatusCode() != 200) {
                throw new \Exception('Error adding rows to dataset: ' . $response->getBody()->getContents());
            }
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $errorMessage = $response ? $response->getBody()->getContents() : $e->getMessage();
            throw new \Exception('Error adding rows to dataset: ' . $errorMessage);
        }
    }



    // FETCH DATA 
    protected function fetchLeadData()
    {
        // Query the leads table
        $leads = \App\Models\Lead::all();

        // Format the data rows
        $rows = [];
        foreach ($leads as $lead) {
            // Validate and format the 'Value of Opportunity'
            $valueOfOpportunity = is_numeric($lead->value_of_opportunity) ? (int)$lead->value_of_opportunity : 0;

            $rows[] = [
                'ID' => $lead->id,
                'User ID' => $lead->user_id,
                'Opportunity Name' => $lead->opportunity_name,
                'Primary Name' => $lead->primary_name,
                'Primary Email' => $lead->primary_email,
                'Primary Contact' => $lead->primary_contact,
                'Primary Address' => $lead->primary_address,
                'Primary Organization' => $lead->primary_organization,
                'Secondary Name' => $lead->secondary_name,
                'Secondary Email' => $lead->secondary_email,
                'Secondary Address' => $lead->secondary_address,
                'Secondary Designation' => $lead->secondary_designation,
                'Region' => $lead->region,
                'Secondary Contact' => $lead->secondary_contact,
                'Company Name' => $lead->company_name,
                'Value of Opportunity' => $valueOfOpportunity,
                'Type' => $lead->type,
                'Sales Stage' => $lead->sales_stage,
                'Proposal Status' => $lead->proposal_status,
                'Status' => $lead->status,
                'Lead Status' => $lead->lead_status,
                'Deal Length' => $lead->deal_length,
                'Difficult Level' => $lead->difficult_level,
                'Assigned User' => $lead->assigned_user,
                'Currency' => $lead->currency,
                'Timing Close' => $lead->timing_close,                
                'Probability to Close' => $lead->probability_to_close,
                'Category' => $lead->category,
                'Sales Subcategory' => $lead->sales_subcategory,
                'Competitor' => $lead->competitor,
                'Products' => $lead->products,
                'Hardware One Time' => $lead->hardware_one_time,
                'Hardware Maintenance' => $lead->hardware_maintenance,
                'Software Recurring' => $lead->software_recurring,
                'Software One Time' => $lead->software_one_time,
                'Systems Integrations' => $lead->systems_integrations,
                'Subscriptions' => $lead->subscriptions,
                'Tech Deployment Volume Based' => $lead->tech_deployment_volume_based,
                'Is NDA Signed' => $lead->is_nda_signed,
                'Created By' => $lead->created_by,               
            ];
        }

        return $rows;
    }
}
