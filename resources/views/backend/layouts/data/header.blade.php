<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route("backend.index")}}" class="logo">
                                <span class="logo-sm">
                                    <img src="{{$_site->logo}}"
                                         height="20">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{$_site->logo}}"
                                         height="40">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

        </div>

        <div class="d-flex">


            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                         src="{{json_decode(\Illuminate\Support\Facades\Session::get("admin")->json,true)['img']}}">
                    <span
                        class="d-none d-xl-inline-block ms-1">{{\Illuminate\Support\Facades\Session::get("admin")->ad}} {{\Illuminate\Support\Facades\Session::get("admin")->soyad}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route("backend.profile")}}"><i class="ri-user-line align-middle me-1"></i> Profil</a>
                    <a class="dropdown-item d-block" href="{{route("backend.setting")}}">
                        <i class="ri-settings-2-line align-middle me-1"></i> Ayarlar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{route("backend.logout")}}"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i> Çıkış Yap</a>
                </div>
            </div>


        </div>
    </div>
</header>
