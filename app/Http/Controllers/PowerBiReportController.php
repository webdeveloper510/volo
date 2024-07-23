<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PowerBiService;
use Illuminate\Support\Facades\Auth;

class PowerBiReportController extends Controller
{
    protected $powerBiService;

    public function __construct(PowerBiService $powerBiService)
    {
        $this->powerBiService = $powerBiService;
    }

    public function getReport(Request $request)
    {
        try {
            $user = Auth::user();
            $reportDetails = $this->powerBiService->getPowerBiReportDetails($user);

            return response()->json([
                'success' => true,
                'embedToken' => $reportDetails['embedToken'],
                'embedUrl' => $reportDetails['embedUrl'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
