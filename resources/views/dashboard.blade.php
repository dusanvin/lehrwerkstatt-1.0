@extends ('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'digi:match') }}</title>
        <style type="text/css">

            .tox-tinymce {
                border-radius: 8px;
            }
        </style>

        <!-- TinyMCE -->

        <script src="https://cdn.tiny.cloud/1/yglw8k1k9swezrnu7oo8rn67dk5kdpbfx8t40xmq239tng93/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <script>

            tinymce.init({

                selector: '#mytextarea',

                height: 300,

                language: 'de',

                menubar: false,

                branding: false,

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],

                toolbar: 'undo redo | formatselect | ' + 'bold italic | bullist numlist | ' + 'removeformat | help',

                content_style: 'body { font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; font-size:14px }'

            });

        </script>

        <!-- TinyMCE -->

    </head>

    <body style="background-color: white;">

		<div class="flex flex-row h-full mx-5 mt-10 mb-10">

			<!-- Nav -->

		    @include('layouts.navigation')

		    <!-- Nav -->
		    
		    <!-- Content -->

            <div class="px-8 py-8 text-gray-700 w-screen bg-white rounded-r-lg shadow-b border-b border-gray-200" style="background-color: #EDF2F7;">

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">

                    <div class="px-4 py-5 sm:px-6">

                        <h2 class="text-lg leading-6 font-medium text-gray-900">

                          Mein Bereich

                        </h2>

                        <p class="mt-1 text-sm text-gray-500">

                          Detaillierte Informationen und Anmerkungen zur Person. Ihre Eingaben sind für Lehrkräfte einsehbar und helfen dabei, eine passende Auswahl zu treffen.

                        </p>

                    </div>

                    <!-- Content -->
            
                    <div class="block items-center justify-center">

                        <div class="grid bg-white rounded-lg">

                            <!-- Beschreibung: Editor -->

                            <div class="grid grid-cols-1 my-5 mx-7 text-sm">

                                <p class="font-medium text-gray-800 leading-none">Beschreibung</p>

                                <p class="text-xs text-gray-500 mt-1 mb-2">Näheres zur Person (Interessen / persönliche Motivation)</p>

                                <textarea class="form-control" id="mytextarea" name="Beschreibung zur Person"></textarea>

                            </div>

                            <!-- Beschreibung: Editor -->

                        </div>

                    </div>

                <!-- Content -->     

                </div>

            </div>         

      	</div>

    </body>

</html>

@endsection