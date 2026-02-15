@extends('Backend.AdminTheme.layout')
@section('title', 'Category List')
@section('content')
    <div class="page-header mb-4">


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Category List</a></li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>

                <a href="{{route('admin.categories.create')}}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Add Category
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Categories list</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table id="categoryTable" class="table table-striped table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Created By</th>
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
$(document).ready(function () {

    let table = $('#categoryTable').DataTable({
        processing: true,
        serverSide: false,

        responsive: false,
        stateSave: true,

        colReorder: {
            realtime: false
        },

        ajax: "{{ route('admin.categories.index') }}",

        /* ✅ SAVE STATE (CORRECT WAY) */
        stateSaveParams: function (settings, data) {
            $.post("{{ route('admin.table.pref.save') }}", {
                _token: "{{ csrf_token() }}",
                table: 'categories',
                preferences: data
            });
        },

        /* ✅ LOAD STATE (CORRECT WAY) */
        stateLoadParams: function (settings, data) {
            let saved = @json($tablePreference?->preferences ?? null);
            if (!saved) return;

            Object.assign(data, saved);
        },

        dom: `
            <"row align-items-center mb-3"
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
            { extend: 'excelHtml5', className: 'dt-btn btn-excel', text: 'Excel' },
            { extend: 'csvHtml5', className: 'dt-btn btn-csv', text: 'CSV' },
            { extend: 'pdfHtml5', className: 'dt-btn btn-pdf', text: 'PDF' },
            { extend: 'print', className: 'dt-btn btn-print', text: 'Print' },
            { extend: 'colvis', className: 'dt-btn btn-columns', text: 'Columns' },
            {
                text: 'Reset',
                className: 'dt-btn btn-reset',
                action: function () {
                    table.state.clear();
                    $.post("{{ route('admin.table.pref.reset') }}", {
                        _token: "{{ csrf_token() }}",
                        table: 'categories'
                    }).done(() => location.reload());
                }
            }
        ],

        columns: [
            { data: 'checkbox', orderable: false, searchable: false },
            { data: 'DT_RowIndex', searchable: false },
            { data: 'image', orderable: false, searchable: false },
            { data: 'name' },
            { data: 'status', orderable: false },
            { data: 'featured', orderable: false },
            { data: 'created_by' },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

});
</script>


@endpush
