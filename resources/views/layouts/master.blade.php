<!DOCTYPE html>
<html lang="utf-8">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'digi:match') }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    </head>

    <body class="" style="">

        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')

    </body>
 <!-- rgba(17, 24, 39, 0.9) -->
</html>