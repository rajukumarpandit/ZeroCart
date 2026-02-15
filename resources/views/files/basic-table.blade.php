@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Basic Tables</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active">Basic Tables</li>
            </ol>
        </nav>
    </div>

    <!-- Default Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Default Table</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Cedric Kelly</td>
                            <td>Senior Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>$433,060</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Striped Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Striped Table</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Wireless Headphones</td>
                            <td>Electronics</td>
                            <td>$99.99</td>
                            <td>45</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Smart Watch</td>
                            <td>Electronics</td>
                            <td>$199.99</td>
                            <td>23</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Laptop Stand</td>
                            <td>Accessories</td>
                            <td>$49.99</td>
                            <td>0</td>
                            <td><span class="badge bg-danger">Out of Stock</span></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>USB-C Cable</td>
                            <td>Accessories</td>
                            <td>$19.99</td>
                            <td>156</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Hoverable Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Hoverable Table</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Order Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Smith</td>
                            <td>john@example.com</td>
                            <td>2024-01-15</td>
                            <td>$1,234.56</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Sarah Johnson</td>
                            <td>sarah@example.com</td>
                            <td>2024-01-16</td>
                            <td>$567.89</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mike Chen</td>
                            <td>mike@example.com</td>
                            <td>2024-01-17</td>
                            <td>$890.12</td>
                            <td><span class="badge bg-info">Processing</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bordered Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Bordered Table</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Task ID</th>
                            <th>Task Name</th>
                            <th>Assigned To</th>
                            <th>Priority</th>
                            <th>Due Date</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>T-001</td>
                            <td>Update Dashboard UI</td>
                            <td>John Doe</td>
                            <td><span class="badge bg-danger">High</span></td>
                            <td>2024-01-20</td>
                            <td>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 75%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>T-002</td>
                            <td>Fix Login Bug</td>
                            <td>Sarah Johnson</td>
                            <td><span class="badge bg-warning">Medium</span></td>
                            <td>2024-01-22</td>
                            <td>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>T-003</td>
                            <td>Write Documentation</td>
                            <td>Mike Chen</td>
                            <td><span class="badge bg-info">Low</span></td>
                            <td>2024-01-25</td>
                            <td>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-info" style="width: 30%"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Small Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Compact Table</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Sarah Johnson</td>
                            <td>sarah@example.com</td>
                            <td>Editor</td>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mike Chen</td>
                            <td>mike@example.com</td>
                            <td>User</td>
                            <td><span class="badge bg-secondary">Inactive</span></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Emma Wilson</td>
                            <td>emma@example.com</td>
                            <td>Moderator</td>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
