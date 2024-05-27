@extends('layouts.admin')
@section('page-title')
    {{__('Call')}}
@endsection
@section('title')
        {{__('Call')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item">{{__('Call')}}</li>
@endsection
@section('action-btn')
    <a href="{{ route('call.index') }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" title="{{ __('List View') }}">
        <i class="ti ti-list text-white"></i>
    </a>

    @can('Create Call')
        <a href="#" data-size="lg" data-url="{{ route('call.create',['call',0]) }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Create New Call')}}" title="{{__('Create')}}" class="btn btn-sm btn-primary btn-icon m-1">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection
@section('filter')
@endsection
@section('content')
<div class="row">
    @foreach($calls as $call)
        <div class="col-md-3">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex align-items-center">
                        @if($call->status == 0)
                        <span class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Call::$status[$call->status]) }}</span>
                        @elseif($call->status == 1)
                            <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Call::$status[$call->status]) }}</span>
                        @elseif($call->status == 2)
                            <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Call::$status[$call->status]) }}</span>
                        @endif
                    </div>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="feather icon-more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                @if(Gate::check('Show Call') || Gate::check('Edit Call') || Gate::check('Delete Call'))

                                @can('Edit Call')
                                    <a href="{{ route('call.edit', $call->id) }}" class="dropdown-item"
                                        data-bs-whatever="{{ __('Edit Call') }}" data-bs-toggle="tooltip"
                                        data-title="{{ __('Edit Call') }}"><i class="ti ti-edit"></i>
                                        {{ __('Edit') }}</a>
                                @endcan
                                @can('Show Call')
                                    <a href="#" data-url="{{ route('call.show', $call->id) }}"
                                        data-ajax-popup="true" data-size="md"class="dropdown-item"
                                        data-bs-whatever="{{ __('Call Details') }}"
                                        data-bs-toggle="tooltip"
                                        data-title="{{ __('Call Details') }}"><i class="ti ti-eye"></i>
                                        {{ __('Details') }}</a>
                                @endcan

                                @can('Delete Call')
                                {!! Form::open(['method' => 'DELETE', 'route' => ['call.destroy', $call->id]]) !!}
                                <a href="#!" class="dropdown-item show_confirm" data-bs-toggle="tooltip">
                                    <i class="ti ti-trash"></i>{{ __('Delete') }}
                                </a>
                                {!! Form::close() !!}

                                @endcan
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2 justify-content-between">
                        <div class="col-12">
                            <div class="text-center client-box">
                                <div class="avatar-parent-child">
                                    {{-- <img @if (!empty($employee->avatar)) src="{{ $profile . '/' . $employee->avatar }}" @else
                                                        avatar="{{ $employee->name }}" @endif
                                                    class="avatar rounded-circle avatar-lg"> --}}
                                    <img alt="user-image" class="img-fluid rounded-circle" @if(!empty($call->avatar)) src="{{(!empty($call->avatar))? asset(Storage::url("upload/profile/".$call->avatar)): asset(url("./assets/img/clients/160x160/img-1.png"))}}" @else  avatar="{{$call->name}}" @endif>
                                </div>
                                <h5 class="h6 mt-2 mb-1 text-primary">{{ $call->name}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-md-3">

        <a href="#" class="btn-addnew-project"  data-ajax-popup="true" data-size="lg" data-title="{{ __('Create New Call') }}" data-url="{{ route('call.create',['call',0]) }}">
             <div class="badge bg-primary proj-add-icon">
                <i class="ti ti-plus"></i>
            </div>
            <h6 class="mt-4 mb-2">New Call</h6>
            <p class="text-muted text-center">Click here to add New Call</p>
        </a>
     </div>
</div>






@endsection
@push('script-page')

    <script>


        $(document).on('change', 'select[name=parent]', function () {

            var parent = $(this).val();

            getparent(parent);
        });

        function getparent(bid) {
            console.log(bid);
            $.ajax({
                url: '{{route('call.getparent')}}',
                type: 'POST',
                data: {
                    "parent": bid, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    console.log(data);
                    $('#parent_id').empty();
                    {{--$('#parent_id').append('<option value="">{{__('Select Parent')}}</option>');--}}

                    $.each(data, function (key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#parent_id').empty();
                    }
                }
            });
        }
    </script>
@endpush
