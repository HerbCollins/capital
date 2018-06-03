<!DOCTYPE html>
<html lang="en-gb">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
</head>

<body>
<div class="container child-page">
    @include('layouts.flash')
    <div class="font-md">
        <div class="panel">
            <div class="panel-body text-center">
                <div class="row">
                    <div class="col-xs-4">
                        <a href="@yield('link')" class="pull-left">
                            <i class="fa fa-fw fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="col-xs-4 text-center">
                        <span><b>@yield('page-name')</b></span>
                    </div>
                    <div class="col-xs-4 text-right">
                        @yield('top-right')
                    </div>
                </div>


            </div>
        </div>
    </div>
    @yield('child-body')
</div>
</body>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('js/toast.js') }}"></script>
@yield('js')
</html>


