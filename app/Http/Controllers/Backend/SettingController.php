<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function setting()
    {
        $setting = json_decode(Admin::first()->json);
        return view("backend.pages.setting", compact("setting"));
    }
    public function updatesetting(Request $request)
    {
        $json = json_decode(Admin::first()->json, true);

        $json["title"] = $request->title;

        if ($request->file('logo')) {
            $path = "site/";
            $filename = "logo." . $request->file('logo')->getClientOriginalExtension();
            $request->file("logo")->storeAs($path, $filename);
            $json["logo"] = "/image?img=" . $path . "/" . $filename;
        }
        $json["adres"]["adres"] = $request->adres;
        $json["adres"]["il"] = $request->il;
        $json["adres"]["ilce"] = $request->ilce;
        $json["harita"]["lat"] = $request->lat;
        $json["harita"]["lng"] = $request->lng;
        $json["eposta"] = $request->eposta;
        $json["tel"] = $request->tel;
        $json["isgunu"]["baslangic"] = $request->baslangic;
        $json["isgunu"]["bitis"] = $request->bitis;
        $json["isgunu"]["period"] = $request->period;
        $json = json_encode($json);
        Admin::first()->update(["json" => $json]);

        return redirect()->back()->with('success', 'Site bilgileri başarılı bir şekilde güncellendi.');

    }
}
