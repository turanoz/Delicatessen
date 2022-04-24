@extends('backend.layouts.app')
@section('title')
    Gösterge Paneli
@endsection

@section('content')

<!-- end page title -->
    <div class="row">
        <div class="col-xl-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">Toplam Ürün</p>
                            <h4 class="mb-2">{{\App\Models\Product::get()->count()}}</h4>
                        </div>
                        <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-shopping-cart-2-line font-size-24"></i>
                                                </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">Toplam Sipariş</p>
                            <h4 class="mb-2">{{\App\Models\Order::get()->count()}}</h4>
                        </div>
                        <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-usd font-size-24"></i>
                                                </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-truncate font-size-14 mb-2">Toplam Kullanıcı</p>
                            <h4 class="mb-2">{{\App\Models\User::get()->count()}}</h4>
                        </div>
                        <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-user-3-line font-size-24"></i>
                                                </span>
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Son Siparişler</h4>

                    <div class="table-responsive">
                        <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                            <thead class="table-light">
                            <tr>
                                <th>Sipariş No</th>
                                <th>Müşteri Adı Soyadı</th>
                                <th>Durum</th>
                                <th>Sipariş Tarihi</th>
                                <th>Teslimat Tarihi</th>
                                <th style="width: 120px;">Toplam Tutar</th>
                            </tr>
                            </thead><!-- end thead -->
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>#{{$order->id}}</td>
                                    <td><h6 class="mb-0">{{$order->user->ad." ".$order->user->soyad}}</h6></td>

                                    <td>
                                        <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 {{$order->status->stil}} align-middle me-2"></i>{{$order->status->ad}}</div>
                                    </td>
                                    <td>
                                        {{$order->created_at->format("d-m-Y H:i")}}
                                    </td>
                                    <td>
                                        {{$order->status->id==4?$order->updated_at->format("d-m-Y H:i"):"-"}}
                                    </td>
                                    <td>{{json_decode($order->json)->total}}₺</td>
                                </tr>
                            @endforeach

                            <!-- end -->
                            </tbody><!-- end tbody -->
                        </table> <!-- end table -->
                    </div>
                </div><!-- end card -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
