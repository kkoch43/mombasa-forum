<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewpoert"
        content="width-device-width, user-scalable-no, initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-COMPATIBLE" content="ie-edge">
    <title>Mombasa Forum</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>

<body>


@include('layouts.partials.navbar')

@yield('banner')

<div class="container">




    <div class="row">
        @include('layouts.partials.errors')
        @include('layouts.partials.success')

        @section('category')
        {{--//category section--}}
@include('layouts.partials.categories')


        @show


        <div class="col-md-9">
            <div class="row content-heading"><h4>@yield('heading')</h4></div>
            <div class="content-wrap well">
                @yield('content')
            </div>
        </div>

    </div>




</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"--}}
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

<!--latest compiled and minified JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>