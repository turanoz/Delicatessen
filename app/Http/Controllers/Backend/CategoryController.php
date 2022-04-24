<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addcategory(Request $request)
    {
        $request->validate([
            'ad' => 'required',
        ]);
        $data = $request->all();

        $result=Category::get()->count();

        $data["sira"]=$result+1;

        Category::create($data);

        return redirect()->back()->with('success', 'Kategori başarılı bir şekilde oluşturuldu');
    }
    public function addsubcategory(Request $request)
    {
        $request->validate([
            'ad' => 'required',
            'kategori_id' => 'required'
        ]);
        $data = $request->all();

        $result=SubCategory::where("kategori_id",$request->kategori_id)->get()->count();

        $data["sira"]=$result+1;

        SubCategory::create($data);

        return redirect()->back()->with('success', 'Alt Kategori başarılı bir şekilde oluşturuldu');
    }
    public function listsubcategory(Request $request)
    {
        $request->validate([
            'kategori' => 'required'
        ]);

        $data=SubCategory::where("kategori_id",$request->kategori)->get();
        return response()->json($data);
    }
}
