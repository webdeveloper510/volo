<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Meeting;
use App\Models\Emailcontent;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\CampaigntextMail;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use App\Mail\SendCampaignMail;
use App\Models\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Campaigndata;
use Twilio\Rest\Client;
use App\Models\MasterCustomer;
use App\Models\NotesCustomer;
use Str;

class CustomerInformation extends Controller
{
    public function index()
    {
        $customers = Lead::all();
        $emailtemplates = Emailcontent::all();
        $leadsuser = Lead::all();
        $users = UserImport::all();
        $campaign = Campaigndata::all();
        return view('customer.index', compact('customers', 'emailtemplates', 'leadsuser', 'users', 'campaign'));
    }
    public function sendmail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required',
                'type' => 'required|max:120',
                'recipients' => 'required',
                'title' => 'required',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $content = $request->content;
        $campaignlist = new Campaigndata();
        $campaignlist['type'] = $request->type;
        $campaignlist['title'] = $request->title;
        $campaignlist['recipients'] = $request->recepient_names;
        $campaignlist['content'] = $content;
        $campaignlist['template'] = $request->template_html;
        $campaignlist['description'] = $request->description;
        $campaignlist->save();
        $notifyvia = $request->notify[1][0];
        $attachment = $request->file('document');
        if ($attachment) {
            $attachmentPath = $attachment->store('attachments', 'public');
        }
        if ($notifyvia != "email") {
            $users = explode(',', $request->recepient_names);
            foreach ($users as $user) {
                $lead = Lead::where('email', $user)->exists();
                $existinguser = UserImport::where('email', $user)->exists();
                if ($lead) {
                    $user =  Lead::where('email', $user)->pluck('phone');
                }
                if ($existinguser) {
                    $user =   UserImport::where('email', $user)->pluck('phone');
                }
                $uArr[] = [
                    'user' => $user,
                    'content' => $request->content,
                ];
            }
            $settings = Utility::settings();
            $account_sid = $settings['twilio_sid'];
            $auth_token = $settings['twilio_token'];
            $twilio_number = $settings['twilio_from'];
            foreach ($uArr as  $value) {
                try {
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create('+1' . $value['user'][0], [
                        'from' => $twilio_number,
                        'body' => $value['content'],
                    ]);
                    return redirect()->back()->with('success', 'Message Sent successfully');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', "Message couldn't be sent");
                }
            }
        }
        $customers = explode(',', $request->recepient_names);
        $subject = $request->description;
        $settings = Utility::settings();
        foreach ($customers as $customer) {
            try {
                config(
                    [
                        'mail.driver'       => $settings['mail_driver'],
                        'mail.host'         => $settings['mail_host'],
                        'mail.port'         => $settings['mail_port'],
                        'mail.username'     => $settings['mail_username'],
                        'mail.password'     => $settings['mail_password'],
                        'mail.from.address' => $settings['mail_from_address'],
                        'mail.from.name'    => $settings['mail_from_name'],
                    ]
                );
                if (($request->format) && $request->format == 'html') {
                    $mail = new SendCampaignMail($campaignlist);

                    if ($attachment !== null) {
                        $mail->attach($attachmentPath);
                    }
                    // Mail::to($customer)->send($mail);
                    Mail::to('sonali@codenomad.net')->send(new SendCampaignMail($campaignlist, $attachmentPath));
                } elseif (($request->format) && $request->format == 'text') {
                    Mail::to($customer)->send(new CampaigntextMail($content));
                }
                return redirect()->back()->with('success', 'Email Sent Successfully');
            } catch (\Exception $e) {
                return response()->json(
                    [
                        'is_success' => false,
                        'message' => $e->getMessage(),
                    ]
                );
                //   return redirect()->back()->with('error', 'Email Not Sent');
            }
        }
        return redirect()->back()->with('success', 'Campaign  Sent Successfully');
    }
    public function campaigntype(Request $request)
    {
        $type = $request->type;
        $settings =  Utility::settings();
        $campaign = explode(',', $settings['campaign_type']);
        $filteredArray = array_filter($campaign, function ($item) use ($type) {
            return stripos($item, $type) !== false;
        });
        return $filteredArray;
    }
    public function existinguserlist()
    {
        $leadsuser = Lead::all();
        return view('customer.existingleads', compact('leadsuser'));
    }
    public function addusers()
    {
        $users = UserImport::all();
        return view('customer.new_user', compact('users'));
    }
    public function uploaduserlist()
    {
        return view('customer.uploaduserinfo');
    }
    public function exportuser(Request $request)
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function importuser(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;

        if ($request->customerType == 'uploadFile') {
            $category = [
                'category' => $request->input('category'),
            ];

            $userid =  \Auth::user()->creatorId();
            Excel::import(new UsersImport($category, $userid), request()->file('users'));
            return redirect()->back()->with('success', 'Data  imported successfully');
        } elseif ($request->customerType == 'addForm') {
            $validator = \Validator::make(
                $request->all(),
                [
                    'company_name' => 'required',
                    'entity_name' => 'required',
                    'primary_name' => 'required',
                    'primary_phone_number' => 'required|unique:import_users',
                    'primary_email' => 'required|email|unique:import_users',
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

            $UsersImports = new UserImport();
            $UsersImports->company_name = $request->company_name;
            $UsersImports->entity_name = $request->entity_name;
            $UsersImports->primary_name = $request->primary_name;
            $UsersImports->primary_phone_number = $request->primary_phone_number;
            $UsersImports->primary_email = $request->primary_email;
            $UsersImports->primary_address = $request->primary_address;
            $UsersImports->primary_organization = $request->primary_organization;
            $UsersImports->secondary_name = $request->secondary_name;
            $UsersImports->secondary_phone_number = $request->secondary_phone_number;
            $UsersImports->secondary_email = $request->secondary_email;
            $UsersImports->secondary_address = $request->secondary_address;
            $UsersImports->secondary_designation = $request->secondary_designation;
            $UsersImports->location = $request->location;
            $UsersImports->region = !empty($request->region) ? $request->region : $request->other_region;;
            $UsersImports->industry = json_encode($request->industry);
            $UsersImports->engagement_level = $request->engagement_level;
            $UsersImports->revenue_booked_to_date = $request->revenue_booked_to_date;
            $UsersImports->referred_by = $request->referred_by;
            $UsersImports->pain_points = $request->pain_points;
            $UsersImports->notes = $request->notes;
            $UsersImports->status =  ($request->is_active == 'on') ? 0 : 1;
            $UsersImports->created_by = \Auth::user()->creatorId();
            $UsersImports->save();
            return redirect()->back()->with('success', 'Customer added successfully');
        }
    }
    public function mailformatting()
    {
        return view('customer.editor');
    }
    public function textmailformatting()
    {
        return view('customer.textmail');
    }
    public function addeduserlist()
    {
        $users = UserImport::all();
        return view('customer.addeduserlist', compact('users'));
    }
    public function campaign_categories(Request $request)
    {
        $types = $request->types;
        if (!empty($types)) {
            foreach ($types as $type) {
                $user[] = UserImport::where('category', $type)->get();
            }
            return $user;
        }
    }

    public function campaignlisting()
    {
        $campaignlist = Campaigndata::all();
        return view('customer.campaignlist', compact('campaignlist'));
    }
    public function contactinfo(Request $request)
    {
        $user =  UserImport::where('id', $request->clientId)->get();
        return $user;
    }
    public function resendcampaign(Request $request)
    {
        $campaign = Campaigndata::where('id', $request->id)->get();
        $settings = Utility::settings();
        $customers = explode(',', $request->recepient_names);
        return $customers;
        // echo "<pre>";print_r($campaign);die;
        // if (!empty($campaign->template)) {
        //     foreach ($customers as $customer) {
        //         try {
        //             config(
        //                 [
        //                     'mail.driver'       => $settings['mail_driver'],
        //                     'mail.host'         => $settings['mail_host'],
        //                     'mail.port'         => $settings['mail_port'],
        //                     'mail.username'     => $settings['mail_username'],
        //                     'mail.password'     => $settings['mail_password'],
        //                     'mail.from.address' => $settings['mail_from_address'],
        //                     'mail.from.name'    => $settings['mail_from_name'],
        //                 ]
        //             );
        //             Mail::to($customer)->send(new SendCampaignMail($campaign));

        //             return redirect()->back()->with('success','Email Sent Successfully');
        //         } catch (\Exception $e) {
        //             return redirect()->back()->with('error','Email Not Sent');
        //             // return response()->json(
        //             //     [
        //             //         'is_success' => false,
        //             //         'message' => $e->getMessage(),
        //             //     ]
        //             // );
        //         }
        //     }
        // } else {

        //     foreach ($customers as $customer) {
        //         $lead = Lead::where('email', $customer)->exists();
        //         $existinguser = UserImport::where('email', $customer)->exists();
        //         if ($lead) {
        //             $user =  Lead::where('email', $customer)->pluck('phone');
        //         }
        //         if ($existinguser) {
        //             $user =   UserImport::where('email', $customer)->pluck('phone');
        //         }
        //         $uArr[] = [
        //             'user' => $user,
        //             'content' => $request->content,
        //         ];
        //     }
        //     $account_sid = $settings['twilio_sid'];
        //     $auth_token = $settings['twilio_token'];
        //     $twilio_number = $settings['twilio_from'];
        //     foreach ($uArr as  $value) {
        //         try {
        //             $client = new Client($account_sid, $auth_token);
        //             $client->messages->create('+91' . $value['user'][0], [
        //                 'from' => $twilio_number,
        //                 'body' => $value['content'],
        //             ]);
        //             return 'Message Sent successfully';
        //         } catch (\Exception $e) {
        //             return "Message couldn't be sent";
        //         }
        //     }
        // }
    }
    public function siteusers()
    {
        $importedcustomers = UserImport::distinct()->get();
        return view('customer.allcustomers', compact('importedcustomers'));
    }
    public function event_customers()
    {
        // $eventcustomers = Meeting::withTrashed()->get();
        $eventcustomers = MasterCustomer::withTrashed()->where('category', 'event')->get();
        return view('customer.event_customer', compact('eventcustomers'));
    }
    public function lead_customers()
    {
        // $leadcustomers = Lead::withTrashed()->get();
        // $distinctCustomers = Lead::withTrashed()->distinct()->get();
        // $uniqueLeads = Lead::withTrashed()->select('*')->distinct('email')->get();
        $leadcustomers = MasterCustomer::where('category', 'lead')->get();
        return view('customer.lead_customer', compact('leadcustomers'));
    }
    public function import_customers_view($id)
    {
        $users = UserImport::find($id);
        return view('customer.userview', compact('users'));
    }
    public function customer_info($id)
    {
        $id = decrypt(urldecode($id));       
        $client = UserImport::find($id);
        // echo "<pre>";
        // print_r($client);
        // die;
        $notes = NotesCustomer::where('user_id', $id)->get();
        return view('customer.userview', compact('client', 'notes'));
    }
    public function cate($category)
    {
        $users = UserImport::where('category', $category)->get();
        return view('customer.new_user', compact('users', 'category'));
        // echo "<pre>";print_r($users);die;
    }
    public function uploadcustomerattachment(Request $request, $id)
    {
        $id = decrypt(urldecode($id));
        // $users = UserImport::find($id);
        if (!empty($request->file('customerattachment'))) {
            $file =  $request->file('customerattachment');
            $filename =  $file->getClientOriginalName() . '_' . Str::random(3) . '.' . $file->getClientOriginalExtension();
            $folder = 'External_customer/' . $id;
            try {
                $path = $file->storeAs($folder, $filename, 'public');
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'File upload failed');
            }
        }
        return redirect()->back()->with('Success', 'File Uploaded Successfully');
    }
    public function usernotes(Request $request, $id)
    {
        $notes = new NotesCustomer();
        $notes->notes = $request->notes;
        $notes->created_by = $request->createrid;
        $notes->user_id = $id;
        $notes->save();
        return true;
    }
}
