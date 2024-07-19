<?php

namespace App\Http\Controllers;

use App\Services\PowerBiService;
use Illuminate\Http\Request;
use Exception;

class PowerBiReportController extends Controller
{
    protected $powerBiService;

    public function __construct(PowerBiService $powerBiService)
    {
        $this->powerBiService = $powerBiService;
    }

    public function showReport()
    {
        try {
            // Get access token
            $accessToken = $this->powerBiService->getAccessToken();
            echo "Access Token: " . $accessToken . "<br>";

            // Create group and get group ID
            $groupId = $this->powerBiService->createGroup();
            echo "Group ID: " . $groupId . "<br>";

            // Get reports in the group
            $reports = $this->powerBiService->getReports($groupId);

            if (!empty($reports['value'])) {
                // Assuming you want details of the first report
                $reportId = $reports['value'][0]['id'];
                $datasetId = $reports['value'][0]['datasetId'];
                $embedUrl = $reports['value'][0]['embedUrl'];

                echo "Report ID: " . $reportId . "<br>";
                echo "Dataset ID: " . $datasetId . "<br>";
                echo "Embed URL: " . $embedUrl . "<br>";
            } else {
                echo "No reports found in the group.<br>";
            }
        } catch (Exception $e) {
            // return view('powerbi-report')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
