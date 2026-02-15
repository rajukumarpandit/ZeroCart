<?php

namespace App\Http\Controllers\Ecome;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AttributeController extends Controller
{
    /* ===============================
        INDEX (LIST + DATATABLE)
    =============================== */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $attributes = Attribute::withCount('values')->latest();

            return DataTables::of($attributes)
                ->addIndexColumn()

                ->addColumn('status', function ($row) {
                    return $row->status
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('admin.attribute-values.index', $row->id).'" 
                        class="btn btn-info btn-sm">
                        Values
                        </a>

                        <button class="btn btn-primary btn-sm edit"
                            data-id="'.$row->id.'">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm delete"
                            data-id="'.$row->id.'">
                            Delete
                        </button>
                    ';
                })

                ->rawColumns(['status','action'])
                ->orderColumn('DT_RowIndex', function($query, $order) {
                    // Ignore DT_RowIndex order → use created_at
                    $query->orderBy('created_at', $order);
                })
                ->make(true);
        }

        return view('ecome.attributes.index');
    }


    /* ===============================
        STORE
    =============================== */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255|unique:attributes,name',
            'status' => 'required|boolean',
        ]);

        Attribute::create([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Attribute created successfully'
        ]);
    }

    /* ===============================
        Crate 
    =============================== */
    public function create()
    {

        return view('ecome.attributes.create');
    }
    /* ===============================
        EDIT (FETCH SINGLE)
    =============================== */
    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);

        return response()->json($attribute);
    }

    /* ===============================
        UPDATE
    =============================== */
    public function update(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:attributes,name,'.$attribute->id,
            'status' => 'required|boolean',
        ]);

        $attribute->update([
            'name'   => $request->name,
            'slug'   => Str::slug($request->name),
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Attribute updated successfully'
        ]);
    }

    /* ===============================
        DELETE (SOFT DELETE)
    =============================== */
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        return response()->json([
            'status' => true,
            'message' => 'Attribute deleted successfully'
        ]);
    }

    /* ===============================
        STATUS TOGGLE (OPTIONAL)
    =============================== */
    public function changeStatus($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->status = !$attribute->status;
        $attribute->save();

        return response()->json([
            'status' => true,
            'message' => 'Status updated'
        ]);
    }
}