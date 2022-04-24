<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table="product";
    protected $guarded=[];

    public function unit(){
        return $this->hasOne(Unit::class,"id","birim_id");
    }
    public function subcategory(){
        return $this->hasOne(SubCategory::class,"id","sub_kategori_id");
    }
    public function image(){
        return $this->hasMany(ProductImage::class,"urun_id","id");
    }
}
