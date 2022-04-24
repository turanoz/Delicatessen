@extends('frontend.layouts.app')
@section('title') - Mağaza @endsection
@section('content')
    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Ürünlerimiz</h4>
                <ul class="lab-ul">
                    <li><a href="{{route("frontend.index")}}">Home</a></li>
                    <li><a class="active">Mağaza</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->
    <!-- shop page Section Start Here -->
    <div class="shop-page padding-tb bg-ash">
        <div class="container">
            <div class="section-wrapper">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-7 col-12">
                        <aside>
                            <div class="widget widget-search">
                                <div class="widget-header">
                                    <h5>Ürün Ara</h5>
                                </div>
                                <form action="/" class="search-wrapper">
                                    <input type="text" name="s">
                                    <button type="submit"><i class="icofont-search-2"></i></button>
                                </form>
                            </div>

                            <div class="widget widget-category">
                                <div class="widget-header">
                                    <h5>Kategoriler</h5>
                                </div>
                                <div class="widget-wrapper">
                                    <ul class="lab-ul shop-menu">
                                        @foreach($__categories as $__category)
                                            <li>
                                                <a class="dd-icon-down"
                                                   href="{{route("frontend.getcategory",["m"=>$__category->id])}}">{{$__category->ad}}</a>
                                                @if($__category->sub->count()>0)
                                                    <ul class="lab-ul shop-submenu open {{request()->is("magaza/kategori/".$__category->id,"/*") ? 'd-block' : ""}} {{request()->is("magaza/kategori/".$__category->id."/*") ? 'd-block' : ""}}  ">
                                                        @foreach($__category->sub as $__sub)
                                                            <li>
                                                                <a href="{{route("frontend.getcategory",["m"=>$__category->id,"s"=>$__sub->id])}}">{{$__sub->ad}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-9 col-12">
                        <article>
                            @if(session('success'))
                                <div style="margin-top: 36px" class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="shop-title d-flex flex-wrap justify-content-between">
                                <p>{{$products->total()}} üründen {{$products->count()*($products->currentPage()-1)+1}}-{{$products->count()*$products->currentPage()}} arası</p>
                                <div class="product-view-mode">
                                    <a class="active" data-target="grids"><i class="icofont-ghost"></i></a>
                                    <a data-target="lists"><i class="icofont-listing-box"></i></a>
                                </div>
                            </div>

                            <div class="shop-product-wrap grids row justify-content-center">
                                @foreach($products as $product)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div style="height: 300px" class="product-item">
                                            <div class="product-thumb">
                                                @php
                                                if ($product->image->count()>0){
                                                    $img=$product->image[mt_rand(0,$product->image->count()-1)]->yol;
                                                }
                                                @endphp


                                                <img style="height: 150px" src="{{$img}}" alt="shope">
                                                <div class="product-action-link">
                                                    <a class="image-popup-vertical-fit" href="{{$img}}">
                                                        <img class="img-fluid d-none" alt="img-2" src="{{$img}}">
                                                        <i class="icofont-eye"></i></a>
                                                    <a href="{{route("frontend.addcart",$product->id)}}"><i
                                                            class="icofont-cart-alt"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h6><a href="{{route("frontend.product",$product->id)}}">{{$product->ad}}</a></h6>
                                                <h6>{{$product->fiyat."₺/".$product->unit->ad}}</h6>
                                            </div>
                                        </div>
                                        <div class="product-list-item">
                                            <div class="product-thumb">
                                                <img style="height: 175px" src="{{$img}}" alt="shope">
                                                <div class="product-action-link">
                                                    <a class="image-popup-vertical-fit" href="{{$img}}">
                                                        <img class="img-fluid d-none" alt="img-2" src="{{$img}}">
                                                        <i class="icofont-eye"></i></a>
                                                    <a href="{{route("frontend.addcart",$product->id)}}"><i
                                                            class="icofont-cart-alt"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h6><a href="{{route("frontend.product",$product->id)}}">{{$product->ad}}</a></h6>
                                                <h6>
                                                    {{$product->fiyat."₺/".$product->unit->ad}}
                                                </h6>
                                                <p>
                                                    {!! html_entity_decode($product->ozet) !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                                {{$products->links()}}

                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop page Section ENding Here -->
@endsection
@section("_css")
    <link href="{{asset("backend")}}/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("backend")}}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
@endsection
@section('_js')

    <!-- Magnific Popup-->
    <script src="{{asset("backend")}}/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- lightbox init js-->
    <script src="{{asset("backend")}}/assets/js/pages/lightbox.init.js"></script>
@endsection
