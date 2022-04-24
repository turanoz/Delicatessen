<!-- Mobile Menu Start Here -->
<div class="mobile-menu transparent-header">
    <nav class="mobile-header">
        <div class="header-logo">
            <a href="{{route("frontend.index")}}"><img style="height: 50px !important;" src="{{$_site->logo}}" alt="logo"></a>
        </div>
        <div class="header-bar">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <nav class="mobile-menu">
        <div class="mobile-menu-area">
            <div class="mobile-menu-area-inner">
                <ul class="lab-ul">
                    <li class="{{ request()->routeIs('frontend.index') ? 'active' : '' }}">
                        <a href="{{route("frontend.index")}}">Anasayfa</a>
                    </li>
                    <li class="{{ request()->routeIs('frontend.shop') ? 'active' : '' }}">
                        <a href="{{route("frontend.shop")}}">Mağaza</a>
                    </li>
                    <li class="{{ request()->routeIs('frontend.contact') ? 'active' : '' }}"><a
                                href="{{route("frontend.contact")}}">İletişim</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- Mobile Menu Ending Here -->

<!-- desktop menu start here -->
<header class="header-section">
    <div class="header-top bg-black">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-7 col-12">
                    <div class="ht-left">
                        <ul class="lab-ul d-flex flex-wrap">
                            <li><i class="icofont-envelope"></i><span>{{$_site->eposta}}</span></li>
                            <li><i class="icofont-phone"></i><span>{{$_site->tel}}</span></li>
                            <li>
                                <i class="icofont-stopwatch"></i><span>{{$_site->isgunu->period}} {{$_site->isgunu->baslangic}}-{{$_site->isgunu->bitis}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="header-area">
            <div class="container">
                <div class="primary-menu">
                    <div class="logo py-2">
                        <a href="{{route("frontend.index")}}"><img style="height: 70px !important;" src="{{$_site->logo}}" alt="logo"></a>
                    </div>
                    <div class="main-area">
                        <div class="main-menu d-flex flex-wrap align-items-center justify-content-center w-100">
                            <ul class="lab-ul">
                                <li class="{{ request()->routeIs('frontend.index') ? 'active' : '' }}">
                                    <a href="{{route("frontend.index")}}">Anasayfa</a>
                                </li>
                                <li class="{{ request()->routeIs('frontend.shop') ? 'active' : '' }}">
                                    <a href="{{route("frontend.shop")}}">Mağaza</a>
                                </li>
                                <li class="{{ request()->routeIs('frontend.contact') ? 'active' : '' }}"><a
                                            href="{{route("frontend.contact")}}">İletişim</a></li>
                            </ul>
                            <ul class="lab-ul search-cart">
                                <li>
                                    <div class="cart-option">
                                        <i class="icofont-cart-alt"></i>
                                        <div class="cart-content">
                                            @if(session('cart'))
                                                @foreach(session('cart') as $id => $details)
                                                    <div class="cart-item">
                                                        <div class="cart-img">
                                                            <img style="max-height: 80px" src="{{ $details['resim'] }}">
                                                        </div>
                                                        <div class="cart-des">
                                                            <a href="{{route("frontend.product",$id)}}">{{ mb_substr($details['ad'],0,15,"UTF-8") }}
                                                                ...</a>
                                                            <p>{{ $details['miktar'] }} {{ $details['birim'] }}
                                                                / {{ $details['fiyat'] }}₺</p>
                                                        </div>
                                                        <div class="cart-btn pl-2">
                                                            <a href="{{route("frontend.deletecart",$id)}}"><i
                                                                        class="icofont-close-circled"></i></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="cart-bottom">
                                                <div class="cart-subtotal">
                                                    @php $total = 0 @endphp
                                                    @foreach((array) session('cart') as $id => $details)
                                                        @php $total += $details['fiyat'] * $details['miktar'] @endphp
                                                    @endforeach
                                                    <p>Toplam: <b class="float-right">{{ $total }} ₺</b></p>
                                                </div>
                                                <div class="cart-action">
                                                    <a href="{{route("frontend.cart")}}" class="lab-btn"><span>Sepete Git</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- desktop menu ending here -->
