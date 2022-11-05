@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="de">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/survey.jquery.min.js') }}"></script>

    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('js/surveyjs-widgets.min.js') }}"></script>

    <link href="{{ asset('css/defaultV2.min.css') }}" type="text/css" rel="stylesheet" />
    <style>
        /* .sd-title {
            display: none !important;
        } */
        .sd-body {
            background-color: rgb(31 41 55) !important;
        }
        .sd-panel {
            background-color: rgb(55 65 81) !important;
        }
        .sv-string-viewer {
            color: white !important;
        }
        .sd-btn {
            background-color: rgb(55 65 81) !important;
            color: white !important;
        }
        .sd-progress__bar {
            display: none !important;
        }
        .sd-input {
            background-color: rgb(17, 24, 39);
            color:white;
        }
        .sd-dropdown {
            color: white !important;
        }
        option { 
            color: #fff !important;
        }
    </style>
</head>


<body>
    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">
        @include('layouts.navigation')
        <div class="px-3 sm:px-8 py-3 sm:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

            <div class="overflow-hidden sm:rounded-lg">
                
                <input type=hidden value="{{ $attention }}" id="attention">
                <input type=hidden value="{{ $jahrgang }}" id="jahrgang">

                <script>
                    var attention = $('#attention').val();
                    var jahrgang = $('#jahrgang').val();
                </script>

                @isset($user)
                    <input type=hidden value="{{ $user }}" id="user">
                    <script>
                        var user = JSON.parse($('#user').val());
                        var data = JSON.parse(user.survey_data);
                        if(!data) {
                            data = new Object();
                        }
                        data.vorname = user.vorname;
                        data.nachname = user.nachname;
                    </script>
                @endisset

                <div id="surveyElement"></div>
                <script src="{{ asset('js/survey_admin_mod.js') }}"></script>
                
            </div>

        </div>
    </div>
</body>

@endsection