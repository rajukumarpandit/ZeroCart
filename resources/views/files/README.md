# Emoce Admin Panel - Complete Bootstrap Theme

A modern, professional, and fully responsive admin panel built with Bootstrap 5.3+ and vanilla JavaScript. Features dark/light theme support, three-level dropdown navigation, and comprehensive UI components.

## 🎨 Features

### Core Features
- ✅ **Dark & Light Theme** - Automatic theme switching with localStorage persistence
- ✅ **Fully Responsive** - Works seamlessly on desktop, tablet, and mobile devices
- ✅ **Bootstrap 5.3+** - Built with latest Bootstrap framework
- ✅ **No jQuery Dependencies** - Pure vanilla JavaScript (except DataTables)
- ✅ **Three-Level Dropdown** - Nested navigation menus in sidebar
- ✅ **Togglable Sidebar** - Collapsible sidebar for desktop, slide-out for mobile
- ✅ **Professional Design** - Modern, clean, and creative UI/UX

### Components Included
- **Dashboard** - Statistics cards, charts, activity feeds, data tables
- **Forms** - Input fields, validation, file uploads, advanced inputs
- **Tables** - Basic tables and DataTables with sorting/filtering
- **Components** - Buttons, cards, alerts, badges, progress bars
- **Charts** - Line charts, donut charts (Chart.js integration)
- **Icons** - Bootstrap Icons included
- **Notifications** - Dropdown notifications and messages
- **User Profile** - Profile dropdown with quick actions

## 📁 File Structure

```
admin-panel/
├── layout.html              # Base layout template
├── dashboard.html           # Main dashboard page
├── custom-admin.css         # Main CSS file (comprehensive)
├── dashboard.css            # Dashboard-specific styles
├── admin-script.js          # Core JavaScript functionality
├── dashboard.js             # Dashboard charts & widgets
│
├── Components:
├── buttons.html             # Button variants & styles
├── cards.html               # Card components
├── alerts.html              # Alert messages
├── badges.html              # Badge components
├── progress.html            # Progress bars
│
├── Forms:
├── form-elements.html       # Basic form inputs
│
└── Tables:
    ├── basic-table.html     # Simple HTML tables
    └── datatable.html       # Advanced DataTables
```

## 🚀 Getting Started

### Installation

1. **Download/Clone the files**
```bash
# All files are ready to use - no build process needed!
```

2. **Open in browser**
```bash
# Simply open any HTML file in your web browser
open dashboard.html
```

### CDN Dependencies

The theme uses the following CDN resources (already included in HTML files):

- **Bootstrap 5.3.2** - CSS & JS
- **Bootstrap Icons 1.11.1** - Icon font
- **Chart.js 4.4.0** - Charts and graphs
- **jQuery 3.7.0** - For DataTables only
- **DataTables 1.13.6** - Advanced table features

## 🎯 Usage Guide

### Theme Switching

The theme automatically detects system preferences and saves user choice:

```javascript
// Manual theme switching
window.emoceAdmin.setTheme('dark');  // or 'light'
```

### Sidebar Toggle

```javascript
// Toggle sidebar programmatically
window.emoceAdmin.toggleSidebar();

// Close sidebar
window.emoceAdmin.closeSidebar();
```

### Notifications

```javascript
// Show toast notification
window.emoceAdmin.showToast('Message text', 'success');
// Types: success, danger, warning, info, primary
```

### Form Validation

```javascript
// Validate form
const isValid = window.emoceAdmin.validateForm('myFormId');
```

## 🎨 Customization

### Color Scheme

Edit CSS variables in `custom-admin.css`:

```css
:root {
  --primary-color: #6366f1;      /* Main brand color */
  --success-color: #22c55e;      /* Success states */
  --danger-color: #ef4444;       /* Error states */
  --warning-color: #f59e0b;      /* Warning states */
  --info-color: #3b82f6;         /* Info states */
}
```

### Dark Theme Colors

```css
[data-bs-theme="dark"] {
  --body-bg: #0f172a;            /* Page background */
  --content-bg: #1e293b;         /* Card/content background */
  --text-primary: #f1f5f9;       /* Primary text */
}
```

### Sidebar Width

```css
:root {
  --sidebar-width: 280px;        /* Adjust sidebar width */
  --header-height: 70px;         /* Adjust header height */
}
```

## 📱 Responsive Breakpoints

The theme uses Bootstrap's standard breakpoints:

- **Mobile**: < 576px
- **Tablet**: 576px - 991px
- **Desktop**: ≥ 992px

### Mobile Behavior
- Sidebar becomes slide-out drawer
- Hamburger menu appears
- Search box hidden on small screens
- Simplified navigation

## 🔧 Laravel Integration

### Step 1: Move Files to Laravel

```bash
# Place in Laravel public directory
public/
├── css/
│   ├── custom-admin.css
│   └── dashboard.css
├── js/
│   ├── admin-script.js
│   └── dashboard.js
```

### Step 2: Create Blade Layout

Create `resources/views/layouts/admin.blade.php`:

```blade
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom-admin.css') }}">
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        @include('partials.sidebar')
        
        <div class="admin-content">
            @include('partials.header')
            
            <main class="admin-main">
                @yield('content')
            </main>
            
            @include('partials.footer')
        </div>
    </div>
    
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin-script.js') }}"></script>
    @stack('scripts')
</body>
</html>
```

### Step 3: Create Partials

**Sidebar** (`resources/views/partials/sidebar.blade.php`):
```blade
<aside class="admin-sidebar" id="sidebar">
    <!-- Copy sidebar content from layout.html -->
</aside>
```

**Header** (`resources/views/partials/header.blade.php`):
```blade
<header class="admin-header">
    <!-- Copy header content from layout.html -->
</header>
```

**Footer** (`resources/views/partials/footer.blade.php`):
```blade
<footer class="admin-footer">
    <!-- Copy footer content from layout.html -->
</footer>
```

### Step 4: Create Dashboard Controller

```php
namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
```

### Step 5: Create Dashboard View

`resources/views/dashboard.blade.php`:

```blade
@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <!-- Copy dashboard content from dashboard.html -->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
```

### Step 6: Routes

```php
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Add more routes
});
```

## 📊 Components Documentation

### Statistics Cards

```html
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
```

### Activity Feed

```html
<div class="activity-item">
    <div class="activity-icon bg-primary">
        <i class="bi bi-person-plus"></i>
    </div>
    <div class="activity-content">
        <p class="activity-text"><strong>User</strong> registered</p>
        <span class="activity-time">5 minutes ago</span>
    </div>
</div>
```

### Charts

```javascript
// Revenue Chart Example
const revenueChart = new Chart(ctx, {
    type: 'line',
    data: { /* your data */ },
    options: { /* your options */ }
});
```

## 🎯 Best Practices

1. **Always use Bootstrap classes** first before custom CSS
2. **Keep JavaScript modular** - use the provided utility functions
3. **Test on multiple devices** - the theme is responsive but always verify
4. **Use CSS variables** for colors - makes theming easier
5. **Follow naming conventions** - use kebab-case for CSS classes

## 🔒 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Opera (latest)

## 📝 License

This theme is created for educational and commercial use. Feel free to modify and use in your projects.

## 🤝 Support

For issues, questions, or suggestions:
- Review the code comments
- Check Bootstrap 5 documentation
- Inspect browser console for errors

## 🎉 Credits

- **Bootstrap 5** - UI Framework
- **Bootstrap Icons** - Icon library
- **Chart.js** - Charts and graphs
- **DataTables** - Advanced table features

---

**Version:** 1.0.0  
**Last Updated:** January 2024  
**Built with:** Bootstrap 5.3.2, Vanilla JavaScript, Chart.js

## Quick Start Checklist

- [ ] Download all files
- [ ] Open `dashboard.html` in browser
- [ ] Test theme switching (moon/sun icon)
- [ ] Test responsive design (resize browser)
- [ ] Explore all component pages
- [ ] Customize colors in CSS variables
- [ ] Integrate with your Laravel project
- [ ] Add your own content and data

**Happy coding! 🚀**
