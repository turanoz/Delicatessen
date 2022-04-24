<!-- footer section start here -->
<footer>
    <div class="footer-top relative padding-tb bg-ash">
        <div class="shape-images">
            <img src="{{asset('frontend')}}/assets/images/shape-images/03.png" alt="shape-images">
        </div>
        <div class="container">
            <div class="section-wrapper row">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                    <div class="post-item">
                        <div class="footer-logo mb-3">
                            <img style="height: 60px !important;" src="{{$_site->logo}}" alt="footer-logo">
                        </div>
                        <ul class="lab-ul footer-location">
                            <li>
                                <div class="icon-part">
                                    <i class="icofont-phone"></i>
                                </div>
                                <div class="content-part">
                                    <p>0232 325 88 99</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon-part">
                                    <i class="icofont-wall-clock"></i>
                                </div>
                                <div class="content-part">
                                    <p>Hergün 09:00 - 20:00</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon-part">
                                    <i class="icofont-location-pin"></i>
                                </div>
                                <div class="content-part">
                                    <p>Kocaeli Üniversitesi Teknoloji Fakültesi Bilişim Sistemleri Mühendisliği <br>Kocaeli
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <div class="post-item">
                        <div class="post-title">
                            <h5>En çok Satılan Ürünlerimiz</h5>
                        </div>
                        <div class="lab-ul footer-post">
                            @foreach($__products as $__product)
                                <div class="media mb-3">
                                    <div class="fp-thumb mr-3">
                                        @php
                                            $__product->image->count()>0?$_img=$__product->image[mt_rand(0,$__product->image->count()-1)]->yol:$_img="";
                                        @endphp
                                        <img style="width: 100px"
                                             src="{{$_img}}"
                                             alt="{{$__product->ad}}">
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{route("frontend.product",$__product->id)}}">
                                            <h6>{{$__product->ad}}</h6></a>
                                        <h6 style="font-size: 14px"
                                            class="price">{{$__product->fiyat."₺ / ".$__product->unit->ad}}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="post-item">
                        <div class="post-title">
                            <h5>Galeri</h5>
                        </div>
                        <div class="lab-ul footer-gellary">
                            @foreach($__productsimage as $__productimage)
                                <figure class="figure">
                                    @php
                                        $__productimage->image->count()>0?$__img=$__productimage->image[mt_rand(0,$__productimage->image->count()-1)]->yol:$__img="";
                                    @endphp
                                    <a href="{{$__img}}" data-rel="lightcase"><img src="{{$__img}}"
                                                                                   style="height: 115px"
                                                                                   class="img-fluid rounded"
                                                                                   alt="{{$__productimage->ad}}"></a>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
        <div class="container">
            <div class="section-wrapper">
                <p class="text-center">&copy; 2022 <a href="{{route("frontend.index")}}">RT Şarküteri</a>. Tüm Hakları
                    Saklıdır.</p>
            </div>
        </div>
    </div>
</footer>
<!-- footer section start here -->
