<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table="order";
    protected $guarded=[];
    public function status(){
        return $this->hasOne(Status::class,"id","durum_id");
    }
    public function adress(){
        return $this->hasOne(Address::class,"id","adres_id");
    }
    public function user(){
        return $this->hasOne(User::class,"id","kullanici_id");
    }
}
