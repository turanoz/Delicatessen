<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    public function signin(Request $request)
    {
        $request->validate([
            'ad' => 'required',
            'soyad' => 'required',
            'tel' => 'required',
            'eposta' => 'required',
            'sifre' => 'required'
        ]);
        $data = $request->all();
        $data['sifre'] = md5($request->sifre);
        User::create($data);

        $username = $request->eposta;
        $password = md5($request->sifre);
        $profile_info = User::whereEposta($username)->whereSifre($password)->first();
        Session::put("profile_info", $profile_info);
        return redirect()->back()->with('success', 'Başarıyla bir şekilde kayıt oldunuz!');
    }

    public function login(Request $request)
    {

        if ($request->forgotpassword == "forgetpassword") {
            $email = $request->username;
            $user = User::whereEposta($email)->first();
            if ($user) {
                $info = Admin::first();
                $signedURL = URL::temporarySignedRoute("frontend.forgetpassword", now()->addMinute(5), ["id" => $user->id]);
                $array = [
                    'adsoyad' => $user->ad . " " . $user->soyad,
                    'key' => $signedURL,
                    'admin' => $info->ad . " " . $info->soyad
                ];
                mail::send("email.forgetpassword", $array, function ($message) use ($email) {
                    $message->subject('Şifre Sıfırla');
                    $message->to($email);
                });
                return redirect()->back()->with('success', 'Talimatlar mail adresine gönderildi.');

            } else {
                return redirect()->back()->with('success', 'Böyle bir kullanıcı bulunamadı.');
            }
        }

        $username = $request->username;
        $password = md5($request->password);

        $data = User::whereEposta($username)->whereSifre($password)->first();
        if ($data) {
            Session::put("profile_info", $data);
            return redirect()->back()->with('success', 'Başarıyla giriş yaptınız!');
        } else {
            return redirect()->back()->with('error', 'Kullanıcı adı veya şifre yanlış!');
        }
    }

    public function logout()
    {
        Session::put("profile_info", null);
        return redirect()->back()->with('success', 'Güvenli bir şekilde çıkış yaptınız!');
    }

    public function forgetpasswordpost(Request $request)
    {

        $user = User::whereEposta($request->eposta)->first();
        if ($request->eposta != "" && $request->sifre != "") {
            User::whereId($user->id)->update(["sifre" => md5($request->sifre)]);
            return redirect()->route("frontend.cart")->with('success',"Şifreniz başarıyla değiştirildi.");
        }
    }


    public function forgetpassword(Request $request, $id)
    {
        $user = User::find($id);
        if (!$request->hasValidSignature()) {
            abort(401);
        } else {
            return view("frontend.pages.forgetpassword", compact("user"));
        }
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'ad' => 'required',
            'soyad' => 'required',
            'tel' => 'required',
            'eposta' => 'required',
            'sifre' => 'nullable'
        ]);
        $id = Session::get("profile_info")->id;
        $ad = $request->ad;
        $soyad = $request->soyad;
        $tel = $request->tel;
        $eposta = $request->eposta;
        $sifre = md5($request->sifre);

        if ($request->sifre == "") {
            User::where(["id" => $id])->update(["ad" => $ad, "soyad" => $soyad, "tel" => $tel, "eposta" => $eposta]);
            $profile_info = User::find(Session::get("profile_info")->id);
            Session::put("profile_info", $profile_info);
            return redirect()->back()->with('success', 'Profiliniz başarılı bir şekilde güncellendi');
        }
        User::where(["id" => $id])->update(["ad" => $ad, "soyad" => $soyad, "tel" => $tel, "eposta" => $eposta, "sifre" => $sifre]);
        $profile_info = User::find(Session::get("profile_info")->id);
        Session::put("profile_info", $profile_info);
        return redirect()->back()->with('success', 'Profiliniz başarılı bir şekilde güncellendi');

    }

    public function addaddress(Request $request)
    {
        $request->validate([
            'kullanici_id' => 'required',
            'adsoyad' => 'required',
            'adres' => 'required',
            'il' => 'required',
            'ilce' => 'required',
            'tel' => 'required'
        ]);

        $data = $request->all();

        if ($request->ekle) {
            Address::create($data);
            $profile_info = User::find(Session::get("profile_info")->id);
            Session::put("profile_info", $profile_info);
            return redirect()->back()->with('success', 'Adres başarılı bir şekilde oluşturuldu!');
        }
        if ($request->guncelle) {
            Address::where(["id" => $data["id"]])->update(["adsoyad" => $data["adsoyad"], "adres" => $data["adres"], "il" => $data["il"], "ilce" => $data["ilce"], "tel" => $data["tel"]]);
            $profile_info = User::find(Session::get("profile_info")->id);
            Session::put("profile_info", $profile_info);
            return redirect()->back()->with('success', 'Adres başarılı bir şekilde güncellendi!');
        }
    }

    public function deleteaddress($id)
    {
        Address::whereId($id)->delete();
        $profile_info = User::find(Session::get("profile_info")->id);
        Session::put("profile_info", $profile_info);
        return redirect()->back()->with('success', 'Adres başarılı bir şekilde silindi!');

    }
}
