<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function auth(Request $request)
    {
        $eposta = $request->eposta;
        $sifre = md5($request->sifre);

        $data = Admin::whereEposta($eposta)->whereSifre($sifre)->first();


        if ($data) {
            Session::put("admin", $data);
            return redirect()->route("backend.index")->with('success', 'Hoşgeldiniz ' . $data->ad . " " . $data->soyad);
        } else {
            return redirect()->back()->with('success', 'Eposta adresi veya şifre yanlış');
        }
    }

    public function login()
    {
        if (Session::get("admin")) {
            return redirect()->route("backend.index");
        }
        return view("backend.pages.auth.login");
    }

    public function logout()
    {
        Session::remove("admin");
        return redirect()->route("backend.login");
    }

    public function index()
    {
        $orders = Order::get();
        return view("backend.pages.index", compact("orders"));
    }

    public function profile()
    {
        $profile = Admin::first();

        return view("backend.pages.profile", compact("profile"));
    }

    public function updateprofile(Request $request)
    {
        $profile = Admin::first();

        $json=json_decode($profile->json,true);

        if ($request->sifre) {
            $data = request()->except(['_token', 'img']);
            $data["sifre"] = md5($data["sifre"]);
            $data["json"]=$json;
        } else {
            $data = request()->except(['_token', 'img', 'sifre']);
            $data["json"]=$json;
        }

        if ($request->file('img')) {
            $path = "site/profile";
            $filename = "profile." . $request->file('img')->getClientOriginalExtension();
            $request->file("img")->storeAs($path, $filename);
            $data["json"]["img"] = "/image?img=" . $path . "/" . $filename;
        }


        Admin::whereId($profile->id)->update($data);
        Session::put("admin", Admin::first());
        return redirect()->back()->with('success', 'Profil başarılı bir şekilde güncellendi.');
    }
}
