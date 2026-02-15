<?php

namespace App\Http\Controllers\Ecome;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariant;
use App\Models\ProductPrice;
use App\Models\Inventory;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {

        $products = Product::with([
            'category:id,name',
            'brand:id,name',
            'mainImage:id,product_id,image',
            'prices.tax:id,name,rate',
            'inventory:id,product_id,sku,stock,stock_status',
            'variants.mainImage:id,product_variant_id,image',
            'variants.inventory:id,product_variant_id,sku,stock,stock_status',
            'variants.prices.tax:id,name,rate',
        ])->latest();

        return DataTables::of($products)
            ->addIndexColumn()

            // Checkbox
            ->addColumn('checkbox', fn ($row) =>
                '<input type="checkbox" class="row-check" value="'.$row->id.'">'
            )

            // Image
           ->addColumn('image', function ($row) {

                $img = $row->mainImage?->image
                    ? asset('storage/' . $row->mainImage->image)
                    : asset('assets/images/placeholder.png');

                return '<img src="'.$img.'" 
                            width="45" 
                            height="45" 
                            style="object-fit:cover;border-radius:6px;">';
            })
            // Name
            ->addColumn('name', fn ($row) => e($row->name))

            // Type
            ->addColumn('type', function ($row) {
                $badge = $row->type === 'variable' ? 'warning' : 'primary';
                return '<span class="badge bg-'.$badge.'">'.ucfirst($row->type).'</span>';
            })

            // Category
            ->addColumn('category', fn ($row) =>
                $row->category?->name ?? '-'
            )

            // Brand
            ->addColumn('brand', fn ($row) =>
                $row->brand?->name ?? '-'
            )

            // SKU
            ->addColumn('sku', function ($row) {
                $skus= $row->inventory->first() ?? $row->variants->first()?->inventory?->sku ?? '-';
                return $skus->sku;
            })

            // Price
            ->addColumn('price', function ($row) {

                $price = $row->prices->first()
                    ?? $row->variants->first()?->prices->first();

                if (!$price) return '-';

                return '
                    <div>
                        <small class="text-muted">MRP:</small> ₹'.$price->mrp.'<br>
                        <strong>₹'.$price->selling_price.'</strong>
                    </div>
                ';
            })

            // Tax
            ->addColumn('tax', function ($row) {
                $tax = $row->prices->first()?->tax
                    ?? $row->variants->first()?->prices->first()?->tax;

                return $tax
                    ? $tax->name.' ('.$tax->rate.'%)'
                    : 'No Tax';
            })

            // Stock
            ->addColumn('stock', function ($row) {
                $stock = $row->totalStock();

                $color = $stock > 10 ? 'success' : ($stock > 0 ? 'warning' : 'danger');

                return '<span class="badge bg-'.$color.'">'.$stock.'</span>';
            })

            // Featured
            ->addColumn('featured', function ($row) {
                return $row->is_featured
                    ? '<span class="badge bg-success">Yes</span>'
                    : '<span class="badge bg-secondary">No</span>';
            })

            // Status
            ->addColumn('status', function ($row) {
                $checked = $row->status ? 'checked' : '';
                return '
                    <div class="form-check form-switch">
                        <input class="form-check-input status-toggle"
                               data-id="'.$row->id.'"
                               type="checkbox" '.$checked.'>
                    </div>
                ';
            })

            // Created
            ->addColumn('created_at', fn ($row) =>
                $row->created_at->format('d M Y')
            )

            // Actions
            ->addColumn('action', function ($row) {
                    return view('ecome.products.action', [
                        'product' => $row
                    ])->render();
                })

            ->rawColumns([
                'checkbox',
                'image',
                'type',
                'price',
                'stock',
                'featured',
                'status',
                'action'
            ])
            ->make(true);
    }

    return view('ecome.products.index');
}


    /* ===============================
       CRUD Methods
    =============================== */

    

public function create()
{
    return view('ecome.products.create', [

        // Product basics
        'productTypes' => [
            'simple'   => 'Simple Product',
            'variable' => 'Variable Product',
        ],

        // Dropdown data
        'categories' => Category::where('status', 1)
            ->orderBy('name')
            ->get(['id', 'name']),

        'brands' => Brand::where('status', 1)
            ->orderBy('name')
            ->get(['id', 'name']),

        'taxes' => Tax::where('status', 1)
            ->orderBy('rate')
            ->get(['id', 'name', 'rate', 'type']),

        // Attributes for variable products
        'attributes' => Attribute::with('values')
            ->where('status', 1)
            ->orderBy('name')
            ->get(),
        'attributeValues' => AttributeValue::where('status', 1)
            ->get(),

        // Defaults
        'defaults' => [
            'status'        => true,
            'is_featured'   => false,
            'manage_stock'  => true,
            'low_stock_qty' => 5,
            'currency'      => 'INR',
        ],
    ]);
}

// public function store(Request $request)
// {
//     dd($request->all());
//     DB::beginTransaction();

//     try {

//         /* ===============================
//            1️⃣ VALIDATION
//         =============================== */

//         $request->validate([
//             'name' => 'required|string|max:255',
//             'type' => 'required|in:simple,variable',
//             'category_id' => 'required|exists:categories,id',
//         ]);
    
//         /* ===============================
//            2️⃣ CREATE PRODUCT
//         =============================== */

//         $product = Product::create([
//             'name' => $request->name,
//             'slug' => Str::slug($request->name),
//             'type' => $request->type,
//             'category_id' => $request->category_id,
//             'brand_id' => $request->brand_id,
//             'description' => $request->description,
//             'short_description' => $request->short_description,
//             'status' => $request->status ?? 0,
//             'is_featured' => $request->is_featured ?? 0,
//             'created_by' => auth()->id(),
//         ]);

//         /* =====================================================
//            3️⃣ SIMPLE PRODUCT LOGIC
//         ===================================================== */

//         if ($request->type === 'simple') {

//             $this->createVariant($product, $request);

//         }

//         /* =====================================================
//            4️⃣ VARIABLE PRODUCT LOGIC
//         ===================================================== */

//         if ($request->type === 'variable') {

//             foreach ($request->variants as $variantData) {

//                 $variant = ProductVariant::create([
//                     'product_id' => $product->id,
//                     'sku' => $variantData['sku'],
//                     'variant_name' => $variantData['variant_name'],
//                     'status' => 1,
//                 ]);

//                 // Price
//                 ProductPrice::create([
//                     'product_id' => $product->id,
//                     'product_variant_id' => $variant->id,
//                     'mrp' => $variantData['mrp'],
//                     'selling_price' => $variantData['price'],
//                     'tax_id' => $variantData['tax_id'] ?? null,
//                 ]);

//                 // Inventory
//                 Inventory::create([
//                     'product_id' => $product->id,
//                     'product_variant_id' => $variant->id,
//                     'sku' => $variantData['sku'],
//                     'stock' => $variantData['stock'],
//                     'reserved_stock' => 0,
//                     'low_stock_qty' => 5,
//                     'manage_stock' => 1,
//                 ]);

//                 // Attribute Mapping
//                 if (!empty($variantData['attributes'])) {
//                     foreach ($variantData['attributes'] as $attrId => $valueId) {
//                         VariantAttributeValue::create([
//                             'product_variant_id' => $variant->id,
//                             'attribute_id' => $attrId,
//                             'attribute_value_id' => $valueId,
//                         ]);
//                     }
//                 }
//             }
//         }

//         DB::commit();

//         return redirect()->route('admin.products.index')
//             ->with('success', 'Product created successfully');

//     } catch (\Exception $e) {

//         DB::rollBack();

//         return back()->withInput()
//             ->with('error', $e->getMessage());
//     }
// }
// private function createVariant($product, $request)
// {
//     $variant = ProductVariant::create([
//         'product_id' => $product->id,
//         'sku' => $request->sku,
//         'variant_name' => $product->name,
//         'status' => 1,
//     ]);

//     ProductPrice::create([
//         'product_id' => $product->id,
//         'product_variant_id' => $variant->id,
//         'mrp' => $request->mrp,
//         'selling_price' => $request->price,
//         'tax_id' => $request->tax_id ?? null,
//     ]);

//     Inventory::create([
//         'product_id' => $product->id,
//         'product_variant_id' => $variant->id,
//         'sku' => $request->sku,
//         'stock' => $request->stock,
//         'reserved_stock' => 0,
//         'low_stock_qty' => 5,
//         'manage_stock' => 1,
//     ]);
// }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'type' => 'required|in:simple,variable',
        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | 1️⃣ Generate Unique Slug
            |--------------------------------------------------------------------------
            */

            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;

            while (Product::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            /*
            |--------------------------------------------------------------------------
            | 2️⃣ Create Product
            |--------------------------------------------------------------------------
            */

            $product = Product::create([
                'name' => $request->name,
                'slug' => $slug,
                'type' => $request->type,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'status' => $request->status ?? 1,
                'is_featured' => $request->is_featured ?? 0,
                'created_by' => auth()->id(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | 3️⃣ SIMPLE PRODUCT LOGIC
            |--------------------------------------------------------------------------
            */

            if ($request->type === 'simple') {

                // Price
                ProductPrice::create([
                    'product_id' => $product->id,
                    'mrp' => $request->mrp,
                    'selling_price' => $request->selling_price,
                    'tax_id' => $request->tax_id,
                ]);

                // Inventory
                Inventory::create([
                    'product_id' => $product->id,
                    'sku' => $request->sku,
                    'stock' => $request->stock ?? 0,
                    'low_stock_qty' => $request->low_stock_qty ?? 0,
                    'manage_stock' => $request->manage_stock ?? 1,
                    'stock_status' => $request->stock_status ?? 'in_stock',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | 4️⃣ VARIABLE PRODUCT LOGIC
            |--------------------------------------------------------------------------
            */

            if ($request->type === 'variable' && $request->has('variants')) {

                foreach ($request->variants as $variantData) {

                    $variant = ProductVariant::create([
                        'product_id' => $product->id,
                        'attribute_id' => $variantData['attribute_id'],
                        'attribute_value_id' => $variantData['attribute_value_id'],
                    ]);

                    // Variant Price
                    ProductPrice::create([
                        'product_id' => $product->id,
                        'variant_id' => $variant->id,
                        'mrp' => $variantData['mrp'] ?? 0,
                        'selling_price' => $variantData['selling_price'] ?? 0,
                    ]);

                    // Variant Inventory
                    Inventory::create([
                        'product_id' => $product->id,
                        'variant_id' => $variant->id,
                        'sku' => $variantData['sku'] ?? null,
                        'stock' => $variantData['stock'] ?? 0,
                        'low_stock_qty' => 0,
                        'manage_stock' => 1,
                        'stock_status' => 'in_stock',
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | 5️⃣ IMAGE UPLOAD WITH PRIMARY FLAG
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $index => $image) {

                    $path = $image->store('products', 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $path,
                        'is_main' => ($request->primary_image_index == $index) ? 1 : 0,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product created successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->withInput()->with('error', $e->getMessage());
        }
    }



    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    public function toggleStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->update(['status' => !$product->status]);

        return response()->json(['status' => true]);
    }
}