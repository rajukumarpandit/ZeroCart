@extends('Backend.AdminTheme.layout')
@section('title', 'Manage Attribute')

@section('content')

<div class="row">
    <!-- Attribute Info -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <strong>Attribute</strong>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.attributes.update',$attribute) }}">
                    @csrf 
                    @method('PUT')

                    <div class="mb-3">
                        <label>Name</label>
                        <input name="name" value="{{ $attribute->name }}" class="form-control">
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox"
                               name="status" {{ $attribute->status ? 'checked' : '' }}>
                        <label>Active</label>
                    </div>

                    <button class="btn btn-success mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>

  
</div>

@endsection
