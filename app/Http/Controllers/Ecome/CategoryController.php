<?php

namespace App\Http\Controllers\Ecome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function index(Request $request)
    {
        $category = Category::with('creator:id,name')->get();
       
        if ($request->ajax()) {

            return DataTables::of($category)
                ->addIndexColumn()

                ->addColumn('checkbox', fn($row) =>
                    '<input type="checkbox" class="row-checked" value="'.$row->id.'">'
                )

                ->addColumn('status', fn($row) =>
                    $row->status
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>'
                )
                ->addColumn('featured', fn($row) =>
                    $row->is_featured
                    ? '<span class="badge bg-success">Featured</span>'
                    : '<span class="badge bg-danger">Unfeatured</span>'
                )

                ->addColumn('created_by', fn($row) =>
                    optional($row->creator)->name ?? '-'
                )
                ->addColumn('image', function ($row) {

    // ✅ Image exists
    if ($row->image) {
        return '
            <img src="'.asset('storage/categories/'.$row->image).'"
                 width="50"
                 height="50"
                 class="rounded-circle shadow-sm"
                 style="object-fit:cover;">
        ';
    }

    // ✅ No image → show initials
    $initials = strtoupper(
        collect(explode(' ', $row->name))
            ->map(fn($word) => substr($word, 0, 1))
            ->take(2)
            ->implode('')
    );

    return '
        <div class="d-flex align-items-center justify-content-center
                    rounded-circle bg-primary text-white fw-bold shadow-sm"
             style="width:50px;height:50px;font-size:14px;">
            '.$initials.'
        </div>
    ';
})

                ->addColumn('action', function ($row) {
                    return view('ecome.categories.action', [
                        'category' => $row
                    ])->render();
                })
                ->rawColumns(['checkbox','status','image','featured','action'])
                ->make(true);
        }
        session()->flash('success', 'Categories list fetched successfully');
        return view('ecome.categories.index',compact('category'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->get();
        return view('ecome.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);
        $imageName = null;

if ($request->hasFile('image')) {
    $imageName = time().'.'.$request->image->extension();
    $request->image->storeAs('categories', $imageName, 'public');
}
        Category::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
            'image' => $imageName,
            'position'=> $request->position ?? 0,
            'description'=>$request->description ??null,
            'is_featured' => $request->is_featured ?? 0,
            'meta_title'=> $request->meta_title ?? null,
            'meta_description' => $request->meta_description ?? null,
            'meta_keywords'=> $request->meta_keywords ?? null,
            'created_by'=>auth()->user()->id,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('ecome.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'boolean',
        ]);
        
        $imageName = $category->image;

if ($request->hasFile('image')) {

    if ($category->image && Storage::disk('public')->exists('categories/'.$category->image)) {
        Storage::disk('public')->delete('categories/'.$category->image);
    }

    $imageName = time().'.'.$request->image->extension();
    $request->image->storeAs('categories', $imageName, 'public');
}
        $category->update([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
            'image' => $imageName,
            'position'=> $request->position ?? 0,
            'description'=>$request->description ??null,
            'is_featured' => $request->is_featured ?? 0,
            'meta_title'=> $request->meta_title ?? null,
            'meta_description' => $request->meta_description ?? null,
            'meta_keywords'=> $request->meta_keywords ?? null,
            'updated_by'=>auth()->user()->id,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->children()->count() > 0) {
            return back()->with('warning', 'Delete child categories first');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }
    
    public function restore($id)
{
    Category::onlyTrashed()->findOrFail($id)->restore();
    return back()->with('success', 'Category restored');
}

public function forceDelete($id)
{
    Category::onlyTrashed()->findOrFail($id)->forceDelete();
    return back()->with('success', 'Category permanently deleted');
}


}