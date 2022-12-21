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

            <div class="px-1 md:px-8 py-8 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

                <div class="overflow-hidden sm:rounded-lg">

                    <div class="grid justify-items-center sm:justify-items-start select-none">

                        <h2 class="font-semibold text-lg text-gray-200">

                            Statistiken

                        </h2>

                        <div class="mt-1 text-sm text-gray-300 text-center sm:text-left">

                            Erhalten Sie Einblicke in die Nutzungsstatistiken des Portals. Momentane Statistiken sind
                            hinsichtlich der Registrierungen, Abmeldungen, Nutzenden, Zuweisungen, Studiengänge und des
                            Betreuungsverhältnisses einsehbar. Kontaktieren Sie bei technischen Anregungen und Anliegen das
                            <a href="mailto:team@digillab.uni-augsburg.de" class="hover:underline text-yellow-500">
                                DigiLLab der Universität Augsburg</a>.

                        </div>





<script src="{{ asset('js/arrays_lehr.js') }}"></script>

<h2 class="font-semibold text-lg text-gray-200">

        Angemeldete Nutzer:innen mit mit vollständig ausgefülltem Formular, die am aktuellen Matchingverfahren teilnehmen.
        <br>

<script>
        var lehr_grundschule = "{{ $users_lehr_grundschule->toJson() }}";
        var lehr_grundschule = lehr_grundschule.split('&quot;').join('\"');
        var lehr_grundschule = lehr_grundschule.replaceAll("&#039;", "\'").replaceAll("&lt;", "\<").replaceAll("&gt;", "\>");
        var lehr_grundschule = JSON.parse(lehr_grundschule);
</script>

<a onclick="exportLehrCSV('Grundschule')" id="csv_link_lehr_Grundschule" href="#" class="bg-blue-600">{{ $users_lehr_grundschule_count }} Lehrkräfte (Grundschule) als CSV exportieren</a>                            

</h2>

<h2 class="font-semibold text-lg text-gray-200">

<script>
        var lehr_realschule = "{{ $users_lehr_realschule->toJson() }}";
        var lehr_realschule = lehr_realschule.split('&quot;').join('\"');
        var lehr_realschule = lehr_realschule.replaceAll("&#039;", "\'").replaceAll("&lt;", "\<").replaceAll("&gt;", "\>");
        var lehr_realschule = JSON.parse(lehr_realschule);
</script>

<a onclick="exportLehrCSV('Realschule')" id="csv_link_lehr_Realschule" href="#" class="bg-blue-600">{{ $users_lehr_realschule_count }} Lehrkräfte (Realschule) als CSV exportieren</a>                            

</h2>

<h2 class="font-semibold text-lg text-gray-200">

<script>
        var lehr_gymnasium = "{{ $users_lehr_gymnasium->toJson() }}";
        var lehr_gymnasium = lehr_gymnasium.split('&quot;').join('\"');
        var lehr_gymnasium = lehr_gymnasium.replaceAll("&#039;", "\'").replaceAll("&lt;", "\<").replaceAll("&gt;", "\>");
        var lehr_gymnasium = JSON.parse(lehr_gymnasium);
</script>

<a onclick="exportLehrCSV('Gymnasium')" id="csv_link_lehr_Gymnasium" href="#" class="bg-blue-600">{{ $users_lehr_gymnasium_count }} Lehrkräfte (Gymnasium) als CSV exportieren</a>                            

</h2>


<script src="{{ asset('js/arrays_stud.js') }}"></script>

<h2 class="font-semibold text-lg text-gray-200">

<script>
        var stud_grundschule = "{{ $users_stud_grundschule->toJson() }}";
        console.log(stud_grundschule);
        var stud_grundschule = stud_grundschule.split('&quot;').join('\"');
        var stud_grundschule = stud_grundschule.replaceAll("&#039;", "\'").replaceAll("&lt;", "\<").replaceAll("&gt;", "\>");
        var stud_grundschule = JSON.parse(stud_grundschule);
        console.log(stud_grundschule);
</script>

<a onclick="exportStudCSV('Grundschule')" id="csv_link_stud_Grundschule" href="#" class="bg-blue-600">{{ $users_stud_grundschule_count }} Studierende (Grundschule) als CSV exportieren</a>                            

</h2>

<h2 class="font-semibold text-lg text-gray-200">

<script>
        var stud_realschule = "{{ $users_stud_realschule->toJson() }}";
        var stud_realschule = stud_realschule.split('&quot;').join('\"');
        var stud_realschule = stud_realschule.replaceAll("&#039;", "\'").replaceAll("&lt;", "\<").replaceAll("&gt;", "\>");
        var stud_realschule = JSON.parse(stud_realschule);
</script>

<a onclick="exportStudCSV('Realschule')" id="csv_link_stud_Realschule" href="#" class="bg-blue-600">{{ $users_stud_realschule_count }} Studierende (Realschule) als CSV exportieren</a>                            

</h2>

<h2 class="font-semibold text-lg text-gray-200">

<script>
        var stud_gymnasium = "{{ $users_stud_gymnasium->toJson() }}";
        var stud_gymnasium = stud_gymnasium.split('&quot;').join('\"');
        var stud_gymnasium = stud_gymnasium.replaceAll("&#039;", "\'").replaceAll("&lt;", "\<").replaceAll("&gt;", "\>");
        var stud_gymnasium = JSON.parse(stud_gymnasium);
</script>

<a onclick="exportStudCSV('Gymnasium')" id="csv_link_stud_Gymnasium" href="#" class="bg-blue-600">{{ $users_stud_gymnasium_count }} Studierende (Gymnasium) als CSV exportieren</a>                            

</h2>



                    </div>


                    <div class="flex flex-wrap px-4 pt-4 pb-1 mx-1 mt-0 sm:mt-6 bg-gray-800 rounded-md">

                        <!-- Alle Nutzenden -->

                        <div class="flex-1 my-2 mx-4">

                            <div class="grid justify-items-center">

                                <div class="py-4 px-4 grid justify-items-center rounded-md">

                                    <h3 class="text-3xl leading-6 font-medium text-gray-200">

                                        {{ $user_count }}

                                    </h3>

                                    <div class="mt-4 text-sm text-gray-400">

                                        Registrierte Nutzer

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Alle Nutzenden -->

                        <!-- Administrierende -->

                        <div class="flex-1 my-2 mx-4">

                            <div class="grid justify-items-center">

                                <div class="py-4 px-4 grid justify-items-center rounded-md">

                                    <h3 class="text-3xl leading-6 font-medium text-gray-200">

                                        {{ $admin_count }}

                                    </h3>

                                    <div class="mt-4 text-sm text-gray-400">

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

                                    <h3 class="text-3xl leading-6 font-medium text-gray-200">

                                        {{ $mod_count }}

                                    </h3>

                                    <div class="mt-4 text-sm text-gray-400">

                                        Moderierende

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Moderierende -->

                        <!-- Lehrkräfte -->

                        <div class="flex-1 my-2 mx-4">

                            <div class="grid justify-items-center">

                                <div class="py-4 px-4 grid justify-items-center rounded-md">

                                    <h3 class="text-3xl leading-6 font-medium text-gray-200">

                                        {{ $lehr_count }}

                                    </h3>

                                    <div class="mt-4 text-sm text-gray-400">

                                        Lehrkräfte

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Lehrkräfte -->

                        <!-- Studierende -->

                        <div class="flex-1 my-2 mx-4">

                            <div class="grid justify-items-center">

                                <div class="py-4 px-4 grid justify-items-center rounded-md text-gray-200">

                                    <h3 class="text-3xl leading-6 font-medium">

                                        {{ $stud_count }}

                                    </h3>

                                    <div class="mt-4 text-sm text-gray-400">

                                        Studierende

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Studierende -->

                    </div>

                    <!-- Diagramme -->

                    <div class="grid grid-cols-1 md:grid-cols-2 pt-1 sm:pt-8 gap-1 sm:gap-4">

                        <!-- Registrierungen in den letzten 12 Monaten -->

                        <div class="mx-1 my-1 bg-gray-800 rounded-md ">

                            <div class="rounded-md p-6">

                                <div class="px-0 py-0 sm:p-8 rounded" style="background: linear-gradient(60deg,#7b1fa2,#913f9e);">

                                    <canvas id="second"></canvas>

                                </div>

                                <div class="text-left my-4">

                                    <h3 class="font-semibold text-lg text-gray-300">Jährliche Registrierungen</h3>

                                    <p class="text-sm text-gray-300">Die letzten {{ count($recent_month_names) }} Monate im
                                        Vergleich</p>

                                </div>

                            </div>

                        </div>

                        <!-- Registrierungen in den letzten 12 Monaten -->

                        <!-- Registrierungen diesen Monat -->

                        <div class="mx-1 my-1 bg-gray-800 rounded-md ">

                            <div class="rounded-md p-6">

                                <div class="px-0 py-0 sm:p-8 rounded" style="background: linear-gradient(60deg,#029eb1,#25b1c3);">

                                    <canvas id="third"></canvas>

                                </div>

                                <div class="text-left my-4">

                                    <h3 class="font-semibold text-lg text-gray-300">Monatliche Registrierungen</h3>

                                    <p class="text-sm text-gray-300">Vorkommen im aktuellen Monat {{ $current_month_name }}</p>

                                </div>

                            </div>

                        </div>

                        <!-- Registrierungen diesen Monat -->

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 pt-1 sm:pt-8 gap-1 sm:gap-4">

                        <!-- Ausfüllstatus im absoluten Vergleich -->

                        <div class="mx-1 my-1 bg-gray-800 rounded-md ">

                            <div class="rounded-md p-6">

                                <div class="px-0 py-0 sm:p-8 rounded" style="background: linear-gradient(60deg,#d22824,#da3a36);">

                                    <canvas id="fourth"></canvas>

                                </div>

                                <div class="text-left my-4">

                                    <h3 class="font-semibold text-lg text-gray-300">Bewerbungsformulare</h3>

                                    <p class="text-sm text-gray-300">Ausfüllstatus im absoluten Vergleich in Bezug auf Rollen</p>

                                </div>

                            </div>

                        </div>

                        <!-- Ausfüllstatus im absoluten Vergleich -->

                        <!-- Ausgefüllte Bewerbungen im absoluten Vergleich -->

                        <div class="mx-1 my-1 bg-gray-800 rounded-md">

                            <div class="rounded-md p-6">

                                <div class="px-0 py-0 sm:p-8 rounded" style="background: linear-gradient(60deg,#d81b60,#ec407a);">

                                    <canvas id="fifth"></canvas>

                                </div>

                                <div class="text-left my-4">

                                    <h3 class="font-semibold text-lg text-gray-300">Bewerbungsformulare</h3>

                                    <p class="text-sm text-gray-300">Ausgefüllte Bewerbungsformulare im absoluten Vergleich in Bezug auf Schulart</p>

                                </div>

                            </div>

                        </div>

                        <!-- Ausgefüllte Bewerbungen im absoluten Vergleich -->

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 pt-1 sm:pt-8 gap-1 sm:gap-4">

                        <!-- Angebotene Landkreise von Lehrkräften -->

                        <div class="mx-1 my-1 bg-gray-800 rounded-md">

                            <div class="rounded-md p-6 ">

                                <div class="px-0 py-0 sm:p-8 rounded" style="background: linear-gradient(60deg,#f5700c,#ff9800);">

                                    <canvas id="sixth"></canvas>

                                </div>

                                <div class="text-left my-4">

                                    <h3 class="font-semibold text-lg text-gray-300">Angebotene Landkreise</h3>

                                    <p class="text-sm text-gray-300">Angebotene Landkreise des Lehrkräfte</p>

                                </div>

                            </div>

                        </div>

                        <!-- Angebotene Landkreise von Lehrkräften -->

                        <!-- Von Student*innen bevorzugte Landkreise -->

                        <div class="mx-1 my-1 bg-gray-800 rounded-md">

                            <div class="rounded-md p-6">

                                <div class="px-0 py-0 sm:p-8 rounded" style="background: linear-gradient(60deg,#288c6c,#4ea752);">

                                    <canvas id="seventh" class="rounded"></canvas>

                                </div>

                                <div class="text-left my-4">

                                    <h3 class="font-semibold text-lg text-gray-300">Bevorzugte Landkreise</h3>

                                    <p class="text-sm text-gray-300">Bevorzugte Landkreise der Studierenden</p>

                                </div>

                            </div>

                        </div>

                        <!-- Von Student*innen bevorzugte Landkreise -->

                    </div>

                </div>

            </div>

            <!-- Diagramme -->

        </div>

        <!-- Resources -->

        <!-- Resources -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script type="text/javascript">

            // SECOND

            data = {
                labels: [
                    @for ($i = 12; $i > 0; $i--)
                        '{{ $recent_month_names[$i] }}',
                    @endfor
                ],
                datasets: [{
                    label: 'Lehrkräfte',
                    data: [
                        @for ($i = 12; $i > 0; $i--)
                            {{ $lehr_registrations_recent_months[$i] }},
                        @endfor
                    ],
                    backgroundColor: 'rgba(255,255,255, 0.6)',
                    borderColor: "rgba(255,255,255, 0.6)",
                    tension: 0.3,
                    pointStyle: 'line',
                    fill: false
                    },
                    {
                    label: 'Studierende',
                    data: [
                        @for ($i = 12; $i > 0; $i--)
                            {{ $stud_registrations_recent_months[$i] }},
                        @endfor
                    ],
                    backgroundColor: 'rgba(88, 28, 135, 173, 0.8)',
                    borderColor: "rgba(88, 28, 135, 0.8)",
                    tension: 0.3,
                    pointStyle: 'line',
                    fill: false,
                    stack: 'Stack 1',
                    },
                ]
            };

            config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    labels: {
                      color: "white",
                    },
                    plugins: {
                        title: {
                            display: false
                        },
                        legend: {
                        position: 'top',
                        labels: {
                          color: 'rgba(255, 255, 255, 0.7)',
                        }
                      }
                    },
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            ticks: {
                              color: 'rgba(255, 255, 255, 0.7)'
                            },
                            stacked: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.2)'
                            }
                        },
                        y: {
                            stacked: true,
                            min: 0,
                            ticks: {
                              color: 'rgba(255, 255, 255, 0.7)',
                              stepSize: 1,
                              beginAtZero: true
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.2)'
                            }
                        }
                    }
                }
            };

            var myChart = new Chart(
                document.getElementById('second'),
                config
            );



            // THIRD

            data = {
                labels: ['Lehrkräfte', 'Studierende'],
                datasets: [{
                    label: 'Registrierte Nutzer (laufender Monat)',
                    data: [{{ $lehr_registrations_current_month }}, {{ $stud_registrations_current_month }}],
                    backgroundColor: ['rgba(255, 255, 255, 0.7)', 'rgba(12, 74, 110, 0.6)']
                }]
            };

            config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    labels: {
                      color: "white",
                    },
                    plugins: {
                        title: {
                            display: false
                        },
                        legend: {
                        position: 'top',
                        labels: {
                          color: 'rgba(255, 255, 255, 0.7)',
                        }
                      }
                    },
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            ticks: {
                              color: 'rgba(255, 255, 255, 0.7)'
                            },
                            stacked: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.2)'
                            }
                        },
                        y: {
                            stacked: true,
                            min: 0,
                            ticks: {
                              color: 'rgba(255, 255, 255, 0.7)',
                              beginAtZero: true
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.2)'
                            }
                        }
                    }
                }
            };

            var myChart = new Chart(
                document.getElementById('third'),
                config
            );


            // FOURTH

            data = {
                labels: ['Lehrkräfte', 'Studierende'],
                datasets: [{
                        label: 'Unvollständig',
                        data: [{{ $lehr_incomplete_form }}, {{ $stud_incomplete_form }}],
                        backgroundColor: 'rgba(255, 255, 255, 0.7)',
                        borderColor: "rgba(255,255,255, 0.6)",
                        borderWidth: 2,
                        borderRadius: 2,
                        stack: 'Stack 0',
                    },
                    {
                        label: 'Vollständig',
                        data: [{{ $lehr_complete_form }}, {{ $stud_complete_form }}],
                        backgroundColor: 'rgba(127, 29, 29, 1)',
                        borderColor: 'rgba(127, 29, 29, 1)',
                        borderWidth: 2,
                        borderRadius: 2,
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
                        legend: {
                position: 'top',
                labels: {
                  color: 'rgba(255, 255, 255, 0.7)',
                }
              }
                    },
                    labels: {
                      color: "white",  // not 'fontColor:' anymore
                      // fontSize: 18  // not 'fontSize:' anymore
                    },
                    responsive: true,
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            stacked: true,
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)',
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.2)'
                            }
                        },
                        y: {
                            stacked: true,
                            min: 0,
                            ticks: {
                                stepSize: 1,
                                color: 'rgba(255, 255, 255, 0.7)'
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.2)'
                            }
                        }
                    }
                }
            };

            var myChart = new Chart(
                document.getElementById('fourth'),
                config
            );


            // FIFTH

            data = {
                labels: ['Grundschule', 'Realschule', 'Gymnasium'],
                datasets: [{
                        label: 'Lehrkräfte',
                        data: [{{ $lehr_grundschule }}, {{ $lehr_realschule }}, {{ $lehr_gymnasium }}],
                        stack: 'Stack 0',
                        backgroundColor: 'rgba(255, 255, 255, 0.8)',
                        borderColor: 'rgba(255,255,255,0.8)',
                        borderWidth: 2,
                        borderRadius: 2,
                    },
                    {
                        label: 'Studierende',
                        data: [{{ $stud_grundschule }}, {{ $stud_realschule }}, {{ $stud_gymnasium }}],
                        stack: 'Stack 1',
                        backgroundColor: 'rgba(131, 24, 67, 1)',
                        borderColor: 'rgba(131, 24, 67, 1)',
                        borderWidth: 2,
                        borderRadius: 2,
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
                    labels: {
                      color: "white",  // not 'fontColor:' anymore
                      // fontSize: 18  // not 'fontSize:' anymore
                    },
                    responsive: true,
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                    x: {  // not 'xAxes: [{' anymore (not an array anymore)
                      
                        ticks: {
                          color: 'rgba(255, 255, 255, 0.7)',
                          stepSize: 1,
                          beginAtZero: true
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                    },
                    y: {                 
                        ticks: {
                          color: 'rgba(255, 255, 255, 0.7)',
                          stepSize: 1,
                          beginAtZero: true
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                    }
                    }
                }
            };

            var myChart = new Chart(
                document.getElementById('fifth'),
                config
            );


            // SIXTH - Landkreise (Studierende)

            data = {
                labels: [
                    @foreach ($lehr_landkreise as $landkreis => $value)
                        '{{ $landkreis }}',
                    @endforeach
                ],
                datasets: [{
                        label: 'Lehrkräfte',
                        data: [
                            @foreach ($lehr_landkreise as $lehr_landkreis)
                                {{ $lehr_landkreis }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(255,255,255,0.8)',
                        borderColor: 'rgba(255,255,255,0.8)',
                        borderWidth: 2,
                        borderRadius: 2,
                    },
                ]
            };

            config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                              color: "white",  // not 'fontColor:' anymore
                              // fontSize: 18  // not 'fontSize:' anymore
                            }
                          }
                    },
                    scales: {
                      y: {  // not 'yAxes: [{' anymore (not an array anymore)
                        ticks: {
                          color: "white", // not 'fontColor:' anymore
                          // fontSize: 18,
                          stepSize: 1,
                          beginAtZero: true
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                      },
                      x: {  // not 'xAxes: [{' anymore (not an array anymore)
                        ticks: {
                          color: "white",
                          barThickness: 2,
                          stepSize: 1,
                          beginAtZero: true
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                      }
                    }
                }
            };

            var myChart = new Chart(
                document.getElementById('sixth'),
                config
            );

            // SEVENTH - Landkreise (Studierende)

            data = {
                labels: [
                    @foreach ($stud_landkreise as $landkreis => $value)
                        '{{ $landkreis }}',
                    @endforeach
                ],
                datasets: [{
                        label: 'Studierende',
                        data: [
                            @foreach ($stud_landkreise as $stud_landkreis)
                                {{ $stud_landkreis }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(255, 255, 255, 0.8)',
                        borderColor: 'rgba(255,255,255,0.8)',
                        borderWidth: 2,
                        borderRadius: 2,
                    }
                ]
            };

            config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                              color: 'rgba(255, 255, 255, 0.7)',
                            }
                          }
                    },
                    scales: {
                      y: {  // not 'yAxes: [{' anymore (not an array anymore)
                        ticks: {
                          color: 'rgba(255, 255, 255, 0.7)',
                          stepSize: 1,
                          beginAtZero: true
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                      },
                      x: {  // not 'xAxes: [{' anymore (not an array anymore)
                      
                        ticks: {
                          color: 'rgba(255, 255, 255, 0.7)',
                          stepSize: 1,
                          beginAtZero: true
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                      }
                    }
                }
            };

            var myChart = new Chart(
                document.getElementById('seventh'),
                config
            );


        </script>

    </body>

    </html>
@endsection
