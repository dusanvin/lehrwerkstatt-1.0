<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ Config::get('site_vars.platformName1') }}{{ Config::get('site_vars.platformName2') }} - {{ Config::get('site_vars.welcomeString1') }} {{ Config::get('site_vars.welcomeString2') }}</title>

        <!-- Styles -->

        <style>

            body {
                font-family: 'Nunito', sans-serif;
            }

        </style>

        <!--CSS        

        <link rel="stylesheet" href="https://tailwindui.com/css/components-v2.css?id=f3889d577d4cc5a215ba"> -->
        <link rel="icon" href="{{ url('img/favicon.png') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        <!--CSS -->

    </head>

    <body class="antialiased bg-white">

        <!-- Reduziertes Nav 48:15 -->

        <nav class="p-3 bg-white flex justify-between max-w-7xl mx-auto">

            <ul class="flex items-center">

                <li class="p-3">

                    <!-- Logo -->

                    <a href="\">

                        <div class="flex items-center">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-7 w-7 fill-current text-yellow-600 flex-shrink-0"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 288c0 35.35-21.49 64-48 64c-32.43 0-31.72-32-55.64-32C394.9 320 384 330.9 384 344.4V480c0 17.67-14.33 32-32 32h-71.64C266.9 512 256 501.1 256 487.6C256 463.1 288 464.4 288 432c0-26.51-28.65-48-64-48s-64 21.49-64 48c0 32.43 32 31.72 32 55.64C192 501.1 181.1 512 167.6 512H32c-17.67 0-32-14.33-32-32v-135.6C0 330.9 10.91 320 24.36 320C48.05 320 47.6 352 80 352C106.5 352 128 323.3 128 288S106.5 223.1 80 223.1c-32.43 0-31.72 32-55.64 32C10.91 255.1 0 245.1 0 231.6v-71.64c0-17.67 14.33-31.1 32-31.1h135.6C181.1 127.1 192 117.1 192 103.6c0-23.69-32-23.24-32-55.64c0-26.51 28.65-47.1 64-47.1s64 21.49 64 47.1c0 32.43-32 31.72-32 55.64c0 13.45 10.91 24.36 24.36 24.36H352c17.67 0 32 14.33 32 31.1v71.64c0 13.45 10.91 24.36 24.36 24.36c23.69 0 23.24-32 55.64-32C490.5 223.1 512 252.7 512 288z"/></svg>

                            <p class="text-xl ml-2">

                                Lehr:<strong>werkstatt</strong>

                            </p>

                        </div>

                    </a>

                    <!-- Logo -->

                </li>

            </ul>

        </nav>

        <!-- Reduziertes Nav -->

        <!-- Hero -->

        <div class="relative bg-white overflow-hidden mt-0">

            <div class="max-w-7xl mx-auto">

                <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">

                    <!-- White Triangle -->

                    <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">

                        <polygon points="50,0 100,0 50,100 0,100" />

                    </svg>

                    <!-- White Triangle -->

                    <!-- Ausrichtung Hero-Image -->

                    <div>

                        <div class="relative pt-6 px-4 sm:px-6 lg:px-8"></div>

                        <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden hidden"></div>

                    </div>

                  <!-- Ausrichtung Hero-Image -->

                    <main class="mt-0 mb-10 sm:mb-0 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">

                        <div class="text-base text-center md:text-left lg:text-left xl:text-left 2xl:text-left sm:max-w-xl sm:mx-auto lg:mx-0">

                            <h1 class="text-2xl sm:text-4xl tracking-tight font-extrabold text-gray-800 sm:text-5xl md:text-6xl">

                                <span class="block xl:inline">{{ Config::get('site_vars.welcomeString1') }}</span>

                                <span class="block text-yellow-600 xl:inline">{{ Config::get('site_vars.welcomeString2') }}</span>

                            </h1>

                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">

                                Bilden Sie im Rahmen der 

                                    <a class="text-yellow-600 font-bold" href="https://www.uni-augsburg.de/de/forschung/einrichtungen/institute/zlbib/lehrwerkstatt/" target="_blank"><em>Augsburger {{ Config::get('site_vars.platformName1') }}{{ Config::get('site_vars.platformName2') }}</em></a> 

                                Tandems. <br><strong>Für Studierende und Lehrer*innen.</strong>

                            </p>

                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">

                                <div class="rounded-md shadow">

                                    <a href="{{ route('register') }}" class="transition duration-300 ease-in-out w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 md:py-4 md:text-lg md:px-10">

                                        Registrieren

                                    </a>

                                </div>

                                <div class="mt-3 sm:mt-0 sm:ml-3">

                                    <a href="{{ route('login') }}" class="transition duration-300 ease-in-out w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-600 bg-white hover:bg-yellow-200 md:py-4 md:text-lg md:px-10">

                                        Anmelden

                                    </a>

                                </div>

                            </div>

                            <p class="mt-5 text-gray-500 sm:max-w-xl sm:mx-auto text-sm">

                            Informationen und FAQ zur Lehr:werkstatt an der Universität Augsburg finden Sie 

                                <a class="text-yellow-600" href="https://www.uni-augsburg.de/zlbib/lehrwerkstatt" target="_blank">hier</a>. 

                            </p>

                        </div>

                    </main>

                </div>

            </div>

            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">

                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ Config::get('site_vars.welcomeImg') }}"></img>

            </div>

        </div>

        <!-- Hero -->


        @include('layouts.footer')
    

        <!-- JS -->

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer=""></script>

        <!-- JS -->

    </body>

</html>