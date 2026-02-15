@extends('installer.layout')

@section('content')
<h2 style="font-size: 24px; color: #333; margin-bottom: 10px;">File Permissions</h2>
<p style="font-size: 14px; color: #666; margin-bottom: 30px;">
    The following directories need to be writable by the web server. Please ensure the correct permissions are set.
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

@php
    $directories = [
        'storage/app' => storage_path('app'),
        'storage/framework' => storage_path('framework'),
        'storage/logs' => storage_path('logs'),
        'bootstrap/cache' => base_path('bootstrap/cache'),
        'public/uploads' => public_path('uploads'),
    ];
    
    $allPermissionsPassed = true;
@endphp

<h3 style="font-size: 18px; color: #333; margin-bottom: 15px;">Directory Permissions</h3>

@foreach($directories as $name => $path)
    @php
        $isWritable = is_writable($path);
        if (!$isWritable) $allPermissionsPassed = false;
        
        // Create directory if it doesn't exist
        if (!file_exists($path)) {
            @mkdir($path, 0775, true);
            $isWritable = is_writable($path);
        }
        
        // Get permission in octal format
        $perms = '';
        if (file_exists($path)) {
            $perms = substr(sprintf('%o', fileperms($path)), -4);
        }
    @endphp
    
    <div class="requirement-item {{ $isWritable ? 'success' : 'error' }}">
        <div>
            <strong>{{ $name }}</strong>
            <span style="color: #666; font-size: 13px; display: block; margin-top: 3px;">
                {{ $path }}
                @if($perms)
                    <span style="margin-left: 10px; padding: 2px 6px; background: #e9ecef; border-radius: 3px; font-family: monospace;">
                        {{ $perms }}
                    </span>
                @endif
            </span>
        </div>
        <span class="badge {{ $isWritable ? 'badge-success' : 'badge-danger' }}">
            {{ $isWritable ? '✓ Writable' : '✗ Not Writable' }}
        </span>
    </div>
@endforeach

@if(!$allPermissionsPassed)
    <div class="alert alert-warning" style="margin-top: 30px;">
        <strong>⚠️ Permission Issues Detected</strong>
        <p style="margin-top: 10px; margin-bottom: 10px;">
            Some directories are not writable. Please run the following commands on your server:
        </p>
        <pre style="background: #f8f9fa; padding: 15px; border-radius: 6px; overflow-x: auto; font-size: 13px; margin: 0;">chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/uploads</pre>
        <p style="margin-top: 10px; margin-bottom: 0; font-size: 13px;">
            Or if you're using a different user/group:
        </p>
        <pre style="background: #f8f9fa; padding: 15px; border-radius: 6px; overflow-x: auto; font-size: 13px; margin-top: 10px; margin-bottom: 0;">sudo chown -R www-data:www-data storage bootstrap/cache public/uploads
sudo chmod -R 775 storage bootstrap/cache public/uploads</pre>
    </div>
@else
    <div class="alert alert-success" style="margin-top: 30px;">
        <strong>✓ Perfect!</strong> All directory permissions are correctly set. You can proceed to the next step.
    </div>
@endif

<div class="alert alert-info" style="margin-top: 20px;">
    <strong>ℹ️ Tip:</strong> After installation, you may want to adjust these permissions for better security. Consult your hosting provider's documentation for recommended permission settings.
</div>
@endsection

@section('footer')
<a href="{{ route('install.requirements') }}" class="btn btn-secondary">← Back</a>
<div style="display: flex; gap: 10px;">
    <button onclick="location.reload()" class="btn btn-secondary">🔄 Recheck</button>
    <a href="{{ route('install.database') }}" class="btn btn-primary {{ !$allPermissionsPassed ? 'disabled' : '' }}"
       {{ !$allPermissionsPassed ? 'onclick="return false;"' : '' }}>
        Next: Database →
    </a>
</div>
@endsection