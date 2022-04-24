<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Method;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function shop()
    {
        $products = Product::where("aktif", 1)->paginate(10);
        return view('frontend.pages.shop')->with(compact('products'));
    }

    public function getcategory($m, $s = null)
    {
        if ($s == null) {
            $subcategories = SubCategory::where("kategori_id", $m)->get();
            $c = [];
            foreach ($subcategories as $subcategory) {
                $c[] = $subcategory->id;
            }
            $products = Product::where("aktif", 1)->whereIn("sub_kategori_id", $c)->paginate(10);
            return view('frontend.pages.shop', compact('products'));
        } else {
            $products = Product::where("aktif", 1)->where("sub_kategori_id", $s)->paginate(10);
            return view('frontend.pages.shop', compact('products'));
        }

    }

    public function detailproduct($id)
    {
        $product = Product::find($id);
        return view('frontend.pages.product', compact('product'));
    }


}
