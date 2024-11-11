<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Traits\Response;
use App\Services\FileUploadService;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $fileUploadService;
    protected $productService;

    public function __construct(FileUploadService $fileUploadService, ProductService $productService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->productService = $productService;
    }
    
    public function index()
    {
        $products = Product::all();
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('product_img_url')) {
            $file = $request->file('product_img_url');
            $imagePath = $this->fileUploadService->upload($file, 'storage/products');
        }

        // Create the product using the ProductService
        $product = $this->productService->createProduct($request, $imagePath);

        return Response::success(200, "Product Added", $product);
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
        //
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
        //
    }
}