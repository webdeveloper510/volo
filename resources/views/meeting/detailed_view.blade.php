@extends('layouts.admin')
@section('page-title')
{{ __('Event Information') }}
@endsection
@section('title')
{{ __('Event Information') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item">{{ __('Event Information') }}</li>
@endsection
@section('action-btn')

@endsection
@section('filter')
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <dl class="row ">
                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Event')}}</span></dt>
                        <dd class="col-md-6 need_half"><span class="">{{ !empty($event->name) ? $event->name : '-' }}</span></dd>
                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Assigned Team Member')}}</span></dt>
                        <dd class="col-md-6 need_half"><span class="">{{$assigned_to}}</span></dd>
                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Start Date')}}</span></dt>
                        @if($event->start_date)
                        <dd class="col-md-6 need_half"><span class="">{{\Auth::user()->dateFormat($event->start_date)}}</span>
                        </dd>
                        @else
                        <dd class="col-md-6 need_half "><span class="">{{\Auth::user()->dateFormat($event->start_date)}} -
                                {{\Auth::user()->dateFormat($event->end_date)}}</span></dd>
                        @endif

                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('End Date')}}</span></dt>
                        @if($event->end_date)
                        <dd class="col-md-6 need_half"><span class="">{{\Auth::user()->dateFormat($event->end_date)}}</span>
                        </dd>
                        @else
                        <dd class="col-md-6 need_half "><span class="">{{\Auth::user()->dateFormat($event->end_date)}} -
                                {{\Auth::user()->dateFormat($event->end_date)}}</span></dd>
                        @endif

                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Location')}}</span></dt>
                        <dd class="col-md-6 need_half"><span class="">{{$event->venue_selection}}</span></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection