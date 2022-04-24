
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | Upcube - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("backend")}}/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{asset("backend")}}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset("backend")}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- Toast Css-->
    <link rel="stylesheet" type="text/css" href="{{asset("backend")}}/assets/libs/toastr/build/toastr.min.css">
    <!-- App Css-->
    <link href="{{asset("backend")}}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">
<div class="bg-overlay"></div>
<div class="wrapper-page">
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">

                <div class="text-center mt-4">
                    <div class="mb-3">
                        <a href="{{route("backend.login")}}" class="auth-logo">
                            <img src="{{$_site->logo}}" height="85" class="logo-dark mx-auto" alt="">
                            <img src="{{$_site->logo}}" height="85" class="logo-light mx-auto" alt="">
                        </a>
                    </div>
                </div>

                <div class="p-3">
                    <form class="form-horizontal mt-3" action="{{route("backend.auth")}}">
                        @csrf
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="eposta" class="form-control" type="text" required="" placeholder="E-posta Adresi">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input name="sifre" class="form-control" type="password" required="" placeholder="Şifre">
                            </div>
                        </div>

                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Giriş Yap</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- end -->
            </div>
            <!-- end cardbody -->
        </div>
        <!-- end card -->
    </div>
    <!-- end container -->
</div>
<!-- end -->

<!-- JAVASCRIPT -->
<script src="{{asset("backend")}}/assets/libs/jquery/jquery.min.js"></script>
<script src="{{asset("backend")}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset("backend")}}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{asset("backend")}}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset("backend")}}/assets/libs/node-waves/waves.min.js"></script>
<!-- toastr plugin -->
<script src="{{asset("backend")}}/assets/libs/toastr/build/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        @if(session('success'))
        toastr.success("{{ session('success') }}");
        @endif
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error("{{$error}}");
        @endforeach

        @endif
    });
</script>

<script src="{{asset("backend")}}/assets/js/app.js"></script>

</body>
</html>
