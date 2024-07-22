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
            // Get MS Access Token
            $accessToken = $this->powerBiService->getAccessToken();

            // Get Group ID
            $groups = $this->powerBiService->getGroups($accessToken);
            if (empty($groups)) {
                throw new Exception('No groups found.');
            }

            $groupId = $groups[0]['id'];

            // Get Report ID and Embed URL
            $reports = $this->powerBiService->getReports($accessToken, $groupId);
            if (empty($reports)) {
                throw new Exception('No reports found.');
            }

            $reportId = $reports[0]['id'];
            $embedUrl = $reports[0]['embedUrl'];

            // Get Dataset ID
            $datasets = $this->powerBiService->getDatasets($accessToken, $groupId);
            if (empty($datasets)) {
                throw new Exception('No datasets found.');
            }

            $datasetId = $datasets[0]['id'];

            // Get Embed Token from Power BI API
            $embedToken = $this->powerBiService->getEmbedToken($accessToken, $groupId, $reportId, $datasetId);
            return response()->json([
                'embedUrl' => $embedUrl,
                'embedToken' => $embedToken,
                'accessToken' => $accessToken
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createReport(Request $request)
    {
        $request->validate([
            'report_name' => 'required|string|max:255',
            'is_rls_enabled' => 'required|boolean',
        ]);

        try {
            $accessToken = $this->powerBiService->getAccessToken();
            $reportName = $request->input('report_name');
            $isRlsEnabled = $request->input('is_rls_enabled');

            $groups = $this->powerBiService->getGroups($accessToken);
            if (empty($groups)) {
                throw new Exception('No groups found.');
            }
            $groupId = $groups[0]['id'];

            $report = $this->powerBiService->createReport($accessToken, $groupId, $reportName, $isRlsEnabled);
            return response()->json(['report' => $report], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
