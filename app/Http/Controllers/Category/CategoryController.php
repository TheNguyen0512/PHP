<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function categories()
    {
        try {
            $categories = Categories::whereNull('parent_id')->get();
            $subcategory = Categories::whereNotNull('parent_id')->get();
            return view('Customer.index', compact('categories', 'subcategory'));
        } catch (\Exception $e) {
            // Log or handle the exception
            return back()->withError($e->getMessage())->withInput();
        }   
    }

    public function show($category_id)
    {
        try {
            $category = Categories::findOrFail($category_id);
            $categories = Categories::whereNull('parent_id')->get();
            $subcategory = Categories::whereNotNull('parent_id')->get();

            $products = Product::where('product_category_id', $category_id)
                ->orWhereIn('product_category_id', function ($query) use ($category_id) {
                    $query->select('category_id')
                        ->from('categories')
                        ->where('parent_id', $category_id);
                })
                ->get();

            return view('Page_Category.index', compact('category', 'categories', 'subcategory', 'products'));
        } catch (ModelNotFoundException $e) {
            return back()->withError("Category not found")->withInput();
        } catch (\Exception $e) {
            // Log or handle the exception
            return back()->withError($e->getMessage())->withInput();
        }
    }

}
