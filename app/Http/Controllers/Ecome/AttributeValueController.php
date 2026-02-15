<?php

namespace App\Http\Controllers\Ecome;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AttributeValueController extends Controller
{
    public function index(Request $request, $attribute_id)
{
    // Fetch the Attribute
    $attribute = Attribute::findOrFail($attribute_id);

    // AJAX request for DataTable
    if ($request->ajax()) {
        $values = $attribute->values()->latest(); // Relation in Attribute model: values()

        return DataTables::of($values)
            ->addIndexColumn()

            ->addColumn('status', function($row) {
                return $row->status
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            })

            ->addColumn('action', function($row) use ($attribute_id) {
                return '
                    <button class="btn btn-primary btn-sm edit-btn" data-id="'.$row->id.'">
                        Edit
                    </button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="'.$row->id.'">
                        Delete
                    </button>
                ';
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }

    // Normal page load
    return view('ecome.attribute-values.index', compact('attribute'));
}

    public function getValues(Request $request)
    {
        $attribute_id = $request->attribute_id;
        $values = AttributeValue::where('attribute_id', $attribute_id)
                    ->where('status', 1)
                    ->get(['id','value']);

        return response()->json($values);
    }

}