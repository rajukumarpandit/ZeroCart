@extends('Backend.AdminTheme.layout')

@section('title', 'Edit Permission')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2 text-gray-800">Edit Permission: {{ $permission->name }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Permissions
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

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
                        <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST"
                            id="permissionForm">
                            @csrf
                            @method('PUT')

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Note:</strong> Changing the permission name will affect all roles using this
                                permission. Proceed with caution.
                            </div>

                            <div class="form-group">
                                <label for="module">Module <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select class="form-control @error('module') is-invalid @enderror" id="module"
                                        name="module" required>
                                        <option value="">Select Module</option>
                                        @foreach ($modules ?? [] as $module)
                                            <option value="{{ $module }}"
                                                {{ old('module', $currentModule) == $module ? 'selected' : '' }}>
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
                                    placeholder="Enter new module name" style="display: none;">
                                @error('module')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="action">Action/Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="action"
                                    name="name"
                                    value="{{ old('name', explode('.', $permission->name)[1] ?? $permission->name) }}"
                                    placeholder="e.g., view, create, edit, delete" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Current full name: <code>{{ $permission->name }}</code>
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="permission_preview">New Permission Name Preview</label>
                                <input type="text" class="form-control bg-light" id="permission_preview" readonly>
                                <small class="form-text text-muted">
                                    This is how the permission will be updated in the system
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                    id="display_name" name="display_name"
                                    value="{{ old('display_name', $permission->display_name) }}"
                                    placeholder="e.g., View Users, Create Products">
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="3">{{ old('description', $permission->description) }}</textarea>
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
                                    <i class="fas fa-save"></i> Update Permission
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Permission Details & Stats -->
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-info-circle"></i> Permission Details
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless table-sm mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted" width="40%"><strong>Current Name:</strong></td>
                                    <td><code>{{ $permission->name }}</code></td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Display Name:</strong></td>
                                    <td>{{ $permission->display_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Module:</strong></td>
                                    <td><span
                                            class="badge badge-primary">{{ explode('.', $permission->name)[0] ?? 'general' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Created:</strong></td>
                                    <td>{{ $permission->created_at->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Updated:</strong></td>
                                    <td>{{ $permission->updated_at->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow-sm mb-4 border-left-warning">
                    <div class="card-body">
                        <h6 class="text-warning mb-3">
                            <i class="fas fa-shield-alt"></i> Roles Using This Permission
                        </h6>
                        @php
                            $rolesCount = $permission->roles()->count();
                        @endphp
                        <div class="text-center mb-3">
                            <h2 class="mb-0">{{ $rolesCount }}</h2>
                            <small class="text-muted">Total Roles</small>
                        </div>

                        @if ($rolesCount > 0)
                            <div class="mb-3">
                                @foreach ($permission->roles as $role)
                                    <span class="badge badge-secondary mb-1">{{ $role->name }}</span>
                                @endforeach
                            </div>
                            <div class="alert alert-warning mb-0">
                                <small>
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Changing this permission will affect {{ $rolesCount }} role(s).
                                </small>
                            </div>
                        @else
                            <p class="text-muted text-center mb-0">
                                <small>No roles are using this permission</small>
                            </p>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm mb-4 border-left-danger">
                    <div class="card-body">
                        <h6 class="text-danger mb-3">
                            <i class="fas fa-trash"></i> Danger Zone
                        </h6>
                        <p class="small mb-3">
                            Deleting this permission will remove it from all roles and cannot be undone.
                        </p>
                        @if ($rolesCount > 0)
                            <button class="btn btn-sm btn-outline-danger btn-block" disabled>
                                <i class="fas fa-trash"></i> Delete Permission
                            </button>
                            <small class="text-muted d-block mt-2">
                                Remove from all roles before deleting
                            </small>
                        @else
                            <button onclick="confirmDelete()" class="btn btn-sm btn-danger btn-block">
                                <i class="fas fa-trash"></i> Delete Permission
                            </button>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm border-left-success">
                    <div class="card-body">
                        <h6 class="text-success mb-3">
                            <i class="fas fa-lightbulb"></i> Quick Tips
                        </h6>
                        <ul class="small mb-0">
                            <li>Use clear, descriptive names</li>
                            <li>Keep naming conventions consistent</li>
                            <li>Test changes in a staging environment first</li>
                            <li>Document complex permissions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the permission <strong>{{ $permission->name }}</strong>?</p>
                    <p class="text-danger mb-0">
                        <strong>Warning:</strong> This action cannot be undone!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Permission
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const moduleSelect = document.getElementById('module');
        const actionInput = document.getElementById('action');
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
        actionInput.addEventListener('input', updatePreview);

        function updatePreview() {
            const module = moduleSelect.value;
            const action = actionInput.value.trim().toLowerCase();

            if (module && action && module !== 'new_module') {
                previewInput.value = `${module}.${action}`;
            } else {
                previewInput.value = '';
            }
        }

        // Confirm delete
        function confirmDelete() {
            $('#deleteModal').modal('show');
        }

        // Initialize preview
        updatePreview();

        // Auto-hide alerts
        setTimeout(function() {
            $('.alert-success').fadeOut('slow');
        }, 5000);
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

        .border-left-danger {
            border-left: 4px solid #e74a3b !important;
        }

        code {
            background: #f8f9fa;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 0.9em;
        }
    </style>
@endpush