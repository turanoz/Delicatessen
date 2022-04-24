@extends('backend.layouts.app')
@section('title')
    Ayarlar
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{route("backend.updatesetting")}}">
                        @csrf
                        <div class="mb-3">
                            <label for="title">Site Adı</label>
                            <input name="title" type="text" class="form-control" value="{{$setting->title}}">
                        </div>
                        <div class="row">
                            <label for="">Çalışma Saatleri</label>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="baslangic">Başlangıç</label>
                                    <input name="baslangic" type="text" class="form-control"
                                           value="{{$setting->isgunu->baslangic}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="bitis">Bitiş</label>
                                    <input name="bitis" type="text" class="form-control"
                                           value="{{$setting->isgunu->bitis}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="period">Periyod</label>
                                    <input name="period" type="text" class="form-control"
                                           value="{{$setting->isgunu->period}}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="logo">Logo</label>
                            <img id="logo-img" class="d-block my-3" height="75" src="{{$setting->logo}}" onclick="document.getElementById('logo').click()">

                            <p class="card-title-desc">Değiştirmek için logoya tıklayın.</p>

                            <input type='file' id="logo" name="logo" accept='image/*' onchange='openFile(event)' style="display:none">

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
                        <div class="mb-3">
                            <label for="eposta">E-posta</label>
                            <input name="eposta" type="email" class="form-control" value="{{$setting->eposta}}">
                        </div>
                        <div class="mb-3">
                            <label for="tel">Telefon Numarası</label>
                            <input name="tel" type="text" class="form-control" value="{{$setting->tel}}">
                        </div>
                        <div class="mb-3">
                            <label for="adres">Adres</label>
                            <input name="adres" type="text" class="form-control" value="{{$setting->adres->adres}}">
                        </div>
                        <div class="mb-3">
                            <label for="il">İl</label>
                            <input name="il" type="text" class="form-control" value="{{$setting->adres->il}}">
                        </div>
                        <div class="mb-3">
                            <label for="ilce">İlçe</label>
                            <input name="ilce" type="text" class="form-control" value="{{$setting->adres->ilce}}">
                        </div>
                        <div class="mb-3">
                            <div id="map"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="latitude">Latitude</label>
                                    <input id="lat" name="lat" type="text" class="form-control"
                                           value="{{$setting->harita->lat}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="longitude">Longitude:</label>
                                    <input id="lng" name="lng" type="text" class="form-control"
                                           value="{{$setting->harita->lng}}">
                                </div>
                            </div>
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
@section("_css")
    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        #map iframe {
            height: 100%;
            width: 100%;
            border: none;
        }

    </style>

@endsection
@section('_js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKVmNj1Nrf_6QJxs0WUb-NZSoZo0AvcDs&callback=loadmap"
            defer></script>


    <script type="text/javascript">
        function loadmap() {
            var medan = new google.maps.LatLng({{$setting->harita->lat}}, {{$setting->harita->lng}});
            var marker;
            var map;

            var mapOptions = {
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: medan
            };
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                title: "{{$setting->title}}",
                position: medan
            });
            google.maps.event.addListener(marker, 'dragend', function () {
                var markerlocation = marker.getPosition();
                $('#lat').val(markerlocation.lat().toString());
                $('#lng').val(markerlocation.lng().toString());
            });
        }


    </script>

@endsection

