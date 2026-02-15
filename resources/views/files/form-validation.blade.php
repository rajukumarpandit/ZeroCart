@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Form Validation</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active">Form Validation</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Browser Default Validation</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password *</label>
                            <input type="password" class="form-control" required minlength="8">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Website URL</label>
                            <input type="url" class="form-control" placeholder="https://example.com">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">I agree to terms *</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Custom Validation Styles</h5>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate id="customForm">
                        <div class="mb-3">
                            <label class="form-label">First Name *</label>
                            <input type="text" class="form-control" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter your first name.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" required>
                            <div class="valid-feedback">Email is valid!</div>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country *</label>
                            <select class="form-select" required>
                                <option value="">Choose...</option>
                                <option value="1">United States</option>
                                <option value="2">Canada</option>
                            </select>
                            <div class="invalid-feedback">Please select a country.</div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agree" required>
                            <label class="form-check-label" for="agree">Agree to terms *</label>
                            <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Form</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Advanced Validation Example</h5>
        </div>
        <div class="card-body">
            <form class="needs-validation" novalidate id="advancedForm">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">First Name *</label>
                        <input type="text" class="form-control" required>
                        <div class="invalid-feedback">Required field.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Last Name *</label>
                        <input type="text" class="form-control" required>
                        <div class="invalid-feedback">Required field.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Username *</label>
                        <div class="input-group">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" required>
                            <div class="invalid-feedback">Please choose a username.</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" required>
                        <div class="invalid-feedback">Please provide a valid email.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" pattern="[0-9]{10}" placeholder="1234567890">
                        <div class="invalid-feedback">Please enter a 10-digit phone number.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">City *</label>
                        <input type="text" class="form-control" required>
                        <div class="invalid-feedback">Please provide a valid city.</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">State *</label>
                        <select class="form-select" required>
                            <option value="">Choose...</option>
                            <option>California</option>
                            <option>Texas</option>
                            <option>New York</option>
                        </select>
                        <div class="invalid-feedback">Please select a state.</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Zip *</label>
                        <input type="text" class="form-control" pattern="[0-9]{5}" required>
                        <div class="invalid-feedback">Please provide a valid zip.</div>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                    <label class="form-check-label" for="agreeTerms">
                        I agree to the terms and conditions *
                    </label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                </div>

                <button type="submit" class="btn btn-primary">Submit Form</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </form>
        </div>
    </div>
@endsection
