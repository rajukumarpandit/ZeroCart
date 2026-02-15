@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Cards</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Components</a></li>
                <li class="breadcrumb-item active">Cards</li>
            </ol>
        </nav>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Card image">
                <div class="card-body">
                    <h5 class="card-title">Card Title</h5>
                    <p class="card-text">Some quick example text to build on the card title.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">Featured</div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in.</p>
                    <a href="#" class="btn btn-outline-primary">Learn More</a>
                </div>
                <div class="card-footer text-muted">2 days ago</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-primary">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Primary Card</h5>
                    <p class="card-text">This is a primary colored card with white text.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Success Card</h5>
                    <p class="card-text">This is a success colored card with white text.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-primary">
                <div class="card-header bg-transparent border-primary">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Primary Border</h5>
                    <p class="card-text">Card with primary border and transparent header.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-bell-fill text-primary" style="font-size: 40px;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-0">Notifications</h5>
                            <p class="card-text text-muted mb-0">15 new alerts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Card with List Group</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
