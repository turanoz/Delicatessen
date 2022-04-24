<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->string("ad",100);
            $table->string("ozet",255);
            $table->longText("aciklama");
            $table->foreignId('sub_kategori_id');
            $table->foreign("sub_kategori_id")->references("id")->on("sub_category");
            $table->foreignId('birim_id');
            $table->foreign("birim_id")->references("id")->on("unit");
            $table->unsignedBigInteger("miktar");
            $table->unsignedBigInteger("satilanmiktar");
            $table->unsignedBigInteger("fiyat");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Product');
    }
}
