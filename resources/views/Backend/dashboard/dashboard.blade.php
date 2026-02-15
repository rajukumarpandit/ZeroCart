@extends('Backend.AdminTheme.layout')

@section('content')
    <!-- Page Header -->
                <div class="page-header mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h1 class="page-title mb-2">Dashboard</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-download me-2"></i>Export
                            </button>
                            <button class="btn btn-primary">
                                <i class="bi bi-plus-lg me-2"></i>Add New
                            </button>
                        </div>
                    </div>
                </div>
    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card stat-card stat-card-primary">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">Total Users</h6>
                        <h3 class="stat-value">12,459</h3>
                        <div class="stat-change positive">
                            <i class="bi bi-arrow-up"></i>
                            <span>12.5%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card stat-card stat-card-success">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="bi bi-cart-fill"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">Total Sales</h6>
                        <h3 class="stat-value">$45,678</h3>
                        <div class="stat-change positive">
                            <i class="bi bi-arrow-up"></i>
                            <span>8.2%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card stat-card stat-card-warning">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="bi bi-bag-check-fill"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">Total Orders</h6>
                        <h3 class="stat-value">1,234</h3>
                        <div class="stat-change negative">
                            <i class="bi bi-arrow-down"></i>
                            <span>3.1%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card stat-card stat-card-info">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">Page Views</h6>
                        <h3 class="stat-value">89,432</h3>
                        <div class="stat-change positive">
                            <i class="bi bi-arrow-up"></i>
                            <span>15.8%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Revenue Overview</h5>
                    <div class="btn-group btn-group-sm" role="group">
                        <input type="radio" class="btn-check" name="revenue-period" id="revenue-week" autocomplete="off">
                        <label class="btn btn-outline-primary" for="revenue-week">Week</label>

                        <input type="radio" class="btn-check" name="revenue-period" id="revenue-month" autocomplete="off"
                            checked>
                        <label class="btn btn-outline-primary" for="revenue-month">Month</label>

                        <input type="radio" class="btn-check" name="revenue-period" id="revenue-year" autocomplete="off">
                        <label class="btn btn-outline-primary" for="revenue-year">Year</label>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Sales by Category</h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Top Products -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Activities</h5>
                    <a href="#" class="text-primary text-decoration-none small">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="activity-list">
                        @forelse($activities as $activity)
                            @php
                                [$icon, $color] = activityIcon($activity->description);
                            @endphp

                            <div class="activity-item">
                                <div class="activity-icon {{ $color }}">
                                    <i class="bi {{ $icon }}"></i>
                                </div>

                                <div class="activity-content">
                                    <p class="activity-text">
                                        <strong>{{ $activity->causer->name ?? 'System' }}</strong>
                                        {{ $activity->description }}
                                    </p>
                                    <span class="activity-time">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted p-3">No recent activities</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Top Products</h5>
                    <a href="#" class="text-primary text-decoration-none small">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Sales</th>
                                    <th>Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="product-img">
                                                <img src="https://via.placeholder.com/40" alt="Product">
                                            </div>
                                            <span>Wireless Headphones</span>
                                        </div>
                                    </td>
                                    <td>2,345</td>
                                    <td class="text-success fw-semibold">$23,450</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="product-img">
                                                <img src="https://via.placeholder.com/40" alt="Product">
                                            </div>
                                            <span>Smart Watch</span>
                                        </div>
                                    </td>
                                    <td>1,876</td>
                                    <td class="text-success fw-semibold">$18,760</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="product-img">
                                                <img src="https://via.placeholder.com/40" alt="Product">
                                            </div>
                                            <span>Laptop Stand</span>
                                        </div>
                                    </td>
                                    <td>1,543</td>
                                    <td class="text-success fw-semibold">$15,430</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="product-img">
                                                <img src="https://via.placeholder.com/40" alt="Product">
                                            </div>
                                            <span>USB-C Cable</span>
                                        </div>
                                    </td>
                                    <td>1,234</td>
                                    <td class="text-success fw-semibold">$12,340</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="product-img">
                                                <img src="https://via.placeholder.com/40" alt="Product">
                                            </div>
                                            <span>Keyboard</span>
                                        </div>
                                    </td>
                                    <td>987</td>
                                    <td class="text-success fw-semibold">$9,870</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Widgets -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-3">Storage Usage</h6>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="h4 mb-0">75%</span>
                        <span class="text-muted">750 GB / 1 TB</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-3">Monthly Goal</h6>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="h4 mb-0">92%</span>
                        <span class="text-muted">$92K / $100K</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 92%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-3">Project Progress</h6>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="h4 mb-0">68%</span>
                        <span class="text-muted">17 / 25 Tasks</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 68%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-3">Server Load</h6>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="h4 mb-0">45%</span>
                        <span class="text-muted">Normal</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 45%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
