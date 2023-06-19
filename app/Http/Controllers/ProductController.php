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
    public function index()
    {
        $products = Product::paginate(25);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create')
            ->with('categories',$categories)
            ->with('brands',$brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $path = $request->file('image')->store('products');
        $product = Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$path,
            'price'=>$request->price,
            'status'=>isset($request->status),
            'brand_id'=>$request->brand_id
        ]);

        $product->categories()->sync($request->categories);
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
            ->with('categories',$categories)
            ->with('products',$product)
            ->with('brands',$brands);
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
        $product->delete();
        toastr()->success('Deleted successfully');
        return redirect(route('products.index'));

    }
}
