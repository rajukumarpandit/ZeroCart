@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">User Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="profile-header">
                    <div class="text-center">
                        <div class="profile-avatar-wrapper">
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=ffffff&color=6366f1&size=120"
                                alt="Profile" class="profile-avatar">
                            <button class="profile-avatar-edit">
                                <i class="bi bi-camera-fill"></i>
                            </button>
                        </div>
                        <h4 class="text-white mt-3 mb-1">John Doe</h4>
                        <p class="text-white-50 mb-0">Full Stack Developer</p>
                    </div>

                    <div class="row mt-4">
                        <div class="col-4 stat-box">
                            <h3>256</h3>
                            <p>Posts</p>
                        </div>
                        <div class="col-4 stat-box">
                            <h3>2.5K</h3>
                            <p>Followers</p>
                        </div>
                        <div class="col-4 stat-box">
                            <h3>365</h3>
                            <p>Following</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">About</h6>
                    <p class="text-muted small">Full-stack developer with 5+ years of experience in building web
                        applications. Passionate about clean code and user experience.</p>

                    <h6 class="mb-3 mt-4">Contact Information</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            <i class="bi bi-envelope me-2 text-primary"></i>
                            john.doe@example.com
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-telephone me-2 text-primary"></i>
                            +1 (555) 123-4567
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt me-2 text-primary"></i>
                            San Francisco, CA
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-globe me-2 text-primary"></i>
                            www.johndoe.com
                        </li>
                    </ul>

                    <h6 class="mb-3 mt-4">Social Links</h6>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-primary btn-sm flex-fill">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm flex-fill">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm flex-fill">
                            <i class="bi bi-github"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm flex-fill">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form>
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
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="john.doe@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">DOB</label>
                            <input type="date" class="form-control" value="">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" value="+1 (555) 123-4567">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control" rows="3">Full-stack developer with 5+ years of experience...</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" value="San Francisco, CA">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Website</label>
                                <input type="url" class="form-control" value="www.johndoe.com">
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <button type="button" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <form>
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
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Skills</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">JavaScript</span>
                            <span class="small text-muted">90%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 90%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">React</span>
                            <span class="small text-muted">85%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">Laravel</span>
                            <span class="small text-muted">80%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: 80%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">UI/UX Design</span>
                            <span class="small text-muted">75%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
