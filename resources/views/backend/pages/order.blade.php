@extends('backend.layouts.app')
@section('title')
    Siparişler
@endsection
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Siparişler</h4>

                    <div class="table-responsive">
                        <table style="font-size: 14px"
                               class="table table-centered mb-0 align-middle table-hover table-nowrap">
                            <thead>
                            <tr>
                                <th>Sipariş Numarası</th>
                                <th>Müşteri Adı Soyadı</th>
                                <th>Durum</th>
                                <th>Sipariş Tarihi</th>
                                <th>Teslimat Tarihi</th>
                                <th>Toplam Tutar</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td><h6 class="mb-0">{{$order->user->ad." ".$order->user->soyad}}</h6></td>
                                    <td>
                                        <div class="font-size-13"><i
                                                class="ri-checkbox-blank-circle-fill font-size-10 {{$order->status->stil}} align-middle me-2"></i>{{$order->status->ad}}
                                        </div>
                                    </td>
                                    <td>{{$order->created_at->format("d-m-Y H:i")}}</span></td>
                                    <td>{{$order->durum_id=="4" ? $order->updated_at->format("d-m-Y H:i"):"-"}}</td>
                                    <td>{{json_decode($order->json)->total}} ₺</td>

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
                                    <td colspan="7">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-4 border-right">
                                                    <h6>Ürünler</h6>
                                                    <table class="table table-sm">
                                                        @foreach(json_decode($order->json)->products as $id=>$product)
                                                            <tr>
                                                                <td style="width: 70px"
                                                                    class="align-middle">
                                                                    <img
                                                                        style="max-height: 92px;max-width: 70px"
                                                                        src="{{$product->resim}}"
                                                                        alt="Card image cap">
                                                                </td>
                                                                <td class="align-middle text-left ">
                                                                    <a class="text-black"
                                                                       href="{{route("frontend.product",$id)}}">{{$product->ad}}</a><br>
                                                                    {{$product->miktar}}/{{$product->birim}}
                                                                </td>
                                                                <td class="align-middle">
                                                                    {{$product->miktar*$product->fiyat}}₺
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6>Fiyatlandırmalar</h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td class="text-left">Ara Toplam :</td>
                                                            <td class="text-right">{{json_decode($order->json)->total}}
                                                                ₺
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Kargo :</td>
                                                            <td class="text-right">Ücretsiz</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Toplam :</td>
                                                            <td class="text-right">{{json_decode($order->json)->total}}
                                                                ₺
                                                            </td>
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
                                                    <table class="table table-sm">
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
                                                    <div class="my-3 ">
                                                        <h6>Sipariş Durumu</h6>
                                                        <form method="post"
                                                              action="{{route("backend.orderupdate",$order->id)}}">
                                                            @csrf
                                                            <div class="input-group">
                                                                <select name="durum_id" class="form-control">
                                                                    @foreach($statuses as $status)
                                                                        @if($order->durum_id==$status->id)
                                                                            <option value="{{$status->id}}"
                                                                                    selected>{{$status->ad}}</option>
                                                                        @else
                                                                            <option
                                                                                value="{{$status->id}}">{{$status->ad}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <button class="btn btn-dark">Güncelle</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div><!-- end card -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section("_js")
    <script>
        $(document).ready(function () {
            $(".hideMode").show();
            $(".showMode").hide();

            $(".hideMode").click(function (e) {
                e.target.parentElement.parentElement.classList.add("activeInfo");
                e.target.parentElement.parentElement.nextElementSibling.style.display = "table-row";
                e.target.previousElementSibling.style.display = "block";
                $(this).hide();
                e.preventDefault();
            })
            $(".showMode").click(function (e) {
                e.target.parentElement.parentElement.classList.remove("activeInfo");
                e.target.parentElement.parentElement.nextElementSibling.style.display = "none"
                e.target.nextElementSibling.style.display = "block";
                $(this).hide();
                e.preventDefault();
            })
        })
    </script>
@endsection
