@extends('installer.layout')

@section('content')
<h2 style="font-size: 24px; color: #333; margin-bottom: 10px;">Server Requirements</h2>
<p style="font-size: 14px; color: #666; margin-bottom: 30px;">
    Please ensure your server meets the following requirements to run Zyrocart successfully.
</p>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h3 style="font-size: 18px; color: #333; margin-bottom: 15px; margin-top: 30px;">PHP Version</h3>
<div class="requirement-item {{ version_compare(PHP_VERSION, '8.1.0', '>=') ? 'success' : 'error' }}">
    <div>
        <strong>PHP {{ PHP_VERSION }}</strong>
        <span style="color: #666; font-size: 13px; display: block; margin-top: 3px;">Required: PHP 8.1.0 or higher</span>
    </div>
    <span class="badge {{ version_compare(PHP_VERSION, '8.1.0', '>=') ? 'badge-success' : 'badge-danger' }}">
        {{ version_compare(PHP_VERSION, '8.1.0', '>=') ? '✓ Passed' : '✗ Failed' }}
    </span>
</div>

<h3 style="font-size: 18px; color: #333; margin-bottom: 15px; margin-top: 30px;">PHP Extensions</h3>
@php
    $extensions = [
        'openssl' => 'OpenSSL',
        'pdo' => 'PDO',
        'mbstring' => 'Mbstring',
        'tokenizer' => 'Tokenizer',
        'xml' => 'XML',
        'ctype' => 'Ctype',
        'json' => 'JSON',
        'bcmath' => 'BCMath',
        'curl' => 'cURL',
        'fileinfo' => 'Fileinfo',
        'gd' => 'GD Library',
        'zip' => 'Zip',
    ];
    
    $allExtensionsPassed = true;
@endphp

@foreach($extensions as $extension => $name)
    @php
        $loaded = extension_loaded($extension);
        if (!$loaded) $allExtensionsPassed = false;
    @endphp
    <div class="requirement-item {{ $loaded ? 'success' : 'error' }}">
        <div>
            <strong>{{ $name }}</strong>
        </div>
        <span class="badge {{ $loaded ? 'badge-success' : 'badge-danger' }}">
            {{ $loaded ? '✓ Enabled' : '✗ Disabled' }}
        </span>
    </div>
@endforeach

<h3 style="font-size: 18px; color: #333; margin-bottom: 15px; margin-top: 30px;">Server Configuration</h3>
@php
    $configurations = [
        'memory_limit' => [
            'name' => 'Memory Limit',
            'required' => '128M',
            'current' => ini_get('memory_limit'),
            'check' => function() {
                $memoryLimit = ini_get('memory_limit');
                if ($memoryLimit == -1) return true;
                return (int)$memoryLimit >= 128;
            }
        ],
        'max_execution_time' => [
            'name' => 'Max Execution Time',
            'required' => '60 seconds',
            'current' => ini_get('max_execution_time') . ' seconds',
            'check' => function() {
                $maxExecutionTime = ini_get('max_execution_time');
                if ($maxExecutionTime == 0) return true;
                return (int)$maxExecutionTime >= 60;
            }
        ],
    ];
    
    $allConfigsPassed = true;
@endphp

@foreach($configurations as $config)
    @php
        $passed = $config['check']();
        if (!$passed) $allConfigsPassed = false;
    @endphp
    <div class="requirement-item {{ $passed ? 'success' : 'error' }}">
        <div>
            <strong>{{ $config['name'] }}</strong>
            <span style="color: #666; font-size: 13px; display: block; margin-top: 3px;">
                Current: {{ $config['current'] }} | Required: {{ $config['required'] }}
            </span>
        </div>
        <span class="badge {{ $passed ? 'badge-success' : 'badge-danger' }}">
            {{ $passed ? '✓ Passed' : '✗ Failed' }}
        </span>
    </div>
@endforeach

@php
    $requirementsPassed = version_compare(PHP_VERSION, '8.1.0', '>=') && $allExtensionsPassed && $allConfigsPassed;
@endphp

@if(!$requirementsPassed)
    <div class="alert alert-warning" style="margin-top: 20px;">
        <strong>⚠️ Warning:</strong> Some requirements are not met. Please fix the issues above before proceeding with the installation.
    </div>
@else
    <div class="alert alert-success" style="margin-top: 20px;">
        <strong>✓ Great!</strong> Your server meets all the requirements. You can proceed to the next step.
    </div>
@endif
@endsection

@section('footer')
<a href="{{ route('install.welcome') }}" class="btn btn-secondary">← Back</a>
<a href="{{ route('install.permissions') }}" class="btn btn-primary {{ !$requirementsPassed ? 'disabled' : '' }}" 
   {{ !$requirementsPassed ? 'onclick="return false;"' : '' }}>
    Next: Permissions →
</a>
@endsection