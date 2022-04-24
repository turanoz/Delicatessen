@extends('backend.layouts.app')
@section('title')
    Profil Düzenle
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route("backend.updateprofile")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="logo">Logo</label>
                            <img id="logo-img" class="d-block my-3" height="75" src="{{json_decode($profile->json)->img}}" onclick="document.getElementById('logo').click()">

                            <p class="card-title-desc">Değiştirmek için resime tıklayın.</p>

                            <input type='file' id="logo" name="img" accept='image/*' onchange='openFile(event)' style="display:none">

                            <script>
                                var openFile = function(file) {
                                    var input = file.target;
                                    console.log(input)

                                    var reader = new FileReader();
                                    reader.onload = function(){
                                        var dataURL = reader.result;
                                        console.log(dataURL)
                                        var output = document.getElementById('logo-img');
                                        output.src = dataURL;
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                };
                            </script>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ad">Ad:</label>
                                    <input name="ad" type="text" class="form-control" value="{{$profile->ad}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="soyad">Soyad:</label>
                                    <input name="soyad" type="text" class="form-control" value="{{$profile->soyad}}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="eposta">Eposta:</label>
                            <input name="eposta" type="email" class="form-control" value="{{$profile->eposta}}">
                        </div>
                        <div class="mb-3">
                            <label for="sifre">Şifre:</label>
                            <input name="sifre" type="password" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-success btn-lg">Kaydet</button>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
