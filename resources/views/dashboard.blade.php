@extends ('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'digi:match') }}</title>


        <!-- Trumbowyg -->
        <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="trumbowyg/dist/trumbowyg.min.js"></script>
        <script type="text/javascript" src="trumbowyg/dist/langs/de.js"></script>

        <!-- Trumbowyg -->

        <style type="text/css">
            .trumbowyg-editor a {
                color: rgb(124, 58, 237);
                text-decoration: underline;
            }
            .trumbowyg-button-pane .trumbowyg-button-group::after {
                display: none !important;
            }
        </style>

    </head>

    <body>

		<div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

            <!-- Nav -->

            @include('layouts.navigation')

            <!-- Nav -->

            <!-- Inhalt -->

            <div class="px-3 sm:px-8 py-8 text-gray-700 w-screen sm:rounded-r-lg" style="background-color: #EDF2F7;">

                <div class="overflow-hidden sm:rounded-lg">

                    <div class="grid justify-items-center sm:justify-items-start select-none">

                        <h2 class="text-lg leading-6 font-medium text-gray-900">

                          Mein Bereich

                        </h2>

                        <p class="mt-1 text-sm text-gray-500 grid text-center sm:text-left">

                          Detaillierte Informationen und Anmerkungen zur Person. Ihre Eingaben sind für Lehrkräfte einsehbar und helfen dabei, eine passende Auswahl zu treffen.

                        </p>

                    </div>

                    <!-- Content -->
            
                    <div class="block items-center justify-center py-4 mx-auto mt-0 md:mt-6 rounded-md">

                        <div class="grid bg-white rounded-lg">

                            <!-- Beschreibung: Editor -->

                            <div class="grid grid-cols-1 my-5 px-2 sm:px-4 text-sm bg-white text-center sm:text-left">

                                <p class="font-medium text-gray-800 leading-none">Beschreibung</p>

                                <p class="text-xs text-gray-500 mt-1 mb-4">Näheres zur Person (Interessen / persönliche Motivation)</p>

                            </div>


                            <!-- Beschreibung: Editor -->

                        </div>

                    </div>

                <!-- Content -->     

                </div>

            </div>         

      	</div>

        <script type="text/javascript">
            // aqui el el nombre de la Variable donde quiero el editor Ejemplo Descripcion
            $('#editor').trumbowyg({
                lang: 'de',
                btns: [
                    //['viewHTML'],
                    ['undo', 'redo'], // Only supported in Blink browsers
                    ['h2','h3','p'],
                    ['strong', 'em'],
                    ['link'],
                    //['insertImage'],
                    //['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList'],
                    //['horizontalRule'],
                    //['removeformat'],
                    ['fullscreen']
                ],
                tagClasses: {
                    h2: 'text-3xl',
                    h3: 'text-2xl',
                    //h4: 'text-xl',
                }
                            //resetCss: true,
            });
        </script>

    </body>

</html>

@endsection