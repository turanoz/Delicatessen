@extends('frontend.layouts.app')
@section('title')
    - Anasayfa
@endsection
@section('content')
<!-- Page Header Section Start Here -->
<section class="page-header bg_img padding-tb">
    <div class="overlay"></div>
</section>
<!-- Page Header Section Ending Here -->
<!-- product category section start here -->
<section class="product-section relative mt-5">
    <div class="shape-images">
        <img src="{{asset('frontend')}}/assets/images/shape-images/01.png" alt="shape-images">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header">
                    <h3>Ürünlerimiz</h3>
                    <p>Günlük ürünlerimizle kalitemize kalite katıyoruz.</p>
                </div>
            </div>
            <div class="col-12">

                <div class="section-wrapper">
                    <div class="row justify-content-center">
                        @foreach($products as $product)
                            <div  class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div style="height: 400px" class="card py-4 px-2 mb-4 text-center bg-ash border-none relative">
                                    @php
                                        $product->image->count()>0?$img=$product->image[mt_rand(0,$product->image->count()-1)]->yol:$img="";
                                    @endphp
                                    <img style="height: 225px" src="{{$img}}" class="card-img-top mb-2" alt="product">
                                    <div class="card-body">
                                        <a href="{{route("frontend.product",$product->id)}}"><h6 class="card-title mb-2">{{$product->ad}}</h6></a>
                                        <h6 class="product-price">{{$product->fiyat."₺ / ".$product->unit->ad}}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="text-center mt-3">
                        <a href="{{route("frontend.shop")}}" class="lab-btn"><span>Tüm Ürünlerimiz</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product category section ending here -->

<!-- sponsor section start here -->
<div class="sponsor-section padding-tb">
    <div class="container">
        <div class="section-wrapper">
            <div class="sponsor-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="sponsor-item">
                            <div class="sponsor-thumb">
                                <a href="#"><img src="{{asset('frontend')}}/assets/images/sponsor/01.png" alt="sponsor"></a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="sponsor-item">
                            <div class="sponsor-thumb">
                                <a href="#"><img src="{{asset('frontend')}}/assets/images/sponsor/02.png" alt="sponsor"></a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="sponsor-item">
                            <div class="sponsor-thumb">
                                <a href="#"><img src="{{asset('frontend')}}/assets/images/sponsor/03.png" alt="sponsor"></a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="sponsor-item">
                            <div class="sponsor-thumb">
                                <a href="#"><img src="{{asset('frontend')}}/assets/images/sponsor/04.png" alt="sponsor"></a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="sponsor-item">
                            <div class="sponsor-thumb">
                                <a href="#"><img src="{{asset('frontend')}}/assets/images/sponsor/05.png" alt="sponsor"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sponsor section ending here -->
@endsection
