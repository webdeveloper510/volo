<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomOpportunity;

class CustomOpportunitiesController extends Controller
{
    public function createOpportunity(Request $request)
    {
        $requestData = $request->all();

        // Assuming your request data structure is as follows
        $requestData = $request->all();

        // Initialize an array to store formatted data for each column
        $formattedData = [];

        // Define the columns and their corresponding request keys
        $columns = [
            'hardware_one_time' => [
                'product_title' => 'product_title_hardware_one_time',
                'product_price' => 'product_price_hardware_one_time',
                'product_quantity' => 'product_quantity_hardware_one_time',
                'unit' => 'unit_hardware_one_time',
                'product_opportunity_value' => 'product_opportunity_value_hardware_one_time',
            ],
            'hardware_maintenance' => [
                'product_title' => 'product_title_hardware_maintenance',
                'product_price' => 'product_price_hardware_maintenance',
                'product_quantity' => 'product_quantity_hardware_maintenance',
                'unit' => 'unit_hardware_maintenance',
                'product_opportunity_value' => 'product_opportunity_value_hardware_maintenance',
            ],
            'software_recurring' => [
                'product_title' => 'product_title_software_recurring',
                'product_price' => 'product_price_software_recurring',
                'product_quantity' => 'product_quantity_software_recurring',
                'unit' => 'unit_software_recurring',
                'product_opportunity_value' => 'product_opportunity_value_software_recurring',
            ],
            'software_one_time' => [
                'product_title' => 'product_title_software_one_time',
                'product_price' => 'product_price_software_one_time',
                'product_quantity' => 'product_quantity_software_one_time',
                'unit' => 'unit_software_one_time',
                'product_opportunity_value' => 'product_opportunity_value_software_one_time',
            ],
            'systems_integrations' => [
                'product_title' => 'product_title_systems_integrations',
                'product_price' => 'product_price_systems_integrations',
                'product_quantity' => 'product_quantity_systems_integrations',
                'unit' => 'unit_systems_integrations',
                'product_opportunity_value' => 'product_opportunity_value_systems_integrations',
            ],
            'subscriptions' => [
                'product_title' => 'product_title_subscriptions',
                'product_price' => 'product_price_subscriptions',
                'product_quantity' => 'product_quantity_subscriptions',
                'unit' => 'unit_subscriptions',
                'product_opportunity_value' => 'product_opportunity_value_subscriptions',
            ],
            'tech_deployment' => [
                'product_title' => 'product_title_tech_deployment',
                'product_price' => 'product_price_tech_deployment',
                'product_quantity' => 'product_quantity_tech_deployment',
                'unit' => 'unit_tech_deployment',
                'product_opportunity_value' => 'product_opportunity_value_tech_deployment',
            ],
        ];

        // Process each column
        foreach ($columns as $columnName => $keys) {
            $productTitles = $requestData[$keys['product_title']];
            $productPrices = $requestData[$keys['product_price']];
            $productQuantities = $requestData[$keys['product_quantity']];
            $productUnits = $requestData[$keys['unit']];
            $productOpportunityValues = $requestData[$keys['product_opportunity_value']];

            $formattedColumnData = [];

            // Loop through the arrays to structure the data for the column
            for ($i = 0; $i < count($productTitles); $i++) {
                $formattedColumnData[] = [
                    'title' => $productTitles[$i],
                    'price' => $productPrices[$i],
                    'quantity' => $productQuantities[$i],
                    'unit' => isset($productUnits[$i]) ? $productUnits[$i] : '',
                    'opportunity_value' => $productOpportunityValues[$i],
                ];
            }

            // Store the formatted data in the main array
            $formattedData[$columnName] = $formattedColumnData;
        }



        if (\Auth::user()->can('Create Lead')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'opportunity_name' => 'required',
                    'primary_name' => 'required',
                    'primary_email' => 'required',
                    'primary_phone_number' => 'required',
                    'primary_address' => 'required',
                    'primary_organization' => 'required'
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first())
                    ->withErrors($validator)
                    ->withInput();
            }



            $opportunity = new CustomOpportunity();
            $opportunity->user_id = Auth::user()->id;
            $opportunity->opportunity_name = $request->opportunity_name;
            $opportunity->existing_client = $request->existing_client ?? '';
            $opportunity->client_name = $request->client_name ?? '';
            $opportunity->primary_name = $request->primary_name;
            $opportunity->primary_phone_number = $request->primary_phone_number;
            $opportunity->primary_email = $request->primary_email;
            $opportunity->primary_address = $request->primary_address;
            $opportunity->primary_organization = $request->primary_organization;
            $opportunity->secondary_name = $request->secondary_name;
            $opportunity->secondary_phone_number = $request->secondary_phone_number;
            $opportunity->secondary_email = $request->secondary_email;
            $opportunity->secondary_address = $request->secondary_address;
            $opportunity->secondary_designation = $request->secondary_designation;
            $opportunity->assigned_user = $request->assign_staff;
            $opportunity->value_of_opportunity = $request->value_of_opportunity;
            $opportunity->currency = $request->currency;
            $opportunity->timing_close = $request->timing_close;
            $opportunity->sales_stage = $request->sales_stage;
            $opportunity->deal_length = $request->deal_length;
            $opportunity->difficult_level = $request->difficult_level;
            $opportunity->probability_to_close = $request->probability_to_close;
            $opportunity->category = $request->category;
            $opportunity->sales_subcategory = $request->sales_subcategory;
            $opportunity->products = json_encode($request->products);
            $opportunity->hardware_one_time = json_encode($formattedData['hardware_one_time']);
            $opportunity->hardware_maintenance = json_encode($formattedData['hardware_maintenance']);
            $opportunity->software_recurring = json_encode($formattedData['software_recurring']);
            $opportunity->software_one_time = json_encode($formattedData['software_one_time']);
            $opportunity->systems_integrations = json_encode($formattedData['systems_integrations']);
            $opportunity->subscriptions = json_encode($formattedData['subscriptions']);
            $opportunity->tech_deployment_volume_based = json_encode($formattedData['tech_deployment']);
            $opportunity->status = 0;
            $opportunity->created_by = \Auth::user()->creatorId();
            $opportunity->is_nda_signed = 0;
            $opportunity->is_deleted = '';
            $opportunity->save();
            return redirect()->back()->with('success', __('Lead Created.'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }
}
