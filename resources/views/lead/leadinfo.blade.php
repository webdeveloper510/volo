@extends('layouts.admin')
@section('page-title')
{{__('Opportunities Information')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Opportunities Information')}}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item"><a href="{{ route('lead.index') }}">{{__('Opportunities')}}</a></li>
<li class="breadcrumb-item">{{__('Opportunities Details')}}</li>
@endsection
@section('action-btn')

@endsection
@section('content')

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Opportunity Name</th>
                                                <th>Assigned Team Member</th>
                                                <th>Value of Opportunity</th>
                                                <th>Currency</th>
                                                <th>Timing – Close</th>
                                                <th>Sales Stage</th>
                                                <th>Deal Length</th>
                                                <th>Difficulty Level</th>
                                                <th>Probability to close</th>
                                                <th>Select Category</th>
                                                <th>Sales Subcategory</th>
                                                <th>Products</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            use App\Models\User;
                                            if(@$lead->assigned_user){
                                            $assignedUserName = $lead->assigned_user ? User::find($lead->assigned_user) : null;

                                            $selected_products = json_decode($lead->products);
                                            $products = $selected_products ? implode(', ', $selected_products) : '-';
                                            }
                                            @endphp
                                            @if ($lead)
                                            <tr>
                                                <td>{{ $lead->opportunity_name }}</td>
                                                <td>{{ @$assignedUserName ? $assignedUserName->name : '-' }}</td>
                                                <td>{{ $lead->value_of_opportunity ?? '-' }}</td>
                                                <td>{{ $lead->currency ?? '-' }}</td>
                                                <td>{{ $lead->timing_close ?? '-' }}</td>
                                                <td>{{ $lead->sales_stage ?? '-' }}</td>
                                                <td>{{ $lead->deal_length ?? '-' }}</td>
                                                <td>{{ $lead->difficult_level ?? '-' }}</td>
                                                <td>{{ $lead->probability_to_close ?? '-' }}</td>
                                                <td>{{ $lead->category ?? '-' }}</td>
                                                <td>{{ $lead->sales_subcategory ?? '-' }}</td>
                                                <td>{{ $products }}</td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td colspan="12">No opportunity found.</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Primary Contact Information</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Name')}} </small>
                                    </div>
                                    @if($lead->primary_name)
                                    <div class="col-md-5 need_half ">
                                        <span class="">{{ $lead->primary_name }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Email')}}</small>
                                    </div>
                                    @if($lead->primary_email)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $lead->primary_email }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Phone Number')}}</small>
                                    </div>
                                    @if($lead->primary_contact)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $lead->primary_contact }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Address')}}</small>
                                    </div>
                                    @if($lead->primary_address)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $lead->primary_address }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Title/Designation')}}</small>
                                    </div>
                                    @if($lead->primary_organization)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $lead->primary_organization }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Secondary Contact Information</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Name')}} </small>
                                    </div>
                                    @if($lead->secondary_name)
                                    <div class="col-md-5 need_half ">
                                        <span class="">{{ $lead->secondary_name }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Email')}}</small>
                                    </div>
                                    @if($lead->secondary_email)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $lead->secondary_email }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Phone Number')}}</small>
                                    </div>
                                    @if($lead->secondary_contact)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $lead->secondary_contact }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Address')}}</small>
                                    </div>
                                    @if($lead->secondary_address)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $lead->secondary_address }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Title/Designation')}}</small>
                                    </div>
                                    @if($lead->secondary_designation)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $lead->secondary_designation }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Upload Documents</h3>
                                {{Form::open(array('route' => ['lead.uploaddoc', $lead->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))}}
                                <label for="customerattachment">Attachment</label>
                                <input type="file" name="customerattachment" id="customerattachment" class="form-control" required>
                                <input type="submit" value="Submit" class="btn btn-primary mt-4" style="float: right;">
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Attachments</h3>
                                <div class="table-responsive ">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Attachment</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($docs as $doc)
                                            @if(Storage::disk('public')->exists($doc->filepath))
                                            <tr>
                                                <td>{{$doc->filename}}</td>
                                                <td><a href="{{ Storage::url('app/public/'.$doc->filepath) }}" download style="color: teal;" title="Download">View Document <i class="fa fa-download"></i></a>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script-page')
<script>
    $(document).ready(function() {
        $('#addnotes').on('submit', function(e) {
            e.preventDefault();
            var id = <?php echo  $lead->id; ?>;
            var notes = $('input[name="notes"]').val();
            var createrid = <?php echo Auth::user()->id; ?>;

            $.ajax({
                url: "{{ route('addleadnotes', ['id' => $lead->id]) }}",
                type: 'POST',
                data: {
                    "notes": notes,
                    "createrid": createrid,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    location.reload();
                }
            });

        });
    });
</script>
@endpush