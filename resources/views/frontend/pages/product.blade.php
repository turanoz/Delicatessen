@extends('frontend.layouts.app')
@section('title')
    RT Şarküteri - Mağaza - Ürün Adı
@endsection
@section('content')
    <!-- Shop Page Section start here -->
    <section class="shop-single padding-tb pb-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-12 sticky-widget">
                    @if(session('success'))
                        <div style="margin-top: 36px" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="product-details">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="product-thumb">
                                    <div class="swiper-container gallery-top">
                                        <div class="swiper-wrapper">
                                            @foreach($product->image as $image)
                                                <div class="swiper-slide">
                                                    <div class="shop-item">
                                                        <div class="shop-thumb">
                                                            <img src="{{$image->yol}}" alt="shop-single">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="shop-navigation d-flex flex-wrap">
                                            <div class="shop-nav shop-slider-prev"><i class="icofont-simple-left"></i>
                                            </div>
                                            <div class="shop-nav shop-slider-next"><i class="icofont-simple-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-container gallery-thumbs">
                                        <div class="swiper-wrapper">
                                            @foreach($product->image as $image)
                                                <div class="swiper-slide">
                                                    <div class="shop-item">
                                                        <div class="shop-thumb">
                                                            <img src="{{$image->yol}}" alt="shop-single">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h4>{{$product->ad}}</h4>
                                <h5>
                                    {{$product->fiyat."₺/".$product->unit->ad}}
                                </h5>
                                <div class="post-content">
                                    <h5>
                                        Açıklama
                                    </h5>
                                    <p>
                                        {!! html_entity_decode($product->ozet) !!}
                                    </p>
                                    <form method="post" action="{{route("frontend.addupdatecart")}}">
                                        @csrf
                                        <input name="id" type="hidden" value="{{$product->id}}">
                                        <div class="cart-plus-minus">
                                            <div class="dec qtybutton">-</div>
                                            <input name="miktar" class="cart-plus-minus-box" type="text" value="1">
                                            <div class="inc qtybutton">+</div>
                                        </div>
                                        <button type="submit">Sepete Ekle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="review ">
                        <ul class="agri-ul review-nav justify-content-center">
                            <li class="desc active" data-target="description-show">Açıklama</li>
                        </ul>
                        <div class="review-content description-show">

                            <div class="description mb-3">
                                {!! html_entity_decode($product->aciklama) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Page Section ending here -->
@endsection
