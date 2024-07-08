<?php
$selectedvenue = explode(',', $lead->venue_selection);
$billing = App\Models\ProposalInfo::where('lead_id', $lead->id)->orderby('id', 'desc')->first();
if (isset($billing) && !empty($billing)) {
    $billing = json_decode($billing->proposal_info, true);
}
$startdate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->start_date)->format('d/m/Y');
$enddate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->end_date)->format('d/m/Y');
?>

<style>
    .section-heading {
        text-align: center;
        margin-top: 2px;
        font-weight: bold;
        font-size: 1.5rem;
        color: #333;
        text-decoration: underline;
    }
</style>

<div class="row ">
    <div class="col-md-12 half-col">
        <div class="card ">
            <div class="card-body">

                <dl class="row">
                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Opportunity Name')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->opportunity_name ?? '--'}}</span></dd>

                    <!-- Primary Information Heading -->
                    <dt class="col-12 section-heading">
                        <h4>Primary Information</h4>
                    </dt>
                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Name')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->primary_name ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Email')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->primary_email ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Phone Number')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->primary_contact ?? '--' }}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Address')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->primary_address ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Designation')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->primary_organization ?? '--'}}</span></dd>

                    <!-- Secondary Information Heading -->
                    <dt class="col-12 section-heading">
                        <h4>Secondary Information</h4>
                    </dt>
                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Name')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->secondary_name ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Email')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->secondary_email ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Phone Number')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->secondary_contact ?? '--' }}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Address')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->secondary_address ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Designation')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->secondary_designation ?? '--'}}</span></dd>


                    <!-- Other Details Heading -->
                    <dt class="col-12 section-heading">
                        <h4>Other Details</h4>
                    </dt>
                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Assigned Team Member')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ !empty($lead->assign_user)?$lead->assign_user->name:'Not Assigned Yet'}}
                            {{ !empty($lead->assign_user)? '('.$lead->assign_user->type.')' :''}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Value of Opportunity')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->value_of_opportunity ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Currency')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->currency ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Timing – Close')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->timing_close ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Sales Stage')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->sales_stage ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Deal Length')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->deal_length ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Difficulty Level')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->difficult_level ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Probability to close')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->probability_to_close ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Select Category')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->category ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Sales Subcategory')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->sales_subcategory ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Competitor')}}</span></dt>
                    <dd class="col-md-6"><span class="">{{ $lead->competitor ?? '--'}}</span></dd>

                    <dt class="col-md-6"><span class="h6  mb-0">{{__('Status')}}</span></dt>
                    <dd class="col-md-6"><span class="">
                            @if($lead->status == 0)
                            <span class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                            @elseif($lead->status == 1)
                            <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                            @elseif($lead->status == 2)
                            <span class="badge bg-secondary p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                            @elseif($lead->status == 3)
                            <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                            @elseif($lead->status == 4)
                            <span class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                            @elseif($lead->status == 5)
                            <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                            @endif
                    </dd>
                </dl>
            </div>
            @if($lead->status == 0)
            <div class="card-footer">
                <div class="w-100 text-end pr-2">
                    @can('Edit Lead')
                    <div class="action-btn bg-info ms-2">
                        <a href="{{ route('lead.edit',$lead->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" data-title="{{__('Opportunitie Edit')}}" title="{{__('Edit')}}"><i class="ti ti-edit"></i>
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
            @endif
        </div>
    </div>
</div>