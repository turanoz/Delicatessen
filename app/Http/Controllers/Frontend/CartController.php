<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Method;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function cart()
    {

        if (Session::get("profile_info")) {
            $id = Session::get("profile_info")->id;
            $methods = Method::get();
            $orders = Order::where("kullanici_id", $id)->get();
            return view('frontend.pages.cart', compact("methods", "orders"));
        }
        return view('frontend.pages.cart');


    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['miktar']++;
        } else {
            $cart[$id] = [
                "ad" => $product->ad,
                "miktar" => 1,
                "fiyat" => $product->fiyat,
                "birim" => $product->unit->ad,
                "resim" => $product->image->count() > 0 ? $product->image[0]->yol : ""
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Ürün sepete eklendi!');
    }

    public function addOrUpdateCart(Request $request)
    {
        $id = $request->id;
        $miktar = $request->miktar;
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['miktar'] += $miktar;
        } else {
            $cart[$id] = [
                "ad" => $product->ad,
                "miktar" => $miktar,
                "fiyat" => $product->fiyat,
                "birim" => $product->unit->ad,
                "resim" => $product->image->count() > 0 ? $product->image[0]->yol : ""
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Ürün sepete eklendi!');
    }

    public function updateToCart($id, $miktar)
    {
        if ($id && $miktar) {
            $cart = session()->get('cart');
            $cart[$id]["miktar"] = $miktar;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Sepet güncellendi!');

        }
    }

    public function deleteToCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('deleted', 'Ürün sepetten silindi!');
        }
    }

    public function addOrder(Request $request)
    {

        $request->validate([
            'adres' => 'required',
            'yontem' => 'required'
        ]);

        $id = Session::get("profile_info")->id;
        $cart["products"] = Session::get("cart");
        $adress = $request->adres;
        $method = $request->yontem;
        $total = 0;
        foreach ($cart["products"] as $details) {
            $total += $details['fiyat'] * $details['miktar'];
        }
        $cart["method"] = $method;
        $cart["total"] = $total;
        $cart=json_encode($cart);
        $order = Order::create(["kullanici_id" => $id, "adres_id" => $adress, "json" => $cart, "durum_id" => 1]);

        $cart=json_decode($cart);



        foreach ($cart->products as $key=>$item) {
            $prd=Product::whereId($key)->first();
            Product::whereId($key)->update(["satilanmiktar" => $prd->satilanmiktar+$item->miktar,"miktar"=>$prd->miktar-$item->miktar]);
        }

        Session::forget("cart");

        return redirect()->back()->with('success', 'Sipariş başarılı bir şekilde oluşturuldu. Sipariş numaranız: #' . $order->id);

    }

}
