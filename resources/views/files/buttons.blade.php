@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Buttons</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Components</a></li>
                <li class="breadcrumb-item active">Buttons</li>
            </ol>
        </nav>
    </div>

    <!-- Button Variants -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Button Variants</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary me-2 mb-2">Primary</button>
            <button type="button" class="btn btn-secondary me-2 mb-2">Secondary</button>
            <button type="button" class="btn btn-success me-2 mb-2">Success</button>
            <button type="button" class="btn btn-danger me-2 mb-2">Danger</button>
            <button type="button" class="btn btn-warning me-2 mb-2">Warning</button>
            <button type="button" class="btn btn-info me-2 mb-2">Info</button>
            <button type="button" class="btn btn-light me-2 mb-2">Light</button>
            <button type="button" class="btn btn-dark me-2 mb-2">Dark</button>
        </div>
    </div>

    <!-- Outline Buttons -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Outline Buttons</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-outline-primary me-2 mb-2">Primary</button>
            <button type="button" class="btn btn-outline-secondary me-2 mb-2">Secondary</button>
            <button type="button" class="btn btn-outline-success me-2 mb-2">Success</button>
            <button type="button" class="btn btn-outline-danger me-2 mb-2">Danger</button>
            <button type="button" class="btn btn-outline-warning me-2 mb-2">Warning</button>
            <button type="button" class="btn btn-outline-info me-2 mb-2">Info</button>
        </div>
    </div>

    <!-- Button Sizes -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Button Sizes</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-sm me-2 mb-2">Small Button</button>
            <button type="button" class="btn btn-primary me-2 mb-2">Default Button</button>
            <button type="button" class="btn btn-primary btn-lg me-2 mb-2">Large Button</button>
        </div>
    </div>

    <!-- Icon Buttons -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Icon Buttons</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary me-2 mb-2">
                <i class="bi bi-plus-lg me-2"></i>Add New
            </button>
            <button type="button" class="btn btn-success me-2 mb-2">
                <i class="bi bi-check-lg me-2"></i>Save
            </button>
            <button type="button" class="btn btn-danger me-2 mb-2">
                <i class="bi bi-trash me-2"></i>Delete
            </button>
            <button type="button" class="btn btn-info me-2 mb-2">
                <i class="bi bi-download me-2"></i>Download
            </button>
        </div>
    </div>

    <!-- Button Groups -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Button Groups</h5>
        </div>
        <div class="card-body">
            <div class="btn-group mb-3" role="group">
                <button type="button" class="btn btn-primary">Left</button>
                <button type="button" class="btn btn-primary">Middle</button>
                <button type="button" class="btn btn-primary">Right</button>
            </div>
            <br>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary">
                    <i class="bi bi-align-left"></i>
                </button>
                <button type="button" class="btn btn-outline-primary">
                    <i class="bi bi-align-center"></i>
                </button>
                <button type="button" class="btn btn-outline-primary">
                    <i class="bi bi-align-right"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
