<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table="user";
    protected $guarded=[];


    public function address(){
        return $this->hasMany(Address::class,"kullanici_id","id");
    }
}
