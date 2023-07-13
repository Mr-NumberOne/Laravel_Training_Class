<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductImage;

class ProductObserver
{
    /**
     * Handle the Product "created" event. - after entering the database
     */
    public function created(Product $product): void
    {
      if (isset($product->id)){
          ProductImage::create([
              'image'=>$product->image,
              'product_id'=>$product->id
          ]);
      }
        $product->categories()->sync(request()->categories);
    }
    /**
     * Handle the Product "while creating " event. - before entering the database
     */
    public function creating(Product $product): void
    {

    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
