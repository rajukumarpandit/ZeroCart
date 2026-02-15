@extends('Backend.AdminTheme.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Settings</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item active">Settings</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="card mb-4">
                <div class="list-group list-group-flush">
                    <a href="#general" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                        <i class="bi bi-gear me-2"></i>General
                    </a>
                    <a href="#account" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="bi bi-person me-2"></i>Account
                    </a>
                    <a href="#security" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="bi bi-shield-check me-2"></i>Security
                    </a>
                    <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="bi bi-bell me-2"></i>Notifications
                    </a>
                    <a href="#privacy" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="bi bi-eye-slash me-2"></i>Privacy
                    </a>
                    <a href="#billing" class="list-group-item list-group-item-action" data-bs-toggle="list">
                        <i class="bi bi-credit-card me-2"></i>Billing
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="tab-content">
                <!-- General Settings -->
                <div class="tab-pane fade show active" id="general">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">General Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" class="form-control" value="Emoce Admin">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Site Description</label>
                                <textarea class="form-control" rows="3">Professional admin dashboard for modern web applications</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Language</label>
                                    <select class="form-select">
                                        <option>English</option>
                                        <option>Spanish</option>
                                        <option>French</option>
                                        <option>German</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Timezone</label>
                                    <select class="form-select">
                                        <option>UTC</option>
                                        <option>America/New_York</option>
                                        <option>Europe/London</option>
                                        <option>Asia/Tokyo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date Format</label>
                                <select class="form-select">
                                    <option>MM/DD/YYYY</option>
                                    <option>DD/MM/YYYY</option>
                                    <option>YYYY-MM-DD</option>
                                </select>
                            </div>
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>

                <!-- Account Settings -->
                <div class="tab-pane fade" id="account">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Account Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" value="John">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="Doe">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" value="john.doe@example.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" value="+1 (555) 123-4567">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" rows="4">Full-stack developer with expertise in modern web technologies.</textarea>
                            </div>
                            <button class="btn btn-primary">Update Account</button>
                        </div>
                    </div>

                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Danger Zone</h5>
                        </div>
                        <div class="card-body">
                            <h6>Delete Account</h6>
                            <p class="text-muted">Once you delete your account, there is no going back. Please be certain.
                            </p>
                            <button class="btn btn-danger">Delete Account</button>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="tab-pane fade" id="security">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Change Password</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <button class="btn btn-primary">Update Password</button>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Two-Factor Authentication</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <h6 class="mb-1">Enable 2FA</h6>
                                    <p class="text-muted small mb-0">Add an extra layer of security to your account</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="enable2fa">
                                </div>
                            </div>
                            <button class="btn btn-outline-primary">Setup Authenticator App</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Active Sessions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div>
                                    <h6 class="mb-1"><i class="bi bi-laptop me-2"></i>Chrome on Windows</h6>
                                    <p class="text-muted small mb-0">San Francisco, CA • Current Session</p>
                                </div>
                                <span class="badge bg-success">Active</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1"><i class="bi bi-phone me-2"></i>Safari on iPhone</h6>
                                    <p class="text-muted small mb-0">New York, NY • Last active 2 hours ago</p>
                                </div>
                                <button class="btn btn-sm btn-outline-danger">Revoke</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div class="tab-pane fade" id="notifications">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Notification Preferences</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">Email Notifications</h6>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="emailOrders" checked>
                                <label class="form-check-label" for="emailOrders">
                                    <strong>Order Updates</strong>
                                    <p class="text-muted small mb-0">Receive emails about your order status</p>
                                </label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="emailPromo" checked>
                                <label class="form-check-label" for="emailPromo">
                                    <strong>Promotions & News</strong>
                                    <p class="text-muted small mb-0">Receive promotional emails and newsletters</p>
                                </label>
                            </div>
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" id="emailSecurity">
                                <label class="form-check-label" for="emailSecurity">
                                    <strong>Security Alerts</strong>
                                    <p class="text-muted small mb-0">Get notified about account security</p>
                                </label>
                            </div>

                            <h6 class="mb-3">Push Notifications</h6>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="pushMessages" checked>
                                <label class="form-check-label" for="pushMessages">
                                    <strong>Messages</strong>
                                    <p class="text-muted small mb-0">Notify me about new messages</p>
                                </label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="pushComments" checked>
                                <label class="form-check-label" for="pushComments">
                                    <strong>Comments</strong>
                                    <p class="text-muted small mb-0">Notify me about new comments</p>
                                </label>
                            </div>

                            <button class="btn btn-primary mt-3">Save Preferences</button>
                        </div>
                    </div>
                </div>

                <!-- Privacy Settings -->
                <div class="tab-pane fade" id="privacy">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Privacy Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="profilePublic" checked>
                                <label class="form-check-label" for="profilePublic">
                                    <strong>Public Profile</strong>
                                    <p class="text-muted small mb-0">Make your profile visible to everyone</p>
                                </label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="showEmail">
                                <label class="form-check-label" for="showEmail">
                                    <strong>Show Email Address</strong>
                                    <p class="text-muted small mb-0">Display your email on your profile</p>
                                </label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="searchEngines" checked>
                                <label class="form-check-label" for="searchEngines">
                                    <strong>Search Engine Indexing</strong>
                                    <p class="text-muted small mb-0">Allow search engines to index your profile</p>
                                </label>
                            </div>
                            <button class="btn btn-primary">Update Privacy</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Data & Privacy</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h6>Download Your Data</h6>
                                <p class="text-muted">Request a copy of your personal data</p>
                                <button class="btn btn-outline-primary">Request Data</button>
                            </div>
                            <hr>
                            <div>
                                <h6>Delete Your Data</h6>
                                <p class="text-muted">Permanently delete all your data</p>
                                <button class="btn btn-outline-danger">Delete Data</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Billing Settings -->
                <div class="tab-pane fade" id="billing">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Current Plan</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-1">Professional Plan</h4>
                                    <p class="text-muted mb-0">$29/month • Renews on Feb 29, 2024</p>
                                </div>
                                <span class="badge bg-success">Active</span>
                            </div>
                            <button class="btn btn-outline-primary me-2">Upgrade Plan</button>
                            <button class="btn btn-outline-secondary">Cancel Subscription</button>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Payment Methods</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-credit-card fs-2 text-primary me-3"></i>
                                    <div>
                                        <h6 class="mb-0">•••• •••• •••• 4242</h6>
                                        <p class="text-muted small mb-0">Expires 12/2025</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-primary me-2">Primary</span>
                                    <button class="btn btn-sm btn-outline-secondary">Remove</button>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-plus-lg me-2"></i>Add Payment Method
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Billing History</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Jan 29, 2024</td>
                                            <td>Professional Plan</td>
                                            <td>$29.00</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                            <td><a href="invoice.html" class="btn btn-sm btn-outline-primary">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dec 29, 2023</td>
                                            <td>Professional Plan</td>
                                            <td>$29.00</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                            <td><a href="invoice.html" class="btn btn-sm btn-outline-primary">View</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
