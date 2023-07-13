<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function deleted_index()
    {
        $products = Product::onlyTrashed()->paginate(5);

        return view('products.index')
            ->with('deleted', 1)
            ->with('products', $products);
    }
    public function restore($id )
    {

        //  return dd($id);
        Product::withTrashed()
            ->where('id',$id)
            ->restore();

        toastr()->success('تم الاسنعادة بنجاح');
        return redirect(route('products.index'));
    }
    public function forceDelete($id)
    {

        //  return dd($id);
        Product::onlyTrashed()
            ->where('id',$id)
            ->forceDelete();

        toastr()->success('تم الحذف بنجاح');
        return redirect(route('products.trashed'));
    }
    public function index()
    {
        $products = Product::
        paginate(25);
//        whereIn('price', [100000, 1000000, 122000])
//            whereBetween('price',[100000,220000])
//            ->whereColumn('')
//        where('status','=',1)
//            ->where('price','>',250000)
//            ->whereDate('created_at', '<', '2023-06-22')
//            ->whereYear('created_at','2000')
//            ->whereMonth('created_at','04')
//            ->whereDay('created_at','12')
//            ->whereTime('created_at', '09')
//            ->whereNull('description')
//            ->whereNotNull('description')
//            ->orwhere('name','LIKE','%21%')
//            ->where('name','LIKE','%21%')
//            ->where([
//                ['status', '=', '1'],
//                ['brand_id', '<>', '1'],
//            ])
        return view('products.index')
            ->with('deleted', 0)
            ->with('products', $products);    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create')
            ->with('categories', $categories)
            ->with('brands', $brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $path = $request->file('image')->store('products');
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
            'price' => $request->price,
            'status' => isset($request->status),
            'brand_id' => $request->brand_id
        ]);

//        $product->categories()->sync($request->categories);
        // used with many-to-many relationships
        toastr()->success('created successfully');
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.edit')
            ->with('categories', $categories)
            ->with('product', $product)
            ->with('brands', $brands);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        $product->deleted_by=auth()->id();
        $product->save();
        $product->delete();

        toastr()->success('تم الحذف بنجاح');
        return redirect(route('products.index'));

    }
}
