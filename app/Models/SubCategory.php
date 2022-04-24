<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table="sub_category";
    protected $guarded=[];
    public function category(){
        return $this->hasOne(Category::class,"id","kategori_id");
    }
    public function product(){
        return $this->hasMany(Product::class,"sub_kategori_id","id");
    }
}
