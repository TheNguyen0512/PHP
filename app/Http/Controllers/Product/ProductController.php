<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product; // Import the Product model

class ProductController extends Controller
{
    public function showproduct($product_id)
    {
        try {
            $categories = Categories::whereNull('parent_id')->get();
            $subcategory = Categories::whereNotNull('parent_id')->get();
            $product = Product::findOrFail($product_id);
            return view('Page_Category.Detail.index', compact('categories', 'subcategory', 'product'));
        } catch (\Exception $e) {
            // Log or handle the exception
            return back()->withError($e->getMessage())->withInput();
        }   
    }

}
