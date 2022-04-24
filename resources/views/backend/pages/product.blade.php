@extends('backend.layouts.app')
@section('title')
    Ürünler
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" id="new-product" class="dropdown-item"
                               data-bs-toggle="offcanvas" data-bs-target="#newproduct">Yeni Ürün</a>
                            <a href="javascript:void(0);" id="new-category" class="dropdown-item"
                               data-bs-toggle="offcanvas" data-bs-target="#newcategory">Yeni Kategori</a>
                        </div>
                    </div>

                    {{--Ürün Ekle--}}
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1"
                         id="newproduct" aria-labelledby="newproductLabel"
                         aria-hidden="true" style="visibility: hidden;">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="newproductLabel">Yeni Ürün</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="post" action="{{route("backend.addproduct")}}">
                                                @csrf
                                                <input type="hidden" name="satilanmiktar" value="0">
                                                <div class="mb-3">
                                                    <input type="checkbox" id="switch3" name="aktif" switch="bool"
                                                           checked/>
                                                    <label for="switch3" data-on-label="Aktif"
                                                           data-off-label="Pasif"></label>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ad">Ürün Adı:</label>
                                                    <input name="ad" type="text" class="form-control">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="miktar">Stok:</label>
                                                            <input name="miktar" type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="birim_id">Birim:</label>
                                                            <select name="birim_id" class="form-control">
                                                                @foreach($units as $unit)
                                                                    <option value="{{$unit->id}}">{{$unit->ad}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="fiyat">Fiyat:</label>
                                                    <div class="input-group">
                                                        <input name="fiyat" type="number" class="form-control">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₺</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="sub_kategori">Kategori:</label>
                                                    <select id="sub_kategori" name="sub_kategori_id"
                                                            class="form-control">
                                                        @foreach($categories as $category)
                                                            <optgroup label="{{$category->ad}}">
                                                                @foreach($category->sub as $sub)
                                                                    <option value="{{$sub->id}}">{{$sub->ad}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ozet">Özet:</label>
                                                    <textarea class="form-control" name="ozet"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="aciklama">Açıklama:</label>
                                                    <textarea class="form-control"
                                                              name="aciklama"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <button class="btn btn-success btn-lg">Kaydet</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                    {{--Kategori Ekle--}}
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1"
                         id="newcategory" aria-labelledby="newcategoryLabel"
                         aria-hidden="true" style="visibility: hidden;">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="newcategoryLabel">Yeni Kategori</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <!-- Row -->
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Listele</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <label class="label-text" for="kategoriselect">Kategori</label>
                                                    <select id="kategoriselect" class="form-control">
                                                        <option value="">Seçiniz</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->ad}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label class="label-text" for="altkategoriselect">Alt Kategori</label>
                                                    <select id="altkategoriselect" class="form-control">
                                                        <option value="">Seçiniz</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Kategori</h3>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{route("backend.addcategory")}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="label-text" for="ad">Ad</label>
                                                    <input name="ad" class="form-control" type="text">
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-success btn-sm">Kaydet</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Alt Kategori</h3>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{route("backend.addsubcategory")}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="label-text" for="kategori_id">Kategori</label>
                                                    <select class="form-control" name="kategori_id">
                                                        <option value="">Seçiniz</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->ad}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label class="label-text" for="ad">Ad</label>
                                                        <input name="ad" class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-success btn-sm">Kaydet</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Row -->
                        </div>
                    </div>

                    <h4 class="card-title mb-4">Ürünler</h4>

                    <div class="table-responsive">
                        <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                            <thead class="table-light">
                            <tr>
                                <th>Ürün No</th>
                                <th>Ürün Adı</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Durum</th>
                                <th style="width: 120px;">Fiyat</th>
                            </tr>
                            </thead><!-- end thead -->
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><a href="{{route("backend.productdetail",$product->id)}}"
                                           class="text-black">#{{$product->id}}</a></td>
                                    <td><h6 class="mb-0"><a class="text-black"
                                                            href="{{route("backend.productdetail",$product->id)}}">{{$product->ad}}</a>
                                        </h6></td>
                                    <td>
                                        {{$product->subcategory->category->ad}}
                                    </td>
                                    <td>
                                        {{$product->miktar}} {{$product->unit->ad}}
                                    </td>
                                    <td>
                                        <div class="font-size-13"><i
                                                class="ri-checkbox-blank-circle-fill font-size-10 {{$product->aktif==1?"text-success":"text-danger"}} align-middle me-2"></i>{{$product->aktif==1?"Aktif":"Pasif"}}
                                        </div>
                                    </td>
                                    <td>{{$product->fiyat}}₺</td>
                                </tr>
                            @endforeach

                            <!-- end -->
                            </tbody><!-- end tbody -->
                            <caption>
                                <div class="d-flex justify-content-end">

                                    {{$products->links()}}
                                </div>

                            </caption>
                        </table> <!-- end table -->
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
            $('#sub_kategori').select2();
            $("#kategoriselect").change(function (e) {
                e.preventDefault();
                const kategori = $("#kategoriselect").val();
                if (kategori!="")
                {
                    $.ajax({
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        url: "{{route("backend.listsubcategory")}}",
                        data: {
                            kategori: kategori,
                        },
                        success: function (data) {
                            $("#altkategoriselect").html(`<option value="">Seçiniz</option>`);
                            for (var i=0;i<data.length;i++){
                                var html=`<option value="${data[i]['kategori_id']}">${data[i]['ad']}</option>`;
                                $("#altkategoriselect").append(html);
                            }
                        }
                    });
                }else {
                    $("#altkategoriselect").html(`<option value="">Seçiniz</option>`);
                }

            });



        });
    </script>
@endsection
