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

                            <div class="grid grid-cols-1 mt-5 mx-7 text-sm">

                                <p class="font-medium text-gray-800 leading-none">Beschreibung</p>

                                <p class="text-xs text-gray-500 mt-1 mb-2">Näheres zur Person (Interessen / persönliche Motivation)</p>

                                <textarea class="form-control" id="mytextarea" name="Beschreibung zur Person"></textarea>

                            </div>

                            <!-- Beschreibung: Editor -->

                            <div class="grid grid-cols-1 mt-5 mx-7 text-sm">

                                  <label class="text-gray-500 text-light">

                                    <p class="font-medium text-gray-800 leading-none">Bild hochladen</p>

                                    <p class="text-xs text-gray-500 mt-1 mb-2">Hinzufügen einer Fotografie</p>

                                </label>
                                <div class='flex items-center justify-center w-full'>
                                    <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                        <div class='flex flex-col items-center justify-center pt-7'>
                                          <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                          <p class='uppercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Foto auswählen</p>
                                        </div>
                                      <input type='file' class="hidden" />
                                    </label>
                                </div>
                            </div>

                            <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5 rounded-md shadow text-sm'>

                              <button class='border border-transparent w-auto text-purple-700 bg-purple-100 hover:bg-purple-200 rounded-lg font-medium text-white px-4 py-2 shadow'>Abbrechen</button>

                              <button class='border border-transparent w-auto bg-purple-600 hover:bg-purple-700 rounded-lg font-medium text-white px-4 py-2 shadow'>Speichern</button>

                            </div>

                        </div>
                    </div>

                <!-- Content -->     

                </div>

            </div>         

      	</div>

    </body>

</html>

@endsection