@extends('Backend.AdminTheme.layout')

@section('title', 'Create Permission')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2 text-gray-800">Create New Permission</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Permissions
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5 class="alert-heading"><i class="fas fa-exclamation-circle"></i> Please fix the following errors:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <!-- Permission Form -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-key"></i> Permission Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.permissions.store') }}" method="POST" id="permissionForm">
                            @csrf

                            <div class="form-group">
                                <label for="module">Module <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-control @error('module') is-invalid @enderror" id="module"
                                        name="module" required>
                                        <option value="">Select Module</option>
                                        @foreach ($modules ?? [] as $module)
                                            <option value="{{ $module }}"
                                                {{ old('module') == $module ? 'selected' : '' }}>
                                                {{ ucfirst($module) }}
                                            </option>
                                        @endforeach
                                        <option value="new_module">+ Create New Module</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="addModuleBtn"
                                            style="display: none;">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="text" class="form-control mt-2" id="newModuleInput"
                                    placeholder="Enter new module name (e.g., products, orders)" style="display: none;">
                                @error('module')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Group related permissions together (e.g., users, products, orders)
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="action">Action/Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="action"
                                    name="name" value="{{ old('name') }}" placeholder="e.g., view, create, edit, delete"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    The action this permission allows (will be combined with module automatically)
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="permission_preview">Permission Name Preview</label>
                                <input type="text" class="form-control bg-light" id="permission_preview" readonly>
                                <small class="form-text text-muted">
                                    This is how the permission will be stored in the system
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                    id="display_name" name="display_name" value="{{ old('display_name') }}"
                                    placeholder="e.g., View Users, Create Products">
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    User-friendly name shown in the admin panel
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="3" placeholder="Brief description of what this permission allows">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Create Permission
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Help & Tips -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-lightbulb"></i> Quick Tips
                        </h6>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Naming Conventions</h6>
                        <ul class="small mb-3">
                            <li>Use lowercase for actions (view, create, edit, delete)</li>
                            <li>Permissions are formatted as: <code>module.action</code></li>
                            <li>Example: <code>users.view</code>, <code>products.create</code></li>
                        </ul>

                        <h6 class="text-primary">Common Actions</h6>
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-outline-secondary m-1"
                                onclick="setAction('view')">view</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary m-1"
                                onclick="setAction('create')">create</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary m-1"
                                onclick="setAction('edit')">edit</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary m-1"
                                onclick="setAction('delete')">delete</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary m-1"
                                onclick="setAction('manage')">manage</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary m-1"
                                onclick="setAction('export')">export</button>
                        </div>

                        <h6 class="text-primary">Best Practices</h6>
                        <ul class="small mb-0">
                            <li>Group related permissions by module</li>
                            <li>Use clear, descriptive display names</li>
                            <li>Add descriptions for complex permissions</li>
                            <li>Follow consistent naming patterns</li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm mb-4 border-left-warning">
                    <div class="card-body">
                        <h6 class="text-warning mb-3">
                            <i class="fas fa-exclamation-triangle"></i> Important Notes
                        </h6>
                        <ul class="small mb-0">
                            <li>Permission names must be unique</li>
                            <li>Once created, permission names cannot be changed</li>
                            <li>Deleted permissions are removed from all roles</li>
                            <li>Consider future needs when naming permissions</li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm border-left-success">
                    <div class="card-body">
                        <h6 class="text-success mb-3">
                            <i class="fas fa-sync"></i> Sync Permissions
                        </h6>
                        <p class="small mb-2">
                            You can also auto-generate permissions by clicking "Sync Permissions" on the main
                            permissions page.
                        </p>
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-success btn-block">
                            <i class="fas fa-sync"></i> Go to Sync
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const moduleSelect = document.getElementById('module');
        const actionInput = document.getElementById('action');
        const displayNameInput = document.getElementById('display_name');
        const previewInput = document.getElementById('permission_preview');
        const newModuleInput = document.getElementById('newModuleInput');
        const addModuleBtn = document.getElementById('addModuleBtn');

        // Handle new module creation
        moduleSelect.addEventListener('change', function() {
            if (this.value === 'new_module') {
                newModuleInput.style.display = 'block';
                addModuleBtn.style.display = 'block';
                newModuleInput.focus();
            } else {
                newModuleInput.style.display = 'none';
                addModuleBtn.style.display = 'none';
                updatePreview();
            }
        });

        // Add new module
        addModuleBtn.addEventListener('click', function() {
            const newModule = newModuleInput.value.trim().toLowerCase();
            if (newModule) {
                const option = new Option(newModule, newModule, true, true);
                moduleSelect.add(option, moduleSelect.options.length - 1);
                newModuleInput.style.display = 'none';
                addModuleBtn.style.display = 'none';
                updatePreview();
            }
        });

        // Update preview when module or action changes
        moduleSelect.addEventListener('change', updatePreview);
        actionInput.addEventListener('input', function() {
            updatePreview();
            updateDisplayName();
        });

        function updatePreview() {
            const module = moduleSelect.value;
            const action = actionInput.value.trim().toLowerCase();

            if (module && action && module !== 'new_module') {
                previewInput.value = `${module}.${action}`;
            } else {
                previewInput.value = '';
            }
        }

        function updateDisplayName() {
            const module = moduleSelect.value;
            const action = actionInput.value.trim();

            if (module && action && module !== 'new_module' && !displayNameInput.value) {
                const displayName = `${capitalize(action)} ${capitalize(module)}`;
                displayNameInput.value = displayName;
            }
        }

        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        // Quick action buttons
        function setAction(action) {
            actionInput.value = action;
            updatePreview();
            updateDisplayName();
        }

        // Initialize preview
        updatePreview();

        // Form validation
        document.getElementById('permissionForm').addEventListener('submit', function(e) {
            const module = moduleSelect.value;
            const action = actionInput.value.trim();

            if (module === 'new_module') {
                e.preventDefault();
                alert('Please select a module or add a new one.');
                return false;
            }

            if (!module || !action) {
                e.preventDefault();
                alert('Please fill in both module and action fields.');
                return false;
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }

        code {
            background: #f8f9fa;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 0.9em;
        }
    </style>
@endpush