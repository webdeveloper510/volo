@extends('layouts.admin')
@section('page-title')
{{ __('Objective Tracker') }}
@endsection
@section('title')
{{ __('Objective Tracker') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('objective-tracker') }}">{{ __('Objective Tracker') }}</a></li>
<li class="breadcrumb-item">{{ __('Objective Tracker') }}</li>
@endsection
<style>
    .container {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .left,
    .right {
        width: 48%;
    }

    .header,
    .data {
        background-color: #90EE90;
        padding: 10px;
        margin-bottom: 10px;
    }

    .header div,
    .data div {
        display: inline-block;
        width: 50%;
    }

    .tasks-status {
        margin-top: 20px;
    }

    .tasks-status .status-header {
        font-weight: bold;
        text-align: left;
        margin-bottom: 5px;
    }

    .status-item {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
    }

    .outstanding {
        color: red;
    }

    .in-progress {
        color: orange;
    }

    .complete {
        color: green;
    }
</style>
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive overflow_hidden">
                    <div class="row">
                        <div class="col-4">
                            <table class="table" style="width: 100%; border-collapse: collapse;">
                                <tr class="table-header">
                                    <th colspan="2">Doe Ref: Objective Tracker_V1_052024</th>
                                </tr>
                                <tr class="table-header">
                                    <th>Name</th>
                                    <th>Period</th>
                                </tr>
                                <tr>
                                    <td>Joe Keane</td>
                                    <td>2024</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                            <table class="table" style="border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th>Tasks</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="outstanding">Outstanding</td>
                                        <td class="outstanding">2</td>
                                        <td>22%</td>
                                    </tr>
                                    <tr>
                                        <td class="in-progress">In Progress</td>
                                        <td class="in-progress">5</td>
                                        <td>56%</td>
                                    </tr>
                                    <tr>
                                        <td class="complete">Complete</td>
                                        <td class="complete">2</td>
                                        <td>22%</td>
                                    </tr>
                                    <tr>
                                        <td>Total:</td>
                                        <td>9</td>
                                        <td>100%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Objective</th>
                                <th scope="col">Measure</th>
                                <th scope="col">Key Dates</th>
                                <th scope="col">Status</th>
                                <th scope="col">Q1 Updates</th>
                                <th scope="col">Q2 Updates</th>
                                <th scope="col">Q3 Updates</th>
                                <th scope="col">Q4 Updates</th>
                                <th scope="col">EOY Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <th>1</th>
                                <td>Mark</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection