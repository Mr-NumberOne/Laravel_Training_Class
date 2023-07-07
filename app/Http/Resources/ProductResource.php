<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'product_name'=>$this->name,
            'image'=>url('storage/'.$this->image),
            'brand'=> new BrandResource($this->brand),
            'categories'=> categoryResource::collection($this->categories),//used for multipule items
            'description'=>$this->description,
            'price'=>$this->price,
            'price_after_discount'=>$this->price*(.5),


        ];
    }
}
