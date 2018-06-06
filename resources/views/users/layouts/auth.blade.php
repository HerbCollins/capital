<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Capital Plate | Login Page</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="{{ asset('asset_admin/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/style.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/style-responsive.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/css/theme/default.css')}}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('asset_admin/assets/plugins/pace/pace.min.js')}}"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<div class="login-cover">
    <div class="login-cover-image"><img src="{{ asset('asset_admin/assets/img/login-bg/bg-6.jpg')}}" data-id="login-cover-image" alt="" /></div>
    <div class="login-cover-bg"></div>
</div>
<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated fadeIn">
        <!-- begin brand -->
        <div class="login-header">
            <div class="brand">
                <span class="logo"></span> Capital Plate
            </div>
            <div class="icon">
                <i class="fa fa-sign-in"></i>
            </div>
        </div>
        <!-- end brand -->
        @yield('user-auth-page-container')
    </div>
    <!-- end login -->

    {{--<ul class="login-bg-list">
        <li class="active"><a href="#" data-click="change-bg"><img src="{{ asset('asset_admin/assets/img/login-bg/bg-6.jpg')}}" alt="" /></a></li>
    </ul>--}}

</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('asset_admin/assets/plugins/jquery/jquery-1.9.1.min.js')}}"></script>
<script src="{{ asset('asset_admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{ asset('asset_admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js')}}"></script>
<script src="{{ asset('asset_admin/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!--[if lt IE 9]>
<script src="{{ asset('asset_admin/assets/crossbrowserjs/html5shiv.js')}}"></script>
<script src="{{ asset('asset_admin/assets/crossbrowserjs/respond.min.js')}}"></script>
<script src="{{ asset('asset_admin/assets/crossbrowserjs/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{ asset('asset_admin/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('asset_admin/assets/plugins/jquery-cookie/jquery.cookie.js')}}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('asset_admin/assets/js/login-v2.demo.min.js')}}"></script>
<script src="{{ asset('asset_admin/assets/js/apps.min.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

@yield('js')
<script>
    $(document).ready(function() {
        App.init();
        LoginV2.init();
    });
</script>
</body>
</html>
