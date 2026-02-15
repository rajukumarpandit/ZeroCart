@extends('Backend.AdminTheme.layout')
@section('title', 'Attribute Values')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Attribute: {{ $attribute->name }}</h4>
        <button class="btn btn-primary btn-sm" id="btnAdd">
            <i class="fas fa-plus"></i> New Value
        </button>
    </div>

    {{-- TABLE --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover" id="valueTable">
                <thead class="table-light">
                    <tr>
                        <th width="40">#</th>
                        <th>Value</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>

{{-- MODAL --}}
<div class="modal fade" id="valueModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="valueForm">
            @csrf
            <input type="hidden" id="id">
            <input type="hidden" id="attribute_id" value="{{ $attribute->id }}">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attribute Value</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Value Name</label>
                        <input type="text" name="value" id="value" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(function () {

    const table = $('#valueTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.attribute-values.index', $attribute->id) }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'value' },
            { data: 'slug' },
            { data: 'status', orderable:false },
            { data: 'action', orderable:false, searchable:false }
        ]
    });

    // ADD MODAL
    $('#btnAdd').click(() => {
        $('#valueForm')[0].reset();
        $('#id').val('');
        $('#valueModal').modal('show');
    });

    // STORE / UPDATE
    $('#valueForm').submit(function(e){
        e.preventDefault();

        let id = $('#id').val();
        let url = id
            ? "{{ url('admin/attribute-values/update') }}/" + id
            : "{{ route('admin.attribute-values.store') }}";

        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: $(this).serialize(),
            success: () => {
                $('#valueModal').modal('hide');
                table.ajax.reload();
            }
        });
    });

    // EDIT
    $(document).on('click', '.edit-btn', function () {
        let id = $(this).data('id');
        $.get("{{ url('admin/attribute-values/edit') }}/" + id, function(data){
            $('#id').val(data.id);
            $('#value').val(data.value);
            $('#status').val(data.status);
            $('#valueModal').modal('show');
        });
    });

    // DELETE
    $(document).on('click', '.delete-btn', function () {
        if (!confirm('Delete this value?')) return;

        let id = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/attribute-values/delete') }}/" + id,
            type: 'DELETE',
            data: { _token: "{{ csrf_token() }}" },
            success: () => table.ajax.reload()
        });
    });

});
</script>
@endpush
