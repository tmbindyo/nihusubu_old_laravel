<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // Product group CRUD
    public function productGroups()
    {
        return view('business.product_groups');
    }
    public function productGroupCreate()
    {
        return view('business.product_group_create');
    }
    public function productGroupStore(Request $request)
    {
        return back()->withStatus(__('Product Group successfully stored.'));
    }
    public function productGroupShow($product_group_id)
    {
        return view('business.product_group_show');
    }
    public function productGroupEdit($product_group_id)
    {
        return view('business.product_group_edit');
    }
    public function productGroupUpdate(Request $request)
    {
        return back()->withStatus(__('Product Group successfully updated.'));
    }
    public function productGroupDelete($product_group_id)
    {
        return back()->withStatus(__('Product Group successfully deleted.'));
    }







    // Product CRUD
    public function products()
    {
        return view('business.products');
    }
    public function productCreate()
    {
        return view('business.product_create');
    }
    public function productStore(Request $request)
    {
        return back()->withStatus(__('Product successfully stored.'));
    }
    public function productShow($product_id)
    {
        return view('business.product_show');
    }
    public function productEdit($product_id)
    {
        return view('business.product_edit');
    }
    public function productUpdate(Request $request)
    {
        return back()->withStatus(__('Product successfully updated.'));
    }
    public function productDelete($product_id)
    {
        return back()->withStatus(__('Product successfully deleted.'));
    }





    // Composite product CRUD
    public function compositeProducts()
    {
        return view('business.composite_products');
    }
    public function compositeProductCreate()
    {
        return view('business.composite_product_create');
    }
    public function compositeProductStore(Request $request)
    {
        return back()->withStatus(__('Composite product successfully stored.'));
    }
    public function compositeProductShow($composite_product_id)
    {
        return view('business.composite_product_show');
    }
    public function compositeProductEdit($composite_product_id)
    {
        return view('business.composite_product_edit');
    }
    public function compositeProductUpdate(Request $request)
    {
        return back()->withStatus(__('Composite product successfully updated.'));
    }
    public function compositeProductDelete($composite_product_id)
    {
        return back()->withStatus(__('Composite product successfully deleted.'));
    }


}
