@extends('Backend.AdminTheme.layout')
@section('title', isset($attribute) ? 'Edit Attribute' : 'Add Attribute')

@section('content')
<div class="page-header mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Attributes</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
        </div>
    </div>
</div>


    <div class="card">
        <div class="card-header">
            Add Attribute 
        </div>
        <div class="card-body">
            <form id="attributeForm" method="POST" 
                action="{{ isset($attribute) ? route('admin.attributes.update', $attribute->id) : route('admin.attributes.store') }}">
                
                @csrf
                @if(isset($attribute))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Attribute Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $attribute->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control"
                        value="{{ old('slug', $attribute->slug ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="1" {{ (old('status', $attribute->status ?? 1) == 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ (old('status', $attribute->status ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($attribute) ? 'Update' : 'Create' }}
                    </button>
                </div>

            </form>
        </div>
    </div>


@endsection
@push('scripts')
<script>

$(document).ready(function(){
    $('#name').on('keyup', function () {
    let name = $(this).val();

    let slug = name
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')   // remove special chars
        .replace(/\s+/g, '-')           // replace space with -
        .replace(/-+/g, '-');           // remove multiple -

    $('#slug').val(slug);
});
    $('#attributeForm').submit(function(e){
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let method = form.find('input[name="_method"]').val() || 'POST';

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(res){
                toastr.success(res.message ?? 'Success');
                window.location.href = "{{ route('admin.attributes.index') }}";
            },
            error: function(err){
                let errors = err.responseJSON.errors;
                if(errors) {
                    let msgs = Object.values(errors).map(v => v.join(', ')).join('<br>');
                    toastr.error(msgs);
                }
            }
        });
    });

});
</script>
@endpush
