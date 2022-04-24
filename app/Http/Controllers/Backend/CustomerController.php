<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customer()
    {
        $users = User::paginate(8);
        return view("backend.pages.customer", compact("users"));
    }

    public function customerdetail($id)
    {
        $user = User::find($id);
        return view("backend.pages.customerdetail", compact("user",));
    }

    public function updatecustomer(Request $request, $id)
    {
        $request->validate([
            'ad' => 'required',
            'soyad' => 'required',
            'eposta' => 'required',
            'tel' => 'required',
            'aktif' => 'required',
        ]);
        $data = request()->except(['_token']);
        User::whereId($id)->update($data);
        return redirect()->back()->with('success', 'Müşteri bilgileri başarılı bir şekilde güncellendi.');

    }

    public function deletecustomer($id)
    {
        User::whereId($id)->delete();
        return redirect()->route("backend.customer")->with('success', 'Müşteri bilgileri başarılı bir şekilde silindi.');
    }
}
