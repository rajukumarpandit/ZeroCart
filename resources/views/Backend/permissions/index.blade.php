@extends('Backend.AdminTheme.layout')

@section('title', 'Permissions Management')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2 text-gray-800">Permissions Management</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Permissions</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-info mr-2" onclick="syncPermissions()">
                    <i class="fas fa-sync"></i> Sync Permissions
                </button>
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Permission
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

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Permissions
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPermissions ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-key fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Active Permissions
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activePermissions ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Permission Modules
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalModules ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-folder fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Roles Using
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRoles ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shield-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Search -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.permissions.index') }}" method="GET" class="form-inline">
                    <div class="form-group mr-3 mb-2">
                        <label for="module" class="mr-2">Module:</label>
                        <select name="module" id="module" class="form-control">
                            <option value="">All Modules</option>
                            @foreach ($modules ?? [] as $module)
                                <option value="{{ $module }}" {{ request('module') == $module ? 'selected' : '' }}>
                                    {{ ucfirst($module) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mr-3 mb-2">
                        <label for="search" class="mr-2">Search:</label>
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Search permissions..." value="{{ request('search') }}">
                    </div>

                    <button type="submit" class="btn btn-primary mb-2 mr-2">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary mb-2">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </form>
            </div>
        </div>

        <!-- Permissions by Module -->
        @if (isset($permissionsByModule) && count($permissionsByModule) > 0)
            @foreach ($permissionsByModule as $module => $permissions)
                <div class="card shadow-sm mb-4">
                    <div
                        class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-folder-open"></i> {{ ucfirst($module) }} Module
                            <span class="badge badge-light ml-2">{{ count($permissions) }}</span>
                        </h6>
                        <div>
                            <button class="btn btn-sm btn-light" onclick="toggleModule('{{ $module }}')">
                                <i class="fas fa-chevron-down" id="icon_{{ $module }}"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="module_{{ $module }}">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="25%">Permission Name</th>
                                        <th width="20%">Display Name</th>
                                        <th width="30%">Description</th>
                                        <th width="10%">Roles</th>
                                        <th width="10%" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <code>{{ $permission->name }}</code>
                                            </td>
                                            <td>
                                                <strong>{{ $permission->display_name ?? 'N/A' }}</strong>
                                            </td>
                                            <td>
                                                <small
                                                    class="text-muted">{{ $permission->description ?? 'No description' }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $permission->roles_count ?? 0 }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                        class="btn btn-sm btn-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="viewPermission({{ $permission->id }})"
                                                        class="btn btn-sm btn-info" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button onclick="confirmDelete({{ $permission->id }})"
                                                        class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-key fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Permissions Found</h5>
                    <p class="text-muted">Create your first permission to get started.</p>
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Permission
                    </a>
                </div>
            </div>
        @endif

        <!-- Pagination -->
        {{-- @if (isset($permissions) && $permissions->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $permissions->links() }}
    </div>
    @endif --}}
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
                    <p>Are you sure you want to delete this permission?</p>
                    <p class="text-danger mb-0">
                        <strong>Warning:</strong> This will remove the permission from all roles that use it!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
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

    <!-- View Permission Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-key"></i> Permission Details
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="permissionDetails">
                    <div class="text-center py-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle module visibility
        function toggleModule(module) {
            const content = document.getElementById(`module_${module}`);
            const icon = document.getElementById(`icon_${module}`);

            if (content.style.display === 'none') {
                content.style.display = 'block';
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-down');
            } else {
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-right');
            }
        }

        // Confirm delete
        function confirmDelete(permissionId) {
            const form = document.getElementById('deleteForm');
            form.action = `/admin/permissions/${permissionId}`;
            $('#deleteModal').modal('show');
        }

        // View permission details
        function viewPermission(permissionId) {
            $('#viewModal').modal('show');

            fetch(`/admin/permissions/${permissionId}`)
                .then(response => response.json())
                .then(data => {
                    let rolesHtml = '';
                    if (data.roles && data.roles.length > 0) {
                        rolesHtml = '<ul class="list-group">';
                        data.roles.forEach(role => {
                            rolesHtml += `<li class="list-group-item">${role.name}</li>`;
                        });
                        rolesHtml += '</ul>';
                    } else {
                        rolesHtml = '<p class="text-muted">No roles assigned</p>';
                    }

                    document.getElementById('permissionDetails').innerHTML = `
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td><code>${data.name}</code></td>
                        </tr>
                        <tr>
                            <th>Display Name</th>
                            <td>${data.display_name || 'N/A'}</td>
                        </tr>
                        <tr>
                            <th>Module</th>
                            <td><span class="badge badge-primary">${data.module}</span></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>${data.description || 'No description'}</td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td>${new Date(data.created_at).toLocaleString()}</td>
                        </tr>
                        <tr>
                            <th>Updated</th>
                            <td>${new Date(data.updated_at).toLocaleString()}</td>
                        </tr>
                    </table>
                    
                    <h6 class="mt-4 mb-3">Assigned Roles (${data.roles.length})</h6>
                    ${rolesHtml}
                `;
                })
                .catch(error => {
                    document.getElementById('permissionDetails').innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> Error loading permission details
                    </div>
                `;
                });
        }

        // Sync permissions
        function syncPermissions() {
            Swal.fire({
                title: 'Sync Permissions',
                text: 'This will synchronize permissions from your code. Continue?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, sync now',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch('/admin/permissions/sync', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                return data;
                            }
                            throw new Error(data.message);
                        });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Permissions Synced!',
                        html: `
                        <p>Added: ${result.value.added || 0}</p>
                        <p>Updated: ${result.value.updated || 0}</p>
                    `,
                        timer: 3000
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }

        // Auto-hide alerts
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
@endpush

@push('styles')
    <style>
        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }

        .border-left-info {
            border-left: 4px solid #36b9cc !important;
        }

        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        }
    </style>
@endpush
