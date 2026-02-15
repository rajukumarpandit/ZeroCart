@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Progress Bars</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Components</a></li>
                <li class="breadcrumb-item active">Progress Bars</li>
            </ol>
        </nav>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Basic Progress Bars</h5>
        </div>
        <div class="card-body">
            <div class="progress mb-3">
                <div class="progress-bar" role="progressbar" style="width: 25%"></div>
            </div>
            <div class="progress mb-3">
                <div class="progress-bar" role="progressbar" style="width: 50%"></div>
            </div>
            <div class="progress mb-3">
                <div class="progress-bar" role="progressbar" style="width: 75%"></div>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Colored Progress Bars</h5>
        </div>
        <div class="card-body">
            <div class="progress mb-3">
                <div class="progress-bar bg-success" style="width: 25%">25%</div>
            </div>
            <div class="progress mb-3">
                <div class="progress-bar bg-info" style="width: 50%">50%</div>
            </div>
            <div class="progress mb-3">
                <div class="progress-bar bg-warning" style="width: 75%">75%</div>
            </div>
            <div class="progress">
                <div class="progress-bar bg-danger" style="width: 100%">100%</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Striped & Animated</h5>
        </div>
        <div class="card-body">
            <div class="progress mb-3">
                <div class="progress-bar progress-bar-striped" style="width: 60%"></div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 75%"></div>
            </div>
        </div>
    </div>
@endsection
