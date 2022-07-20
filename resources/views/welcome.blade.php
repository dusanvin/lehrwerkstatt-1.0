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

                        <div class="flex items-center"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 16" class="h-7 w-7 -mt-2 flex-shrink-0"><path fill-rule="evenodd" clip-rule="evenodd" d="M25.517 0C18.712 0 14.46 3.382 12.758 10.146c2.552-3.382 5.529-4.65 8.931-3.805 1.941.482 3.329 1.882 4.864 3.432 2.502 2.524 5.398 5.445 11.722 5.445 6.804 0 11.057-3.382 12.758-10.145-2.551 3.382-5.528 4.65-8.93 3.804-1.942-.482-3.33-1.882-4.865-3.431C34.736 2.92 31.841 0 25.517 0zM12.758 15.218C5.954 15.218 1.701 18.6 0 25.364c2.552-3.382 5.529-4.65 8.93-3.805 1.942.482 3.33 1.882 4.865 3.432 2.502 2.524 5.397 5.445 11.722 5.445 6.804 0 11.057-3.381 12.758-10.145-2.552 3.382-5.529 4.65-8.931 3.805-1.941-.483-3.329-1.883-4.864-3.432-2.502-2.524-5.398-5.446-11.722-5.446z" fill="#7C3AED"></path></svg> <p class="text-xl ml-2">Lehr:<strong>werkstatt</strong> an der Universität Augsburg</p></div>

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

                            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">

                                <span class="block xl:inline">{{ Config::get('site_vars.welcomeString1') }}</span>

                                <span class="block text-yellow-600 xl:inline">{{ Config::get('site_vars.welcomeString2') }}</span>

                            </h1>

                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">

                                Bilden Sie im Rahmen der 

                                    <a class="text-yellow-600 font-bold" href="#" target="_blank"><em>Augsburger {{ Config::get('site_vars.platformName1') }}{{ Config::get('site_vars.platformName2') }}</em></a> 

                                Tandems. <br><strong>Für Studierende und Lehrer*innen.</strong>

                            </p>

                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">

                                <div class="rounded-md shadow">

                                    <a href="{{ route('register') }}" class="transition duration-300 ease-in-out w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 md:py-4 md:text-lg md:px-10">

                                        Registrieren

                                    </a>

                                </div>

                                <div class="mt-3 sm:mt-0 sm:ml-3">

                                    <a href="{{ route('login') }}" class="transition duration-300 ease-in-out w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-yellow-600 bg-yellow-100 hover:bg-yellow-200 md:py-4 md:text-lg md:px-10">

                                        Anmelden

                                    </a>

                                </div>

                            </div>

                            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-sm sm:max-w-xl sm:mx-auto md:mt-5 md:text-sm lg:mx-0">

                            Informationen und FAQ zur Lehr:werkstatt an der Universität Augsburg finden Sie 

                                <a class="text-yellow-600 font-bold" href="https://www.uni-augsburg.de/zlbib/lehrwerkstatt" target="_blank"><em>hier</em></a>. 

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