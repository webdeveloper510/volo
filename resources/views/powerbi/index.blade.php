@extends('layouts.admin')
@section('page-title')
{{ __('Report') }}
@endsection
@section('title')
{{ __('Power BI Report') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item">{{ __('Report') }}</li>
<li class="breadcrumb-item">{{ __('Power BI Report') }}</li>
@endsection
@section('content')
<div class="row">
    <div id="embed-container" style="width:100%;height:500px;"></div>
</div>
@endsection

@push('script-page')
<script src="{{ asset('js/powerbi-client/powerbi.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let embedContainer = document.getElementById('embed-container');
        let embedConfiguration = {
            type: 'report',
            accessToken: '{{ $accessToken }}',
            embedUrl: '{{ $embedUrl }}',
            id: '{{ $reportId }}',
            permissions: powerbi.models.Permissions.View,
            tokenType: powerbi.models.TokenType.Aad
        };

        // Log embedConfiguration to the console
        console.log(embedConfiguration);

        // Embed the report
        let report = powerbi.embed(embedContainer, embedConfiguration);
        report.on('loaded', function() {
            console.log('Report loaded successfully');
        });

        report.on('error', function(event) {
            console.error('Error loading report', event.detail);
        });
    });
</script>
@endpush