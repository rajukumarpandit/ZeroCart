<?php

namespace App\Http\Controllers\Ecome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand;

class BrandController extends Controller
{
    //
    public function index(Request $request)
{
    if ($request->ajax()) {
        $brands = Brand::with('creator:id,name')->get();
        // dd($brands);

        return DataTables::of($brands)
            ->addIndexColumn()
            ->addColumn('checkbox', fn($row) =>
                    '<input type="checkbox" class="row-checked" value="'.$row->id.'">'
                )
            ->addColumn('logo', function($row){
    if ($row->logo) {
        return '
            <img src="'.asset('storage/brands/'.$row->logo).'"
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

            ->addColumn('status', fn($row) =>
                $row->status
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>'
            )

            ->addColumn('created_by', fn($row) =>
                $row->creator->name ?? '-'
            )

            ->addColumn('action', function ($row) {
                    return view('ecome.brands.action', [
                        'brand' => $row
                    ])->render();
                })
            ->rawColumns(['checkbox','logo','status','action'])
            ->make(true);
    }

    return view('ecome.brands.index');
}

public function create()
{
    return view('ecome.brands.create');
}

public function store(Request $request)
{
    $request->validate([
        'name'   => 'required|string|max:255|unique:brands,name',
        'logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|boolean',
    ]);

    $logoName = null;

    if ($request->hasFile('logo')) {
        $logoName = Str::uuid().'.'.$request->logo->extension();
        $request->logo->storeAs('brands', $logoName, 'public');
    }

    Brand::create([
        'name'       => $request->name,
        'logo'       => $logoName,
        'status'     => $request->status,
        'created_by' => auth()->id(),
    ]);

    return redirect()->route('admin.brands.index')
        ->with('success', 'Brand created successfully');
}
public function edit(Brand $brand)
{
    return view('ecome.brands.edit', compact('brand'));
}
public function update(Request $request, Brand $brand)
{
    $request->validate([
        'name'   => 'required|string|max:255|unique:brands,name,'.$brand->id,
        'logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|boolean',
    ]);

    if ($request->hasFile('logo')) {
        if ($brand->logo && Storage::disk('public')->exists('brands/'.$brand->logo)) {
            Storage::disk('public')->delete('brands/'.$brand->logo);
        }

        $logoName = Str::uuid().'.'.$request->logo->extension();
        $request->logo->storeAs('brands', $logoName, 'public');
        $brand->logo = $logoName;
    }

    $brand->update([
        'name'   => $request->name,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.brands.index')
        ->with('success', 'Brand updated successfully');
}
public function destroy(Brand $brand)
{
    $brand->delete();

    return response()->json([
        'success' => true,
        'message' => 'Brand deleted successfully'
    ]);
}

public function restore($id)
{
    Brand::onlyTrashed()->findOrFail($id)->restore();

    return back()->with('success', 'Brand restored successfully');
}

public function forceDelete($id)
{
    $brand = Brand::onlyTrashed()->findOrFail($id);

    if ($brand->logo && Storage::disk('public')->exists('brands/'.$brand->logo)) {
        Storage::disk('public')->delete('brands/'.$brand->logo);
    }

    $brand->forceDelete();

    return back()->with('success', 'Brand permanently deleted');
}


}