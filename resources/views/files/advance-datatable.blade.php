@extends('Backend.AdminTheme.layout')

@section('title', 'Advanced DataTable')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2 text-gray-800">
                    <i class="fas fa-table"></i> Advanced DataTable
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">DataTable</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-success mr-2" onclick="exportData('excel')">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <button class="btn btn-info mr-2" onclick="exportData('csv')">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#columnSettingsModal">
                    <i class="fas fa-columns"></i> Column Settings
                </button>
            </div>
        </div>

        <!-- Advanced Filters & Search -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-filter"></i> Advanced Filters
                    <button class="btn btn-sm btn-light float-right" onclick="resetFilters()">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                </h6>
            </div>
            <div class="card-body">
                <form id="filterForm">
                    <div class="row">
                        <!-- Global Search -->
                        <div class="col-md-4 mb-3">
                            <label for="globalSearch">Global Search</label>
                            <input type="text" class="form-control" id="globalSearch"
                                placeholder="Search across all columns...">
                        </div>

                        <!-- Date Range Filter -->
                        <div class="col-md-4 mb-3">
                            <label for="dateRange">Date Range</label>
                            <input type="text" class="form-control" id="dateRange" placeholder="Select date range">
                        </div>

                        <!-- Status Filter -->
                        <div class="col-md-4 mb-3">
                            <label for="statusFilter">Status</label>
                            <select class="form-control" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </div>

                        <!-- Category Filter -->
                        <div class="col-md-3 mb-3">
                            <label for="categoryFilter">Category</label>
                            <select class="form-control" id="categoryFilter">
                                <option value="">All Categories</option>
                            </select>
                        </div>

                        <!-- Custom Filter 1 -->
                        <div class="col-md-3 mb-3">
                            <label for="customFilter1">Custom Filter</label>
                            <input type="text" class="form-control" id="customFilter1" placeholder="Custom value...">
                        </div>

                        <!-- Records Per Page -->
                        <div class="col-md-3 mb-3">
                            <label for="perPage">Records Per Page</label>
                            <select class="form-control" id="perPage">
                                <option value="10">10</option>
                                <option value="25" selected>25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                            </select>
                        </div>

                        <!-- Apply Filters -->
                        <div class="col-md-3 mb-3 d-flex align-items-end">
                            <button type="button" class="btn btn-primary btn-block" onclick="applyFilters()">
                                <i class="fas fa-search"></i> Apply Filters
                            </button>
                        </div>
                    </div>

                    <!-- Advanced Options -->
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-sm btn-link" type="button" data-toggle="collapse"
                                data-target="#advancedOptions">
                                <i class="fas fa-cog"></i> Advanced Options
                            </button>
                        </div>
                        <div class="col-12 collapse" id="advancedOptions">
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="showDeleted">
                                        <label class="custom-control-label" for="showDeleted">Show Deleted</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="groupByCategory">
                                        <label class="custom-control-label" for="groupByCategory">Group by
                                            Category</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="enableRowSelection"
                                            checked>
                                        <label class="custom-control-label" for="enableRowSelection">Row Selection</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="enableInlineEdit">
                                        <label class="custom-control-label" for="enableInlineEdit">Inline Editing</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bulk Actions Bar -->
        <div id="bulkActionsBar" class="card shadow-sm mb-3" style="display: none;">
            <div class="card-body py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span id="selectedCount" class="font-weight-bold">0</span> item(s) selected
                    </div>
                    <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-success" onclick="bulkAction('activate')">
                            <i class="fas fa-check"></i> Activate
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="bulkAction('deactivate')">
                            <i class="fas fa-ban"></i> Deactivate
                        </button>
                        <button class="btn btn-sm btn-info" onclick="bulkAction('export')">
                            <i class="fas fa-download"></i> Export Selected
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="bulkAction('delete')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="clearSelection()">
                            <i class="fas fa-times"></i> Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main DataTable -->
        <div class="card shadow-sm">
            <div class="card-header bg-gradient-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-list"></i> Data Records
                        <span class="badge badge-light ml-2" id="totalRecords">0</span>
                    </h6>
                    <div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-light" onclick="toggleView('table')" id="tableViewBtn">
                                <i class="fas fa-table"></i>
                            </button>
                            <button class="btn btn-outline-light" onclick="toggleView('grid')" id="gridViewBtn">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="btn btn-outline-light" onclick="toggleView('list')" id="listViewBtn">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- Table View -->
                <div id="tableView" class="table-responsive">
                    <table class="table table-hover table-bordered mb-0" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th width="30" class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll"></label>
                                    </div>
                                </th>
                                <th width="50" class="sortable" data-column="id">
                                    ID
                                    <i class="fas fa-sort ml-1"></i>
                                </th>
                                <th class="sortable resizable" data-column="name">
                                    Name
                                    <i class="fas fa-sort ml-1"></i>
                                    <div class="resize-handle"></div>
                                </th>
                                <th class="sortable resizable" data-column="email">
                                    Email
                                    <i class="fas fa-sort ml-1"></i>
                                    <div class="resize-handle"></div>
                                </th>
                                <th class="sortable resizable" data-column="category">
                                    Category
                                    <i class="fas fa-sort ml-1"></i>
                                    <div class="resize-handle"></div>
                                </th>
                                <th class="sortable resizable" data-column="status">
                                    Status
                                    <i class="fas fa-sort ml-1"></i>
                                    <div class="resize-handle"></div>
                                </th>
                                <th class="sortable resizable" data-column="created_at">
                                    Created Date
                                    <i class="fas fa-sort ml-1"></i>
                                    <div class="resize-handle"></div>
                                </th>
                                <th width="120" class="text-center">Actions</th>
                            </tr>
                            <!-- Column Filters Row -->
                            <tr class="column-filters">
                                <th></th>
                                <th>
                                    <input type="text" class="form-control form-control-sm column-filter"
                                        placeholder="ID" data-column="id">
                                </th>
                                <th>
                                    <input type="text" class="form-control form-control-sm column-filter"
                                        placeholder="Name" data-column="name">
                                </th>
                                <th>
                                    <input type="text" class="form-control form-control-sm column-filter"
                                        placeholder="Email" data-column="email">
                                </th>
                                <th>
                                    <select class="form-control form-control-sm column-filter" data-column="category">
                                        <option value="">All</option>
                                    </select>
                                </th>
                                <th>
                                    <select class="form-control form-control-sm column-filter" data-column="status">
                                        <option value="">All</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </th>
                                <th>
                                    <input type="text" class="form-control form-control-sm column-filter"
                                        placeholder="Date" data-column="created_at">
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Data will be loaded here via AJAX -->
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <p class="mt-2 text-muted">Loading data...</p>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="2">Total:</th>
                                <th id="footerName">-</th>
                                <th id="footerEmail">-</th>
                                <th id="footerCategory">-</th>
                                <th id="footerStatus">-</th>
                                <th id="footerDate">-</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Grid View (Hidden by default) -->
                <div id="gridView" class="p-3" style="display: none;">
                    <div class="row" id="gridContainer">
                        <!-- Grid items will be loaded here -->
                    </div>
                </div>

                <!-- List View (Hidden by default) -->
                <div id="listView" class="p-3" style="display: none;">
                    <div id="listContainer">
                        <!-- List items will be loaded here -->
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Pagination Info -->
                    <div>
                        <span class="text-muted">
                            Showing <span id="showingFrom">0</span> to <span id="showingTo">0</span> of
                            <span id="totalItems">0</span> entries
                        </span>
                    </div>

                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination mb-0" id="pagination">
                            <!-- Pagination will be generated here -->
                        </ul>
                    </nav>

                    <!-- Quick Jump -->
                    <div class="input-group" style="width: 150px;">
                        <input type="number" class="form-control form-control-sm" id="jumpToPage"
                            placeholder="Page #">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" onclick="jumpToPage()">Go</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Column Settings Modal -->
    <div class="modal fade" id="columnSettingsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-columns"></i> Column Settings
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Drag and drop to reorder columns. Toggle visibility with checkboxes.</p>
                    <div id="columnList" class="list-group">
                        <!-- Column settings will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="resetColumnSettings()">Reset to
                        Default</button>
                    <button type="button" class="btn btn-primary" onclick="saveColumnSettings()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline Edit Modal -->
    <div class="modal fade" id="inlineEditModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-edit"></i> Edit Record
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="inlineEditForm">
                        <input type="hidden" id="editRecordId">
                        <!-- Form fields will be dynamically generated -->
                        <div id="editFormFields"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveInlineEdit()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <style>
        /* AG Grid-like Styles */
        #dataTable {
            font-size: 14px;
        }

        #dataTable thead th {
            background-color: #f8f9fc;
            border-bottom: 2px solid #e3e6f0;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .sortable {
            cursor: pointer;
            user-select: none;
            position: relative;
        }

        .sortable:hover {
            background-color: #e9ecef !important;
        }

        .sortable.asc .fa-sort:before {
            content: "\f0de";
            color: #4e73df;
        }

        .sortable.desc .fa-sort:before {
            content: "\f0dd";
            color: #4e73df;
        }

        /* Resizable Columns */
        .resizable {
            position: relative;
        }

        .resize-handle {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            cursor: col-resize;
            background: transparent;
        }

        .resize-handle:hover {
            background: #4e73df;
        }

        /* Row Hover Effect */
        #dataTable tbody tr {
            transition: all 0.2s;
        }

        #dataTable tbody tr:hover {
            background-color: #f8f9fc;
            transform: translateX(2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Selected Row */
        #dataTable tbody tr.selected {
            background-color: #e3f2fd !important;
        }

        /* Column Filters */
        .column-filters th {
            padding: 5px;
            background-color: #fff;
        }

        .column-filter {
            width: 100%;
        }

        /* Editable Cell */
        .editable-cell {
            position: relative;
            cursor: pointer;
        }

        .editable-cell:hover::after {
            content: '\f044';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 10px;
            color: #6c757d;
        }

        /* Grid View */
        .grid-item {
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }

        .grid-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        /* List View */
        .list-item {
            border-left: 3px solid #4e73df;
            padding: 15px;
            margin-bottom: 10px;
            background: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Loading Overlay */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        /* Custom Scrollbar */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Drag and Drop for Column Reordering */
        .column-item {
            cursor: move;
            padding: 10px;
            margin-bottom: 5px;
            background: #f8f9fc;
            border: 1px solid #e3e6f0;
            border-radius: 4px;
        }

        .column-item.dragging {
            opacity: 0.5;
        }

        /* Status Badges */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        /* Gradient Header */
        .bg-gradient-primary {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        // Global Variables
        let dataTable;
        let selectedRows = new Set();
        let currentView = 'table';
        let currentPage = 1;
        let perPage = 25;
        let sortColumn = 'id';
        let sortDirection = 'asc';
        let filters = {};
        let columnSettings = {
            id: {
                visible: true,
                order: 0,
                width: 50
            },
            name: {
                visible: true,
                order: 1,
                width: 200
            },
            email: {
                visible: true,
                order: 2,
                width: 200
            },
            category: {
                visible: true,
                order: 3,
                width: 150
            },
            status: {
                visible: true,
                order: 4,
                width: 100
            },
            created_at: {
                visible: true,
                order: 5,
                width: 150
            }
        };

        $(document).ready(function() {
            initializeDataTable();
            initializeEventListeners();
            initializeDateRangePicker();
            initializeColumnDragDrop();
            loadData();
        });

        // Initialize DataTable
        function initializeDataTable() {
            // Load column settings from localStorage
            const savedSettings = localStorage.getItem('columnSettings');
            if (savedSettings) {
                columnSettings = JSON.parse(savedSettings);
            }
        }

        // Initialize Event Listeners
        function initializeEventListeners() {
            // Global Search
            $('#globalSearch').on('keyup', debounce(function() {
                filters.global = $(this).val();
                loadData();
            }, 500));

            // Per Page Change
            $('#perPage').on('change', function() {
                perPage = $(this).val();
                currentPage = 1;
                loadData();
            });

            // Select All Checkbox
            $('#selectAll').on('change', function() {
                const isChecked = $(this).prop('checked');
                $('.row-checkbox').prop('checked', isChecked);

                if (isChecked) {
                    $('.row-checkbox').each(function() {
                        selectedRows.add($(this).val());
                    });
                } else {
                    selectedRows.clear();
                }

                updateBulkActionsBar();
            });

            // Row Checkbox
            $(document).on('change', '.row-checkbox', function() {
                const value = $(this).val();
                if ($(this).prop('checked')) {
                    selectedRows.add(value);
                    $(this).closest('tr').addClass('selected');
                } else {
                    selectedRows.delete(value);
                    $(this).closest('tr').removeClass('selected');
                }
                updateBulkActionsBar();
            });

            // Column Sorting
            $(document).on('click', '.sortable', function() {
                const column = $(this).data('column');

                if (sortColumn === column) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortColumn = column;
                    sortDirection = 'asc';
                }

                $('.sortable').removeClass('asc desc');
                $(this).addClass(sortDirection);

                loadData();
            });

            // Column Filters
            $('.column-filter').on('keyup change', debounce(function() {
                const column = $(this).data('column');
                const value = $(this).val();

                if (value) {
                    filters[column] = value;
                } else {
                    delete filters[column];
                }

                loadData();
            }, 500));

            // Status Filter
            $('#statusFilter').on('change', function() {
                filters.status = $(this).val();
                loadData();
            });

            // Column Resize
            initializeColumnResize();
        }

        // Initialize Date Range Picker
        function initializeDateRangePicker() {
            $('#dateRange').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
                filters.dateFrom = picker.startDate.format('YYYY-MM-DD');
                filters.dateTo = picker.endDate.format('YYYY-MM-DD');
                loadData();
            });

            $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                delete filters.dateFrom;
                delete filters.dateTo;
                loadData();
            });
        }

        // Load Data via AJAX
        function loadData() {
            showLoading();

            const params = {
                page: currentPage,
                per_page: perPage,
                sort_by: sortColumn,
                sort_direction: sortDirection,
                ...filters
            };

            $.ajax({
                url: '/admin/datatable/data', // Your API endpoint
                method: 'GET',
                data: params,
                success: function(response) {
                    renderData(response);
                    updatePagination(response);
                    hideLoading();
                },
                error: function(xhr) {
                    hideLoading();
                    showError('Failed to load data. Please try again.');
                }
            });
        }

        // Render Data based on current view
        function renderData(response) {
            if (currentView === 'table') {
                renderTableView(response.data);
            } else if (currentView === 'grid') {
                renderGridView(response.data);
            } else if (currentView === 'list') {
                renderListView(response.data);
            }

            // Update totals
            $('#totalRecords').text(response.total);
            $('#totalItems').text(response.total);
            $('#showingFrom').text(response.from || 0);
            $('#showingTo').text(response.to || 0);
        }

        // Render Table View
        function renderTableView(data) {
            const tbody = $('#tableBody');
            tbody.empty();

            if (data.length === 0) {
                tbody.append(`
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No records found</p>
                        </td>
                    </tr>
                `);
                return;
            }

            data.forEach(row => {
                const isSelected = selectedRows.has(row.id.toString());
                const rowHtml = `
                    <tr class="${isSelected ? 'selected' : ''}" data-id="${row.id}">
                        <td class="text-center">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input row-checkbox" 
                                       id="row_${row.id}" value="${row.id}" ${isSelected ? 'checked' : ''}>
                                <label class="custom-control-label" for="row_${row.id}"></label>
                            </div>
                        </td>
                        <td>${row.id}</td>
                        <td class="editable-cell" data-field="name" data-id="${row.id}">${row.name || '-'}</td>
                        <td class="editable-cell" data-field="email" data-id="${row.id}">${row.email || '-'}</td>
                        <td class="editable-cell" data-field="category" data-id="${row.id}">${row.category || '-'}</td>
                        <td>
                            <span class="status-badge status-${row.status}">${row.status || 'N/A'}</span>
                        </td>
                        <td>${formatDate(row.created_at)}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <button class="btn btn-info" onclick="viewRecord(${row.id})" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-primary" onclick="editRecord(${row.id})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" onclick="deleteRecord(${row.id})" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.append(rowHtml);
            });

            // Enable inline editing if checkbox is checked
            if ($('#enableInlineEdit').is(':checked')) {
                enableInlineEditing();
            }
        }

        // Render Grid View
        function renderGridView(data) {
            const container = $('#gridContainer');
            container.empty();

            if (data.length === 0) {
                container.append(`
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No records found</p>
                    </div>
                `);
                return;
            }

            data.forEach(row => {
                const cardHtml = `
                    <div class="col-md-4 col-lg-3">
                        <div class="grid-item">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0">${row.name || 'N/A'}</h6>
                                <span class="status-badge status-${row.status}">${row.status}</span>
                            </div>
                            <p class="text-muted small mb-2"><i class="fas fa-envelope"></i> ${row.email || 'N/A'}</p>
                            <p class="text-muted small mb-2"><i class="fas fa-folder"></i> ${row.category || 'N/A'}</p>
                            <p class="text-muted small mb-3"><i class="fas fa-calendar"></i> ${formatDate(row.created_at)}</p>
                            <div class="btn-group btn-group-sm btn-block" role="group">
                                <button class="btn btn-info" onclick="viewRecord(${row.id})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-primary" onclick="editRecord(${row.id})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" onclick="deleteRecord(${row.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                container.append(cardHtml);
            });
        }

        // Render List View
        function renderListView(data) {
            const container = $('#listContainer');
            container.empty();

            if (data.length === 0) {
                container.append(`
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No records found</p>
                    </div>
                `);
                return;
            }

            data.forEach(row => {
                const listHtml = `
                    <div class="list-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-2">
                                    <h6 class="mb-0 mr-3">${row.name || 'N/A'}</h6>
                                    <span class="status-badge status-${row.status}">${row.status}</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <small class="text-muted">
                                            <i class="fas fa-envelope"></i> ${row.email || 'N/A'}
                                        </small>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted">
                                            <i class="fas fa-folder"></i> ${row.category || 'N/A'}
                                        </small>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar"></i> ${formatDate(row.created_at)}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group btn-group-sm ml-3" role="group">
                                <button class="btn btn-info" onclick="viewRecord(${row.id})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-primary" onclick="editRecord(${row.id})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" onclick="deleteRecord(${row.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                container.append(listHtml);
            });
        }

        // Update Pagination
        function updatePagination(response) {
            const pagination = $('#pagination');
            pagination.empty();

            const totalPages = Math.ceil(response.total / perPage);

            // Previous Button
            pagination.append(`
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="goToPage(${currentPage - 1}); return false;">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            `);

            // Page Numbers
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, currentPage + 2);

            if (startPage > 1) {
                pagination.append(`
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="goToPage(1); return false;">1</a>
                    </li>
                `);
                if (startPage > 2) {
                    pagination.append(`<li class="page-item disabled"><a class="page-link">...</a></li>`);
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                pagination.append(`
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="goToPage(${i}); return false;">${i}</a>
                    </li>
                `);
            }

            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    pagination.append(`<li class="page-item disabled"><a class="page-link">...</a></li>`);
                }
                pagination.append(`
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="goToPage(${totalPages}); return false;">${totalPages}</a>
                    </li>
                `);
            }

            // Next Button
            pagination.append(`
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="goToPage(${currentPage + 1}); return false;">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            `);
        }

        // Go to Page
        function goToPage(page) {
            currentPage = page;
            loadData();
        }

        // Jump to Page
        function jumpToPage() {
            const page = parseInt($('#jumpToPage').val());
            if (page && page > 0) {
                goToPage(page);
            }
        }

        // Toggle View
        function toggleView(view) {
            currentView = view;

            // Hide all views
            $('#tableView, #gridView, #listView').hide();

            // Show selected view
            $(`#${view}View`).show();

            // Update buttons
            $('.btn-group button').removeClass('btn-light').addClass('btn-outline-light');
            $(`#${view}ViewBtn`).removeClass('btn-outline-light').addClass('btn-light');

            loadData();
        }

        // Update Bulk Actions Bar
        function updateBulkActionsBar() {
            const count = selectedRows.size;
            $('#selectedCount').text(count);

            if (count > 0) {
                $('#bulkActionsBar').slideDown();
            } else {
                $('#bulkActionsBar').slideUp();
            }
        }

        // Clear Selection
        function clearSelection() {
            selectedRows.clear();
            $('.row-checkbox').prop('checked', false);
            $('#selectAll').prop('checked', false);
            $('tr').removeClass('selected');
            updateBulkActionsBar();
        }

        // Bulk Action
        function bulkAction(action) {
            if (selectedRows.size === 0) {
                showError('Please select at least one record');
                return;
            }

            const ids = Array.from(selectedRows);

            Swal.fire({
                title: `Confirm ${action}`,
                text: `Are you sure you want to ${action} ${ids.length} record(s)?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/datatable/bulk-${action}`,
                        method: 'POST',
                        data: {
                            ids: ids,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            showSuccess(response.message || `${action} completed successfully`);
                            clearSelection();
                            loadData();
                        },
                        error: function(xhr) {
                            showError(`Failed to ${action} records`);
                        }
                    });
                }
            });
        }

        // Export Data
        function exportData(format) {
            const params = new URLSearchParams({
                format: format,
                ...filters
            });

            window.location.href = `/admin/datatable/export?${params.toString()}`;
        }

        // View Record
        function viewRecord(id) {
            window.location.href = `/admin/datatable/${id}`;
        }

        // Edit Record
        function editRecord(id) {
            if ($('#enableInlineEdit').is(':checked')) {
                openInlineEditModal(id);
            } else {
                window.location.href = `/admin/datatable/${id}/edit`;
            }
        }

        // Delete Record
        function deleteRecord(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/datatable/${id}`,
                        method: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            showSuccess('Record deleted successfully');
                            loadData();
                        },
                        error: function(xhr) {
                            showError('Failed to delete record');
                        }
                    });
                }
            });
        }

        // Enable Inline Editing
        function enableInlineEditing() {
            $(document).off('dblclick', '.editable-cell').on('dblclick', '.editable-cell', function() {
                const cell = $(this);
                const currentValue = cell.text();
                const field = cell.data('field');
                const id = cell.data('id');

                const input = $('<input>', {
                    type: 'text',
                    class: 'form-control form-control-sm',
                    value: currentValue
                });

                cell.html(input);
                input.focus().select();

                input.on('blur keyup', function(e) {
                    if (e.type === 'keyup' && e.keyCode !== 13) return;

                    const newValue = $(this).val();

                    if (newValue !== currentValue) {
                        updateCell(id, field, newValue);
                    }

                    cell.text(newValue);
                });
            });
        }

        // Update Cell
        function updateCell(id, field, value) {
            $.ajax({
                url: `/admin/datatable/${id}/update-field`,
                method: 'POST',
                data: {
                    field: field,
                    value: value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showSuccess('Updated successfully');
                },
                error: function(xhr) {
                    showError('Failed to update');
                }
            });
        }

        // Open Inline Edit Modal
        function openInlineEditModal(id) {
            // Fetch record data and populate form
            $.ajax({
                url: `/admin/datatable/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#editRecordId').val(id);
                    const fields = `
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="${data.name || ''}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="${data.email || ''}">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" class="form-control" name="category" value="${data.category || ''}">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="active" ${data.status === 'active' ? 'selected' : ''}>Active</option>
                                <option value="inactive" ${data.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                                <option value="pending" ${data.status === 'pending' ? 'selected' : ''}>Pending</option>
                            </select>
                        </div>
                    `;
                    $('#editFormFields').html(fields);
                    $('#inlineEditModal').modal('show');
                }
            });
        }

        // Save Inline Edit
        function saveInlineEdit() {
            const id = $('#editRecordId').val();
            const formData = $('#inlineEditForm').serialize();

            $.ajax({
                url: `/admin/datatable/${id}`,
                method: 'PUT',
                data: formData + '&_token=' + $('meta[name="csrf-token"]').attr('content'),
                success: function(response) {
                    showSuccess('Record updated successfully');
                    $('#inlineEditModal').modal('hide');
                    loadData();
                },
                error: function(xhr) {
                    showError('Failed to update record');
                }
            });
        }

        // Initialize Column Drag and Drop
        function initializeColumnDragDrop() {
            const el = document.getElementById('columnList');
            if (el) {
                Sortable.create(el, {
                    animation: 150,
                    handle: '.drag-handle',
                    onEnd: function() {
                        updateColumnOrder();
                    }
                });
            }

            // Populate column list
            loadColumnSettings();
        }

        // Load Column Settings
        function loadColumnSettings() {
            const columnList = $('#columnList');
            columnList.empty();

            const sortedColumns = Object.keys(columnSettings).sort((a, b) => {
                return columnSettings[a].order - columnSettings[b].order;
            });

            sortedColumns.forEach(column => {
                const setting = columnSettings[column];
                const item = `
                    <div class="list-group-item column-item" data-column="${column}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-grip-vertical drag-handle mr-2" style="cursor: move;"></i>
                                <strong>${capitalizeFirst(column)}</strong>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input column-visibility" 
                                       id="col_${column}" ${setting.visible ? 'checked' : ''}>
                                <label class="custom-control-label" for="col_${column}">Visible</label>
                            </div>
                        </div>
                    </div>
                `;
                columnList.append(item);
            });
        }

        // Update Column Order
        function updateColumnOrder() {
            $('.column-item').each(function(index) {
                const column = $(this).data('column');
                columnSettings[column].order = index;
            });
        }

        // Save Column Settings
        function saveColumnSettings() {
            $('.column-visibility').each(function() {
                const column = $(this).attr('id').replace('col_', '');
                columnSettings[column].visible = $(this).prop('checked');
            });

            localStorage.setItem('columnSettings', JSON.stringify(columnSettings));
            showSuccess('Column settings saved');
            $('#columnSettingsModal').modal('hide');
            loadData();
        }

        // Reset Column Settings
        function resetColumnSettings() {
            localStorage.removeItem('columnSettings');
            location.reload();
        }

        // Initialize Column Resize
        function initializeColumnResize() {
            let isResizing = false;
            let currentColumn = null;
            let startX = 0;
            let startWidth = 0;

            $(document).on('mousedown', '.resize-handle', function(e) {
                isResizing = true;
                currentColumn = $(this).parent();
                startX = e.pageX;
                startWidth = currentColumn.width();
                e.preventDefault();
            });

            $(document).on('mousemove', function(e) {
                if (isResizing) {
                    const width = startWidth + (e.pageX - startX);
                    currentColumn.width(width);
                }
            });

            $(document).on('mouseup', function() {
                if (isResizing) {
                    isResizing = false;
                    const column = currentColumn.data('column');
                    columnSettings[column].width = currentColumn.width();
                    localStorage.setItem('columnSettings', JSON.stringify(columnSettings));
                }
            });
        }

        // Reset Filters
        function resetFilters() {
            filters = {};
            $('#filterForm')[0].reset();
            $('#globalSearch').val('');
            $('.column-filter').val('');
            currentPage = 1;
            loadData();
        }

        // Apply Filters
        function applyFilters() {
            currentPage = 1;
            loadData();
        }

        // Helper Functions
        function showLoading() {
            // Add loading overlay or spinner
        }

        function hideLoading() {
            // Remove loading overlay or spinner
        }

        function showSuccess(message) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                timer: 2000,
                showConfirmButton: false
            });
        }

        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message
            });
        }

        function formatDate(date) {
            if (!date) return '-';
            return moment(date).format('MMM DD, YYYY');
        }

        function capitalizeFirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }
    </script>
@endpush