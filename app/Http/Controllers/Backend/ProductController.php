<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function product()
    {
        $products = Product::paginate(8);
        $units = Unit::get();
        $categories = Category::get();
        $subcategories = SubCategory::get();
        return view("backend.pages.product", compact("products", "units", "categories", "subcategories"));
    }

    public function detailproduct($id)
    {
        $product = Product::find($id);
        $units = Unit::get();
        $categories = Category::get();
        $subcategories = SubCategory::get();
        return view("backend.pages.productdetail", compact("product", "units", "categories", "subcategories"));
    }

    public function addproduct(Request $request)
    {
        $request->validate([
            'ad' => 'required',
            'miktar' => 'required',
            'birim_id' => 'required',
            'sub_kategori_id' => 'required',
            'ozet' => 'required',
            'aciklama' => 'required'
        ]);
        $data = $request->all();
        if ($request->aktif == "on") {
            $data["aktif"] = 1;
        } else {
            $data["aktif"] = 0;
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Ürün başarılı bir şekilde oluşturuldu');
    }

    public function updateproduct(Request $request, $id)
    {
        $request->validate([
            'ad' => 'required',
            'miktar' => 'required',
            'birim_id' => 'required',
            'sub_kategori_id' => 'required',
            'ozet' => 'required',
            'aktif' => 'required',
            'aciklama' => 'required'
        ]);
        $data = request()->except(['_token']);

        Product::whereId($id)->update($data);

        return redirect()->back()->with('success', 'Ürün başarılı bir şekilde güncellendi');
    }

    public function deleteproduct($id)
    {
        ProductImage::whereUrun_id($id)->delete();
        Storage::deleteDirectory("product/" . $id);
        Product::whereId($id)->delete();
        return redirect()->route("backend.product")->with('success', 'Ürün başarılı bir şekilde silindi.');
    }

}
