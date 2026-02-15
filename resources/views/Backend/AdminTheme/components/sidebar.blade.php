<!-- Sidebar with Tooltip Support for Collapsed Mode -->
<aside class="admin-sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <i class="bi bi-lightning-charge-fill"></i>
            <span class="brand-text">Emoce Admin</span>
        </div>
        <button class="sidebar-close d-lg-none" id="sidebarClose">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="sidebar-body">
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Request::routeIs('admin.dashboard.*') ? 'active' : '' }}"
                        data-tooltip="Dashboard">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link {{ Request::routeIs('admin.categories.*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#categoryMenu" aria-expanded="false"
                        data-tooltip="Category">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Category</span>
                        <i class="bi bi-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="nav-dropdown collapse {{ Request::routeIs('admin.categories.*') ? 'show' : '' }}"
                        id="categoryMenu">
                        <li>
                            <a href="{{ route('admin.categories.index') }}"
                                class="nav-link {{ Request::routeIs('admin.categories.index') ? 'active' : '' }}">
                                <i class="fas fa-list me-1"></i>Category List
                            </a>
                        </li>
                        <li><a href="{{ route('admin.categories.create') }}" class="nav-link {{ Request::routeIs('admin.categories.create') ? 'active' : '' }}">
                                <i class="fas fa-plus me-1"></i>Add Category
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link {{ Request::routeIs('admin.brands.*') ? 'active' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#brandMenu" aria-expanded="false"
                        data-tooltip="Brands">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Brand</span>
                        <i class="bi bi-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="nav-dropdown collapse {{ Request::routeIs('admin.brands.*') ? 'show' : '' }}"
                        id="brandMenu">
                        <li>
                            <a href="{{ route('admin.brands.index') }}"
                                class="nav-link {{ Request::routeIs('admin.brands.index') ? 'active' : '' }}">
                                <i class="fas fa-list me-1"></i>Brand List
                            </a>
                        </li>
                        <li><a href="{{ route('admin.brands.create') }}" class="nav-link {{ Request::routeIs('admin.brands.create') ? 'active' : '' }}">
                                <i class="fas fa-plus me-1"></i>Add Brand
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Components -->
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link {{ Request::routeIs('admin.attributes.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#attributeMenu"
                        aria-expanded="false" data-tooltip="Attribute">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <span>Attribute</span>
                        <i class="bi bi-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="nav-dropdown collapse {{ Request::routeIs('admin.attributes.*') ? 'show' : '' }}" id="attributeMenu">
                        <li>
                            <a href="{{ route('admin.attributes.index') }}" class="nav-link {{ Request::routeIs('admin.attributes.index') ? 'active' : '' }}">
                                <i class="fas fa-list me-1"></i> Attribute List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.attributes.create') }}" class="nav-link {{ Request::routeIs('admin.attributes.create') ? 'active' : '' }}">
                                <i class="fas fa-plus me-1"></i>Add Attribute
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-dropdown ">
                    <a href="#" class="nav-link " {{ Request::routeIs('admin.products.*') ? 'active' : '' }}
                        data-bs-toggle="collapse" data-bs-target="#productMenu"
                        aria-expanded="false" data-tooltip="product">
                        <i class="bi bi-box-seam"></i>
                        <span>Proudct</span>
                        <i class="bi bi-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="nav-dropdown collapse {{ Request::routeIs('admin.products.*') ? 'show' : '' }}" id="productMenu">
                        <li>
                            <a href="{{ route('admin.products.index') }}" class="nav-link {{ Request::routeIs('admin.products.index') ? 'active' : '' }}">
                            <i class="fas fa-list me-1"></i>Product List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.create') }}" class="nav-link {{ Request::routeIs('admin.products.create') ? 'active' : '' }}">
                            <i class="fas fa-plus me-1"></i>Add Product
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link " data-bs-toggle="collapse" data-bs-target="#componentsMenu"
                        aria-expanded="false" data-tooltip="Components">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <span>Components</span>
                        <i class="bi bi-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="nav-dropdown collapse" id="componentsMenu">
                        <li><a href="{{ url('button') }}" class="nav-link">Buttons</a></li>
                        <li><a href="{{ url('card') }}" class="nav-link">Cards</a></li>
                        <li><a href="{{ url('alert') }}" class="nav-link">Alerts</a></li>
                        <li><a href="{{ url('badges') }}" class="nav-link">Badges</a></li>
                        <li><a href="{{ url('progress') }}" class="nav-link">Progress Bars</a></li>
                    </ul>
                </li>

                <!-- Forms -->
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link " data-bs-toggle="collapse" data-bs-target="#formsMenu"
                        aria-expanded="false" data-tooltip="Forms">
                        <i class="bi bi-ui-checks"></i>
                        <span>Forms</span>
                        <i class="bi bi-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="nav-dropdown collapse" id="formsMenu">
                        <li><a href="{{ url('form') }}" class="nav-link">Form Elements</a></li>
                        <li><a href="{{ url('validation') }}" class="nav-link">Form Validation</a></li>
                        <li><a href="{{ url('select2') }}" class="nav-link">Select2</a></li>
                        <li><a href="{{ url('tags') }}" class="nav-link">Tags Input</a></li>

                        <!-- Advanced Forms (2nd Level) -->
                        <li class="nav-item has-dropdown">
                            <a href="#" class="nav-link " data-bs-toggle="collapse"
                                data-bs-target="#advancedForms" aria-expanded="false">
                                <span>Advanced Forms</span>
                                <i class="bi bi-chevron-down dropdown-icon"></i>
                            </a>
                            <ul class="nav-dropdown collapse" id="advancedForms">
                                <li><a href="{{ url('wizard') }}" class="nav-link">Form Wizard</a></li>
                                <li><a href="{{ url('upload') }}" class="nav-link">File Upload</a></li>

                                <!-- Special Inputs (3rd Level) -->
                                <li class="nav-item has-dropdown">
                                    <a href="#" class="nav-link " data-bs-toggle="collapse"
                                        data-bs-target="#specialInputs" aria-expanded="false">
                                        <span>Special Inputs</span>
                                        <i class="bi bi-chevron-down dropdown-icon"></i>
                                    </a>
                                    <ul class="nav-dropdown collapse" id="specialInputs">
                                        <li><a href="{{ url('datepicker') }}" class="nav-link">Date Picker</a></li>
                                        <li><a href="{{ url('color-picker') }}" class="nav-link">Color Picker</a>
                                        </li>
                                        <li><a href="{{ url('richeditor') }}" class="nav-link">Rich Editor</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Tables -->
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link " data-bs-toggle="collapse" data-bs-target="#tablesMenu"
                        aria-expanded="false" data-tooltip="Tables">
                        <i class="bi bi-table"></i>
                        <span>Tables</span>
                        <i class="bi bi-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="nav-dropdown collapse" id="tablesMenu">
                        <li><a href="{{ url('basic-table') }}" class="nav-link">Basic Table</a></li>
                        <li><a href="{{ url('datatable') }}" class="nav-link">DataTable</a></li>
                        <li><a href="{{ url('advance-datatable') }}" class="nav-link">DataTable</a></li>
                    </ul>
                </li>

                <!-- Pages -->
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link " data-bs-toggle="collapse" data-bs-target="#pagesMenu"
                        aria-expanded="false" data-tooltip="Pages">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Pages</span>
                        <i class="bi bi-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="nav-dropdown collapse" id="pagesMenu">
                        <li><a href="{{ url('profile') }}" class="nav-link">Profile</a></li>
                        <li><a href="{{ url('setting') }}" class="nav-link">Settings</a></li>
                        <li><a href="{{ url('invoice') }}" class="nav-link">Invoice</a></li>
                    </ul>
                </li>


                <!-- Charts -->
                <li class="nav-item">
                    <a href="{{ url('charts') }}" class="nav-link" data-tooltip="Charts">
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Charts</span>
                    </a>
                </li>

                <!-- Icons -->
                <li class="nav-item">
                    <a href="{{ url('icons') }}" class="nav-link" data-tooltip="Icons">
                        <i class="bi bi-star-fill"></i>
                        <span>Icons</span>
                    </a>
                </li>

                <!-- Divider -->
                <li class="nav-divider">
                    <span>Settings</span>
                </li>

                <!-- Users -->
                <li class="nav-item">
                    <a href="{{ url('users') }}" class="nav-link" data-tooltip="Users">
                        <i class="bi bi-people"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item has-dropdown">
                    <a href="#" class="nav-link " data-bs-toggle="collapse" data-bs-target="#roleMenu"
                        aria-expanded="false" data-tooltip="Components">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <span>Roles and Permission</span>
                        <i class="bi bi-chevron-down dropdown-icon"></i>
                    </a>
                    <ul class="nav-dropdown collapse" id="roleMenu">
                        <li><a href="{{ route('admin.roles.index') }}" class="nav-link">Roles</a></li>
                        <li><a href="{{ route('admin.permissions.index') }}" class="nav-link">Permission</a></li>
                    </ul>
                </li>

                <!-- Settings -->
                <li class="nav-item">
                    <a href="{{ url('settings') }}" class="nav-link" data-tooltip="Settings">
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</aside>
