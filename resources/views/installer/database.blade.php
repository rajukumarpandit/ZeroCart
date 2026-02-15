@extends('installer.layout')

@section('content')
<h2 style="font-size: 24px; color: #333; margin-bottom: 10px;">Database Configuration</h2>
<p style="font-size: 14px; color: #666; margin-bottom: 30px;">
    Enter your database credentials. Make sure the database already exists before proceeding.
</p>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>
        <ul style="margin: 10px 0 0 20px; padding: 0;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('install.saveDatabase') }}" id="databaseForm">
    @csrf
    
    <div class="form-group">
        <label for="db_connection">Database Connection</label>
        <select name="db_connection" id="db_connection" class="form-control {{ $errors->has('db_connection') ? 'is-invalid' : '' }}">
            <option value="mysql" {{ old('db_connection', 'mysql') == 'mysql' ? 'selected' : '' }}>MySQL</option>
            <option value="pgsql" {{ old('db_connection') == 'pgsql' ? 'selected' : '' }}>PostgreSQL</option>
            <option value="sqlite" {{ old('db_connection') == 'sqlite' ? 'selected' : '' }}>SQLite</option>
            <option value="sqlsrv" {{ old('db_connection') == 'sqlsrv' ? 'selected' : '' }}>SQL Server</option>
        </select>
        @if($errors->has('db_connection'))
            <div class="invalid-feedback">{{ $errors->first('db_connection') }}</div>
        @endif
    </div>

    <div id="mysql-fields">
        <div class="form-group">
            <label for="db_host">Database Host</label>
            <input type="text" name="db_host" id="db_host" class="form-control {{ $errors->has('db_host') ? 'is-invalid' : '' }}" 
                   value="{{ old('db_host', '127.0.0.1') }}" placeholder="127.0.0.1 or localhost">
            @if($errors->has('db_host'))
                <div class="invalid-feedback">{{ $errors->first('db_host') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="db_port">Database Port</label>
            <input type="text" name="db_port" id="db_port" class="form-control {{ $errors->has('db_port') ? 'is-invalid' : '' }}" 
                   value="{{ old('db_port', '3306') }}" placeholder="3306">
            @if($errors->has('db_port'))
                <div class="invalid-feedback">{{ $errors->first('db_port') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="db_name">Database Name</label>
            <input type="text" name="db_name" id="db_name" class="form-control {{ $errors->has('db_name') ? 'is-invalid' : '' }}" 
                   value="{{ old('db_name') }}" placeholder="zyrocart" required>
            @if($errors->has('db_name'))
                <div class="invalid-feedback">{{ $errors->first('db_name') }}</div>
            @endif
            <small style="color: #6c757d; font-size: 12px; display: block; margin-top: 5px;">
                The database must already exist. Create it using phpMyAdmin or MySQL command line.
            </small>
        </div>

        <div class="form-group">
            <label for="db_username">Database Username</label>
            <input type="text" name="db_username" id="db_username" class="form-control {{ $errors->has('db_username') ? 'is-invalid' : '' }}" 
                   value="{{ old('db_username', 'root') }}" placeholder="root" required>
            @if($errors->has('db_username'))
                <div class="invalid-feedback">{{ $errors->first('db_username') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="db_password">Database Password</label>
            <input type="password" name="db_password" id="db_password" class="form-control {{ $errors->has('db_password') ? 'is-invalid' : '' }}" 
                   value="{{ old('db_password') }}" placeholder="Enter database password">
            @if($errors->has('db_password'))
                <div class="invalid-feedback">{{ $errors->first('db_password') }}</div>
            @endif
            <small style="color: #6c757d; font-size: 12px; display: block; margin-top: 5px;">
                Leave blank if there is no password (not recommended for production).
            </small>
        </div>
    </div>

    <div class="alert alert-info">
        <strong>ℹ️ Testing Connection</strong>
        <p style="margin-top: 8px; margin-bottom: 0;">
            When you click "Test & Continue", we'll verify the database connection before proceeding.
        </p>
    </div>

    <button type="button" onclick="testConnection()" class="btn btn-secondary" style="margin-top: 10px;" id="testBtn">
        🔍 Test Connection
    </button>
    
    <div id="connectionResult" style="margin-top: 15px;"></div>
</form>
@endsection

@section('footer')
<a href="{{ route('install.permissions') }}" class="btn btn-secondary">← Back</a>
<button type="submit" form="databaseForm" class="btn btn-primary" id="submitBtn">
    Test & Continue →
</button>
@endsection

@section('scripts')
<script>
    const dbConnection = document.getElementById('db_connection');
    const dbPort = document.getElementById('db_port');
    const mysqlFields = document.getElementById('mysql-fields');
    
    dbConnection.addEventListener('change', function() {
        const connection = this.value;
        
        // Update default port based on connection type
        switch(connection) {
            case 'mysql':
                dbPort.value = '3306';
                mysqlFields.style.display = 'block';
                break;
            case 'pgsql':
                dbPort.value = '5432';
                mysqlFields.style.display = 'block';
                break;
            case 'sqlsrv':
                dbPort.value = '1433';
                mysqlFields.style.display = 'block';
                break;
            case 'sqlite':
                mysqlFields.style.display = 'none';
                break;
        }
    });
    
    function testConnection() {
        const form = document.getElementById('databaseForm');
        const formData = new FormData(form);
        const resultDiv = document.getElementById('connectionResult');
        const testBtn = document.getElementById('testBtn');
        
        testBtn.disabled = true;
        testBtn.innerHTML = '⏳ Testing...';
        resultDiv.innerHTML = '<div class="spinner"></div>';
        
        fetch('{{ route('install.database') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            testBtn.disabled = false;
            testBtn.innerHTML = '🔍 Test Connection';
            
            if (data.success) {
                resultDiv.innerHTML = `
                    <div class="alert alert-success">
                        <strong>✓ Success!</strong> Database connection established successfully.
                    </div>
                `;
            } else {
                resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <strong>✗ Connection Failed</strong>
                        <p style="margin-top: 8px; margin-bottom: 0;">${data.message || 'Could not connect to the database. Please check your credentials.'}</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            testBtn.disabled = false;
            testBtn.innerHTML = '🔍 Test Connection';
            resultDiv.innerHTML = `
                <div class="alert alert-danger">
                    <strong>✗ Error</strong>
                    <p style="margin-top: 8px; margin-bottom: 0;">An error occurred while testing the connection.</p>
                </div>
            `;
        });
    }
    
    // Auto-hide connection result when form fields change
    const formInputs = document.querySelectorAll('#databaseForm input, #databaseForm select');
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            const resultDiv = document.getElementById('connectionResult');
            if (resultDiv.innerHTML) {
                resultDiv.style.opacity = '0.5';
            }
        });
    });
</script>
@endsection