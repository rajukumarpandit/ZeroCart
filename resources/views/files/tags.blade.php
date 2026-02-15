@extends('Layout.layout')
@section('content')
    <div class="page-header mb-4">
        <h1 class="page-title mb-2">Tags Input</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active">Tags Input</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Basic Tags</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Simple Tags</label>
                        <input type="text" class="form-control" id="basicTags" placeholder="Type and press Enter">
                        <small class="text-muted">Press Enter or comma to add tags</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Predefined Tags</label>
                        <input type="text" class="form-control" id="predefinedTags" value="JavaScript,Python,PHP,Ruby">
                        <small class="text-muted">Edit or remove existing tags</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Max Tags (5)</label>
                        <input type="text" class="form-control" id="maxTags" placeholder="Maximum 5 tags">
                        <div class="tag-counter" id="tagCounter">0 / 5 tags</div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Email Tags</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Email Recipients</label>
                        <input type="text" class="form-control" id="emailTags" placeholder="Enter email addresses">
                        <small class="text-muted">Only valid email addresses allowed</small>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Color Tags</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Select Colors</label>
                        <input type="text" class="form-control" id="colorTags" placeholder="Add colors">
                        <small class="text-muted">Tags will be colored automatically</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Autocomplete Tags</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Programming Languages</label>
                        <input type="text" class="form-control" id="autocompleteTags" placeholder="Start typing...">
                        <small class="text-muted">Suggestions appear as you type</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Countries</label>
                        <input type="text" class="form-control" id="countryTags" placeholder="Type country name">
                        <small class="text-muted">Autocomplete with country suggestions</small>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Advanced Options</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Unique Tags Only</label>
                        <input type="text" class="form-control" id="uniqueTags" placeholder="No duplicates allowed">
                        <small class="text-muted">Duplicate tags will be prevented</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Read Only Tags</label>
                        <input type="text" class="form-control" id="readonlyTags" value="Fixed Tag,Locked,Cannot Remove">
                        <small class="text-muted">These tags cannot be modified</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Blog Post Example</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label class="form-label">Post Title</label>
                    <input type="text" class="form-control" placeholder="Enter post title">
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select">
                        <option>Technology</option>
                        <option>Business</option>
                        <option>Lifestyle</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tags</label>
                    <input type="text" class="form-control" id="postTags" placeholder="Add relevant tags">
                    <small class="text-muted">Add tags to help readers find your content</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keywords (SEO)</label>
                    <input type="text" class="form-control" id="seoTags" placeholder="SEO keywords">
                    <small class="text-muted">Add keywords for search engine optimization</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Related Topics</label>
                    <input type="text" class="form-control" id="relatedTags" placeholder="Add related topics">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send me-2"></i>Publish Post
                </button>
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-save me-2"></i>Save Draft
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Product Tags Example</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" placeholder="Enter product name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control" placeholder="Product SKU">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Categories</label>
                        <input type="text" class="form-control" id="productCategories" placeholder="Add categories">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Features</label>
                        <input type="text" class="form-control" id="productFeatures"
                            placeholder="Add product features">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Search Tags</label>
                    <input type="text" class="form-control" id="searchTags" placeholder="Tags for product search">
                    <small class="text-muted">Help customers find this product</small>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i>Add Product
                </button>
            </form>
        </div>
    </div>
@endsection
