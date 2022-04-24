<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <title>{{$_site->title}} - Admin - @yield("title")</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("backend")}}/assets/images/favicon.ico">

    <!-- jquery.vectormap css -->
    <link href="{{asset("backend")}}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
          rel="stylesheet" type="text/css"/>

    <!-- DataTables -->
    <link href="{{asset("backend")}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="{{asset("backend")}}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>

    @yield('_css')

    <!-- Bootstrap Css -->
    <link href="{{asset("backend")}}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset("backend")}}/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset("backend")}}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css"/>
    <!-- Toast Css-->
    <link rel="stylesheet" type="text/css" href="{{asset("backend")}}/assets/libs/toastr/build/toastr.min.css">

    <!-- select2 plugin -->
    <link href="{{asset("backend")}}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">

</head>

<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">


    @include('backend.layouts.data.header')

    @include('backend.layouts.data.nav')




    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">@yield("title")</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">RT Şarküteri</a></li>
                                    <li class="breadcrumb-item active">@yield("title")</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                @yield('content')


            </div>
        </div>
        <!-- End Page-content -->


        @include('backend.layouts.data.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
<script src="{{asset("backend")}}/assets/libs/jquery/jquery.min.js"></script>
<script src="{{asset("backend")}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset("backend")}}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{asset("backend")}}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset("backend")}}/assets/libs/node-waves/waves.min.js"></script>

<!-- toastr plugin -->
<script src="{{asset("backend")}}/assets/libs/toastr/build/toastr.min.js"></script>

<!-- select2 plugin -->
<script src="{{asset("backend")}}/assets/libs/select2/js/select2.min.js"></script>

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
@yield('_js')
<script src="{{asset("backend")}}/assets/js/app.js"></script>


</body>

</html>
