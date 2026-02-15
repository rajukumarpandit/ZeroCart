@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Form Elements</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active">Form Elements</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Basic Form</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="John Doe">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="john@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country">
                                <option selected>Choose...</option>
                                <option value="1">United States</option>
                                <option value="2">Canada</option>
                                <option value="3">United Kingdom</option>
                                <option value="4">Australia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Your message..."></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms">
                            <label class="form-check-label" for="terms">
                                I agree to the terms and conditions
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary ms-2">Reset</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Input Groups</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">With Icon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" placeholder="Username">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">With Button</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <button class="btn btn-primary" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">With Dropdown</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                Options
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                            </ul>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Radio & Checkboxes</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label d-block">Radio Buttons</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="radio1" checked>
                            <label class="form-check-label" for="radio1">Option 1</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="radio2">
                            <label class="form-check-label" for="radio2">Option 2</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Checkboxes</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="check1" checked>
                            <label class="form-check-label" for="check1">Checkbox 1</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="check2">
                            <label class="form-check-label" for="check2">Checkbox 2</label>
                        </div>
                    </div>
                    <div>
                        <label class="form-label d-block">Switches</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="switch1" checked>
                            <label class="form-check-label" for="switch1">Enable notifications</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="switch2">
                            <label class="form-check-label" for="switch2">Auto-save</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
