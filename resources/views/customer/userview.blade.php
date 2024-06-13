@extends('layouts.admin')
@section('page-title')
@endsection
@section('title')
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('siteusers') }}">{{ __('Clients') }}</a></li>
<li class="breadcrumb-item">{{ __('Client Details') }}</li>
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Opportunities</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Primary Details</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Name')}} </small>
                                    </div>
                                    @if($client->primary_name)
                                    <div class="col-md-5 need_half ">
                                        <span class="">{{ $client->primary_name }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Email')}}</small>
                                    </div>
                                    @if($client->primary_email)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->primary_email }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Phone Number')}}</small>
                                    </div>
                                    @if($client->primary_phone_number)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->primary_phone_number }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Address')}}</small>
                                    </div>
                                    @if($client->primary_address)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->primary_address }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Title/Designation')}}</small>
                                    </div>
                                    @if($client->primary_organization)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->primary_organization }}</span>
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
                                <h3>Secondary Details</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Name')}} </small>
                                    </div>
                                    @if($client->secondary_name)
                                    <div class="col-md-5 need_half ">
                                        <span class="">{{ $client->secondary_name }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Email')}}</small>
                                    </div>
                                    @if($client->secondary_email)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->secondary_email }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Phone Number')}}</small>
                                    </div>
                                    @if($client->secondary_phone_number)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->secondary_phone_number }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Address')}}</small>
                                    </div>
                                    @if($client->secondary_address)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->secondary_address }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Title/Designation')}}</small>
                                    </div>
                                    @if($client->secondary_designation)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->secondary_designation }}</span>
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
                                <h3>Other Details</h3>
                                <div class="row align-items-center ">
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Company Name')}} </small>
                                    </div>
                                    @if($client->company_name)
                                    <div class="col-md-5 need_half ">
                                        <span class="">{{ $client->company_name }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Entity Name')}} </small>
                                    </div>
                                    @if($client->entity_name)
                                    <div class="col-md-5 need_half ">
                                        <span class="">{{ $client->entity_name }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Location')}} </small>
                                    </div>
                                    @if($client->location)
                                    <div class="col-md-5 need_half ">
                                        <span class="">{{ $client->location }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Region')}}</small>
                                    </div>
                                    @if($client->region)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->region }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Industry')}}</small>
                                    </div>
                                    @if($client->industry)
                                    @php
                                    $industries = json_decode($client->industry, true);
                                    @endphp
                                    <div class="col-md-5 mt-1 need_half">
                                        <span>
                                            {{ implode(', ', $industries) }}
                                        </span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Engagement Level')}}</small>
                                    </div>
                                    @if($client->engagement_level)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->engagement_level }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Revenue Booked To Date')}}</small>
                                    </div>
                                    @if($client->revenue_booked_to_date)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->revenue_booked_to_date }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Referred By')}}</small>
                                    </div>
                                    @if($client->referred_by)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">{{ $client->referred_by }}</span>
                                    </div>
                                    @else
                                    <div class="col-md-5 need_half ">
                                        <span class="">--</span>
                                    </div>
                                    @endif
                                    <div class="col-md-4  mt-1 need_half">
                                        <small class="h6  mb-3 mb-md-0">{{__('Status')}}</small>
                                    </div>
                                    @if($client->status == 0)
                                    <div class="col-md-5  mt-1 need_half">
                                        <span class="">Active</span>
                                    </div>
                                    @else
                                    <<div class="col-md-5  mt-1 need_half">
                                        <span class="">Inactive</span>
                                </div>
                                @endif
                                <div class="col-md-4  mt-1 need_half">
                                    <small class="h6  mb-3 mb-md-0">{{__('Created At')}}</small>
                                </div>
                                @if($client->created_at)
                                <div class="col-md-5  mt-1 need_half">
                                    <span class="">{{ \Carbon\Carbon::parse($client->created_at)->format('F j, Y') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card" id="useradd-1">
                        <div class="card-body table-border-style">
                            <h3>Pain Points</h3>
                            {{ $client->pain_points }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card" id="useradd-1">
                        <div class="card-body table-border-style">
                            <h3>Attachments</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Attachment</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $files = Storage::files('app/public/External_customer/' . $client->id);
                                        ?>
                                        @foreach ($files as $file)
                                        <tr>
                                            <td>{{ basename($file) }}</td>
                                            <td><a href="{{ Storage::url($file) }}" download style="color: teal;" title="Download">
                                                    View Document <i class="fa fa-download"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card" id="useradd-1">
                        <div class="card-body table-border-style">
                            <h3>Notes</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Notes</th>
                                        <th>Created By</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $client->notes }}</td>
                                            <td>{{App\Models\User::where('id', $client->created_by)->first()->name}}</td>
                                            <td>{{\Auth::user()->dateFormat($client->created_at)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card" id="useradd-1">
                        <div class="card-body table-border-style">
                            <h3>Upload Documents</h3>
                            <form action="{{route('upload-info',urlencode(encrypt($client->id)))}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="customerattachment">Attachment</label>
                                <input type="file" name="customerattachment" id="customerattachment" class="form-control" required>
                                <input type="submit" value="Submit" class="btn btn-primary mt-4" style="float: right;">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body table-border-style">
                            <h3>Add Notes/Comments</h3>
                            <form method="POST" id="addnotes">
                                @csrf
                                <label for="notes">Notes</label>
                                <input type="text" class="form-control" name="notes">
                                <input type="submit" value="Submit" class="btn btn-primary mt-4" style=" float: right;">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

@endsection
<style>
    .list-group-flush .list-group-item {
        background: none;
    }

    /* body{
    overflow-y: clip;
} */
</style>
@push('script-page')
<script>
    $(document).ready(function() {
        $('#addnotes').on('submit', function(e) {
            e.preventDefault();
            var id = <?php echo  $client->id; ?>;
            var notes = $('input[name="notes"]').val();
            var createrid = <?php echo Auth::user()->id; ?>;
            $.ajax({
                url: "{{ route('addusernotes', ['id' => $client->id]) }}",
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