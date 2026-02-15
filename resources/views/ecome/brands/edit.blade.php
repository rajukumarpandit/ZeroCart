@extends('Backend.AdminTheme.layout')
@section('title','Edit Brand')

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
<div class="card">
    <div class="card-header">
        <h5>Edit Brand</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.brands.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('ecome.brands.form')
        </form>
    </div>
</div>
@endsection
