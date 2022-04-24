<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function addproductimage(Request $request, $id)
    {
        $image = Product::find($id)->image;
        if ($image->count() < 5) {
            $path = "product/" . $id;
            $filename = $image->count() + 1 . "." . $request->file('img')->getClientOriginalExtension();
            $request->file("img")->storeAs($path, $filename);

            ProductImage::create(["urun_id" => $id, "yol" => "/image?img=" . $path . "/" . $filename]);

            return response()->json([
                "msg" => "Resim başarılı bir şekilde eklendi.",
                "type" => "success"
            ]);
        }

    }

    public function updateproductimage(Request $request)
    {
        $product_id = $request->prd_id;
        $image_id = $request->img_id;

        $path = "product/" . $product_id;
        $filename = $image_id . "." . $request->file('img')->getClientOriginalExtension();
        $request->file("img")->storeAs($path, $filename);

        ProductImage::whereId($image_id)->update(["yol" => "/image?img=" . $path . "/" . $filename]);

        return response()->json([
            "msg" => "Resim başarılı bir şekilde güncellendi.",
            "type" => "success"
        ]);
    }

    public function deleteproductimage($id)
    {

        $data = ProductImage::whereId($id)->first();
        $parts = parse_url($data->yol);

        dd($parts);

        parse_str($parts['query'], $query);
        dd($query['img']);
        Storage::delete($query['img']);

        ProductImage::whereId($id)->delete();
        return redirect()->back()->with('error', 'Resim başarılı bir şekilde silindi.');

    }
}
