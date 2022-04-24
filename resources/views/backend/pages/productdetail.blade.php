@extends('backend.layouts.app')
@section('title')
    {{$product->ad}}
@endsection

@section("_css")
    <link href="{{asset("backend")}}/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("backend")}}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Galeri</h4>
                    <p class="card-title-desc">Yeni bir resim eklemek için <span id="image-add"
                                                                                 style="cursor: pointer; text-decoration: underline">buraya</span>
                        tıklayın. </p>

                    <input id="image-add-file" accept="image/*" type="file" style="display: none">

                    <div style="position: relative" class="popup-gallery ">
                        @foreach($product->image as $image)

                            <span class="image-delete" data-url="{{route("backend.deleteproductimage",$image->id)}}"
                                  style="cursor: pointer; position: absolute; top: -13px; margin-left: 234px">
                                    <i class="dripicons-document-delete text-danger font-size-17 font-weight-bold"></i>
                                </span>
                            <span class="image-update"
                                  style="cursor: pointer;position: absolute; top: -13px; margin-left: 218px">
                                    <i class="dripicons-document-edit text-warning font-size-17 font-weight-bold"></i>
                                </span>

                            <input class="image-update-file" data-img_id="{{$image->id}}" data-prd_id="{{$product->id}}"
                                   accept="image/*" type="file" style="display: none">

                            <a class="float-start" href="{{$image->yol}}">
                                <div class="img-fluid">
                                    <img src="{{$image->yol}}" height="250">
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route("backend.updateproduct",$product->id)}}">
                        @csrf
                        <div class="mb-3">
                            <label for="aktif">Aktif:</label>
                            <select name="aktif" class="form-control">
                                @if($product->aktif=="1")
                                    <option value="1" selected>Aktif</option>
                                    <option value="0">Pasif</option>
                                @else
                                    <option value="0" selected>Pasif</option>
                                    <option value="1">Aktif</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ad">Ürün Adı:</label>
                            <input name="ad" type="text" class="form-control" value="{{$product->ad}}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="miktar">Stok:</label>
                                    <input name="miktar" type="text" class="form-control" value="{{$product->miktar}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="birim_id">Birim:</label>
                                    <select name="birim_id" class="form-control">
                                        @foreach($units as $unit)
                                            @if($unit->id==$product->birim_id)
                                                <option selected value="{{$unit->id}}">{{$unit->ad}}</option>
                                            @else
                                                <option value="{{$unit->id}}">{{$unit->ad}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fiyat">Fiyat:</label>
                            <div class="input-group">
                                <input name="fiyat" type="number" class="form-control" value="{{$product->fiyat}}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₺</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="kategori">Kategori:</label>
                            <select id="kategori" name="sub_kategori_id" class="form-control">
                                @foreach($categories as $category)
                                    <optgroup label="{{$category->ad}}">
                                        @foreach($category->sub as $sub)
                                            @if($product->sub_kategori_id==$sub->id)
                                                <option selected value="{{$sub->id}}">{{$sub->ad}}</option>
                                            @else
                                                <option value="{{$sub->id}}">{{$sub->ad}}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ozet">Özet:</label>
                            <textarea id="ozet" name="ozet">{{$product->ozet}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="aciklama">Açıklama:</label>
                            <textarea id="aciklama" name="aciklama">{{$product->aciklama}}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-success btn-lg">Kaydet</button>
                            <a href="{{route("backend.deleteproduct",$product->id)}}" class="btn btn-danger btn-lg">Sil</a>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection

@section('_js')



    <!-- Magnific Popup-->
    <script src="{{asset("backend")}}/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- lightbox init js-->
    <script src="{{asset("backend")}}/assets/js/pages/lightbox.init.js"></script>

    <!--tinymce js-->
    <script src="{{asset("backend")}}/assets/libs/tinymce/tinymce.min.js"></script>

    <!-- init js -->
    <script src="{{asset("backend")}}/assets/js/pages/form-editor.init.js"></script>


    <script src="{{asset("backend")}}/assets/libs/select2/js/select2.min.js"></script>



    <script>
        $(document).ready(function () {

            $("#image-add").click(function (e) {
                $("#image-add-file").click();
                e.preventDefault();
            })
            $("#image-add-file").change(function (e) {

                let img = $(this)[0].files;

                if (img.length > 0) {
                    var fd = new FormData();
                    // Append data
                    fd.append('img', img[0]);
                    fd.append('_token', '{{csrf_token()}}');

                    $.ajax({
                        url: "{{route("backend.addproductimage",$product->id)}}",
                        method: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {
                            if (data["type"] == "success") {
                                toastr.success(data["msg"]);
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }
                        }
                    });
                }

                e.preventDefault();

            })
            $(".image-update").click(function (e) {
                e.target.parentElement.nextElementSibling.click();
                e.preventDefault();
            })
            $(".image-update-file").change(function (e) {

                let img = $(this)[0].files;
                let img_id = $(this).attr("data-img_id");
                let prd_id = $(this).attr("data-prd_id");

                if (img.length > 0) {
                    var fd = new FormData();
                    // Append data
                    fd.append('img', img[0]);
                    fd.append('img_id', img_id);
                    fd.append('prd_id', prd_id);
                    fd.append('_token', '{{csrf_token()}}');

                    $.ajax({
                        url: "{{route("backend.updateproductimage")}}",
                        method: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {
                            if (data["type"] == "success") {
                                toastr.success(data["msg"]);
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }
                        }
                    });
                }

                e.preventDefault();

            })
            $(".image-delete").click(function (e) {
                window.location.href = $(this).attr("data-url");
                e.preventDefault();
            })
            $('#kategori').select2();

        })
    </script>

@endsection
