<?php

namespace App\Services;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;

class ProductService
{
    /**
     * Create a new product.
     *
     * @param StoreProductRequest $request
     * @param string|null $imagePath
     * @return Product
     */
    public function createProduct(StoreProductRequest $request, ?string $imagePath = null): Product
    {
      
        $product = new Product();
        $product->name = $request->product_name;
        $product->description = $request->product_description;
        $product->price = $request->product_price;
        if ($imagePath) {
            $product->product_img_url = $imagePath;
        }
        $product->save();

        return $product;
    }
}