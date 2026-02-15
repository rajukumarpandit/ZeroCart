{{-- @extends('Backend.AdminTheme.layout')
@push('styles')
    <style>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            padding: 20px;
        }

        .btn {
            font-weight: 500;
            padding: 10px 20px;
            border-radius: var(--border-radius-sm);
            transition: var(--transition);
            font-size: 14px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-success {
            background-color: var(--success-color);
            color: #ffffff;
        }

        .btn-success:hover {
            background-color: #16a34a;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: #ffffff;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-outline-secondary {
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            background-color: transparent;
        }

        .btn-outline-secondary:hover {
            background-color: var(--border-light);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .form-control, .form-select {
            background-color: var(--content-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 10px 14px;
            border-radius: var(--border-radius-sm);
            font-size: 14px;
            transition: var(--transition);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background-color: var(--content-bg);
            color: var(--text-primary);
            outline: none;
        }

        .form-label {
            color: var(--text-primary);
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .required {
            color: var(--danger-color);
        }

        .form-text {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 4px;
        }

        /* Image Upload Area */
        .image-upload-wrapper {
            border: 2px dashed var(--border-color);
            border-radius: var(--border-radius);
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            background-color: var(--border-light);
        }

        .image-upload-wrapper:hover {
            border-color: var(--primary-color);
            background-color: rgba(99, 102, 241, 0.05);
        }

        .image-upload-wrapper.dragover {
            border-color: var(--primary-color);
            background-color: rgba(99, 102, 241, 0.1);
        }

        .upload-icon {
            font-size: 48px;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .upload-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .upload-subtitle {
            color: var(--text-muted);
            font-size: 13px;
        }

        .uploaded-images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        .uploaded-image-card {
            position: relative;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-sm);
            overflow: hidden;
            background-color: var(--content-bg);
            transition: var(--transition);
        }

        .uploaded-image-card:hover {
            box-shadow: var(--shadow-md);
        }

        .uploaded-image-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .image-actions {
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            gap: 4px;
            padding: 6px;
        }

        .image-action-btn {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            transition: var(--transition);
        }

        .btn-remove-image {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-remove-image:hover {
            background-color: #dc2626;
        }

        .btn-primary-image {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary-image:hover {
            background-color: var(--primary-dark);
        }

        .primary-badge {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        /* Variant Section */
        .variant-card {
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 16px;
            background-color: var(--border-light);
            transition: var(--transition);
        }

        .variant-card:hover {
            box-shadow: var(--shadow-md);
        }

        .variant-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .variant-title {
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .variant-number {
            background-color: var(--primary-color);
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .section-description {
            color: var(--text-muted);
            font-size: 13px;
            margin-top: 4px;
        }

        .form-switch .form-check-input {
            width: 48px;
            height: 24px;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .info-box {
            background-color: rgba(59, 130, 246, 0.1);
            border-left: 4px solid var(--info-color);
            padding: 16px;
            border-radius: var(--border-radius-sm);
            margin-bottom: 20px;
        }

        .info-box-title {
            font-weight: 600;
            color: var(--info-color);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box-text {
            color: var(--text-secondary);
            font-size: 13px;
            margin: 0;
        }

        /* Fixed Action Bar */
        .fixed-action-bar {
            position: fixed;
            bottom: 0;
            left: var(--sidebar-width);
            right: 0;
            background-color: var(--header-bg);
            border-top: 1px solid var(--border-color);
            padding: 16px 24px;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 998;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-bar-left {
            display: flex;
            gap: 12px;
        }

        .action-bar-right {
            display: flex;
            gap: 12px;
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

        .input-group-text {
            background-color: var(--border-light);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        /* Rich Text Editor Placeholder */
        .editor-placeholder {
            min-height: 200px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-sm);
            padding: 12px;
            background-color: var(--content-bg);
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-content {
                margin-left: 0;
            }

            .fixed-action-bar {
                left: 0;
            }
        }

        @media (max-width: 767.98px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .uploaded-images-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }

            .action-bar-left,
            .action-bar-right {
                flex-direction: column;
                width: 100%;
            }

            .fixed-action-bar {
                flex-direction: column;
                gap: 12px;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        .badge {
            font-weight: 600;
            padding: 4px 8px;
            border-radius: var(--border-radius-sm);
            font-size: 11px;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        /* Variant Options Builder */
        .variant-option-item {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
        }

        .variant-option-item input {
            flex: 1;
        }

        .add-option-btn {
            color: var(--primary-color);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 8px;
        }

        .add-option-btn:hover {
            text-decoration: underline;
        }

        /* Variant Combination Table */
        .variant-combinations {
            margin-top: 20px;
        }

        .combination-table {
            width: 100%;
            border-collapse: collapse;
        }

        .combination-table th {
            background-color: var(--border-light);
            padding: 10px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            border: 1px solid var(--border-color);
        }

        .combination-table td {
            padding: 10px;
            border: 1px solid var(--border-color);
        }

        .combination-table input {
            width: 100%;
            padding: 6px 10px;
        }

        .mb-100 {
            margin-bottom: 100px;
        } 
    </style>
@endpush
@section('content')
<div class="page-header mb-4">


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Add Product</a></li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>

            </div>
        </div>
</div>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="card">
    <div class="card-body">

                <form id="productForm">
                    <div class="row">
                        <!-- Left Column - Main Information -->
                        <div class="col-lg-8">
                            <!-- Basic Information Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info-circle me-2"></i>Basic Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">
                                                Product Name <span class="required">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name" required>
                                            <div class="form-text">This is the main name that will appear to customers</div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Short Description</label>
                                            <input type="text" class="form-control" name="short_description" id="short_description" placeholder="Brief product description (max 160 characters)">
                                            <div class="form-text">A brief summary that appears in product listings</div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Full Description</label>
                                            <textarea class="form-control" rows="6" name="description" id="description" placeholder="Detailed product description with features, benefits, and specifications"></textarea>
                                            <div class="form-text">Detailed description with all product features and specifications</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Images Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-images me-2"></i>Product Images
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="image-upload-wrapper" id="imageUploadArea">
                                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                        <div class="upload-title">Click to upload or drag and drop</div>
                                        <p class="upload-subtitle">SVG, PNG, JPG or GIF (recommended size: 800x800px)</p>
                                        <input type="file" id="imageInput" name="image" multiple accept="image/*" style="display: none;">
                                    </div>

                                    <div class="uploaded-images-grid" id="uploadedImagesGrid">
                                        <!-- Example images -->
                                        <div class="uploaded-image-card" data-primary="true">
                                            <img src="https://via.placeholder.com/120" alt="Product">
                                            <div class="image-actions">
                                                <button type="button" class="image-action-btn btn-remove-image" title="Remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="primary-badge">Primary</div>
                                        </div>
                                        <div class="uploaded-image-card">
                                            <img src="https://via.placeholder.com/120" alt="Product">
                                            <div class="image-actions">
                                                <button type="button" class="image-action-btn btn-primary-image" title="Set as Primary">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                                <button type="button" class="image-action-btn btn-remove-image" title="Remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="uploaded-image-card">
                                            <img src="https://via.placeholder.com/120" alt="Product">
                                            <div class="image-actions">
                                                <button type="button" class="image-action-btn btn-primary-image" title="Set as Primary">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                                <button type="button" class="image-action-btn btn-remove-image" title="Remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing & Inventory Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-dollar-sign me-2"></i>Pricing & Inventory
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Sale Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" placeholder="0.00" step="0.01">
                                            </div>
                                            <div class="form-text">Leave empty if not on sale</div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">MRP</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" name="mrp" class="form-control" placeholder="0.00" step="0.01">
                                            </div>
                                            <div class="form-text">Your cost per unit</div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="my-2">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">
                                                Stock Quantity <span class="required">*</span>
                                            </label>
                                            <input type="number" name="" class="form-control" placeholder="0" min="0" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Low Stock Alert Threshold</label>
                                            <input type="number" class="form-control" placeholder="10" min="0">
                                            <div class="form-text">Get notified when stock falls below this</div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Weight (kg)</label>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Dimensions (L x W x H cm)</label>
                                            <input type="text" class="form-control" placeholder="e.g., 20 x 15 x 10">
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="trackInventory" checked>
                                                <label class="form-check-label" for="trackInventory">
                                                    Track inventory for this product
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="allowBackorder">
                                                <label class="form-check-label" for="allowBackorder">
                                                    Allow customers to purchase when out of stock
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Variants Card -->
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h5 class="mb-0">
                                            <i class="fas fa-layer-group me-2"></i>Product Variants
                                        </h5>
                                        <small class="text-muted">Add different variations like size, color, material, etc.</small>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" id="addVariantBtn">
                                        <i class="fas fa-plus"></i>
                                        Add Variant
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="info-box">
                                        <div class="info-box-title">
                                            <i class="fas fa-info-circle"></i>
                                            About Product Variants
                                        </div>
                                        <p class="info-box-text">
                                            Variants allow you to offer the same product in different options such as sizes, colors, or materials. 
                                            Each variant can have its own SKU, price, and stock quantity.
                                        </p>
                                    </div>

                                    <div id="variantsContainer">
                                        <!-- Variants will be added here dynamically -->
                                        <!-- Example Variant 1 -->
                                        <div class="variant-card">
                                            <div class="variant-header">
                                                <h6 class="variant-title">
                                                    <span class="variant-number">1</span>
                                                    Variant Configuration
                                                </h6>
                                                <button type="button" class="btn btn-sm btn-danger remove-variant-btn">
                                                    <i class="fas fa-trash"></i>
                                                    Remove
                                                </button>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Variant Type <span class="required">*</span></label>
                                                    <select class="form-select" name="attribute_id">
                                                        <option value="">Select variant type</option>
                                                        @foreach ($attributes as $attribute)
                                                            
                                                        <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Variant Value <span class="required">*</span></label>
                                                    <select class="form-select" name="attribut_value_id">
                                                        <option value="">Select variant value</option>
                                                        @foreach ($attributeValues as $attributeValue)
                                                            
                                                        <option value="{{$attributeValue->id}}">{{$attributeValue->value}}</option>
                                                        @endforeach
                                                        
                                                    </select>

                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">SKU</label>
                                                    <input type="text" class="form-control" placeholder="Unique variant SKU" value="PROD-BLK-001">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Barcode / EAN</label>
                                                    <input type="text" class="form-control" placeholder="Product barcode">
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Price Adjustment</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" class="form-control" placeholder="0.00" step="0.01" value="0.00">
                                                    </div>
                                                    <div class="form-text">+ or - from base price</div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Stock Quantity</label>
                                                    <input type="number" class="form-control" placeholder="0" min="0" value="50">
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Weight (kg)</label>
                                                    <input type="number" class="form-control" placeholder="0.00" step="0.01" value="0.5">
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-select">
                                                        <option value="active" selected>Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Variant Image (Optional)</label>
                                                    <input type="file" class="form-control" accept="image/*">
                                                    <div class="form-text">Upload a specific image for this variant</div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div id="emptyVariantState" style="display: none;">
                                        <div class="empty-state">
                                            <i class="fas fa-layer-group"></i>
                                            <h5>No Variants Added</h5>
                                            <p>Click "Add Variant" to create different variations of this product</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO & Meta Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-search me-2"></i>SEO & Meta Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" class="form-control" placeholder="SEO optimized title">
                                            <div class="form-text">Recommended: 50-60 characters</div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Meta Description</label>
                                            <textarea class="form-control" rows="3" placeholder="SEO meta description"></textarea>
                                            <div class="form-text">Recommended: 150-160 characters</div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">URL Slug</label>
                                            <input type="text" class="form-control" placeholder="product-url-slug">
                                            <div class="form-text">URL-friendly version of the product name</div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Keywords (Tags)</label>
                                            <input type="text" class="form-control" placeholder="Separate keywords with commas">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Additional Settings -->
                        <div class="col-lg-4">
                            <!-- Publish Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-rocket me-2"></i>Publish
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select">
                                            <option value="published">Published</option>
                                            <option value="draft" selected>Draft</option>
                                            <option value="scheduled">Scheduled</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Visibility</label>
                                        <select class="form-select">
                                            <option value="public" selected>Public</option>
                                            <option value="private">Private</option>
                                            <option value="password">Password Protected</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Publish Date</label>
                                        <input type="datetime-local" class="form-control">
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="featuredProduct">
                                        <label class="form-check-label" for="featuredProduct">
                                            Mark as Featured Product
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Organization Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-folder me-2"></i>Organization
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Category <span class="required">*</span>
                                        </label>
                                        <select class="form-select" required>
                                            <option value="">Select category</option>
                                            <option value="electronics">Electronics</option>
                                            <option value="clothing">Clothing & Apparel</option>
                                            <option value="books">Books & Media</option>
                                            <option value="home">Home & Garden</option>
                                            <option value="sports">Sports & Outdoors</option>
                                            <option value="beauty">Beauty & Health</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Brand</label>
                                        <input type="text" class="form-control" placeholder="Brand name">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">SKU <span class="required">*</span></label>
                                        <input type="text" class="form-control" placeholder="Unique product SKU" required>
                                        <div class="form-text">Stock Keeping Unit - unique identifier</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Collections</label>
                                        <select class="form-select" multiple size="4">
                                            <option>New Arrivals</option>
                                            <option>Best Sellers</option>
                                            <option>Summer Collection</option>
                                            <option>Clearance Sale</option>
                                        </select>
                                        <div class="form-text">Hold Ctrl/Cmd to select multiple</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-truck me-2"></i>Shipping
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="requiresShipping" checked>
                                            <label class="form-check-label" for="requiresShipping">
                                                This product requires shipping
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Shipping Class</label>
                                        <select class="form-select">
                                            <option value="standard" selected>Standard</option>
                                            <option value="express">Express</option>
                                            <option value="fragile">Fragile Items</option>
                                            <option value="heavy">Heavy Items</option>
                                        </select>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="freeShipping">
                                        <label class="form-check-label" for="freeShipping">
                                            Free shipping available
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Tax Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-receipt me-2"></i>Tax
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tax Class</label>
                                        <select class="form-select">
                                            <option value="standard" selected>Standard Rate</option>
                                            <option value="reduced">Reduced Rate</option>
                                            <option value="zero">Zero Rate</option>
                                        </select>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="taxable" checked>
                                        <label class="form-check-label" for="taxable">
                                            This product is taxable
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        <div class="text-end mt-4">
            <button class="btn btn-primary">Save Product</button>
        </div>

    </div>
</div>
</form>
@endsection
@push('scripts')
    <script>
        
        
        // Image upload functionality
        const imageUploadArea = document.getElementById('imageUploadArea');
        const imageInput = document.getElementById('imageInput');
        const uploadedImagesGrid = document.getElementById('uploadedImagesGrid');

        imageUploadArea.addEventListener('click', () => {
            imageInput.click();
        });

        imageUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUploadArea.classList.add('dragover');
        });

        imageUploadArea.addEventListener('dragleave', () => {
            imageUploadArea.classList.remove('dragover');
        });

        imageUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            handleImageFiles(files);
        });

        imageInput.addEventListener('change', (e) => {
            handleImageFiles(e.target.files);
        });

        function handleImageFiles(files) {
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        addImageToGrid(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function addImageToGrid(src) {
            const imageCard = document.createElement('div');
            imageCard.className = 'uploaded-image-card';
            imageCard.innerHTML = `
                <img src="${src}" alt="Product">
                <div class="image-actions">
                    <button type="button" class="image-action-btn btn-primary-image" title="Set as Primary">
                        <i class="fas fa-star"></i>
                    </button>
                    <button type="button" class="image-action-btn btn-remove-image" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            uploadedImagesGrid.appendChild(imageCard);
            attachImageCardEvents(imageCard);
        }

        function attachImageCardEvents(card) {
            // Set as primary
            card.querySelector('.btn-primary-image')?.addEventListener('click', function() {
                document.querySelectorAll('.uploaded-image-card').forEach(c => {
                    c.removeAttribute('data-primary');
                    const badge = c.querySelector('.primary-badge');
                    if (badge) badge.remove();
                });
                
                card.setAttribute('data-primary', 'true');
                const badge = document.createElement('div');
                badge.className = 'primary-badge';
                badge.textContent = 'Primary';
                card.appendChild(badge);
            });

            // Remove image
            card.querySelector('.btn-remove-image').addEventListener('click', function() {
                card.remove();
            });
        }

        // Attach events to existing images
        document.querySelectorAll('.uploaded-image-card').forEach(card => {
            attachImageCardEvents(card);
        });

        // Add variant functionality
        let variantCount = 2;
        document.getElementById('addVariantBtn').addEventListener('click', function() {
            variantCount++;
            const variantHTML = `
                <div class="variant-card">
                    <div class="variant-header">
                        <h6 class="variant-title">
                            <span class="variant-number">${variantCount}</span>
                            Variant Configuration
                        </h6>
                        <button type="button" class="btn btn-sm btn-danger remove-variant-btn">
                            <i class="fas fa-trash"></i>
                            Remove
                        </button>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Variant Type <span class="required">*</span></label>
                            <select class="form-select">
                                <option value="">Select variant type</option>
                                <option value="size">Size</option>
                                <option value="color">Color</option>
                                <option value="material">Material</option>
                                <option value="style">Style</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Variant Value <span class="required">*</span></label>
                            <input type="text" class="form-control" placeholder="e.g., Red, Large, Cotton">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SKU</label>
                            <input type="text" class="form-control" placeholder="Unique variant SKU">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Barcode / EAN</label>
                            <input type="text" class="form-control" placeholder="Product barcode">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Price Adjustment</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" placeholder="0.00" step="0.01">
                            </div>
                            <div class="form-text">+ or - from base price</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" placeholder="0" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Weight (kg)</label>
                            <input type="number" class="form-control" placeholder="0.00" step="0.01">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Variant Image (Optional)</label>
                            <input type="file" class="form-control" accept="image/*">
                            <div class="form-text">Upload a specific image for this variant</div>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('variantsContainer').insertAdjacentHTML('beforeend', variantHTML);
            
            // Attach remove event to new variant
            const newVariant = document.getElementById('variantsContainer').lastElementChild;
            attachRemoveVariantEvent(newVariant);
        });

        function attachRemoveVariantEvent(variantCard) {
            const removeBtn = variantCard.querySelector('.remove-variant-btn');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    variantCard.remove();
                    updateVariantNumbers();
                });
            }
        }

        function updateVariantNumbers() {
            const variants = document.querySelectorAll('.variant-card');
            variants.forEach((variant, index) => {
                const numberSpan = variant.querySelector('.variant-number');
                if (numberSpan) {
                    numberSpan.textContent = index + 1;
                }
            });
            variantCount = variants.length;
        }

        // Attach remove events to existing variants
        document.querySelectorAll('.variant-card').forEach(card => {
            attachRemoveVariantEvent(card);
        });

        // Form submission
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success message (you would actually submit the form here)
            alert('Product would be published here! Form data would be sent to the server.');
        });

        // Auto-save functionality (simulated)
        let autoSaveInterval = setInterval(() => {
            const lastSavedEl = document.querySelector('.action-bar-left span');
            if (lastSavedEl) {
                const now = new Date();
                lastSavedEl.textContent = `Last saved: ${now.toLocaleTimeString()}`;
            }
        }, 30000); // Auto-save every 30 seconds
    </script>
@endpush --}}
@extends('Backend.AdminTheme.layout')

@section('content')

<div class="container-fluid">

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- LEFT SIDE --}}
            <div class="col-lg-8">

                {{-- BASIC INFO --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Basic Information</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Type</label>
                            <select name="type" id="productType" class="form-select">
                                <option value="simple">Simple</option>
                                <option value="variable">Variable</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" class="form-select">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="6"></textarea>
                        </div>

                    </div>
                </div>


                {{-- SIMPLE PRICING --}}
                <div class="card mb-4" id="simplePricing">
                    <div class="card-header">
                        <h5 class="mb-0">Pricing</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>MRP</label>
                                <input type="number" step="0.01" name="mrp" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Selling Price</label>
                                <input type="number" step="0.01" name="selling_price" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Tax</label>
                            <select name="tax_id" class="form-select">
                                <option value="">Select Tax</option>
                                @foreach($taxes as $tax)
                                    <option value="{{ $tax->id }}">
                                        {{ $tax->name }} ({{ $tax->rate }}%)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>


                {{-- SIMPLE INVENTORY --}}
                <div class="card mb-4" id="simpleInventory">
                    <div class="card-header">
                        <h5 class="mb-0">Inventory</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>SKU</label>
                                <input type="text" name="sku" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Stock</label>
                                <input type="number" name="stock" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Low Stock Qty</label>
                            <input type="number" name="low_stock_qty" class="form-control">
                        </div>

                        <input type="hidden" name="manage_stock" value="1">

                        <div class="mb-3">
                            <label>Stock Status</label>
                            <select name="stock_status" class="form-select">
                                <option value="in_stock">In Stock</option>
                                <option value="out_of_stock">Out Of Stock</option>
                            </select>
                        </div>

                    </div>
                </div>


                {{-- VARIABLE SECTION --}}
                <div class="card mb-4" id="variantSection" style="display:none;">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Variants</h5>
                        <button type="button" class="btn btn-dark btn-sm" onclick="addVariant()">
                            Add Variant
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="variantContainer"></div>
                    </div>
                </div>


                {{-- SEO --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">SEO</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control"></textarea>
                        </div>

                    </div>
                </div>

            </div>


            {{-- RIGHT SIDE --}}
            <div class="col-lg-4">

                {{-- PRODUCT STATUS --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Publish</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select">
                                <option value="1">Published</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Featured</label>
                            <select name="is_featured" class="form-select">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Save Product
                        </button>

                    </div>
                </div>


                {{-- IMAGE UPLOAD --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Product Images</h5>
                    </div>
                    <div class="card-body">

                        <input type="file" name="images[]" class="form-control mb-3" multiple>

                        <div class="mb-3">
                            <label>Primary Image Index (0 based)</label>
                            <input type="number" name="primary_image_index" class="form-control">
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </form>

</div>


{{-- JS SECTION --}}
<script>

let variantIndex = 0;

function addVariant() {

    let html = `
        <div class="border p-3 mb-3 rounded">

            <div class="mb-2">
                <label>Attribute</label>
                <select name="variants[${variantIndex}][attribute_id]" class="form-select">
                    @foreach($attributes as $attribute)
                        <option value="{{ $attribute->id }}">
                            {{ $attribute->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Attribute Value</label>
                <select name="variants[${variantIndex}][attribute_value_id]" class="form-select">
                    @foreach($attributeValues as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>SKU</label>
                <input type="text" name="variants[${variantIndex}][sku]" class="form-control">
            </div>

            <div class="mb-2">
                <label>Stock</label>
                <input type="number" name="variants[${variantIndex}][stock]" class="form-control">
            </div>

            <div class="mb-2">
                <label>MRP</label>
                <input type="number" step="0.01" name="variants[${variantIndex}][mrp]" class="form-control">
            </div>

            <div class="mb-2">
                <label>Selling Price</label>
                <input type="number" step="0.01" name="variants[${variantIndex}][selling_price]" class="form-control">
            </div>

        </div>
    `;

    document.getElementById('variantContainer')
            .insertAdjacentHTML('beforeend', html);

    variantIndex++;
}


document.getElementById('productType').addEventListener('change', function () {

    if (this.value === 'variable') {

        document.getElementById('variantSection').style.display = 'block';
        document.getElementById('simplePricing').style.display = 'none';
        document.getElementById('simpleInventory').style.display = 'none';

    } else {

        document.getElementById('variantSection').style.display = 'none';
        document.getElementById('simplePricing').style.display = 'block';
        document.getElementById('simpleInventory').style.display = 'block';

    }

});

</script>

@endsection

