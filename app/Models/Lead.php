<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;
    protected $table = 'leads';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'opportunity_name',
        'primary_name',
        'primary_email',
        'primary_contact',
        'primary_address',
        'primary_organization',
        'secondary_name',
        'secondary_email',
        'secondary_address',
        'secondary_designation',
        'secondary_contact',
        'type',
        'company_name',
        'lead_address',
        'relationship',
        'start_date',
        'end_date',
        'guest_count',
        'sales_stage',
        'value_of_opportunity',
        'created_by',
        'status',
        'currency',
        'proposal_status',
        'leadname',
        'start_time',
        'end_time',
        'deal_length',
        'difficult_level',
        'timing_close',
        'description',
        'probability_to_close',
        'assigned_user',
        'category',
        'sales_subcategory',
        'competitor',
        'products',
        'hardware_one_time',
        'hardware_maintenance',
        'software_recurring',
        'software_one_time',
        'systems_integrations',
        'subscriptions',
        'tech_deployment_volume_based',
    ];



    protected $appends = [
        'status_name',
        'account_name',
        'source_name',
        'campaign_name',
    ];
    public static $lead_status = [
        'Waiting For Customer Confimation',
        'In Process',
        'Approved',
        'Withdrawn',
    ];
    // public static $status = [
    //     'Share Proposal',
    //     'Waiting For Customer Confirmation',
    //     'Customer Confirmed / Need Admin Approval',
    //     'Withdrawn',
    //     'Approved',
    //     'Resent',
    //     'Nda signed'
    // ];

    public static $status = [
        'New',
        'Contacted',
        'Qualifying',
        'Qualified',
        'NDA Signed',
        'Demo or Meeting',
        'Proposal',
        'Negotiation',
        'Awaiting Decision',
        'Closed Won',
        'Closed Lost',
        'Close No Decision',
        'Follow-Up Needed',
        'Implementation',
        'Renewal',
        'Upsell'
    ];
    public static $stat = [
        'Inactive',
        'Active'
    ];
    private static $account_name = null;
    private static $campaign_name = null;

    public function assign_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'assigned_user');
    }

    public function accountIndustry()
    {
        return $this->hasOne('App\Models\AccountIndustry', 'id', 'industry');
    }

    public function LeadSource()
    {
        return $this->hasOne('App\Models\LeadSource', 'id', 'source');
    }

    public function campaigns()
    {
        return $this->hasOne('App\Models\Campaign', 'id', 'campaign');
    }

    public function accounts()
    {
        return $this->hasOne('App\Models\Account', 'id', 'account');
    }

    public static function leads($id)
    {
        return Lead::where('status', '=', $id)->get();
    }

    public function getStatusNameAttribute()
    {
        $status = Lead::$status[$this->status];
        return $this->attributes['status_name'] = $status;
    }

    public  function getAccountNameAttribute()
    {
        if (self::$account_name === null) {
            self::$account_name = self::fetchgetAccountNameAttribute();
        }

        return self::$account_name;
    }
    public  function fetchgetAccountNameAttribute()
    {
        $account = Lead::find($this->account);
        return $this->attributes['account_name'] = !empty($account) ? $account->name : '';
    }
    public  function getCampaignNameAttribute()
    {
        if (self::$campaign_name === null) {
            self::$campaign_name = self::fetchgetCampaignNameAttribute();
        }

        return self::$campaign_name;
    }
    public function fetchgetCampaignNameAttribute()
    {
        $campaign = Lead::find($this->campaign);

        return $this->attributes['campaign_name'] = !empty($campaign) ? $campaign->name : '';
    }
    public function getSourceNameAttribute()
    {
        $lead_source = Lead::find($this->source);

        return $this->attributes['source_name'] = !empty($lead_source) ? $lead_source->name : '';
    }
    public function stages()
    {
        return $this->hasOne('App\Models\TaskStage', 'id', 'stage');
    }
}
