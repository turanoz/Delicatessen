<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {
        $products=Product::inRandomOrder()->limit(4)->get();
        return view('frontend.pages.index',compact('products'));
    }

    public function contact(){
        return view('frontend.pages.contact');
    }
}
