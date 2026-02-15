@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Badges</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Components</a></li>
                <li class="breadcrumb-item active">Badges</li>
            </ol>
        </nav>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Basic Badges</h5>
        </div>
        <div class="card-body">
            <span class="badge bg-primary me-2 mb-2">Primary</span>
            <span class="badge bg-secondary me-2 mb-2">Secondary</span>
            <span class="badge bg-success me-2 mb-2">Success</span>
            <span class="badge bg-danger me-2 mb-2">Danger</span>
            <span class="badge bg-warning me-2 mb-2">Warning</span>
            <span class="badge bg-info me-2 mb-2">Info</span>
            <span class="badge bg-light text-dark me-2 mb-2">Light</span>
            <span class="badge bg-dark me-2 mb-2">Dark</span>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Pill Badges</h5>
        </div>
        <div class="card-body">
            <span class="badge rounded-pill bg-primary me-2 mb-2">Primary</span>
            <span class="badge rounded-pill bg-success me-2 mb-2">Success</span>
            <span class="badge rounded-pill bg-danger me-2 mb-2">Danger</span>
            <span class="badge rounded-pill bg-warning me-2 mb-2">Warning</span>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Badges in Context</h5>
        </div>
        <div class="card-body">
            <h4>Example heading <span class="badge bg-secondary">New</span></h4>
            <button type="button" class="btn btn-primary">
                Notifications <span class="badge bg-danger">4</span>
            </button>
            <button type="button" class="btn btn-outline-primary ms-2">
                Messages <span class="badge bg-success">12</span>
            </button>
        </div>
    </div>
@endsection
