<!DOCTYPE html>
<html lang="utf-8">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tables</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        <style type="text/css">
            summary::marker { color: transparent !important; }
            summary:focus { 
                
                outline-style: none !important;
                
            }
        </style>

                <!-- Styles -->



    </head>

    <body class="bg-white">

        <!-- Header -->

    	@include('layouts.header')

        <!-- Header -->

        <!-- About -->

        <div class="text-gray-600 body-font">

            <!-- Log Inner Div -->

            <div class="container px-5 pt-24 mx-auto">

                <!-- Ankündigung -->

                <div class="flex flex-col text-center w-full mb-20">

                    <h2 class="text-xs text-purple-500 tracking-widest font-medium title-font mb-1">Über</h2>

                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Näheres zum <em>digi<strong>:match</strong></em></h1>

                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Das <em>digi<strong>:match</strong></em> ist mittels des PHP-Frameworks <a href="https://laravel.com/" class="text-purple-500">Laravel</a> und des CSS-Frameworks <a href="https://tailwindcss.com/" class="text-purple-500">TailwindCSS</a> programmiert worden. Das Projekt steht unter einer MIT-Lizenz. Zum <a href="https://github.com/dusanvin/digimatch" class="text-purple-500">GitHub-Projekt</a>.</p>

                </div>    

                <!-- Ankündigung -->

            </div>

            <!-- Stepstones -->

            <div class="container px-5 pt-12 pb-24 mx-auto flex flex-wrap">

                <div class="flex flex-wrap w-full">

                    <div class="lg:w-2/5 md:w-1/2 md:pr-10 md:py-6">

                        <div class="flex relative pb-12">

                            <div class="h-full w-10 absolute inset-0 flex items-center justify-center">

                                <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>

                            </div>

                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-500 inline-flex items-center justify-center text-white relative z-10">

                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">

                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>

                                    <circle cx="12" cy="7" r="4"></circle>

                                </svg>

                            </div>

                            <div class="flex-grow pl-4">

                                <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">PROFIL</h2>

                                <p class="leading-relaxed">Praktikumssuchene ergänzen ihr Profil individuell, um Schulen die Auswahl zu erleichtern.</p>

                            </div>

                        </div>

                        <div class="flex relative pb-12">

                            <div class="h-full w-10 absolute inset-0 flex items-center justify-center">

                                <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>

                            </div>

                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-500 inline-flex items-center justify-center text-white relative z-10">

                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">

                                    <circle cx="12" cy="5" r="3"></circle>

                                    <path d="M12 22V8M5 12H2a10 10 0 0020 0h-3"></path>

                                </svg>

                            </div>

                            <div class="flex-grow pl-4">

                                <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">ZUTEILUNG</h2>

                                <p class="leading-relaxed">Praktikumssuchene und -beauftrage erstellen Bedarfe. Ein Algorithmus weist auf mögliche Praktika hin.</p>

                            </div>

                        </div>

                        <div class="flex relative pb-12">

                            <div class="h-full w-10 absolute inset-0 flex items-center justify-center">

                                <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>

                            </div>

                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-500 inline-flex items-center justify-center text-white relative z-10">

                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">

                                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>

                                    <path d="M22 4L12 14.01l-3-3"></path>

                                </svg>

                            </div>

                            <div class="flex-grow pl-4">

                                <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">MAILSYSTEM</h2>

                                <p class="leading-relaxed">Praktikumsbeauftrage schreiben -suchene an, um ein passgerechtes Praktikum zu offerieren.</p>

                            </div>

                        </div>

                        <div class="flex relative pb-12">

                            <div class="h-full w-10 absolute inset-0 flex items-center justify-center">

                                <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>

                            </div>

                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-500 inline-flex items-center justify-center text-white relative z-10">

                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">

                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>

                                </svg>

                            </div>

                            <div class="flex-grow pl-4">

                                <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">SICHERHEIT UND DATENSCHUTZ</h2>

                                <p class="leading-relaxed">Im Sinne der DSGVO-Richtlinien erfolgt keine Weitergabe persönlicher Daten ohne Zustimmung an Dritte.</p>

                            </div>

                        </div>

                        <div class="flex relative">

                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-500 inline-flex items-center justify-center text-white relative z-10">

                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">

                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>

                                </svg>

                            </div>

                            <div class="flex-grow pl-4">

                                <h2 class="font-medium title-font text-sm text-gray-900 mb-1 tracking-wider">STATISTIKEN</h2>

                                <p class="leading-relaxed">Teilnehmende, Schulen und Praktika: erhalten Sie anonymisierte Einblicke in relevante Statistiken.</p>

                            </div>

                        </div>

                    </div>

                    <!--<img class="lg:w-3/5 md:w-1/2 object-cover object-center rounded-lg md:mt-0 mt-12" src="https://dummyimage.com/1200x500" alt="step">-->
                    <img class="lg:w-3/5 md:w-1/2 object-cover object-center rounded-lg md:mt-0 mt-12" src="https://images.pexels.com/photos/3771107/pexels-photo-3771107.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="step">

                </div>

                <!-- Stepstones -->

            </div>

            <!-- Log Inner Div -->

        </div>

        <!-- About -->

        <!-- Footer -->

		@include('layouts.footer')

        <!-- Footer -->

    </body>

</html>