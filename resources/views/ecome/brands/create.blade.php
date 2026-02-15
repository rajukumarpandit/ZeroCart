@extends('Backend.AdminTheme.layout')
@section('title','Create Brand')

@section('content')
<div class="page-header mb-4">


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Add Brand</a></li>
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
<div class="row">
    <div class="col-12">
        <div class="card">
    <div class="card-header">
        Create Brand
    </div>

    <div class="card-body">
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
            @include('ecome.brands.form')
        </form>
    </div>
</div>
    </div>
</div>
@endsection
@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const skeleton = document.getElementById('imageSkeleton');

    if (input.files && input.files[0]) {
        skeleton.classList.remove('d-none');
        preview.classList.add('d-none');

        const reader = new FileReader();
        reader.onload = function (e) {
            setTimeout(() => { // skeleton effect
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                skeleton.classList.add('d-none');
            }, 600);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
