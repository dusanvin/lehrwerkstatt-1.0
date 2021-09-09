@extends ('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'digi:match') }}</title>
        <style type="text/css">
            li:hover {
                /*background-color: #EDF2F7 !important;*/
            }
        </style>


    </head>

    <body style="background-color: white;">

        <div class="flex flex-row h-full mx-5 mt-10 mb-10">

            <!-- Nav -->

            @include('layouts.navigation')

            <!-- Nav -->
            
            <!-- Content --> <!-- Del:  h-screen  Old colour: EDF2F7-->

            <div class="px-8 py-8 text-gray-700 w-screen bg-white rounded-r-lg" style="background-color: #EDF2F7;">

                <div class="overflow-hidden sm:rounded-lg">

                    <div class="px-4 py-5 sm:px-6">

                        <h2 class="text-lg leading-6 font-medium text-gray-900">

                            Statistiken

                        </h2>

                        <p class="mt-1 text-sm text-gray-500">

                            Erhalten Sie Einblicke in die Nutzungsstatistiken des Portals. Momentane Statistiken sind hinsichtlich der Registrierungen, Abmeldungen, Nutzenden, Zuweisungen, Studiengänge und des Betreuungsverhältnisses einsehbar. Kontaktieren Sie bei technischen Anregungen und Anliegen das <a href="mailto:digillab@zlbib.uni-augsburg.de" class="text-purple-500 hover:text-purple-700">DigiLLab</a>.

                        </p>

                    </div>

                    <!-- Diagramme -->

                    <div class="flex flex-wrap px-4 pt-4 pb-1 mx-auto mt-6 mb-1 bg-white rounded-md">

                        <!-- Alle Nutzenden -->

                        <div class="flex-1 my-2 mx-4">

                            <div class="grid justify-items-center">

                                <div class="py-4 px-4 grid justify-items-center rounded-md">

                                    <h3 class="text-3xl leading-6 font-medium">

                                        {{$users}}

                                    </h3>

                                    <div class="mt-4 text-sm text-gray-500">

                                        Nutzende

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- Alle Nutzenden -->

                        <!-- Administrierende -->

                        <div class="flex-1 my-2 mx-4">

                            <div class="grid justify-items-center">

                                <div class="py-4 px-4 grid justify-items-center rounded-md">

                                    <h3 class="text-3xl leading-6 font-medium">

                                        {{ $adminsCount }}

                                    </h3>

                                    <div class="mt-4 text-sm text-gray-500">

                                        Administrierende

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Administrierende -->

                        <!-- Moderierende -->

                        <div class="flex-1 my-2 mx-4">

                            <div class="grid justify-items-center">

                                <div class="py-4 px-4 grid justify-items-center rounded-md">

                                    <h3 class="text-3xl leading-6 font-medium">

                                    {{ $modsCount }}

                                </h3>

                                <div class="mt-4 text-sm text-gray-500">

                                    Moderierende 

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Moderierende -->

                        <!-- Helfende -->

                        <div class="flex-1 my-2 mx-4">

                            <div class="grid justify-items-center">

                                <div class="py-4 px-4 grid justify-items-center rounded-md">

                                    <h3 class="text-3xl leading-6 font-medium">

                                    {{ $helfendeCount }}

                                </h3>

                                <div class="mt-4 text-sm text-gray-500">

                                    Helfende

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Helfende -->

                        <!-- Lehrende -->

                        <div class="flex-1 my-2 mx-4">

                            <div class="grid justify-items-center">

                                <div class="py-4 px-4 grid justify-items-center rounded-md">

                                    <h3 class="text-3xl leading-6 font-medium">

                                    {{ $lehrendeCount }}

                                </h3>

                                <div class="mt-4 text-sm text-gray-500">

                                    Lehrende 

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Lehrende -->

                    </div>

                    <!-- Kreisdiagramme -->

                    <div class="grid grid-cols-1 md:grid-cols-2 pt-8" style="background-color: #EDF2F7;">

                        <!-- Nutzende im relativen Vergleich -->

                        <div class="mx-1 my-1 bg-white rounded-md ">

                            <div class="rounded-md p-6 ">

                                <div class="mb-2 pb-2 text-center">

                                    <h3 class="font-semibold text-lg text-gray-600">Nutzende</h3>

                                    <p class="text-sm text-gray-500">Nutzende im relativen Vergleich</p>

                                </div>

                                <div>

                                    <canvas id="myChart3"></canvas>

                                </div>

                            </div>

                        </div>

                        <!-- Nutzende im relativen Vergleich -->

                        <!-- Nutzende im relativen Vergleich -->

                        <div class="mx-1 my-1 bg-white rounded-md ">

                            <div class="rounded-md p-6">

                                <div class="mb-2 pb-2 text-center">

                                    <h3 class="font-semibold text-lg text-gray-600">Vergleich</h3>

                                    <p class="text-sm text-gray-500">Helfende und Lernende im relativen Vergleich</p>

                                </div>

                                <canvas id="myChart4"></canvas>
                                
                            </div>

                        </div>

                        <!-- Nutzende im relativen Vergleich -->

                    </div>

                    <!-- Kreisdiagramme -->

                </div>

            </div>

            <!-- Diagramme -->

        </div>

        <!-- Resources -->

        <!-- Resources -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script type="text/javascript">

              //mychart3

            // Setup
            DATA_COUNT = 5;
            NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 400};

            labels2 = ['Admins', 'Moderierende', 'Helfende', 'Lehrkräfte'];
            data = {
              labels: labels2,
              datasets: [
                {
                  label: 'Dataset 1',
                  data: [{{ $adminsCount }}, {{ $modsCount }}, {{ $helfendeCount }}, {{ $lehrendeCount }}],
                  backgroundColor: [
                    'rgba(220, 38, 38, 0.6)',
                    'rgba(5, 150, 105, 0.6)',
                    'rgba(79, 70, 229, 0.6)',
                    'rgba(245, 158, 11, 0.6)'
                  ]
                }
              ]
            };

            // Config
            config = {
              type: 'polarArea',
              data: data,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  }

                }
              },
            };

            // Aufruf
            var myChart = new Chart(
                document.getElementById('myChart3'),
                config
              );

            // mychart4

            // Setup
            DATA_COUNT = 5;
            NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 100};

            data = {
              labels: [ 'Lernende', 'Helfende'],
              datasets: [
                {
                  label: 'Dataset 1',
                  data: [{{ $lehrendeCount }}, {{ $helfendeCount }}],
                  backgroundColor: [
                    'rgba(245, 158, 11, 0.6)',
                    'rgba(79, 70, 229, 0.6)'
                ],
                }
              ]
            };

            // Config
            config = {
              type: 'doughnut',
              data: data,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  }

                }
              },
            };

            // Aufruf
            var myChart = new Chart(
                document.getElementById('myChart4'),
                config
              );


        </script>

    </body>

</html>

@endsection