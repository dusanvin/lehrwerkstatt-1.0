@extends('welcome')

@section('hero')

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

@endsection