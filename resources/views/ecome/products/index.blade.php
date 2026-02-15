@extends('Backend.AdminTheme.layout')

@section('content')

<div class="page-header mb-4">


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Product List</a></li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>

                <a href="{{route('admin.products.create')}}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Add Product
                </a>
            </div>
        </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Product list</h5>
        </div>
    <div class="card-body">
        <table class="table table-striped table-hover w-100" id="products-table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Tax</th>
                    <th>Stock</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function(){

    let table = $('#products-table').DataTable({
        processing: true,
        stateSave: true,

        ajax: "{{ route('admin.products.index') }}",

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
            {data:'checkbox', orderable:false, searchable:false},
            {data:'image', orderable:false, searchable:false},
            {data:'name'},
            {data:'type'},
            {data:'category'},
            {data:'brand'},
            {data:'sku'},
            {data:'price', orderable:false},
            {data:'tax', orderable:false},
            {data:'stock', orderable:false},
            {data:'featured', orderable:false},
            {data:'status', orderable:false},
            {data:'created_at'},
            {data:'action', orderable:false, searchable:false},
        ]

    });

});
</script>
@endpush
