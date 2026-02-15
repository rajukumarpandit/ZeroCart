@extends('installer.layout')

@section('content')
<h2 style="font-size: 24px; color: #333; margin-bottom: 10px;">Admin Account Setup</h2>
<p style="font-size: 14px; color: #666; margin-bottom: 30px;">
    Create your administrator account. You'll use these credentials to log in to the Zyrocart admin panel.
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

<form method="POST" action="{{ route('install.admin') }}" id="adminForm">
    @csrf
    
    <div style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin-bottom: 30px;">
        <h3 style="font-size: 18px; color: #333; margin-bottom: 20px;">👤 Personal Information</h3>
        
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                   value="{{ old('name') }}" placeholder="John Doe" required autofocus>
            @if($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                   value="{{ old('email') }}" placeholder="admin@example.com" required>
            @if($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
            <small style="color: #6c757d; font-size: 12px; display: block; margin-top: 5px;">
                This will be your login username.
            </small>
        </div>
    </div>

    <div style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin-bottom: 30px;">
        <h3 style="font-size: 18px; color: #333; margin-bottom: 20px;">🔐 Security</h3>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                   placeholder="Enter a strong password" required>
            @if($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
            <div id="passwordStrength" style="margin-top: 8px; font-size: 12px;"></div>
            <small style="color: #6c757d; font-size: 12px; display: block; margin-top: 5px;">
                Minimum 8 characters. Use a mix of letters, numbers, and symbols for better security.
            </small>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                   placeholder="Re-enter your password" required>
            <div id="passwordMatch" style="margin-top: 8px; font-size: 12px;"></div>
        </div>
    </div>

    <div style="background: #f8f9fa; padding: 25px; border-radius: 8px; margin-bottom: 20px;">
        <h3 style="font-size: 18px; color: #333; margin-bottom: 20px;">🏪 Store Settings</h3>
        
        <div class="form-group">
            <label for="store_name">Store Name</label>
            <input type="text" name="store_name" id="store_name" class="form-control {{ $errors->has('store_name') ? 'is-invalid' : '' }}" 
                   value="{{ old('store_name', 'Zyrocart Store') }}" placeholder="My Awesome Store" required>
            @if($errors->has('store_name'))
                <div class="invalid-feedback">{{ $errors->first('store_name') }}</div>
            @endif
            <small style="color: #6c757d; font-size: 12px; display: block; margin-top: 5px;">
                You can change this later in the settings.
            </small>
        </div>

        <div class="form-group">
            <label for="store_email">Store Email</label>
            <input type="email" name="store_email" id="store_email" class="form-control {{ $errors->has('store_email') ? 'is-invalid' : '' }}" 
                   value="{{ old('store_email') }}" placeholder="support@yourstore.com">
            @if($errors->has('store_email'))
                <div class="invalid-feedback">{{ $errors->first('store_email') }}</div>
            @endif
            <small style="color: #6c757d; font-size: 12px; display: block; margin-top: 5px;">
                This email will be used for customer communications.
            </small>
        </div>
    </div>

    <div class="alert alert-info">
        <strong>ℹ️ Almost Done!</strong>
        <p style="margin-top: 8px; margin-bottom: 0;">
            After creating your admin account, the installer will set up the database tables and finalize the installation.
        </p>
    </div>
</form>
@endsection

@section('footer')
<a href="{{ route('install.database') }}" class="btn btn-secondary">← Back</a>
<button type="submit" form="adminForm" class="btn btn-primary" id="submitBtn">
    Create Admin & Finish →
</button>
@endsection

@section('scripts')
<script>
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    const passwordStrength = document.getElementById('passwordStrength');
    const passwordMatch = document.getElementById('passwordMatch');
    
    // Password strength checker
    password.addEventListener('input', function() {
        const value = this.value;
        let strength = 0;
        let strengthText = '';
        let strengthColor = '';
        
        if (value.length >= 8) strength++;
        if (value.length >= 12) strength++;
        if (/[a-z]/.test(value) && /[A-Z]/.test(value)) strength++;
        if (/[0-9]/.test(value)) strength++;
        if (/[^a-zA-Z0-9]/.test(value)) strength++;
        
        switch(strength) {
            case 0:
            case 1:
                strengthText = '❌ Weak password';
                strengthColor = '#dc3545';
                break;
            case 2:
            case 3:
                strengthText = '⚠️ Medium strength';
                strengthColor = '#ffc107';
                break;
            case 4:
                strengthText = '✓ Strong password';
                strengthColor = '#28a745';
                break;
            case 5:
                strengthText = '✓ Very strong password';
                strengthColor = '#28a745';
                break;
        }
        
        passwordStrength.textContent = strengthText;
        passwordStrength.style.color = strengthColor;
        
        checkPasswordMatch();
    });
    
    // Password match checker
    passwordConfirmation.addEventListener('input', checkPasswordMatch);
    
    function checkPasswordMatch() {
        const pass = password.value;
        const passConfirm = passwordConfirmation.value;
        
        if (passConfirm.length === 0) {
            passwordMatch.textContent = '';
            return;
        }
        
        if (pass === passConfirm) {
            passwordMatch.textContent = '✓ Passwords match';
            passwordMatch.style.color = '#28a745';
        } else {
            passwordMatch.textContent = '❌ Passwords do not match';
            passwordMatch.style.color = '#dc3545';
        }
    }
    
    // Auto-fill store email with admin email
    const emailInput = document.getElementById('email');
    const storeEmailInput = document.getElementById('store_email');
    
    emailInput.addEventListener('blur', function() {
        if (!storeEmailInput.value && this.value) {
            storeEmailInput.value = this.value;
        }
    });
    
    // Form submission with loading state
    const adminForm = document.getElementById('adminForm');
    const submitBtn = document.getElementById('submitBtn');
    
    adminForm.addEventListener('submit', function(e) {
        // Check if passwords match
        if (password.value !== passwordConfirmation.value) {
            e.preventDefault();
            alert('Passwords do not match!');
            return;
        }
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '⏳ Creating Account & Setting Up...';
    });
</script>
@endsection