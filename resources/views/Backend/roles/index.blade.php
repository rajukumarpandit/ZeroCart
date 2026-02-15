@extends('Backend.AdminTheme.layout')

@section('title', 'Roles & Permissions')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">Roles & Permissions</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Role
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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <!-- Roles Cards -->
    <div class="row">
        @forelse($roles as $role)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-left-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title mb-1">
                                    <i class="fas fa-shield-alt text-primary"></i>
                                    {{ $role->name }}
                                </h5>
                                @if($role->is_default)
                                    <span class="badge badge-info">Default Role</span>
                                @endif
                                @if($role->name === 'Super Admin')
                                    <span class="badge badge-danger">System Role</span>
                                @endif
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('admin.roles.show', $role->id) }}">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.roles.edit', $role->id) }}">
                                        <i class="fas fa-edit"></i> Edit Role
                                    </a>
                                    @if($role->name !== 'Super Admin' && !$role->is_default)
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#" 
                                           onclick="confirmDelete({{ $role->id }})">
                                            <i class="fas fa-trash"></i> Delete Role
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <p class="card-text text-muted small mb-3">
                            {{ $role->description ?? 'No description provided.' }}
                        </p>

                        <div class="row text-center">
                            <div class="col-6 border-right">
                                <div class="text-muted small">Users</div>
                                <div class="h5 mb-0">{{ $role->users_count ?? 0 }}</div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted small">Permissions</div>
                                <div class="h5 mb-0">{{ $role->permissions_count ?? 0 }}</div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="far fa-calendar"></i> Created: {{ $role->created_at->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-sm btn-outline-primary">
                                View Details
                            </a>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shield-alt fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Roles Found</h5>
                        <p class="text-muted">Create your first role to get started.</p>
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create Role
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    {{-- @if($roles->hasPages())
        <div class="d-flex justify-content-center">
            {{ $roles->links() }}
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
                <p>Are you sure you want to delete this role?</p>
                <p class="text-danger mb-0">
                    <strong>Warning:</strong> This action cannot be undone. All users assigned to this role will lose their permissions.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
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
    function confirmDelete(roleId) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/roles/${roleId}`;
        $('#deleteModal').modal('show');
    }

    // Auto-hide alerts after 5 seconds
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
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endpush
