@extends('frontend.layouts.app')
@section('title') - İletişim @endsection
@section('content')
    <!-- Page Header Section Start Here -->
    <section class="page-header bg_img padding-tb">
        <div class="overlay"></div>
        <div class="container">
            <div class="page-header-content-area">
                <h4 class="ph-title">İletişim</h4>
                <ul class="lab-ul">
                    <li><a href="{{route("frontend.index")}}">Ana</a></li>
                    <li><a class="active">İletişim</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Header Section Ending Here -->

    <!-- Contact Us Section Start Here -->
    <div class="contact-section padding-tb bg-ash">
        <div class="container">
            <div class="contac-top mb-0">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="icofont-google-map"></i>
                            </div>
                            <div class="contact-details">
                                <p>{{$_site->adres->adres}} {{$_site->adres->il}}/{{$_site->adres->ilce}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="icofont-phone"></i>
                            </div>
                            <div class="contact-details">
                                <p>{{$_site->tel}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="icofont-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <p>{{$_site->eposta}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contac-bottom">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-12">
                        <div class="location-map">
                            <div id="map">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Us Section ENding Here -->
@endsection
@section("_js")
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKVmNj1Nrf_6QJxs0WUb-NZSoZo0AvcDs&callback=initMap&v=weekly" defer></script>
@endsection
@section("_css")

    <script>
        let map;
        function initMap() {
            var medan = new google.maps.LatLng({{$_site->harita->lat}}, {{$_site->harita->lng}});
            map = new google.maps.Map(document.getElementById("map"), {
                center: medan,
                zoom: 16,
                clickableIcons:false,
                disableDefaultUI:!0
            });
            marker= new google.maps.Marker({
                position:medan,
                map:map,
                title:"{{$_site->title}}"
            });
        }

        window.initMap = initMap;
    </script>

@endsection
