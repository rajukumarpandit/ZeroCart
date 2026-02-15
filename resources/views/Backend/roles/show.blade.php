@extends('Backend.AdminTheme.layout')

@section('title', 'Role Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">
                <i class="fas fa-shield-alt"></i> {{ $role->name }}
                @if($role->is_default)
                    <span class="badge badge-info">Default</span>
                @endif
                @if($role->name === 'Super Admin')
                    <span class="badge badge-danger">System</span>
                @endif
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active">{{ $role->name }}</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Roles
            </a>
            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Role
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
                    <table class="table table-borderless table-sm mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted" width="40%"><strong>Name:</strong></td>
                                <td>{{ $role->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Guard:</strong></td>
                                <td>{{ $role->guard_name }}</></td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Created:</strong></td>
                                <td>{{ $role->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Updated:</strong></td>
                                <td>{{ $role->updated_at->format('M d, Y h:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-chart-bar"></i> Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 border-right">
                            <i class="fas fa-users fa-2x text-primary mb-2"></i>
                            <h3 class="mb-0">{{ $role->users_count ?? 0 }}</h3>
                            <small class="text-muted">Total Users</small>
                        </div>
                        <div class="col-6">
                            <i class="fas fa-key fa-2x text-success mb-2"></i>
                            <h3 class="mb-0">{{ $role->permissions_count ?? 0 }}</h3>
                            <small class="text-muted">Permissions</small>
                        </div>
                    </div>
                    
                    @if($role->users_count > 0)
                        <hr>
                        {{-- <a href="{{ route('admin.users.index', ['role' => $role->id]) }}" class="btn btn-sm btn-outline-info btn-block">
                            <i class="fas fa-eye"></i> View All Users
                        </a> --}}
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-cog"></i> Actions
                    </h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-block mb-2">
                        <i class="fas fa-edit"></i> Edit Role
                    </a>
                    <button onclick="duplicateRole({{ $role->id }})" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-copy"></i> Duplicate Role
                    </button>
                    <button onclick="exportRole({{ $role->id }})" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-download"></i> Export Role
                    </button>
                    @if($role->name !== 'Super Admin' && !$role->is_default)
                        <hr>
                        <button onclick="confirmDelete({{ $role->id }})" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Delete Role
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Permissions -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-key"></i> Assigned Permissions ({{ $role->permissions_count ?? 0 }})
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
                    @if($role->permissions && count($role->permissions) > 0)
                        @php
                            $groupedPermissions = $role->permissions->groupBy('module');
                        @endphp
                        
                        @foreach($groupedPermissions as $module => $permissions)
                            <div class="permission-module mb-4">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-folder-open"></i> {{ ucfirst($module) }}
                                    <span class="badge badge-primary ml-2">{{ count($permissions) }}</span>
                                </h6>
                                
                                <div class="row">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-6 col-lg-4 mb-3 permission-item">
                                            <div class="card border-left-success h-100">
                                                <div class="card-body p-3">
                                                    <div class="d-flex align-items-start">
                                                        <i class="fas fa-check-circle text-success mt-1 mr-2"></i>
                                                        <div>
                                                            <h6 class="mb-1">{{ $permission->display_name ?? $permission->name }}</h6>
                                                            @if($permission->description)
                                                                <small class="text-muted">{{ $permission->description }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-key fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Permissions Assigned</h5>
                            <p class="text-muted">This role currently has no permissions.</p>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Assign Permissions
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Users with this Role -->
            @if(isset($recentUsers) && count($recentUsers) > 0)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-users"></i> Recent Users with this Role
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Assigned On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm mr-2">
                                                        @if($user->avatar)
                                                            <img src="{{ asset($user->avatar) }}" class="rounded-circle" width="32" height="32">
                                                        @else
                                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                                {{ substr($user->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    {{ $user->name }}
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                            {{-- <td>
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($role->users_count > count($recentUsers))
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.users.index', ['role' => $role->id]) }}" class="btn btn-sm btn-outline-info">
                                    View All {{ $role->users_count }} Users →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
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
                <p>Are you sure you want to delete the role <strong>{{ $role->name }}</strong>?</p>
                @if($role->users_count > 0)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Warning:</strong> This role is currently assigned to {{ $role->users_count }} user(s). 
                        They will lose their permissions.
                    </div>
                @endif
                <p class="text-danger mb-0">
                    <strong>This action cannot be undone!</strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete Role
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Search permissions
    document.getElementById('searchPermissions').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.permission-item').forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Confirm delete
    function confirmDelete(roleId) {
        $('#deleteModal').modal('show');
    }

    // Duplicate role
    function duplicateRole(roleId) {
        Swal.fire({
            title: 'Duplicate Role',
            text: 'Enter a name for the duplicated role:',
            input: 'text',
            inputValue: '{{ $role->name }} (Copy)',
            showCancelButton: true,
            confirmButtonText: 'Duplicate',
            showLoaderOnConfirm: true,
            preConfirm: (name) => {
                return fetch(`/admin/roles/${roleId}/duplicate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name: name })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        return data;
                    }
                    throw new Error(data.message);
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Role Duplicated!',
                    text: 'The role has been duplicated successfully.',
                    timer: 2000
                }).then(() => {
                    window.location.href = `/admin/roles/${result.value.role.id}`;
                });
            }
        });
    }

    // Export role
    function exportRole(roleId) {
        window.location.href = `/admin/roles/${roleId}/export`;
    }

    // Auto-hide alerts
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush

@push('styles')
<style>
    .border-left-success {
        border-left: 3px solid #1cc88a !important;
    }
    
    .permission-module {
        border-left: 3px solid #4e73df;
        padding-left: 15px;
    }
    
    .avatar-sm {
        width: 32px;
        height: 32px;
    }
</style>
@endpush