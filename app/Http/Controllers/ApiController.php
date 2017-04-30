<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

/* API controller */
class ApiController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth'); // oAuth2
    }

    /* API for fetch all categories */
    public function category()
    {
        $category = \App\Category::all();
        return Response::json(array(
            'error' => false,
            'categories' => $category,
            'status_code' => 200
        ));
    }

    /* API for edit category view */
    public function editCategory(Request $request)
    {
        $category = \App\Category::find($request->input('id'));
        return Response::json(array(
            'error' => false,
            'category' => $category,
            'status_code' => 200
        ));
    }

    /* API for save or update category */
    public function addUpdateCategory(Request $request)
    {
        // add validation rules
        $rules = array(
            'category' => 'required',
            'description' => 'required',
        );

        // for Validator
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        if($request->input('id')) // Update category
        {
            $category = \App\Category::find($request->input('id'));
            $category->category = $request->input('category');
            $category->description = $request->input('description');
            $category->save();
            print json_encode(array("message"=>"Category updated successfully!!"));
        }
        else // save category
        {
            $category = new \App\Category;
            $category->category = $request->input('category');
            $category->description = $request->input('description');
            $category->save();
            print json_encode(array("message"=>"Category added successfully!!"));
        }
    }

    /* API for delete category by id */
    public function deleteCategory(Request $request)
    {
        $category = \App\Category::find($request->input('id'));
        $category->delete();
        print json_encode(array("message"=>"Category delete successfully!!"));
    }

    /* API for view products */
    public function product()
    {
        $products = DB::table('products')
                    ->leftjoin('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.*', 'categories.category')
                    ->get(); // join query for fetch product category

        return Response::json(array(
            'error' => false,
            'products' => $products,
            'status_code' => 200
        ));
    }

    /* API for show edit product by id */
    public function editProduct(Request $request)
    {
        $product = \App\Product::find($request->input('id'));
        return Response::json(array(
            'error' => false,
            'product' => $product,
            'status_code' => 200
        ));
    }

    /* API for add/edit product */
    public function addUpdateProduct(Request $request)
    {
        // add validation rules
        $rules = array(
            'product' => 'required',
            'category' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric',
            'cost' => 'required|numeric',
        );

        // for Validator
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        if($request->input('id')) // update product by id
        {
            $product = \App\Product::find($request->input('id'));
            $product->product_name = $request->input('product');
            $product->category_id = $request->input('category');
            $product->product_desc = $request->input('description');
            $product->product_quantity = $request->input('quantity');
            $product->product_price = $request->input('cost');
            $product->save();
            print json_encode(array("message"=>"Product updated successfully!!"));
        }
        else // add product
        {
            $product = new \App\Product;
            $product->product_name = $request->input('product');
            $product->category_id = $request->input('category');
            $product->product_desc = $request->input('description');
            $product->product_quantity = $request->input('quantity');
            $product->product_price = $request->input('cost');
            $product->save();
            print json_encode(array("message"=>"Product added successfully!!"));
        }
    }

    /* API for delete product by id */
    public function deleteProduct(Request $request)
    {
        $product = \App\Product::find($request->input('id'));
        $product->delete();
        print json_encode(array("message"=>"Product delete successfully!!"));
    }

}
