<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>digi:match - Finden Sie Ihr Praktikum</title>

        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Fonts -->

        <!-- Styles -->

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>

            body {
                font-family: 'Nunito', sans-serif;
            }

        </style>

        <!-- Styles -->

        <!-- CSS -->

        <link rel="stylesheet" href="https://tailwindui.com/css/components-v2.css?id=f3889d577d4cc5a215ba">

        <!-- CSS -->

    </head>

    <!-- https://tailwindui.com/components/marketing/sections/heroes -->
    <!-- https://www.creative-tim.com/learning-lab/tailwind-starter-kit/documentation/css/pagination/with-numbers -->
    <!-- Tooltips: https://codepen.io/t7team/pen/XWdyVyB -->

    <body class="antialiased bg-white mt-2">

        <!-- Reduziertes Nav 48:15 -->

        @include('layouts.header')

        <!-- Reduziertes Nav -->

<!-- Hero -->

<div class="relative bg-white overflow-hidden mt-2">

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

            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">

                <div class="text-center md:text-left lg:text-left xl:text-left 2xl:text-left">

                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">

                        <span class="block xl:inline">Finden Sie Ihr*e</span>

                        <span class="block text-purple-600 xl:inline">Helfer*in</span>

                    </h1>

                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">

                        Das <em>digi:match</em> ist eine Plattform des DigiLLab der Uni Augsburg, um Helfer*innen zu finden. Für Studierende und Schulen. <strong>Kostenfrei und DSGVO-konform.</strong>

                    </p>

                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">

                        <div class="rounded-md shadow">

                            <a href="{{ route('register') }}" class="transition duration-300 ease-in-out w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 md:py-4 md:text-lg md:px-10">

                                Registrieren

                            </a>

                        </div>

                        <div class="mt-3 sm:mt-0 sm:ml-3">
                  
                            <a href="{{ route('login') }}" class="transition duration-300 ease-in-out w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 md:py-4 md:text-lg md:px-10">

                                Anmelden

                            </a>

                        </div>

                    </div>

                </div>

            </main>
        
        </div>
      
    </div>
          
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">

        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.pexels.com/photos/5212320/pexels-photo-5212320.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="">

    </div>
        
</div>

<!-- Hero -->

        <footer class="footer relative pt-10 max-w-7xl mx-auto">

            <!-- Container Grid -->

            <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto divide-y divide-gray-200 px-4 sm:px-6 md:px-8 mt-8">

                <!-- Grid -->

                <ul class="text-center Footer_nav__2rFid text-sm font-medium pb-14 sm:pb-20 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-10">

                    <!-- Informationen -->

                    <li class="space-y-3 row-span-2 px-4">

                        <h2 class="text-xs font-semibold tracking-wide text-gray-800 uppercase">

                            Informationen

                        </h2>

                        <ul class="space-y-1">

                            <li>

                                <p class="text-gray-500 transition-colors duration-200 font-normal">

                                    BETA-Version 0.1: 05/2021

                                </p>

                                <p class="text-gray-500 transition-colors duration-200 font-normal mt-2">

                                    Das <em>digi:match</em> ist eine Plattform des DigiLLab der Uni Augsburg, um Helfer*innen im Rahmen des Projekts <em>Augsburger DaZ-Buddys</em> zu finden.

                                </p>

                                <p class="text-gray-500 transition-colors duration-200 font-normal mt-2 mr-2">

                                    <em>digi:match</em> von <strong>Vincent Dusanek</strong> für <strong>DigiLLab</strong>, 2020. MIT-Lizenz.

                                </p>

                            </li>

                        </ul>

                    </li>

                    <!-- Informationen -->

                    <!-- Organisation -->

                    <li class="space-y-3 row-span-2 px-4">

                        <h2 class="text-xs font-semibold tracking-wide text-gray-800 uppercase">

                            Organisation
                        </h2>

                        <ul class="space-y-1">

                            <li>

                                <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="https://digillab.zlbib.uni-augsburg.de">

                                    DigiLLab

                                </a>

                            </li>

                            <li>

                                <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="https://www.uni-augsburg.de/de/forschung/einrichtungen/institute/zlbib/">

                                    ZLbiB

                                </a>

                            </li>

                        </ul>

                    </li>

                    <!-- Organisation -->

                    <!-- Über -->

                    <li class="space-y-3 row-span-2 px-4">

                        <h2 class="text-xs font-semibold tracking-wide text-gray-800 uppercase">

                            Über

                        </h2>

                        <ul class="space-y-1">

                            <li>

                                <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="https://digillab.zlbib.uni-augsburg.de/impressum/">

                                    Impressum

                                </a>

                            </li>

                            <li>

                                <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="https://www.uni-augsburg.de/de/impressum/datenschutz/">

                                    Datenschutz
                                </a>

                            </li>

                        </ul>

                    </li>

                    <!-- Über -->

                    <!-- Allgemein -->

                    <li class="space-y-3 row-span-2 px-4">

                        <h2 class="text-xs font-semibold tracking-wide text-gray-800 uppercase">

                            Allgemein

                        </h2>

                        <ul class="space-y-1">

                            <li>

                                <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="/about">

                                    Näheres zum <em>digi:match</em>

                                </a>

                            </li>

                            <li>

                                <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-bold" href="/faq">

                                    FAQ

                                </a>

                            </li>

                            <li>

                                <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="{{ $mail_to_digillab }}">

                                    Kontakt

                                </a>

                            </li>

                            <li>

                                <a class="text-gray-500 hover:text-gray-800 transition-colors duration-200 font-normal" href="/log">

                                    Log

                                </a>

                            </li>

                        </ul>

                    </li>

                    <!-- Allgemein -->

                </ul>

                <!-- Grid -->

            </div>

            <!-- Container Grid -->

        </footer>

        <!-- Footer -->

<!-- Styles -->

<style type="text/css">
    #user {
        background-color: transparent !important;
    }
</style>

<!-- Styles -->



        <!-- Hero und Footer -->
    
        <!-- JS -->

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer=""></script>

        <!-- JS -->

    </body>

</html>
