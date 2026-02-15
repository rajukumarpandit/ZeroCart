<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UI Components - EMOCE Admin Panel</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        /* Include the entire custom CSS here or link to external file */
        /* For brevity, I'm adding essential styles - you should link to your main CSS file */
        
        /* ROOT VARIABLES */
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary-color: #64748b;
            --success-color: #22c55e;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            
            --body-bg: #f1f5f9;
            --content-bg: #ffffff;
            --sidebar-bg: #ffffff;
            --header-bg: #ffffff;
            --card-bg: #ffffff;
            
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            
            --border-color: #e2e8f0;
            --border-light: #f1f5f9;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            
            --sidebar-width: 280px;
            --header-height: 70px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --border-radius: 10px;
            --border-radius-sm: 6px;
            --border-radius-lg: 14px;
        }

        [data-bs-theme="dark"] {
            --body-bg: #0f172a;
            --content-bg: #1e293b;
            --sidebar-bg: #1e293b;
            --header-bg: #1e293b;
            --card-bg: #1e293b;
            
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            
            --border-color: #334155;
            --border-light: #1e293b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--body-bg);
            color: var(--text-primary);
            font-size: 14px;
            line-height: 1.6;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            border-right: 1px solid var(--border-color);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 0 20px;
            min-height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .sidebar-body {
            padding: 20px 0;
        }

        .sidebar-nav {
            padding: 0 12px;
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: var(--border-radius-sm);
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 14px;
            transition: var(--transition);
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: rgba(99, 102, 241, 0.08);
            color: var(--primary-color);
        }

        .nav-link.active {
            background-color: rgba(99, 102, 241, 0.12);
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
            padding-left: 13px;
            font-weight: 600;
        }

        .admin-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .admin-header {
            height: var(--header-height);
            background-color: var(--header-bg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--border-color);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-primary);
            cursor: pointer;
            padding: 8px;
            border-radius: var(--border-radius-sm);
        }

        .breadcrumb {
            margin: 0;
            background: none;
            padding: 0;
        }

        .breadcrumb-item {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .breadcrumb-item.active {
            color: var(--text-primary);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .theme-toggle {
            background: none;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: var(--border-radius-sm);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: var(--transition);
        }

        .theme-toggle:hover {
            background-color: var(--border-light);
            color: var(--text-primary);
        }

        .admin-main {
            flex: 1;
            padding: 24px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 20px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .card-body {
            padding: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 16px;
        }

        .component-example {
            padding: 20px;
            background-color: var(--border-light);
            border-radius: var(--border-radius-sm);
            margin-bottom: 16px;
        }

        .example-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--border-light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        /* Custom Accordion Styles */
        .accordion-item {
            border: 1px solid var(--border-color);
            margin-bottom: 8px;
            border-radius: var(--border-radius-sm);
            overflow: hidden;
        }

        .accordion-button {
            background-color: var(--card-bg);
            color: var(--text-primary);
            font-weight: 500;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: var(--border-color);
        }

        /* Badge Styles */
        .badge {
            font-weight: 600;
            padding: 6px 12px;
            border-radius: var(--border-radius-sm);
            font-size: 12px;
        }

        /* Button Styles */
        .btn {
            font-weight: 500;
            padding: 8px 16px;
            border-radius: var(--border-radius-sm);
            transition: var(--transition);
            font-size: 14px;
        }

        /* Icon Box */
        .icon-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--border-radius-sm);
            font-size: 20px;
            margin-bottom: 8px;
        }

        .icon-box.bg-primary { background-color: rgba(99, 102, 241, 0.1); color: var(--primary-color); }
        .icon-box.bg-success { background-color: rgba(34, 197, 94, 0.1); color: var(--success-color); }
        .icon-box.bg-danger { background-color: rgba(239, 68, 68, 0.1); color: var(--danger-color); }
        .icon-box.bg-warning { background-color: rgba(245, 158, 11, 0.1); color: var(--warning-color); }
        .icon-box.bg-info { background-color: rgba(59, 130, 246, 0.1); color: var(--info-color); }

        /* Responsive */
        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-content {
                margin-left: 0;
            }
        }

        /* List Group Custom */
        .list-group-item {
            background-color: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        .list-group-item:hover {
            background-color: var(--border-light);
        }

        /* Progress Bar */
        .progress {
            height: 10px;
            border-radius: 10px;
            background-color: var(--border-light);
        }

        .progress-bar {
            border-radius: 10px;
        }

        /* Spinner Custom */
        .spinner-container {
            display: flex;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* Tab Custom */
        .nav-tabs .nav-link {
            color: var(--text-secondary);
            border: none;
            border-bottom: 2px solid transparent;
        }

        .nav-tabs .nav-link:hover {
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            border-color: var(--primary-color);
            background-color: transparent;
        }

        /* Tooltip Custom */
        .tooltip-inner {
            background-color: var(--text-primary);
            color: var(--content-bg);
            border-radius: var(--border-radius-sm);
            padding: 8px 12px;
        }

        /* Typography */
        .display-1, .display-2, .display-3, .display-4, .display-5, .display-6 {
            color: var(--text-primary);
            font-weight: 700;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--text-primary);
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        /* Carousel Custom */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1);
        }

        [data-bs-theme="dark"] .carousel-control-prev-icon,
        [data-bs-theme="dark"] .carousel-control-next-icon {
            filter: invert(0);
        }

        /* Modal */
        .modal-content {
            background-color: var(--content-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
        }

        .modal-footer {
            border-top: 1px solid var(--border-color);
        }

        /* Offcanvas */
        .offcanvas {
            background-color: var(--content-bg);
            color: var(--text-primary);
        }

        .offcanvas-header {
            border-bottom: 1px solid var(--border-color);
        }

        /* Popover */
        .popover {
            background-color: var(--content-bg);
            border: 1px solid var(--border-color);
        }

        .popover-header {
            background-color: var(--border-light);
            border-bottom: 1px solid var(--border-color);
        }

        .popover-body {
            color: var(--text-primary);
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <i class="fas fa-cube"></i>
                    <span class="brand-text">EMOCE</span>
                </div>
            </div>
            
            <div class="sidebar-body">
                <nav class="sidebar-nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="#accordions" class="nav-link">
                                <i class="fas fa-bars"></i>
                                <span>Accordions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#alerts" class="nav-link">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Alerts</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#buttons" class="nav-link">
                                <i class="fas fa-hand-pointer"></i>
                                <span>Buttons</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#badges" class="nav-link">
                                <i class="fas fa-tag"></i>
                                <span>Badges</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#cards" class="nav-link">
                                <i class="fas fa-id-card"></i>
                                <span>Cards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#custom-cards" class="nav-link">
                                <i class="fas fa-credit-card"></i>
                                <span>Custom Cards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#carousel" class="nav-link">
                                <i class="fas fa-images"></i>
                                <span>Carousel</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#icons" class="nav-link">
                                <i class="fas fa-icons"></i>
                                <span>Icons</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#list-items" class="nav-link">
                                <i class="fas fa-list"></i>
                                <span>List Items</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#modals" class="nav-link">
                                <i class="fas fa-window-restore"></i>
                                <span>Modals</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#offcanvas" class="nav-link">
                                <i class="fas fa-bars-staggered"></i>
                                <span>Offcanvas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#progress-bars" class="nav-link">
                                <i class="fas fa-tasks"></i>
                                <span>Progress Bars</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#popovers" class="nav-link">
                                <i class="fas fa-comment"></i>
                                <span>Popovers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#spinners" class="nav-link">
                                <i class="fas fa-spinner"></i>
                                <span>Spinners</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs" class="nav-link">
                                <i class="fas fa-folder"></i>
                                <span>Tabs</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tooltips" class="nav-link">
                                <i class="fas fa-info-circle"></i>
                                <span>Tooltips</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#typography" class="nav-link">
                                <i class="fas fa-font"></i>
                                <span>Typography</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="admin-content">
            <!-- Header -->
            <header class="admin-header">
                <div class="header-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Components</a></li>
                            <li class="breadcrumb-item active">UI Elements</li>
                        </ol>
                    </nav>
                </div>
                <div class="header-right">
                    <button class="theme-toggle" id="themeToggle">
                        <i class="fas fa-moon"></i>
                    </button>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="admin-main">
                <div class="page-header">
                    <h1 class="page-title">UI Components</h1>
                    <p class="page-subtitle">Comprehensive collection of Bootstrap 5 components styled for EMOCE Admin Panel</p>
                </div>

                <!-- Accordions Section -->
                <section id="accordions" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Accordions</h5>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                            <i class="fas fa-info-circle me-2"></i> Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            This is the first item's accordion body. It is shown by default with clean, modern styling that matches the admin panel theme.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                            <i class="fas fa-cog me-2"></i> Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            This is the second item's accordion body. Click to expand and see the smooth animation and consistent theming.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                            <i class="fas fa-star me-2"></i> Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            This is the third item's accordion body. Perfect for FAQs, settings panels, and collapsible content sections.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Alerts Section -->
                <section id="alerts" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Alerts</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <i class="fas fa-info-circle me-3 fs-5"></i>
                                <div>
                                    <strong>Info!</strong> This is a primary alert with an icon.
                                </div>
                            </div>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fas fa-check-circle me-3 fs-5"></i>
                                <div>
                                    <strong>Success!</strong> Your operation was completed successfully.
                                </div>
                            </div>
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <i class="fas fa-exclamation-triangle me-3 fs-5"></i>
                                <div>
                                    <strong>Warning!</strong> Please check your input and try again.
                                </div>
                            </div>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="fas fa-times-circle me-3 fs-5"></i>
                                <div>
                                    <strong>Error!</strong> Something went wrong. Please contact support.
                                </div>
                            </div>
                            <div class="alert alert-info d-flex align-items-center alert-dismissible fade show" role="alert">
                                <i class="fas fa-lightbulb me-3 fs-5"></i>
                                <div>
                                    <strong>Tip!</strong> This is a dismissible alert. Click the close button.
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Buttons Section -->
                <section id="buttons" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Buttons</h5>
                        </div>
                        <div class="card-body">
                            <div class="example-label">Solid Buttons</div>
                            <div class="component-example">
                                <button class="btn btn-primary me-2 mb-2">Primary</button>
                                <button class="btn btn-secondary me-2 mb-2">Secondary</button>
                                <button class="btn btn-success me-2 mb-2">Success</button>
                                <button class="btn btn-danger me-2 mb-2">Danger</button>
                                <button class="btn btn-warning me-2 mb-2">Warning</button>
                                <button class="btn btn-info me-2 mb-2">Info</button>
                                <button class="btn btn-light me-2 mb-2">Light</button>
                                <button class="btn btn-dark me-2 mb-2">Dark</button>
                            </div>

                            <div class="example-label">Outline Buttons</div>
                            <div class="component-example">
                                <button class="btn btn-outline-primary me-2 mb-2">Primary</button>
                                <button class="btn btn-outline-secondary me-2 mb-2">Secondary</button>
                                <button class="btn btn-outline-success me-2 mb-2">Success</button>
                                <button class="btn btn-outline-danger me-2 mb-2">Danger</button>
                                <button class="btn btn-outline-warning me-2 mb-2">Warning</button>
                                <button class="btn btn-outline-info me-2 mb-2">Info</button>
                            </div>

                            <div class="example-label">Buttons with Icons</div>
                            <div class="component-example">
                                <button class="btn btn-primary me-2 mb-2">
                                    <i class="fas fa-download me-2"></i>Download
                                </button>
                                <button class="btn btn-success me-2 mb-2">
                                    <i class="fas fa-plus me-2"></i>Add New
                                </button>
                                <button class="btn btn-danger me-2 mb-2">
                                    <i class="fas fa-trash me-2"></i>Delete
                                </button>
                                <button class="btn btn-warning me-2 mb-2">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </button>
                            </div>

                            <div class="example-label">Button Sizes</div>
                            <div class="component-example">
                                <button class="btn btn-primary btn-lg me-2 mb-2">Large Button</button>
                                <button class="btn btn-primary me-2 mb-2">Default Button</button>
                                <button class="btn btn-primary btn-sm me-2 mb-2">Small Button</button>
                            </div>

                            <div class="example-label">Button Group</div>
                            <div class="component-example">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary">Left</button>
                                    <button type="button" class="btn btn-outline-primary">Middle</button>
                                    <button type="button" class="btn btn-outline-primary">Right</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Badges Section -->
                <section id="badges" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Badges</h5>
                        </div>
                        <div class="card-body">
                            <div class="example-label">Colored Badges</div>
                            <div class="component-example">
                                <span class="badge bg-primary me-2 mb-2">Primary</span>
                                <span class="badge bg-secondary me-2 mb-2">Secondary</span>
                                <span class="badge bg-success me-2 mb-2">Success</span>
                                <span class="badge bg-danger me-2 mb-2">Danger</span>
                                <span class="badge bg-warning me-2 mb-2">Warning</span>
                                <span class="badge bg-info me-2 mb-2">Info</span>
                                <span class="badge bg-light text-dark me-2 mb-2">Light</span>
                                <span class="badge bg-dark me-2 mb-2">Dark</span>
                            </div>

                            <div class="example-label">Pill Badges</div>
                            <div class="component-example">
                                <span class="badge rounded-pill bg-primary me-2 mb-2">Primary</span>
                                <span class="badge rounded-pill bg-success me-2 mb-2">Success</span>
                                <span class="badge rounded-pill bg-danger me-2 mb-2">Danger</span>
                                <span class="badge rounded-pill bg-warning me-2 mb-2">Warning</span>
                            </div>

                            <div class="example-label">Badges with Icons</div>
                            <div class="component-example">
                                <span class="badge bg-primary me-2 mb-2">
                                    <i class="fas fa-user me-1"></i>12 Users
                                </span>
                                <span class="badge bg-success me-2 mb-2">
                                    <i class="fas fa-check me-1"></i>Verified
                                </span>
                                <span class="badge bg-danger me-2 mb-2">
                                    <i class="fas fa-times me-1"></i>Failed
                                </span>
                                <span class="badge bg-warning me-2 mb-2">
                                    <i class="fas fa-clock me-1"></i>Pending
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Cards Section -->
                <section id="cards" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Cards</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Featured Card
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Card Title</h5>
                                            <p class="card-text">This is a basic card with header, body, and footer sections.</p>
                                            <a href="#" class="btn btn-primary">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/400x200/6366f1/ffffff?text=Card+Image" class="card-img-top" alt="Card">
                                        <div class="card-body">
                                            <h5 class="card-title">Image Card</h5>
                                            <p class="card-text">Card with a beautiful image on top and content below.</p>
                                            <a href="#" class="btn btn-success">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Simple Card</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                            <p class="card-text">A simple card with just body content, title, and subtitle.</p>
                                            <a href="#" class="card-link">Card link</a>
                                            <a href="#" class="card-link">Another link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Custom Cards Section -->
                <section id="custom-cards" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Custom Cards</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="icon-box bg-primary mx-auto">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <h3 class="mt-3 mb-1">2,543</h3>
                                            <p class="text-muted mb-0">Total Users</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="icon-box bg-success mx-auto">
                                                <i class="fas fa-dollar-sign"></i>
                                            </div>
                                            <h3 class="mt-3 mb-1">$45,890</h3>
                                            <p class="text-muted mb-0">Revenue</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="icon-box bg-warning mx-auto">
                                                <i class="fas fa-shopping-cart"></i>
                                            </div>
                                            <h3 class="mt-3 mb-1">1,234</h3>
                                            <p class="text-muted mb-0">Orders</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div class="icon-box bg-danger mx-auto">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <h3 class="mt-3 mb-1">87.5%</h3>
                                            <p class="text-muted mb-0">Growth</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Carousel Section -->
                <section id="carousel" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Carousel</h5>
                        </div>
                        <div class="card-body">
                            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></button>
                                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
                                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://via.placeholder.com/1200x400/6366f1/ffffff?text=Slide+1" class="d-block w-100" alt="Slide 1">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>First Slide</h5>
                                            <p>Beautiful carousel with smooth transitions.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://via.placeholder.com/1200x400/22c55e/ffffff?text=Slide+2" class="d-block w-100" alt="Slide 2">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Second Slide</h5>
                                            <p>Fully responsive and touch-enabled.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://via.placeholder.com/1200x400/f59e0b/ffffff?text=Slide+3" class="d-block w-100" alt="Slide 3">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Third Slide</h5>
                                            <p>Perfect for showcasing content.</p>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Icons Section -->
                <section id="icons" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Font Awesome Icons</h5>
                        </div>
                        <div class="card-body">
                            <div class="example-label">Regular Icons</div>
                            <div class="component-example">
                                <i class="fas fa-home fs-3 me-3"></i>
                                <i class="fas fa-user fs-3 me-3"></i>
                                <i class="fas fa-cog fs-3 me-3"></i>
                                <i class="fas fa-heart fs-3 me-3"></i>
                                <i class="fas fa-star fs-3 me-3"></i>
                                <i class="fas fa-envelope fs-3 me-3"></i>
                                <i class="fas fa-phone fs-3 me-3"></i>
                                <i class="fas fa-camera fs-3 me-3"></i>
                                <i class="fas fa-music fs-3 me-3"></i>
                                <i class="fas fa-shopping-cart fs-3 me-3"></i>
                            </div>

                            <div class="example-label">Colored Icons</div>
                            <div class="component-example">
                                <i class="fas fa-home fs-3 me-3 text-primary"></i>
                                <i class="fas fa-user fs-3 me-3 text-success"></i>
                                <i class="fas fa-cog fs-3 me-3 text-danger"></i>
                                <i class="fas fa-heart fs-3 me-3 text-warning"></i>
                                <i class="fas fa-star fs-3 me-3 text-info"></i>
                            </div>

                            <div class="example-label">Icons in Boxes</div>
                            <div class="component-example">
                                <div class="icon-box bg-primary d-inline-flex me-3">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="icon-box bg-success d-inline-flex me-3">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="icon-box bg-danger d-inline-flex me-3">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="icon-box bg-warning d-inline-flex me-3">
                                    <i class="fas fa-exclamation"></i>
                                </div>
                                <div class="icon-box bg-info d-inline-flex me-3">
                                    <i class="fas fa-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- List Items Section -->
                <section id="list-items" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">List Groups</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="example-label">Basic List Group</div>
                                    <ul class="list-group mb-4">
                                        <li class="list-group-item">First item</li>
                                        <li class="list-group-item">Second item</li>
                                        <li class="list-group-item">Third item</li>
                                        <li class="list-group-item">Fourth item</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="example-label">Active & Disabled Items</div>
                                    <ul class="list-group mb-4">
                                        <li class="list-group-item active">Active item</li>
                                        <li class="list-group-item">Normal item</li>
                                        <li class="list-group-item disabled">Disabled item</li>
                                        <li class="list-group-item">Another item</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="example-label">List with Icons</div>
                                    <ul class="list-group mb-4">
                                        <li class="list-group-item">
                                            <i class="fas fa-home me-2 text-primary"></i>Dashboard
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fas fa-user me-2 text-success"></i>Profile
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fas fa-cog me-2 text-warning"></i>Settings
                                        </li>
                                        <li class="list-group-item">
                                            <i class="fas fa-sign-out-alt me-2 text-danger"></i>Logout
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="example-label">List with Badges</div>
                                    <ul class="list-group mb-4">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Notifications
                                            <span class="badge bg-primary rounded-pill">14</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Messages
                                            <span class="badge bg-success rounded-pill">5</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Alerts
                                            <span class="badge bg-danger rounded-pill">2</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Modals Section -->
                <section id="modals" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Modals</h5>
                        </div>
                        <div class="card-body">
                            <div class="component-example">
                                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalSmall">
                                    Small Modal
                                </button>
                                <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#modalDefault">
                                    Default Modal
                                </button>
                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#modalLarge">
                                    Large Modal
                                </button>
                                <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#modalFullscreen">
                                    Fullscreen Modal
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Offcanvas Section -->
                <section id="offcanvas" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Offcanvas</h5>
                        </div>
                        <div class="card-body">
                            <div class="component-example">
                                <button class="btn btn-primary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft">
                                    Left Offcanvas
                                </button>
                                <button class="btn btn-success me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                                    Right Offcanvas
                                </button>
                                <button class="btn btn-warning me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop">
                                    Top Offcanvas
                                </button>
                                <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom">
                                    Bottom Offcanvas
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Progress Bars Section -->
                <section id="progress-bars" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Progress Bars</h5>
                        </div>
                        <div class="card-body">
                            <div class="example-label">Basic Progress</div>
                            <div class="component-example">
                                <div class="progress mb-3">
                                    <div class="progress-bar" style="width: 25%"></div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar" style="width: 50%"></div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar" style="width: 75%"></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                            </div>

                            <div class="example-label">Colored Progress Bars</div>
                            <div class="component-example">
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" style="width: 25%">25%</div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-info" style="width: 50%">50%</div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-warning" style="width: 75%">75%</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width: 100%">100%</div>
                                </div>
                            </div>

                            <div class="example-label">Striped Progress</div>
                            <div class="component-example">
                                <div class="progress mb-3">
                                    <div class="progress-bar progress-bar-striped" style="width: 40%"></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Popovers Section -->
                <section id="popovers" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Popovers</h5>
                        </div>
                        <div class="card-body">
                            <div class="component-example">
                                <button type="button" class="btn btn-primary me-2" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Popover on top">
                                    Top Popover
                                </button>
                                <button type="button" class="btn btn-success me-2" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Popover on right">
                                    Right Popover
                                </button>
                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Popover on bottom">
                                    Bottom Popover
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Popover on left">
                                    Left Popover
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Spinners Section -->
                <section id="spinners" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Spinners</h5>
                        </div>
                        <div class="card-body">
                            <div class="example-label">Border Spinners</div>
                            <div class="component-example">
                                <div class="spinner-container">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-border text-success" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-border text-danger" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-border text-warning" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-border text-info" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>

                            <div class="example-label">Growing Spinners</div>
                            <div class="component-example">
                                <div class="spinner-container">
                                    <div class="spinner-grow text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-success" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-danger" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-warning" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-info" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>

                            <div class="example-label">Spinner Sizes</div>
                            <div class="component-example">
                                <div class="spinner-container">
                                    <div class="spinner-border spinner-border-sm text-primary me-3" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-border text-primary me-3" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tabs Section -->
                <section id="tabs" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Tabs</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button">
                                        <i class="fas fa-home me-2"></i>Home
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button">
                                        <i class="fas fa-envelope me-2"></i>Contact
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button">
                                        <i class="fas fa-cog me-2"></i>Settings
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <h5>Home Content</h5>
                                    <p>This is the home tab content. Tabs are perfect for organizing related content in a compact space.</p>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel">
                                    <h5>Profile Content</h5>
                                    <p>This is the profile tab content. Each tab can contain different types of content including forms, tables, and more.</p>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel">
                                    <h5>Contact Content</h5>
                                    <p>This is the contact tab content. Tabs provide an excellent user experience for content-heavy interfaces.</p>
                                </div>
                                <div class="tab-pane fade" id="settings" role="tabpanel">
                                    <h5>Settings Content</h5>
                                    <p>This is the settings tab content. You can add as many tabs as needed for your application.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tooltips Section -->
                <section id="tooltips" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Tooltips</h5>
                        </div>
                        <div class="card-body">
                            <div class="component-example">
                                <button type="button" class="btn btn-primary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                                    Top Tooltip
                                </button>
                                <button type="button" class="btn btn-success me-2" data-bs-toggle="tooltip" data-bs-placement="right" title="Tooltip on right">
                                    Right Tooltip
                                </button>
                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">
                                    Bottom Tooltip
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="Tooltip on left">
                                    Left Tooltip
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Typography Section -->
                <section id="typography" class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Typography</h5>
                        </div>
                        <div class="card-body">
                            <div class="example-label">Headings</div>
                            <div class="component-example">
                                <h1>H1 Heading</h1>
                                <h2>H2 Heading</h2>
                                <h3>H3 Heading</h3>
                                <h4>H4 Heading</h4>
                                <h5>H5 Heading</h5>
                                <h6>H6 Heading</h6>
                            </div>

                            <div class="example-label">Display Headings</div>
                            <div class="component-example">
                                <h1 class="display-1">Display 1</h1>
                                <h1 class="display-2">Display 2</h1>
                                <h1 class="display-3">Display 3</h1>
                                <h1 class="display-4">Display 4</h1>
                            </div>

                            <div class="example-label">Text Styles</div>
                            <div class="component-example">
                                <p class="lead">This is a lead paragraph with larger font size.</p>
                                <p>This is a normal paragraph with <strong>bold text</strong>, <em>italic text</em>, and <u>underlined text</u>.</p>
                                <p><mark>Highlighted text</mark> and <small>small text</small>.</p>
                                <p class="text-muted">Muted text color</p>
                            </div>

                            <div class="example-label">Text Colors</div>
                            <div class="component-example">
                                <p class="text-primary">Primary text color</p>
                                <p class="text-success">Success text color</p>
                                <p class="text-danger">Danger text color</p>
                                <p class="text-warning">Warning text color</p>
                                <p class="text-info">Info text color</p>
                                <p class="text-muted mb-0">Muted text color</p>
                            </div>

                            <div class="example-label">Blockquote</div>
                            <div class="component-example">
                                <blockquote class="blockquote">
                                    <p>A well-known quote, contained in a blockquote element.</p>
                                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </section>

            </main>
        </div>
    </div>

    <!-- Modals -->
    <!-- Small Modal -->
    <div class="modal fade" id="modalSmall" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Small Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>This is a small modal with minimal content.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Default Modal -->
    <div class="modal fade" id="modalDefault" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Default Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>This is a default sized modal with standard content and actions.</p>
                    <p>Modals are perfect for forms, confirmations, and important messages.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Large Modal -->
    <div class="modal fade" id="modalLarge" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Large Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>This is a large modal that can contain more content, forms, or data tables.</p>
                    <p>Perfect for detailed forms or complex content that needs more space.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Fullscreen Modal -->
    <div class="modal fade" id="modalFullscreen" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Fullscreen Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>This is a fullscreen modal that takes up the entire viewport.</p>
                    <p>Great for immersive experiences or when you need maximum space.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Offcanvas Elements -->
    <!-- Left Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Left Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <p>This offcanvas slides in from the left side of the screen.</p>
            <p>Perfect for navigation menus or additional content.</p>
        </div>
    </div>

    <!-- Right Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Right Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <p>This offcanvas slides in from the right side.</p>
            <p>Commonly used for shopping carts or filter panels.</p>
        </div>
    </div>

    <!-- Top Offcanvas -->
    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Top Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <p>This offcanvas slides down from the top.</p>
        </div>
    </div>

    <!-- Bottom Offcanvas -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Bottom Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <p>This offcanvas slides up from the bottom.</p>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize tooltips
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        // Initialize popovers
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;
        
        // Check for saved theme preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';
        htmlElement.setAttribute('data-bs-theme', currentTheme);
        updateThemeIcon(currentTheme);

        themeToggle.addEventListener('click', function() {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });

        function updateThemeIcon(theme) {
            const icon = themeToggle.querySelector('i');
            if (theme === 'dark') {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        }

        // Smooth scroll for sidebar links
        document.querySelectorAll('.nav-link[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Update active state
                    document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

        // Highlight active section on scroll
        window.addEventListener('scroll', function() {
            let current = '';
            const sections = document.querySelectorAll('section[id]');
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>