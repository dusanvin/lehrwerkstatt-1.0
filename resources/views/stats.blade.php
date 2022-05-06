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

    <body>

        <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

            <!-- Nav -->

            @include('layouts.navigation')

            <!-- Nav -->

            <!-- Inhalt -->

            <div class="px-1 md:px-8 py-8 md:py-8 text-gray-700 w-screen sm:rounded-r-lg" style="background-color: #EDF2F7;">

                <div class="overflow-hidden sm:rounded-lg">

                    <div class="grid justify-items-center sm:justify-items-start select-none">

                        <h2 class="font-semibold text-lg text-gray-600">

                            Statistiken

                        </h2>

                        <div class="mt-1 text-sm text-gray-500 grid text-center sm:text-left flex">

                            Erhalten Sie Einblicke in die Nutzungsstatistiken des Portals. Momentane Statistiken sind hinsichtlich der Registrierungen, Abmeldungen, Nutzenden, Zuweisungen, Studiengänge und des Betreuungsverhältnisses einsehbar. Kontaktieren Sie bei technischen Anregungen und Anliegen das DigiLLab der Universität Augsburg.

                        </div>

                    </div>

                    <!-- Diagramme -->

                    <div class="flex flex-wrap px-4 pt-4 pb-1 mx-1 mt-0 sm:mt-6 bg-white rounded-md">

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

                    <div class="grid grid-cols-1 md:grid-cols-4 pt-1 sm:pt-8" style="background-color: #EDF2F7;">

                        <!-- Nutzende im relativen Vergleich -->

                        <div class="mx-1 my-1 bg-white rounded-md ">

                            <div class="rounded-md p-6 ">

                                <div class="text-center">

                                    <h3 class="font-semibold text-lg text-gray-600">Nutzende</h3>

                                    <p class="text-sm text-gray-500">Nutzende im relativen Vergleich</p>

                                </div>

                                <div>                                    

                                    <div class="px-0 py-0 sm:px-8 sm:py-8">

                                        <canvas id="nutzende"></canvas>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Nutzende im relativen Vergleich -->

                        <!-- Rollen im relativen Vergleich -->

                        <div class="mx-1 my-1 bg-white rounded-md ">

                            <div class="rounded-md p-6">

                                <div class="text-center">

                                    <h3 class="font-semibold text-lg text-gray-600">Rollen</h3>

                                    <p class="text-sm text-gray-500">Rollen im relativen Vergleich</p>

                                </div>

                                <div class="px-0 py-0 sm:px-8 sm:py-8">

                                    <canvas id="myChart4"></canvas>

                                </div>
                                
                            </div>

                        </div>

                        <!-- Rollen im relativen Vergleich -->

                        <!-- Angebote im relativen Vergleich -->

                        <div class="mx-1 my-1 bg-white rounded-md ">

                            <div class="rounded-md p-6">

                                <div class="text-center">

                                    <h3 class="font-semibold text-lg text-gray-600">Angebote</h3>

                                    <p class="text-sm text-gray-500">{{ $alleAngeboteCount }} Angebote im relativen Vergleich</p>

                                </div>

                                <div class="px-0 py-0 sm:px-8 sm:py-8">

                                    <canvas id="myChart7"></canvas>

                                </div>
                                
                            </div>

                        </div>

                        <!-- Angebote im relativen Vergleich -->

                        <!-- Bedarfe im relativen Vergleich -->

                        <div class="mx-1 my-1 bg-white rounded-md ">

                            <div class="rounded-md p-6">

                                <div class="text-center">

                                    <h3 class="font-semibold text-lg text-gray-600">Bedarfe</h3>

                                    <p class="text-sm text-gray-500">{{ $alleBedarfeCount }} Bedarfe im relativen Vergleich</p>

                                </div>

                                <div class="px-0 py-0 sm:px-8 sm:py-8">

                                    <canvas id="myChart8"></canvas>

                                </div>
                                
                            </div>

                        </div>

                        <!-- Bedarfe im relativen Vergleich -->

                    </div>

                    <!-- Kreisdiagramme -->

                    <!-- Balkendiagramme -->

                    <div class="grid grid-cols-1 md:grid-cols-3" style="background-color: #EDF2F7;">

                        <!-- Nutzende im relativen Vergleich -->

                        <div class="mx-1 my-1 bg-white rounded-md ">

                            <div class="rounded-md p-6 ">

                                <div class="text-center">

                                    <h3 class="font-semibold text-lg text-gray-600">Lernende</h3>

                                    <p class="text-sm text-gray-500">Betreute Lernende</p>

                                </div>

                                <div>                                    

                                    <div class="px-0 py-0 sm:py-8">

                                        <canvas id="lernende"></canvas>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Nutzende im relativen Vergleich -->

                        <!-- Studiengänge -->

                        <div class="mx-1 my-1 bg-white rounded-md ">

                            <div class="rounded-md p-6">

                                <div class="text-center">

                                    <h3 class="font-semibold text-lg text-gray-600">Studiengänge</h3>

                                    <p class="text-sm text-gray-500">Nutzende</p>

                                </div>

                                <div class="px-0 py-0 sm:py-8">

                                    <canvas id="myChart"></canvas>

                                </div>
                                
                            </div>

                        </div>

                        <!-- Studiengänge x-Achse: HF DaZ | NF DaZ | GS | MS | RS | GYM | Sonstiges -->

                        <!-- Rollen (nach Monat) im relativen Vergleich -->

                        <div class="mx-1 my-1 bg-white rounded-md ">

                            <div class="rounded-md p-6">

                                <div class="text-center">

                                    <h3 class="font-semibold text-lg text-gray-600">Registrierungen</h3>

                                    <p class="text-sm text-gray-500">Rollen im relativen Vergleich</p>

                                </div>

                                <div class="px-0 py-0 sm:py-8">

                                    <canvas id="mix"></canvas>

                                </div>
                                
                            </div>

                        </div>

                        <!-- Rollen (nach Monat) im relativen Vergleich -->

                    </div>

                    <!-- Balkendiagramme -->

                </div>

            </div>

            <!-- Diagramme -->

        </div>

        <!-- Resources -->

        <!-- Resources -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script type="text/javascript">

            //Angebote myChart7

            DATA_COUNT = 5;
            NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 100};

            datapie = {
              labels: ['Aktiv', 'Inaktiv'],
              datasets: [
                {
                  label: 'Dataset 1',
                  data: [{{ $aktiveAngeboteCount }}, {{ $inaktiveAngeboteCount }}],
                  backgroundColor: ['rgba(5, 150, 105, 0.6)', 'rgba(220, 38, 38, 0.6)']
                }
              ]
            };

            config = {
              type: 'pie',
              data: datapie,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  }
                }
              },
            };

            var myChart = new Chart(
                document.getElementById('myChart7'),
                config
            );

            //Bedarfe myChart8

            DATA_COUNT = 5;
            NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 100};

            datapie = {
              labels: ['Aktiv', 'Inaktiv'],
              datasets: [
                {
                  label: 'Dataset 1',
                  data: [{{ $aktiveBedarfeCount }}, {{ $inaktiveBedarfeCount }}],
                  backgroundColor: ['rgba(5, 150, 105, 0.6)', 'rgba(220, 38, 38, 0.6)']
                }
              ]
            };

            config = {
              type: 'pie',
              data: datapie,
              options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  }
                }
              },
            };

            var myChart = new Chart(
                document.getElementById('myChart8'),
                config
            );


            //Nutzende
                DATA_COUNT = 5;
                NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 400};

                labels2 = ['Admins', 'Moderierende', 'Helfende', 'Lehrende'];
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

                config = {
                  // type: 'polarArea',
                  type: 'pie',
                  data: data,
                  options: {
                    // scales: {
                    //   r: {
                    //     ticks: {
                    //       display: false
                    //     },
                    //     gridLines: {
                    //       display: false
                    //     }
                    //   }
                    // },
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top',
                      }

                    }
                  },
                };

                var myChart = new Chart(
                    document.getElementById('nutzende'),
                    config
                  );

            // mychart4 - Rollen
                DATA_COUNT = 5;
                NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 100};

                data = {
                  labels: [ 'Lehrende', 'Helfende'],
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

                config = {
                  type: 'pie',
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

                var myChart = new Chart(
                    document.getElementById('myChart4'),
                    config
                  );

            
            //Lernende
            labels = [
              'September',
              'Oktober',
              'November',
              'Dezember',
              'Januar',
              'Februar',
              'März',
              'April',
              'Mai',
              'Juni',
              'Juli',
              'August',
            ];
            data = {
              labels: labels,
              datasets: [{
                label: 'Betreute Lernende',
                backgroundColor: 'rgba(5, 150, 105, 0.6)',
                borderColor: 'rgba(5, 150, 105, 0.6)',
                data: [4, 0, 0, 0, 0, 0, 0],
              }]
            };

            config = {
              type: 'line',
              data,
              options: {
                scales: {
                        y: {
                            min: 0,
                            ticks: {
                              stepSize: 1
                            }
                        }
                    },
                responsive: true,
                plugins: {
                  legend: {
                        display: false,
                  }

                }
              }
            };

            var myChart = new Chart(
                document.getElementById('lernende'),
                config
              );


            // mychart
            labels = [
              'HF DaZ',
              'NF DaZ',
              'GS',
              'MS',
              'RS',
              'GYM',
              'Sonstiges'
            ];

            data = {
                labels: labels,
                datasets: [{
                    // label: 'DaZ/DaF (B.A.)',
                    data: [{{ $hfDazCount }}, {{ $nfDazCount }}, {{ $gsCount }}, {{ $msCount }}, {{ $rsCount }}, {{ $gymCount }}, {{ $sonstigesCount }}],
                    backgroundColor: [
                        'rgba(79, 70, 229, 0.6)'
                    ]
                }]
            };

            config = {
                type: 'bar',
                data,
                options: {
                    scales: {
                        y: {
                            min: 0,
                            ticks: {
                              stepSize: 1
                            }
                        }
                    },
                    plugins: {
                      legend: {
                        display: false,
                      }
                    }
                }
            };

            var myChart = new Chart(
                document.getElementById('myChart'),
                config
              );

            //mix: Helfende, Lehrende und Lernende pro Monat als Stacked Bar Chart with Groups

            DATA_COUNT = 7;
            NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

            labels = [
              'September',
              'Oktober',
              'November',
              'Dezember',
              'Januar',
              'Februar',
              'März',
              'April',
              'Mai',
              'Juni',
              'Juli',
              'August',
            ];
            data = {
              labels: labels,
              datasets: [
                {
                  label: 'Helfende',
                  data: [4],
                  backgroundColor: 'rgba(79, 70, 229, 0.6)',
                  stack: 'Stack 0',
                },
                {
                  label: 'Lehrende',
                  data: [4],
                  backgroundColor: 'rgba(245, 158, 11, 0.6)',
                  stack: 'Stack 0',
                },
                {
                  label: 'Lernende',
                  data: [2],
                  backgroundColor: 'rgba(5, 150, 105, 0.6)',
                  stack: 'Stack 1',
                },
              ]
            };

            config = {
              type: 'bar',
              data: data,
              options: {
                plugins: {
                  title: {
                    display: false
                  },
                },
                responsive: true,
                interaction: {
                  intersect: false,
                },
                scales: {
                  x: {
                    stacked: true,
                  },
                  y: {
                    stacked: true
                  }
                }
              }
            };

            // Aufruf
            var myChart = new Chart(
                document.getElementById('mix'),
                config
              );


        </script>

    </body>

</html>

@endsection