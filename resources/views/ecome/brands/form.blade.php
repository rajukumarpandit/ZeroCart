@csrf

<div class="mb-3">
    <label class="form-label">Brand Name</label>
    <input type="text" name="name" class="form-control"
        value="{{ old('name', $brand->name ?? '') }}" required>
</div>


<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $brand->description ?? '') }}</textarea>
</div>
<div class="row">

    {{-- Category Image --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Brand Logo</label>
    
        <div class="d-flex align-items-start gap-3">
            {{-- Preview Box --}}
            <div class="position-relative">
                <div id="imageSkeleton" class="rounded bg-light d-none" style="width:120px;height:120px;">
                </div>
    
                <img id="imagePreview"
                    src="{{ isset($brand) && $brand->logo
                        ? asset('storage/categories/' . $category->logo)
                        : 'https://via.placeholder.com/120x120?text=No+Image' }}"
                    class="rounded border" style="width:120px;height:120px;object-fit:cover;">
            </div>
    
            {{-- File Input --}}
            <div class="flex-grow-1">
                <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror"
                    accept="image/*" onchange="previewImage(this)">
    
                <small class="text-muted">
                    JPG, PNG, WEBP • Max 2MB
                </small>
    
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    {{-- Position --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Position (Sorting Order)</label>
        <input type="number" name="position" class="form-control" value="{{ old('position', $category->position ?? 0) }}">
    </div>
</div>
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="status" value="1"
        {{ old('status', $brand->status ?? 1) ? 'checked' : '' }}>
    <label class="form-check-label">Active</label>
</div>

<button class="btn btn-primary">Save</button>
<a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancel</a>
