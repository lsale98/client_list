<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Evidencija klijenata</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b74812e088.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="row m-0">
        <div class="col-lg-2 col-md-2 col-sm-12 p-0 fixed-top">
            @include('includes.navbar')
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 p-0 offset-md-2">
            @yield('content')
        </div>
    </div>

</body>

</html>
