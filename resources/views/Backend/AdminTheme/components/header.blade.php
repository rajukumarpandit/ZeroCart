<!-- Header -->
<header class="admin-header">
    <div class="header-left">
        <button class="menu-toggle" id="menuToggle">
            <i class="bi bi-list"></i>
        </button>
        <div class="search-box d-none d-md-block">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control" placeholder="Search...">
        </div>
    </div>

    <div class="header-right">
        <button class="header-btn theme-toggle" id="themeToggle">
            <i class="bi bi-moon-fill"></i>
        </button>

        <div class="dropdown">
            <button class="header-btn position-relative" data-bs-toggle="dropdown">
                <i class="bi bi-bell-fill"></i>
                <span class="notification-badge">3</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end notification-dropdown">
                <div class="dropdown-header">
                    <h6>Notifications</h6>
                    <span class="badge bg-primary">3 New</span>
                </div>
                <div class="notification-list">
                    <a href="#" class="notification-item unread">
                        <div class="notification-icon bg-primary">
                            <i class="bi bi-bag-check"></i>
                        </div>
                        <div class="notification-content">
                            <h6>New order received</h6>
                            <p>Order #12345 has been placed</p>
                            <span class="notification-time">2 min ago</span>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer">
                    <a href="#">View all notifications</a>
                </div>
            </div>
        </div>

        <div class="dropdown">
            <button class="header-profile" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name=John+Doe&background=6366f1&color=fff" alt="User">
                <span class="d-none d-md-block">{{auth()->user()->name}}</span>
                <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                <div class="dropdown-header">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=6366f1&color=fff" alt="User">
                    <div>
                        <h6>{{auth()->user()->name}}</h6>
                        <span>{{auth()->user()->email}}</span>
                    </div>
                </div>
                <a href="profile.html" class="dropdown-item">
                    <i class="bi bi-person"></i> My Profile
                </a>
                <a href="settings.html" class="dropdown-item">
                    <i class="bi bi-gear"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('admin.logout')}}" class="dropdown-item text-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </div>
</header>
