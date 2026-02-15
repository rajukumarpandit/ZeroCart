<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zyrocart Installer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .installer-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            overflow: hidden;
        }

        .installer-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .installer-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .installer-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .installer-progress {
            display: flex;
            justify-content: space-between;
            padding: 30px 40px;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .progress-step {
            flex: 1;
            text-align: center;
            position: relative;
            padding: 0 10px;
        }

        .progress-step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 15px;
            right: -50%;
            width: 100%;
            height: 2px;
            background: #dee2e6;
            z-index: 0;
        }

        .progress-step.active:not(:last-child)::after,
        .progress-step.completed:not(:last-child)::after {
            background: #667eea;
        }

        .progress-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #dee2e6;
            color: #6c757d;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .progress-step.active .progress-circle {
            background: #667eea;
            color: white;
        }

        .progress-step.completed .progress-circle {
            background: #28a745;
            color: white;
        }

        .progress-step.completed .progress-circle::before {
            content: '✓';
        }

        .progress-label {
            font-size: 12px;
            color: #6c757d;
            font-weight: 500;
        }

        .progress-step.active .progress-label {
            color: #667eea;
            font-weight: 600;
        }

        .installer-content {
            padding: 40px;
        }

        .installer-footer {
            padding: 20px 40px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .requirement-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .requirement-item.success {
            background: #d4edda;
            border-left: 4px solid #28a745;
        }

        .requirement-item.error {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #28a745;
            color: white;
        }

        .badge-danger {
            background: #dc3545;
            color: white;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="installer-container">
        <div class="installer-header">
            <h1>🛒 Zyrocart</h1>
            <p>Installation Wizard</p>
        </div>

        <div class="installer-progress">
            <div class="progress-step {{ request()->is('install') || request()->is('install/welcome') ? 'active' : '' }} {{ request()->is('install/requirements') || request()->is('install/permissions') || request()->is('install/database') || request()->is('install/admin') || request()->is('install/finish') ? 'completed' : '' }}">
                <div class="progress-circle">1</div>
                <div class="progress-label">Welcome</div>
            </div>
            <div class="progress-step {{ request()->is('install/requirements') ? 'active' : '' }} {{ request()->is('install/permissions') || request()->is('install/database') || request()->is('install/admin') || request()->is('install/finish') ? 'completed' : '' }}">
                <div class="progress-circle">2</div>
                <div class="progress-label">Requirements</div>
            </div>
            <div class="progress-step {{ request()->is('install/permissions') ? 'active' : '' }} {{ request()->is('install/database') || request()->is('install/admin') || request()->is('install/finish') ? 'completed' : '' }}">
                <div class="progress-circle">3</div>
                <div class="progress-label">Permissions</div>
            </div>
            <div class="progress-step {{ request()->is('install/database') ? 'active' : '' }} {{ request()->is('install/admin') || request()->is('install/finish') ? 'completed' : '' }}">
                <div class="progress-circle">4</div>
                <div class="progress-label">Database</div>
            </div>
            <div class="progress-step {{ request()->is('install/admin') ? 'active' : '' }} {{ request()->is('install/finish') ? 'completed' : '' }}">
                <div class="progress-circle">5</div>
                <div class="progress-label">Admin</div>
            </div>
            <div class="progress-step {{ request()->is('install/finish') ? 'active' : '' }}">
                <div class="progress-circle">6</div>
                <div class="progress-label">Finish</div>
            </div>
        </div>

        <div class="installer-content">
            @yield('content')
        </div>

        @hasSection('footer')
        <div class="installer-footer">
            @yield('footer')
        </div>
        @endif
    </div>

    @yield('scripts')
</body>
</html>