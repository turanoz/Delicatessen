@extends('frontend.layouts.app')
@section('title') - Sepet @endsection
@section("_css")
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/order.css">
@endsection
@section('content')

    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">Sepetim</h4>
                <ul class="lab-ul">
                    <li><a href="{{route("frontend.shop")}}">Mağaza</a></li>
                    <li><a class="active">Alışveriş Sepeti</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->

    <!-- Shop Cart Page Section start here -->
    <div class="shop-cart mt-5 pb-0">
        <div class="container">
            @if(session('success'))
                <div style="margin-top: 36px" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="section-wrapper">
                <div class="cart-top">
                    @if(session('cart'))
                        <table>
                            <thead>
                            <tr>
                                <th>Ürün</th>
                                <th>Fiyat</th>
                                <th>Adet</th>
                                <th>Toplam</th>
                                <th>Düzenle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(session('cart') as $id => $details)
                                <tr>
                                    <td class="product-item">
                                        <div class="p-thumb">
                                            <a href="#"><img src="{{ $details['resim'] }}" alt="product"></a>
                                        </div>
                                        <div class="p-content">
                                            <a href="#">{{ $details['ad'] }}</a>
                                        </div>
                                    </td>
                                    <td>{{ $details['fiyat'] }}₺/{{ $details['birim'] }}</td>
                                    <td>
                                        <div class="cart-plus-minus">
                                            <div class="dec qtybutton">-</div>
                                            <input data-id="{{$id}}" class="cart-plus-minus-box" type="text" id="miktar"
                                                   value="{{ $details['miktar'] }}">
                                            <div class="inc qtybutton">+</div>
                                        </div>
                                    </td>
                                    <td>{{ $details['fiyat'] * $details['miktar'] }} ₺</td>
                                    <td>
                                        <a data-id="{{$id}}" style="cursor: pointer"><i style="color: #ef5350"
                                                                                        class="icofont-refresh guncelle"></i></a>
                                        <a href="{{route("frontend.deletecart",$id)}}"><i style="color: #ef5350"
                                                                                          class="icofont-close-circled"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="card">
                            <div class="card-header">
                                !!
                            </div>
                            <div class="card-body text-center">
                                Sepette hiç ürün yok.!! <br><a class="btn btn-danger text-white"
                                                               href="{{route("frontend.shop")}}">Mağaza</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="cart-bottom mb-5">
                    <div class="shiping-box">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                @php
                                    $profile_info=\Illuminate\Support\Facades\Session::get("profile_info");
                                @endphp
                                @if(!session()->has("profile_info"))
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#uyegirisi"
                                               role="tab" aria-controls="uyegirisi" aria-selected="true">Üye Girişi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kayitol"
                                               role="tab" aria-controls="kayitol" aria-selected="false">Kayıt Ol</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!--GİRİŞ YAP-->
                                        <div class="tab-pane fade show active" id="uyegirisi" role="tabpanel"
                                             aria-labelledby="uyegirisi-tab">
                                            <form action="{{route("frontend.login")}}" method="post">
                                                @csrf
                                                <h6 class="mt-3">Üye Girişi</h6>
                                                <div class="mb-2">
                                                    <label for="username">Eposta:</label>
                                                    <input type="text" class="form-control" name="username">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="password">Şifre:</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                                <button type="submit" name="login" class="btn btn-danger">Giriş Yap
                                                </button>
                                                <button type="submit" name="forgotpassword" class="btn btn-danger" value="forgetpassword">Şifremi Unuttum</button>
                                            </form>
                                        </div>
                                        <!--KAYIT OL-->
                                        <div class="tab-pane fade" id="kayitol" role="tabpanel"
                                             aria-labelledby="kayitol-tab">
                                            <form action="{{route("frontend.signin")}}" method="post">
                                                <h6 class="mt-3">Kayıt Ol</h6>
                                                @csrf
                                                <div class="mb-2">
                                                    <label for="ad">Ad:</label>
                                                    <input type="text" class="form-control" name="ad">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="soyad">Soyad:</label>
                                                    <input type="text" class="form-control" name="soyad">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="tel">Tel:</label>
                                                    <input type="number" class="form-control" name="tel">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="eposta">Eposta:</label>
                                                    <input type="text" class="form-control" name="eposta">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="sifre">Şifre:</label>
                                                    <input type="password" class="form-control" name="sifre">
                                                </div>
                                                <input type="submit" class="btn btn-danger" value="Kayıt Ol">
                                            </form>
                                        </div>
                                    </div>
                                @elseif(!session()->has("cart"))
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link"> {{$profile_info->ad." ".$profile_info->soyad}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#order">Siparişlerim</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#profile">Bilgilerim</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link adress" href="#adress">Adreslerim</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route("frontend.logout")}}">Çıkış Yap</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!--SİPARİŞLERİM-->
                                        <div class="tab-pane fade show active" id="order">
                                            <table style="font-size: 14px" class="table table-sm">
                                                <thead>
                                                <tr>
                                                    <th>Sipariş Numarası</th>
                                                    <th>Sipariş Tarihi</th>
                                                    <th>Teslimat Tarihi</th>
                                                    <th>Toplam Tutar</th>
                                                    <th>Durum</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{$order->id}}</td>
                                                        <td>{{$order->created_at}}</span></td>
                                                        <td>{{$order->durum_id=="4" ? $order->updated_at:"-"}}</td>
                                                        <td>{{json_decode($order->json)->total}} ₺</td>
                                                        <td>{{$order->status->ad}}</td>
                                                        <td>
                                                            <div class="showMode" style="cursor: pointer;display: none">
                                                                Detayları Gizle <i class="fa fa-angle-up"></i>
                                                            </div>
                                                            <div class="hideMode" style="cursor: pointer">
                                                                Detayları Göster <i class="fa fa-angle-down"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="detailInfo" style="display: none">
                                                        <td colspan="6">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-4 border-right">
                                                                        <h6>Ürünler</h6>
                                                                        <table style="border:0px;width:100%">
                                                                            @foreach(json_decode($order->json)->products as $id=>$product)

                                                                                <tr>
                                                                                    <td style="width: 70px"
                                                                                        class="align-middle">
                                                                                        <img
                                                                                            style="max-height: 92px;max-width: 70px"
                                                                                            src="{{$product->resim}}"
                                                                                            alt="Card image cap">
                                                                                    </td>
                                                                                    <td class="align-middle text-left">
                                                                                        <a href="{{route("frontend.product",$id)}}">{{$product->ad}}</a><br>
                                                                                        {{$product->miktar}}/{{$product->birim}}
                                                                                    </td>
                                                                                    <td class="align-middle">
                                                                                        {{$product->miktar*$product->fiyat}}₺
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-md-4 border-right">
                                                                        <h6>Fiyatlandırmalar</h6>
                                                                        <table style="border: 0px; width: 100%">
                                                                            <tr>
                                                                                <td class="text-left">Ara Toplam :</td>
                                                                                <td class="text-right">{{json_decode($order->json)->total}} ₺</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">Kargo :</td>
                                                                                <td class="text-right">Ücretsiz</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">Toplam :</td>
                                                                                <td class="text-right">{{json_decode($order->json)->total}} ₺</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">Ödeme Yöntemi :
                                                                                </td>
                                                                                <td class="text-right">{{\App\Models\Method::find(json_decode($order->json)->method)->ad}}</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <h6>Teslimat Adresi</h6>
                                                                        <table style="border: 0px; width: 100%">
                                                                            <tr>
                                                                                <td class="text-left">{{$order->adress->adsoyad}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">{{$order->adress->adres}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">
                                                                                    {{$order->adress->il}}/{{$order->adress->ilce}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">{{$order->adress->tel}}</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <!--BİLGİLERİM-->
                                        <div class="tab-pane fade" id="profile">
                                            <form action="{{route("frontend.updateprofile")}}" method="post">
                                                @csrf
                                                <h6 class="mt-3">Bilgilerim</h6>
                                                <div class="mb-2">
                                                    <label for="ad">Ad:</label>
                                                    <input type="text" class="form-control" name="ad"
                                                           value="{{$profile_info->ad}}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="soyad">Soyad:</label>
                                                    <input type="text" class="form-control" name="soyad"
                                                           value="{{$profile_info->soyad}}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="tel">Tel:</label>
                                                    <input type="number" class="form-control" name="tel"
                                                           value="{{$profile_info->tel}}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="eposta">Eposta:</label>
                                                    <input type="text" class="form-control" name="eposta"
                                                           value="{{$profile_info->eposta}}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="sifre">Şifre:</label>
                                                    <input type="password" class="form-control" name="sifre">
                                                </div>
                                                <button class="btn btn-danger">Güncelle</button>
                                            </form>
                                        </div>
                                        <!--ADRES-->
                                        <div class="tab-pane fade" id="adress">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Ad Soyad</th>
                                                    <th>Adres</th>
                                                    <th>İl</th>
                                                    <th>İlçe</th>
                                                    <th>Tel</th>
                                                    <th>Düzenle</th>
                                                </tr>
                                                <tbody>
                                                @foreach($profile_info->address as $key=>$address)
                                                    <tr>
                                                        <td data-id="{{$address->id}}">{{$key+1}}</td>
                                                        <td>{{$address->adsoyad}}</td>
                                                        <td>{{$address->adres}}</td>
                                                        <td>{{$address->il}}</td>
                                                        <td>{{$address->ilce}}</td>
                                                        <td>{{$address->tel}}</td>
                                                        <td>
                                                            <a style="cursor: pointer"><i style="color: #ef5350"
                                                                                          class="icofont-refresh adresguncelle"></i></a>
                                                            <a href="{{route("frontend.deleteaddress",$address->id)}}"><i
                                                                    style="color: #ef5350"
                                                                    class="icofont-close-circled"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                </thead>
                                            </table>
                                            <h6 class="mt-3">Adres Ekle/Düzenle</h6>
                                            <form action="{{route("frontend.addaddress")}}" method="post">
                                                @csrf
                                                <input type="hidden" name="kullanici_id" value="{{$profile_info->id}}">
                                                <input type="hidden" id="aid" name="id">
                                                <div class="mb-2">
                                                    <label for="adsoyad">Ad Soyad:</label>
                                                    <input type="text" id="aas" class="form-control" name="adsoyad">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="adres">Adres:</label>
                                                    <textarea name="adres" id="adres" class="form-control"></textarea>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="il">İl:</label>
                                                    <input type="text" id="il" class="form-control" name="il">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="ilce">İlçe:</label>
                                                    <input type="text" id="ilce" class="form-control" name="ilce">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="tel">Tel:</label>
                                                    <input type="number" class="form-control" id="atel" name="tel">
                                                </div>
                                                <input type="submit" name="ekle" class="btn btn-danger" value="Ekle">
                                                <input type="submit" name="guncelle" class="btn btn-danger"
                                                       value="Güncelle">
                                            </form>

                                        </div>
                                    </div>
                                @else
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link"> {{$profile_info->ad." ".$profile_info->soyad}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#siparis" id="siparistab" class="nav-link active">Siparişi Tamamla</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#order">Siparişlerim</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#profile">Bilgilerim</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link adress" href="#adress">Adreslerim</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route("frontend.logout")}}">Çıkış Yap</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!--SİPARİŞ-->
                                        <div class="tab-pane fade show active" id="siparis">
                                            <div class="row justify-content-center">
                                                <div class="cart-overview w-75">
                                                    @php $total = 0 @endphp
                                                    @foreach((array) session('cart') as $id => $details)
                                                        @php $total += $details['fiyat'] * $details['miktar'] @endphp
                                                    @endforeach
                                                    <ul>
                                                        <li class="mt-3">
                                                            <span class="pull-left">Ara Toplam</span>
                                                            <p class="pull-right">{{$total}}₺</p>
                                                        </li>
                                                        <li>
                                                            <span class="pull-left">Kargo</span>
                                                            <p class="pull-right">Ücretsiz Teslimat</p>
                                                        </li>
                                                        <li>
                                                            <span class="pull-left">Genel Toplam</span>
                                                            <p class="pull-right">{{$total}}₺</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <form action="{{route("frontend.addorder")}}" class="d-flex row"
                                                      method="post">
                                                    @csrf
                                                    <div class="w-75">
                                                        <label for="adres">Adres</label>
                                                        @if($profile_info->address->count()>0)
                                                            <select name="adres" class="form-control">
                                                                @foreach($profile_info->address as $adress)
                                                                    <option
                                                                        value="{{$adress->id}}">{{$adress->adres}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <ul class="nav nav-tabs">
                                                                <li class="nav-item">
                                                                    <a class="nav-link adress"
                                                                       href="#adress">Adreslerim</a>
                                                                </li>
                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <div class="w-75 mt-3">
                                                        <label for="yontem">Ödeme Yöntemi</label>
                                                        <select name="yontem" class="form-control">
                                                            @foreach($methods as $method)
                                                                <option
                                                                    value="{{$method->id}}">{{$method->ad}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="w-75 mt-3 d-flex justify-content-center">
                                                        <button class="btn btn-danger">Siparişi Tamamla</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--SİPARİŞLERİM-->
                                        <div class="tab-pane fade" id="order">
                                            <table style="font-size: 14px" class="table table-sm">
                                                <thead>
                                                <tr>
                                                    <th>Sipariş Numarası</th>
                                                    <th>Sipariş Tarihi</th>
                                                    <th>Teslimat Tarihi</th>
                                                    <th>Toplam Tutar</th>
                                                    <th>Durum</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{$order->id}}</td>
                                                        <td>{{$order->created_at}}</span></td>
                                                        <td>{{$order->durum_id=="4" ? $order->updated_at:"-"}}</td>
                                                        <td>{{json_decode($order->json)->total}} ₺</td>
                                                        <td>{{$order->status->ad}}</td>
                                                        <td>
                                                            <div class="showMode" style="cursor: pointer;display: none">
                                                                Detayları Gizle <i class="fa fa-angle-up"></i>
                                                            </div>
                                                            <div class="hideMode" style="cursor: pointer">
                                                                Detayları Göster <i class="fa fa-angle-down"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="detailInfo" style="display: none">
                                                        <td colspan="6">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-4 border-right">
                                                                        <h6>Ürünler</h6>
                                                                        <table style="border:0px;width:100%">
                                                                            @foreach(json_decode($order->json)->products as $id=>$product)

                                                                                <tr>
                                                                                    <td style="width: 70px"
                                                                                        class="align-middle">
                                                                                        <img
                                                                                            style="max-height: 92px;max-width: 70px"
                                                                                            src="{{$product->resim}}"
                                                                                            alt="Card image cap">
                                                                                    </td>
                                                                                    <td class="align-middle text-left">
                                                                                        <a href="{{route("frontend.product",$id)}}">{{$product->ad}}</a><br>
                                                                                        {{$product->miktar}}/{{$product->birim}}
                                                                                    </td>
                                                                                    <td class="align-middle">
                                                                                        {{$product->miktar*$product->fiyat}}₺
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-md-4 border-right">
                                                                        <h6>Fiyatlandırmalar</h6>
                                                                        <table style="border: 0px; width: 100%">
                                                                            <tr>
                                                                                <td class="text-left">Ara Toplam :</td>
                                                                                <td class="text-right">{{json_decode($order->json)->total}} ₺</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">Kargo :</td>
                                                                                <td class="text-right">Ücretsiz</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">Toplam :</td>
                                                                                <td class="text-right">{{json_decode($order->json)->total}} ₺</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">Ödeme Yöntemi :
                                                                                </td>
                                                                                <td class="text-right">{{\App\Models\Method::find(json_decode($order->json)->method)->ad}}</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <h6>Teslimat Adresi</h6>
                                                                        <table style="border: 0px; width: 100%">
                                                                            <tr>
                                                                                <td class="text-left">{{$order->adress->adsoyad}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">{{$order->adress->adres}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">
                                                                                    {{$order->adress->il}}/{{$order->adress->ilce}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-left">{{$order->adress->tel}}</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <!--BİLGİLERİM-->
                                        <div class="tab-pane fade" id="profile">
                                            <form action="{{route("frontend.updateprofile")}}" method="post">
                                                @csrf
                                                <h6 class="mt-3">Bilgilerim</h6>
                                                <div class="mb-2">
                                                    <label for="ad">Ad:</label>
                                                    <input type="text" class="form-control" name="ad"
                                                           value="{{$profile_info->ad}}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="soyad">Soyad:</label>
                                                    <input type="text" class="form-control" name="soyad"
                                                           value="{{$profile_info->soyad}}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="tel">Tel:</label>
                                                    <input type="number" class="form-control" name="tel"
                                                           value="{{$profile_info->tel}}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="eposta">Eposta:</label>
                                                    <input type="text" class="form-control" name="eposta"
                                                           value="{{$profile_info->eposta}}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="sifre">Şifre:</label>
                                                    <input type="password" class="form-control" name="sifre">
                                                </div>
                                                <button class="btn btn-danger">Güncelle</button>
                                            </form>
                                        </div>
                                        <!--ADRES-->
                                        <div class="tab-pane fade" id="adress">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Ad Soyad</th>
                                                    <th>Adres</th>
                                                    <th>İl</th>
                                                    <th>İlçe</th>
                                                    <th>Tel</th>
                                                    <th>Düzenle</th>
                                                </tr>
                                                <tbody>
                                                @foreach($profile_info->address as $key=>$address)
                                                    <tr>
                                                        <td data-id="{{$address->id}}">{{$key+1}}</td>
                                                        <td>{{$address->adsoyad}}</td>
                                                        <td>{{$address->adres}}</td>
                                                        <td>{{$address->il}}</td>
                                                        <td>{{$address->ilce}}</td>
                                                        <td>{{$address->tel}}</td>
                                                        <td>
                                                            <a style="cursor: pointer"><i style="color: #ef5350"
                                                                                          class="icofont-refresh adresguncelle"></i></a>
                                                            <a href="{{route("frontend.deleteaddress",$address->id)}}"><i
                                                                    style="color: #ef5350"
                                                                    class="icofont-close-circled"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                </thead>
                                            </table>
                                            <h6 class="mt-3">Adres Ekle/Düzenle</h6>
                                            <form action="{{route("frontend.addaddress")}}" method="post">
                                                @csrf
                                                <input type="hidden" name="kullanici_id" value="{{$profile_info->id}}">
                                                <input type="hidden" id="aid" name="id">
                                                <div class="mb-2">
                                                    <label for="adsoyad">Ad Soyad:</label>
                                                    <input type="text" id="aas" class="form-control" name="adsoyad">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="adres">Adres:</label>
                                                    <textarea name="adres" id="adres" class="form-control"></textarea>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="il">İl:</label>
                                                    <input type="text" id="il" class="form-control" name="il">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="ilce">İlçe:</label>
                                                    <input type="text" id="ilce" class="form-control" name="ilce">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="tel">Tel:</label>
                                                    <input type="number" class="form-control" id="atel" name="tel">
                                                </div>
                                                <input type="submit" name="ekle" class="btn btn-danger" value="Ekle">
                                                <input type="submit" name="guncelle" class="btn btn-danger"
                                                       value="Güncelle">
                                            </form>

                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Shop Cart Page Section ending here -->

@endsection
@section('_js')
    <script>
        $(document).ready(function () {

            $(".guncelle").click(function (e) {
                var miktar = e.target.parentElement.parentElement.parentElement.children[2].children[0].children[2].value;
                var id = e.target.parentElement.getAttribute("data-id");
                window.location.href = "{{route("frontend.updatecart")}}/" + id + "/" + miktar;
            });
            $(".adresguncelle").click(function (e) {
                let data = e.target.parentElement.parentElement.parentElement.children;
                $("#aid").val(data[0].getAttribute("data-id"));
                $("#aas").val(data[1].innerText);
                $("#adres").val(data[2].innerText);
                $("#il").val(data[3].innerText);
                $("#ilce").val(data[4].innerText);
                $("#atel").val(data[5].innerText);
                e.preventDefault();
            })
            $(".nav-tabs a").click(function () {
                if ($(this).attr('class').indexOf("adress") > -1) {
                    $(this).tab('show')
                    var list;
                    list = document.querySelectorAll(".adress");
                    for (var i = 0; i < list.length; ++i) {
                        list[i].classList.add('active');
                    }
                    $("#siparistab").removeClass("active");
                } else {
                    var list;
                    list = document.querySelectorAll(".adress");
                    for (var i = 0; i < list.length; ++i) {
                        list[i].classList.remove('active');
                    }
                }
                $(this).tab('show');
            });

            $(".hideMode").show();
            $(".showMode").hide();

            $(".hideMode").click(function (e) {
                e.target.parentElement.parentElement.classList.add("activeInfo");
                e.target.parentElement.parentElement.nextElementSibling.style.display = "table-row";
                e.target.previousElementSibling.style.display="block";
                $(this).hide();
                e.preventDefault();
            })
            $(".showMode").click(function (e) {
                e.target.parentElement.parentElement.classList.remove("activeInfo");
                e.target.parentElement.parentElement.nextElementSibling.style.display = "none"
                e.target.nextElementSibling.style.display="block";
                $(this).hide();
                e.preventDefault();
            })


        });


    </script>
@endsection
