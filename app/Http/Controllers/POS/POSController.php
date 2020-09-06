<?php

namespace App\Http\Controllers\POS;

use App\Product;
use App\ProductSubCategory;
use App\Traits\InstitutionTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class POSController extends Controller
{
    //
    use UserTrait;
    use institutionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function landing($portal)
    {
        return "Working";
    }

    public function login($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);


        return view('pos.auth.login', compact('user', 'institution'));
    }

    public function dashboard($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);


        return view('pos.dashboard', compact('user', 'institution'));
    }

    public function pos($portal)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // categories
        $productSubCategories = ProductSubCategory::where('institution_id',$institution->id)->get();
        return view('pos.pos', compact('user', 'institution', 'productSubCategories'));
    }

    public function viewBill($portal, $bill_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // categories
        $productSubCategories = ProductSubCategory::where('institution_id',$institution->id)->get();
        return view('pos.view_bill', compact('user', 'institution', 'productSubCategories'));
    }

    public function viewPaidBill($portal, $bill_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // categories
        $productSubCategories = ProductSubCategory::where('institution_id',$institution->id)->get();
        return view('pos.view_paid_bill', compact('user', 'institution', 'productSubCategories'));
    }

    public function productSubCategoryCategories($portal, $product_sub_category_id)
    {
        // User
        $user = $this->getUser();
        // Institution
        $institution = $this->getInstitution($portal);
        // categories
        $productSubCategories = ProductSubCategory::where('institution_id',$institution->id)->get();
        // check if product sub category exists
        $productSubCategory = ProductSubCategory::findOfFail($product_sub_category_id);
        // get products
        $products = Product::where('product_sub_category',$productSubCategory->id)->get();
        return view('pos.view_paid_bill', compact('user', 'institution', 'productSubCategories', 'products'));
    }
    public function ajaxProductTest( $category_id = NULL, $return = NULL) {
    }

    public function ajaxProducts( $portal, $category_id , $tcp) {


//        elseif (!$category_id)
//        {
//            $category_id = $this->Settings->default_category;
//        }

//        if ($this->input->get('per_page') == 'n' )
//        {
//            $page = 0; } else { $page = $this->input->get('per_page');
//        }

//        if ($this->input->get('tcp') == 1 )
//        {
//            $tcp = TRUE; } else { $tcp = FALSE;
//        }


//        return $category_id;
//        $products = $this->pos_model->fetch_products($category_id, $this->Settings->pro_limit, $page);
        $products = Product::where('product_sub_category_id',$category_id)->get();

        $pro = 1;
        $prods = "<div>";
        if($products) {
            foreach($products as $product) {
                $count = $product->id;
                if($count < 10) { $count = "0".($count /100) *100;  }
                if($category_id < 10) { $category_id = "0".($category_id /100) *100;  }
                $prods .= "<button type=\"button\" data-name=\"".$product->name."\" id=\"product-".$category_id.$count."\" type=\"button\" value='".$product->id."' class=\"btn btn-name btn-default btn-flat product\">".$product->name."</button>";
                $pro++;
            }
//            if($this->Settings->bsty == 1) {
//                foreach($products as $product) {
//                    $count = $product->id;
//                    if($count < 10) { $count = "0".($count /100) *100;  }
//                    if($category_id < 10) { $category_id = "0".($category_id /100) *100;  }
//                    $prods .= "<button type=\"button\" data-name=\"".$product->name."\" id=\"product-".$category_id.$count."\" type=\"button\" value='".$product->code."' class=\"btn btn-name btn-default btn-flat product\">".$product->name."</button>";
//                    $pro++;
//                }
//            } elseif($this->Settings->bsty == 2) {
//                foreach($products as $product) {
//                    $count = $product->id;
//                    if($count < 10) { $count = "0".($count /100) *100;  }
//                    if($category_id < 10) { $category_id = "0".($category_id /100) *100;  }
//                    $prods .= "<button type=\"button\" data-name=\"".$product->name."\" id=\"product-".$category_id.$count."\" type=\"button\" value='".$product->code."' class=\"btn btn-img btn-flat product\"><img src=\"".base_url()."uploads/thumbs/".$product->image."\" alt=\"".$product->name."\" style=\"width: 110px; height: 110px;\"></button>";
//                    $pro++;
//                }
//            } elseif($this->Settings->bsty == 3) {
//                foreach($products as $product) {
//                    $count = $product->id;
//                    if($count < 10) { $count = "0".($count /100) *100;  }
//                    if($category_id < 10) { $category_id = "0".($category_id /100) *100;  }
//                    $prods .= "<button type=\"button\" data-name=\"".$product->name."\" id=\"product-".$category_id.$count."\" type=\"button\" value='".$product->code."' class=\"btn btn-both btn-flat product\"><span class=\"bg-img\"><img src=\"".base_url()."uploads/thumbs/".$product->image."\" alt=\"".$product->name."\" style=\"width: 100px; height: 100px;\"></span><span><span>".$product->name."</span></span></button>";
//                    $pro++;
//                }
//            }
        } else {
            $prods .= '<h4 class="text-center text-info" style="margin-top:50px;">'.lang('category_is_empty').'</h4>';
        }

        $prods .= "</div>";


        if(!$tcp) {
            echo $prods;
        } else {
            $category_products = Product::where('product_sub_category_id',$category_id)->count();
            header('Content-Type: application/json');
            echo json_encode(array('products' => $prods, 'tcp' => $category_products));
        }

//        if(!$return) {
//            if(!$tcp) {
//                echo $prods;
//            } else {
//                $category_products = Product::where('product_sub_category_id',$category_id)->count();
//                header('Content-Type: application/json');
//                echo json_encode(array('products' => $prods, 'tcp' => $category_products));
//            }
//        } else {
//            return $prods;
//        }

    }

    public function getProduct($code = NULL) {

        return $http_response_header;

        if ($this->input->get('code')) { $code = $this->input->get('code'); }
        $combo_items = FALSE;
        // get product
        $product = Product::where('code',$this->input->get('code'))->first();
        if($product) {
            unset($product->cost, $product->details);
            $product->qty = 1;
            $product->comment = '';
            $product->discount = '0';
            $product->price = $product->store_price > 0 ? $product->store_price : $product->price;
            $product->real_unit_price = $product->price;
            $product->unit_price = $product->tax ? ($product->price+(($product->price*$product->tax)/100)) : $product->price;
            if ($product->type == 'combo') {
                $combo_items = $this->pos_model->getComboItemsByPID($product->id);
            }
            echo json_encode(array('id' => str_replace(".", "", microtime(true)), 'item_id' => $product->id, 'label' => $product->name . " (" . $product->id . ")", 'row' => $product, 'combo_items' => $combo_items));
        } else {
            echo NULL;
        }

    }
}
