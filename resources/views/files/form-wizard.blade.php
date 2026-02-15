@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Multi-Step Form Wizard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active">Form Wizard</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Wizard Steps -->
            <div class="wizard-steps">
                <div class="wizard-step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Personal Info</div>
                </div>
                <div class="wizard-step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Account Details</div>
                </div>
                <div class="wizard-step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Upload Files</div>
                </div>
                <div class="wizard-step" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-label">Review & Submit</div>
                </div>
            </div>

            <form id="wizardForm">
                <!-- Step 1: Personal Information -->
                <div class="wizard-content active" id="step1">
                    <h5 class="mb-4">Personal Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name *</label>
                            <input type="text" class="form-control" name="firstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name *</label>
                            <input type="text" class="form-control" name="lastName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth *</label>
                            <input type="date" class="form-control" name="dob" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="3"></textarea>
                    </div>
                </div>

                <!-- Step 2: Account Details -->
                <div class="wizard-content" id="step2">
                    <h5 class="mb-4">Account Details</h5>
                    <div class="mb-3">
                        <label class="form-label">Email Address *</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username *</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password *</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirm Password *</label>
                            <input type="password" class="form-control" name="confirmPassword" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Account Type</label>
                        <select class="form-select" name="accountType">
                            <option value="personal">Personal</option>
                            <option value="business">Business</option>
                            <option value="enterprise">Enterprise</option>
                        </select>
                    </div>
                </div>

                <!-- Step 3: Upload Files -->
                <div class="wizard-content" id="step3">
                    <h5 class="mb-4">Upload Documents</h5>
                    <div class="mb-4">
                        <label class="form-label">Profile Picture</label>
                        <div class="file-upload-wrapper">
                            <i class="bi bi-cloud-upload file-upload-icon"></i>
                            <h6>Drag & Drop or Click to Upload</h6>
                            <p class="text-muted small mb-0">Supported formats: JPG, PNG (Max 5MB)</p>
                            <input type="file" class="d-none" name="profilePic" accept="image/*">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Identity Document</label>
                        <div class="file-upload-wrapper">
                            <i class="bi bi-file-earmark-text file-upload-icon"></i>
                            <h6>Drag & Drop or Click to Upload</h6>
                            <p class="text-muted small mb-0">Supported formats: PDF, JPG, PNG (Max 10MB)</p>
                            <input type="file" class="d-none" name="idDocument" accept=".pdf,image/*">
                        </div>
                    </div>
                </div>

                <!-- Step 4: Review & Submit -->
                <div class="wizard-content" id="step4">
                    <h5 class="mb-4">Review Your Information</h5>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Please review all information before submitting.
                    </div>

                    <div class="card mb-3">
                        <div class="card-header"><strong>Personal Information</strong></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Name:</small>
                                    <div id="reviewName">-</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Phone:</small>
                                    <div id="reviewPhone">-</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header"><strong>Account Details</strong></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Email:</small>
                                    <div id="reviewEmail">-</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted">Username:</small>
                                    <div id="reviewUsername">-</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">
                            I accept the terms and conditions *
                        </label>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary" id="prevBtn" style="display:none;">
                        <i class="bi bi-arrow-left me-2"></i>Previous
                    </button>
                    <button type="button" class="btn btn-primary" id="nextBtn">
                        Next<i class="bi bi-arrow-right ms-2"></i>
                    </button>
                    <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">
                        <i class="bi bi-check-circle me-2"></i>Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
