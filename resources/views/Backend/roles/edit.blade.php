@extends('Backend.AdminTheme.layout')

@section('title', 'Edit Role')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">Edit Role: {{ $role->name }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Roles
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="fas fa-exclamation-circle"></i> Please fix the following errors:</h5>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if($role->name === 'super_admin')
        <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Warning:</strong> This is a system role. Some options may be restricted to protect system integrity.
        </div>
    @endif

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" id="roleForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Role Information -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-info-circle"></i> Role Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Role Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $role->name) }}" 
                                   {{ $role->name === 'super_admin' ? 'readonly' : '' }}
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="guard_name">Guard</label>
                            <select 
                                name="guard_name" 
                                id="guard_name" 
                                class="form-control @error('guard_name') is-invalid @enderror"
                            >
                                <option value="">-- Select Guard --</option>
                                <option value="web" {{ old('guard_name',$role->guard_name) == 'web' ? 'selected' : '' }}>
                                    Web
                                </option>
                                <option value="api" {{ old('guard_name',$role->guard_name) == 'api' ? 'selected' : '' }}>
                                    Api
                                </option>
                            </select>

                            @error('guard_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="form-text text-muted">
                                Select guard for this role / permission
                            </small>
                        </div>

                        

                        @if($role->name !== 'super_admin')
                            <div class="custom-control custom-switch">
                                <input type="checkbox" 
                                       class="custom-control-input" 
                                       id="is_default" 
                                       name="is_default" 
                                       value="1"
                                       {{ old('is_default', $role->is_default) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_default">
                                    Set as Default Role
                                </label>
                                <small class="form-text text-muted">
                                    Automatically assign this role to new users
                                </small>
                            </div>
                        @endif

                        <hr>

                        <div class="text-muted small">
                            <p class="mb-1"><strong>Created:</strong> {{ $role->created_at->format('M d, Y h:i A') }}</p>
                            <p class="mb-0"><strong>Last Updated:</strong> {{ $role->updated_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-users"></i> Users with this Role
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <h2 class="mb-0">{{ $role->users_count ?? 0 }}</h2>
                            <small class="text-muted">Active Users</small>
                        </div>
                        @if($role->users_count > 0)
                            <hr>
                            <a href="{{ route('admin.users.index', ['role' => $role->id]) }}" class="btn btn-sm btn-outline-info btn-block">
                                <i class="fas fa-eye"></i> View Users
                            </a>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-lightbulb"></i> Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-outline-primary btn-block mb-2" onclick="selectAll()">
                            <i class="fas fa-check-double"></i> Select All Permissions
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-block mb-2" onclick="deselectAll()">
                            <i class="fas fa-times"></i> Deselect All
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-info btn-block" onclick="compareChanges()">
                            <i class="fas fa-exchange-alt"></i> Compare Changes
                        </button>
                    </div>
                </div>
            </div>

            <!-- Permissions -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-key"></i> Manage Permissions
                        </h6>
                        <div>
                            <input type="text" 
                                   class="form-control form-control-sm" 
                                   id="searchPermissions" 
                                   placeholder="Search permissions..."
                                   style="width: 250px;">
                        </div>
                    </div>
                    <div class="card-body" style="max-height: 600px; overflow-y: auto;">
                        @if(isset($permissionsByModule) && count($permissionsByModule) > 0)
                            @foreach($permissionsByModule as $module => $permissions)
                                <div class="permission-module mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-primary mb-0">
                                            <i class="fas fa-folder"></i> {{ ucfirst($module) }}
                                            <span class="badge badge-primary ml-2">
                                                <span class="module-count" data-module="{{ $module }}">0</span>/{{ count($permissions) }}
                                            </span>
                                        </h6>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" 
                                                   class="custom-control-input module-toggle" 
                                                   id="module_{{ $module }}"
                                                   data-module="{{ $module }}"
                                                   {{ $role->name === 'super_admin' ? 'disabled' : '' }}>
                                            <label class="custom-control-label" for="module_{{ $module }}">
                                                <small>Toggle All</small>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        @foreach($permissions as $permission)
                                            <div class="col-md-6 col-lg-4 mb-3 permission-item" data-module="{{ $module }}">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" 
                                                           class="custom-control-input permission-checkbox" 
                                                           id="permission_{{ $permission->id }}" 
                                                           name="permissions[]" 
                                                           value="{{ $permission->id }}"
                                                           data-module="{{ $module }}"
                                                           {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}
                                                           {{ $role->name === 'super_admin' ? 'disabled' : '' }}>
                                                    <label class="custom-control-label" for="permission_{{ $permission->id }}">
                                                        <strong>{{ $permission->display_name ?? $permission->name }}</strong>
                                                        @if($permission->description)
                                                            <br><small class="text-muted">{{ $permission->description }}</small>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-exclamation-circle fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No Permissions Available</h5>
                                <p class="text-muted">Please create permissions first.</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                <span id="selectedCount">0</span> permissions selected
                                <span id="changesIndicator" class="ml-2"></span>
                            </span>
                            <div>
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary" {{ $role->name === 'super_admin' ? 'disabled' : '' }}>
                                    <i class="fas fa-save"></i> Update Role
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const initialPermissions = @json($role->permissions->pluck('id')->toArray());
    
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        if ('{{ $role->name }}' !== 'super_admin') {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
            document.getElementById('slug').value = slug;
        }
    });

    // Select all permissions
    function selectAll() {
        document.querySelectorAll('.permission-checkbox:not([disabled])').forEach(checkbox => {
            checkbox.checked = true;
        });
        updateSelectedCount();
        updateModuleCounts();
    }

    // Deselect all permissions
    function deselectAll() {
        document.querySelectorAll('.permission-checkbox:not([disabled])').forEach(checkbox => {
            checkbox.checked = false;
        });
        document.querySelectorAll('.module-toggle:not([disabled])').forEach(toggle => {
            toggle.checked = false;
        });
        updateSelectedCount();
        updateModuleCounts();
    }

    // Module toggle
    document.querySelectorAll('.module-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const module = this.dataset.module;
            const checkboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]:not([disabled])`);
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
            updateModuleCounts();
        });
    });

    // Update module toggle when individual permissions change
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const module = this.dataset.module;
            const moduleCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]:not([disabled])`);
            const moduleToggle = document.querySelector(`.module-toggle[data-module="${module}"]`);
            
            const allChecked = Array.from(moduleCheckboxes).every(cb => cb.checked);
            if (moduleToggle && !moduleToggle.disabled) {
                moduleToggle.checked = allChecked;
            }
            
            updateSelectedCount();
            updateModuleCounts();
        });
    });

    // Update selected count
    function updateSelectedCount() {
        const count = document.querySelectorAll('.permission-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = count;
        
        // Show changes indicator
        const currentPermissions = Array.from(document.querySelectorAll('.permission-checkbox:checked'))
            .map(cb => parseInt(cb.value));
        
        const added = currentPermissions.filter(id => !initialPermissions.includes(id)).length;
        const removed = initialPermissions.filter(id => !currentPermissions.includes(id)).length;
        
        let indicator = '';
        if (added > 0) indicator += `<span class="badge badge-success">+${added}</span> `;
        if (removed > 0) indicator += `<span class="badge badge-danger">-${removed}</span>`;
        
        document.getElementById('changesIndicator').innerHTML = indicator;
    }

    // Update module counts
    function updateModuleCounts() {
        document.querySelectorAll('.module-count').forEach(counter => {
            const module = counter.dataset.module;
            const count = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]:checked`).length;
            counter.textContent = count;
        });
    }

    // Search permissions
    document.getElementById('searchPermissions').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.permission-item').forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Compare changes
    function compareChanges() {
        const currentPermissions = Array.from(document.querySelectorAll('.permission-checkbox:checked'))
            .map(cb => parseInt(cb.value));
        
        const added = currentPermissions.filter(id => !initialPermissions.includes(id));
        const removed = initialPermissions.filter(id => !currentPermissions.includes(id));
        
        let html = '<div class="text-left">';
        
        if (added.length > 0) {
            html += '<h6 class="text-success"><i class="fas fa-plus-circle"></i> Added Permissions:</h6><ul class="mb-3">';
            added.forEach(id => {
                const label = document.querySelector(`#permission_${id}`).nextElementSibling.textContent.trim();
                html += `<li>${label}</li>`;
            });
            html += '</ul>';
        }
        
        if (removed.length > 0) {
            html += '<h6 class="text-danger"><i class="fas fa-minus-circle"></i> Removed Permissions:</h6><ul class="mb-3">';
            removed.forEach(id => {
                const label = document.querySelector(`#permission_${id}`).nextElementSibling.textContent.trim();
                html += `<li>${label}</li>`;
            });
            html += '</ul>';
        }
        
        if (added.length === 0 && removed.length === 0) {
            html += '<p class="text-muted"><i class="fas fa-info-circle"></i> No changes detected.</p>';
        }
        
        html += '</div>';
        
        Swal.fire({
            title: 'Permission Changes',
            html: html,
            icon: 'info',
            width: '600px'
        });
    }

    // Initialize counts
    updateSelectedCount();
    updateModuleCounts();

    // Auto-hide alerts
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush

@push('styles')
<style>
    .permission-module {
        border-left: 3px solid #4e73df;
        padding-left: 15px;
    }
    
    .custom-checkbox .custom-control-label {
        cursor: pointer;
    }
    
    .custom-checkbox:hover {
        background-color: #f8f9fc;
        border-radius: 5px;
        padding: 5px;
    }
</style>
@endpush