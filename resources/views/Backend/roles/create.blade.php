@extends('Backend.AdminTheme.layout')

@section('title', 'Create New Role')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">Create New Role</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Roles
            </a>
        </div>
    </div>

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

    <form action="{{ route('admin.roles.store') }}" method="POST" id="roleForm">
        @csrf
        
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
                                   value="{{ old('name') }}" 
                                   placeholder="e.g., Admim, Editor, Customer"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                A unique name for this role
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="guard_name">Guard</label>
                            <select 
                                name="guard_name" 
                                id="guard_name" 
                                class="form-control @error('guard_name') is-invalid @enderror"
                            >
                                <option value="">-- Select Guard --</option>
                                <option value="web" {{ old('guard_name') == 'web' ? 'selected' : '' }}>
                                    Web
                                </option>
                                <option value="api" {{ old('guard_name') == 'api' ? 'selected' : '' }}>
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

                        
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
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
                        <button type="button" class="btn btn-sm btn-outline-info btn-block" onclick="selectByModule()">
                            <i class="fas fa-filter"></i> Select by Module
                        </button>
                    </div>
                </div>
            </div>

            <!-- Permissions -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-key"></i> Assign Permissions
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
                                        </h6>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" 
                                                   class="custom-control-input module-toggle" 
                                                   id="module_{{ $module }}"
                                                   data-module="{{ $module }}">
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
                                                           {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
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
                            </span>
                            <div>
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Create Role
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
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
        document.getElementById('slug').value = slug;
    });

    // Select all permissions
    function selectAll() {
        document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
            checkbox.checked = true;
        });
        updateSelectedCount();
    }

    // Deselect all permissions
    function deselectAll() {
        document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
        document.querySelectorAll('.module-toggle').forEach(toggle => {
            toggle.checked = false;
        });
        updateSelectedCount();
    }

    // Module toggle
    document.querySelectorAll('.module-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const module = this.dataset.module;
            const checkboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
        });
    });

    // Update module toggle when individual permissions change
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const module = this.dataset.module;
            const moduleCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
            const moduleToggle = document.querySelector(`.module-toggle[data-module="${module}"]`);
            
            const allChecked = Array.from(moduleCheckboxes).every(cb => cb.checked);
            if (moduleToggle) {
                moduleToggle.checked = allChecked;
            }
            
            updateSelectedCount();
        });
    });

    // Update selected count
    function updateSelectedCount() {
        const count = document.querySelectorAll('.permission-checkbox:checked').length;
        document.getElementById('selectedCount').textContent = count;
    }

    // Search permissions
    document.getElementById('searchPermissions').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.permission-item').forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Select by module modal
    function selectByModule() {
        const modules = [...new Set(Array.from(document.querySelectorAll('.permission-module')).map(m => 
            m.querySelector('h6').textContent.trim().replace('folder', '').trim()
        ))];
        
        let options = modules.map(module => `<option value="${module}">${module}</option>`).join('');
        
        Swal.fire({
            title: 'Select Module',
            html: `<select id="moduleSelect" class="form-control">${options}</select>`,
            showCancelButton: true,
            confirmButtonText: 'Select Permissions',
            preConfirm: () => {
                return document.getElementById('moduleSelect').value;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const selectedModule = result.value.toLowerCase();
                document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                    if (checkbox.dataset.module === selectedModule) {
                        checkbox.checked = true;
                    }
                });
                updateSelectedCount();
            }
        });
    }

    // Initialize selected count
    updateSelectedCount();
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