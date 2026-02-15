@csrf

<div class="row">
    {{-- Category Name --}}

    <div class="col-md-6 mb-3">
        <label class="form-label">Category Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $category->name ?? '') }}" placeholder="Enter category name">

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Parent Category --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Parent Category</label>
        <select name="parent_id" class="form-select">
            <option value="">— None —</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id ?? '') == $parent->id)>
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">

    {{-- Description --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Short description">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Meta Description</label>
        <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
    </div>
</div>


{{-- Meta SEO --}}
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Meta Title</label>
        <input type="text" name="meta_title" class="form-control"
            value="{{ old('meta_title', $category->meta_title ?? '') }}">
    </div>


    <div class="col-md-6 mb-3">
        <label class="form-label">Meta Keywords</label>
        <input type="text" name="meta_keywords" class="form-control"
            value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}">
    </div>
</div>

<div class="row">

    {{-- Category Image --}}
    <div class="col-md-6 mb-3">
        <label class="form-label">Category Image</label>
    
        <div class="d-flex align-items-start gap-3">
            {{-- Preview Box --}}
            <div class="position-relative">
                <div id="imageSkeleton" class="rounded bg-light d-none" style="width:120px;height:120px;">
                </div>
    
                <img id="imagePreview"
                    src="{{ isset($category) && $category->image
                        ? asset('storage/categories/' . $category->image)
                        : 'https://via.placeholder.com/120x120?text=No+Image' }}"
                    class="rounded border" style="width:120px;height:120px;object-fit:cover;">
            </div>
    
            {{-- File Input --}}
            <div class="flex-grow-1">
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    accept="image/*" onchange="previewImage(this)">
    
                <small class="text-muted">
                    JPG, PNG, WEBP • Max 2MB
                </small>
    
                @error('image')
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
{{-- Flags --}}
<div class="row">
    <div class="col-md-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="status" value="1" id="status"
                {{ old('status', $category->status ?? 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">
                Active
            </label>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                {{ old('is_featured', $category->is_featured ?? 0) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">
                Featured
            </label>
        </div>
    </div>
</div>

{{-- Actions --}}
<div class="d-flex gap-2">
    <button class="btn btn-primary">
        💾 Save
    </button>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        Cancel
    </a>
</div>
