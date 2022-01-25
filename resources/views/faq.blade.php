<!DOCTYPE html>
<html lang="utf-8">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>digi:match - Finden Sie Ihren DaZ-Buddy</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        <style type="text/css">

            summary::marker { color: transparent !important; }
            summary:focus {
                outline-style: none !important;
            }

            details
            {
                transition: margin .1s ease-in-out;
                overflow: hidden;
            }

            details[open] summary ~ * {
                animation: sweep .1s ease-in-out;
            }

            details:not([open]) summary ~ * {
                animation: sweep .1s ease-in-out;
            }

            @keyframes sweep {
                0%    {margin: -5px 0 0 0;}
                100%  {margin: 0px 0 0 0;}
            }

        </style>

    </head>

    <body class="bg-white">

    	@include('layouts.header')

    	@include('faq.general')

		@include('layouts.footer')

    </body>

</html>