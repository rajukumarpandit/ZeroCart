@extends('Backend.AdminTheme.layout')
@section('title', 'Attribute List')

@section('content')
<div class="page-header mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Attributes List</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Add Attribute
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Attribute List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="attributeTable" class="table table-striped table-hover w-100">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Values</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(function () {

    let table = $('#attributeTable').DataTable({
        processing: true,
        stateSave: true,

        ajax: "{{ route('admin.attributes.index') }}",

        dom: `
            <"row mb-3"
                <"col-md-4" l>
                <"col-md-4 text-center" f>
                <"col-md-4 text-end" B>
            >
            rt
            <"row mt-3"
                <"col-md-6" i>
                <"col-md-6" p>
            >
        `,

        buttons: [
            { extend: 'excelHtml5', className: 'dt-btn btn-excel' },
            { extend: 'pdfHtml5', className: 'dt-btn btn-pdf' },
            { extend: 'print', className: 'dt-btn btn-print' },
            { extend: 'colvis', className: 'dt-btn btn-columns' }
        ],

        columns: [
            { data: 'DT_RowIndex', searchable: false },
            { data: 'name' },
            { data: 'slug' },
            { data: 'values_count', orderable: false },
            { data: 'status', orderable: false },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

});
</script>
@endpush
