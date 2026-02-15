@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Alerts</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Components</a></li>
                <li class="breadcrumb-item active">Alerts</li>
            </ol>
        </nav>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Basic Alerts</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-primary" role="alert">A simple primary alert—check it out!</div>
            <div class="alert alert-secondary" role="alert">A simple secondary alert—check it out!</div>
            <div class="alert alert-success" role="alert">A simple success alert—check it out!</div>
            <div class="alert alert-danger" role="alert">A simple danger alert—check it out!</div>
            <div class="alert alert-warning" role="alert">A simple warning alert—check it out!</div>
            <div class="alert alert-info" role="alert">A simple info alert—check it out!</div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Dismissible Alerts</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Well done!</strong> You successfully read this important alert message.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Something went wrong. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Alerts with Icons</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-primary d-flex align-items-center" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>
                <div>An example alert with an icon</div>
            </div>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>Success! Your action was completed successfully.</div>
            </div>
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div>Warning! Please review this information.</div>
            </div>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="bi bi-x-circle-fill me-2"></i>
                <div>Error! There was a problem with your request.</div>
            </div>
        </div>
    </div>
@endsection
