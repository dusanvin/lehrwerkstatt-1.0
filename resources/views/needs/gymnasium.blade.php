@extends ('layouts.app')

@section('content')

<script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>

<div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->

    <!-- Content -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

        <div class="mx-auto rounded">

            <!-- Tabs -->

            <ul id="tabs" class="inline-flex w-full">

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600"><a href="{{ route('users.stud') }}">Alle Schularten</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600"><a href="{{ route('users.stud', ['schulart' => 'grundschule']) }}">Grundschule</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600"><a href="{{ route('users.stud', ['schulart' => 'realschule']) }}">Realschule</a></li>

                <li class="px-4 py-2 -mb-px font-medium text-xs sm:text-sm text-gray-200 border-b-2 border-gray-700 rounded-t opacity-50 bg-gray-800 border-b-4 -mb-px opacity-100"><a href="{{ route('users.stud', ['schulart' => 'gymnasium']) }}">Gymnasium</a></li>

            </ul>

            <!-- Tabs -->

            <!-- Tab Contents -->

            <div id="tab-contents">

                <!-- Alle Angebote -->

                <div id="first" class="px-4 pt-4 pb-2 bg-gray-800 mb-4 rounded-b-md">

                    <!-- Suchfilter -->

                    <div class="grid grid-cols-1 text-sm text-gray-500 text-light py-1 my-2 px-1 md:px-4">

                        <!-- Übernommene Vorschläge -->

                        <h1 class="font-semibold text-2xl text-gray-200 text-center sm:text-left">

                            Angebote

                        </h1>

                        <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left flex">

                            <p>Hier erhalten Sie eine Übersicht zu den momentan aktiven Angeboten am <span class="font-semibold">Gymnasium</span>. Die Darstellung erfolgt in Abhängigkeit Ihrer Suchkriterien. Sollten keine Kriterien ausgewählt werden, erfolgt keine Filterung.</p>

                        </div>

                        <div class="flex flex-col">

                            <div class="bg-gray-700 my-4 shadow-sm rounded-md" x-data="accordion(1)">

                                <h2 @click="handleClick()" class="flex flex-row justify-between items-center px-4 cursor-pointer text-sm text-gray-300 px-6 py-6 hover:text-gray-200">

                                    <p>

                                        Suchen Sie nach <span class="font-semibold">aktiven Angeboten</span>. Filtern Sie diese bei Bedarf nach Einsatzgebieten und Fächern.

                                    </p>

                                    <svg :class="handleRotate()" class="fill-current text-gray-200 h-6 w-6 transform transition-transform duration-500" viewBox="0 0 20 20">

                                        <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>

                                    </svg>

                                </h2>

                                <div x-ref="tab" :style="handleToggle()" class="overflow-hidden max-h-0 duration-500 transition-all px-6">

                                    <form id="search" action="{{ route('users.stud', ['schulart' => 'gymnasium']) }}" method="post">

                                    @csrf

                                    <div class="flex flex-wrap mb-6">

                                        <!-- Schulart -->

                                        <script>
                                            var schulart_select = document.getElementById("schulart");
                                            @if(isset($schulart))
                                            schulart_select.value = "gymnasium";
                                            @endif
                                        </script>

                                        <!-- Schulart -->

                                        <!-- Gebiete -->

                                        <div class="text-sm text-gray-500 text-light mt-3 mx-6">

                                            <p class="py-3 text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">Einsatzgebiete</p>

                                            <script>
                                                var landkreise = [];

                                                function addLandkreisToSelection(landkreis, checked) {
                                                    console.log(landkreis, checked);
                                                    if (checked) {
                                                        landkreise.push(landkreis);
                                                    } else {
                                                        let i = landkreise.indexOf(landkreis);
                                                        landkreise.splice(i, 1);
                                                    }
                                                    console.log(landkreise);
                                                    document.getElementById('landkreise').value = landkreise;
                                                }
                                            </script>

                                            <input name="landkreise" id="landkreise" type=hidden value="" />

                                            <div class="flex relative flex-wrap">

                                                <ul class="list-group">
                                                    @foreach($landkreise as $landkreis)

                                                    <li class="list-group-item mb-1">
                                                        <input class="form-check-input me-1 bg-gray-800 mr-1" type="checkbox" value="{{ $landkreis }}" id="{{ $landkreis }}" onclick="addLandkreisToSelection(this.value, this.checked)">
                                                        <span class="text-gray-300">{{ $landkreis }}</span>
                                                    </li>
                                                    @endforeach
                                                </ul>

                                            </div>

                                            <script>
                                                @if(isset($selected_landkreise))
                                                @foreach($selected_landkreise as $landkreis)
                                                document.getElementById("{{ $landkreis }}").click();
                                                console.log("{{ $landkreis }}");
                                                @endforeach
                                                @endif
                                            </script>

                                        </div>

                                        <!-- Gebiete -->

                                        <!-- Fächer -->

                                        <div class="text-sm text-gray-500 text-light mt-3 ml-6">

                                            <p class="py-3 text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">Fächer</p>

                                            <script>
                                                var faecher = [];

                                                function addToSelection(fach, checked) {
                                                    console.log(fach, checked);
                                                    if (checked) {
                                                        faecher.push(fach);
                                                    } else {
                                                        let i = faecher.indexOf(fach);
                                                        faecher.splice(i, 1);
                                                    }
                                                    console.log(faecher);
                                                    document.getElementById('faecher').value = faecher;
                                                }
                                            </script>

                                            <input name="faecher" id="faecher" type=hidden value="" />

                                            <div class="flex relative flex-wrap">

                                                <ul class="list-group">
                                                    @foreach($faecher as $fach)

                                                    <li class="list-group-item mb-1">
                                                        <input class="form-check-input me-1 bg-gray-800 mr-1" type="checkbox" value="{{ $fach }}" id="{{ $fach }}" onclick="addToSelection(this.value, this.checked)">
                                                        <span class="text-gray-300">{{ $fach }}</span>
                                                    </li>
                                                    @endforeach
                                                </ul>

                                            </div>

                                            <script>
                                                @if(isset($selected_faecher))
                                                @foreach($selected_faecher as $fach)
                                                document.getElementById("{{ $fach }}").click();
                                                @endforeach
                                                @endif
                                            </script>

                                        </div>

                                        <!-- Fächer -->     

                                    </div>

                                    <!-- Suchen -->

                                    <div class="flex justify-end md:gap-8 gap-4 pt-1 rounded-md text-sm mb-4">

                                        <button class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-yellow-700 hover:border-transparent focus:outline-none focus:ring ring-yellow-300 focus:border-yellow-300 rounded flex items-center transform duration-150 hover:scale-105 transition-colors" form="search">

                                            <div>

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                                </svg>

                                            </div>

                                            <div class="pl-3 sm:inline-block hidden">

                                                <span>Suchen</span>

                                            </div>

                                        </button>

                                    </div>

                                    <!-- Suchen -->

                                </form>

                            </div>

                        </div>
                                
                    </div>

                    <script>
                        document.addEventListener('alpine:init', () => {
                          Alpine.store('accordion', {
                            tab: 0
                          });
                          
                          Alpine.data('accordion', (idx) => ({
                            init() {
                              this.idx = idx;
                            },
                            idx: -1,
                            handleClick() {
                              this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this.idx;
                            },
                            handleRotate() {
                              return this.$store.accordion.tab === this.idx ? 'rotate-180' : '';
                            },
                            handleToggle() {
                              return this.$store.accordion.tab === this.idx ? `max-height: ${this.$refs.tab.scrollHeight}px` : '';
                            }
                          }));
                        })
                    </script>

                </div>

            </div>

            <!-- Angebote -->

            <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md mt-4">

                <h2 class="font-semibold text-lg text-gray-200">

                    Gefundene Angebote

                </h2>

                <!-- Anzahl -->

                @php

                    $zaehler = 0;

                @endphp

                @foreach($users as $user)

                    @if($user->survey_data->schulart  == "Gymnasium")

                        @php

                            $zaehler++;

                        @endphp

                    @endif

                @endforeach

                @if ($zaehler == 0)

                    <div class="mt-1 text-sm text-gray-300 text-center sm:text-left">

                        Es wurde <strong>kein Angebot</strong> gefunden.

                    </div>

                @elseif ($zaehler == 1)

                    <div class="mt-1 text-sm text-gray-300 text-center sm:text-left">

                        Das <strong>folgende Angebot</strong> wurde gefunden.

                    </div>

                @else

                    <div class="mt-1 text-sm text-gray-300 text-center sm:text-left">

                        Die folgenden <strong>{{ $zaehler }} Angebote</strong> wurden gefunden.

                    </div>

                @endif

                <!-- Anzahl -->

                <!-- Suchfilter -->

                <div class="min-w-full mt-4 mr-4 shadow-sm">

                    <p class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 rounded-t-lg tracking-wider uppercase font-bold">Auflistung von kompatiblen Angeboten</p>

                </div>

                @foreach($users as $user)

                    @if($user->survey_data->schulart  == "Gymnasium")

                    <div class="border-b border-gray-200 bg-gray-700 flex">

                        <div class="hidden sm:table-cell text-sm pl-6 py-4 text-gray-100 w-1/8">

                            {{ $user->created_at->diffForHumans() }}

                        </div>

                        <div class="px-6 py-4 w-1/4">

                            <div class="text-xs sm:text-sm leading-5 font-medium text-white">

                                <a href="{{ route('profile.details', ['id' => $user->id]) }}" class="text-xs sm:text-sm leading-5 font-medium text-white hover:underline break-all">

                                    {{ $user->survey_data->vorname }} {{ $user->survey_data->nachname }}

                                </a>

                            </div>

                            <a href="mailto:{{ $user->email }}" class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-all">{{ $user->email }} </a>

                        </div>

                        <div class="hidden sm:table-cell px-6 py-4 w-1/4">

                            <div class="text-xs sm:text-sm leading-5 font-medium text-white">
        
                                {{ $user->survey_data->schulart }}
                                
                            </div>

                            <!-- Fächer -->

                            @if(isset($user->survey_data->faecher))

                                <div class="text-xs sm:text-sm leading-5 text-gray-400">
            
                                    {{ $user->survey_data->faecher }}
                                    
                                </div>

                            @else

                                <div class="text-xs sm:text-sm leading-5 text-gray-400">
        
                                    Keine Fächer angegeben
                                    
                                </div>

                            @endif

                        </div>

                        <div class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap w-1/4">

                            <div class="text-xs sm:text-sm leading-5 text-gray-400">
        
                                {{ $user->survey_data->landkreise }}
                                
                            </div>

                        </div>

                        <div class="w-1/8 px-6 py-4 flex">

                            <!-- MSE -->

                            <div x-data="{ modelOpen: false }" class="flex flex-wrap mr-2 mb-2">

                                <button @click="modelOpen =!modelOpen" class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 max-h-9 transform duration-150 hover:scale-105 transition-colors">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                                    </svg>

                                    <span>Details</span>

                                </button>

                                <!-- ModelOpen -->

                                <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

                                    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

                                        <div x-cloak @click="modelOpen = false" x-show="modelOpen" 
                                            x-transition:enter="transition ease-out duration-300 transform"
                                            x-transition:enter-start="opacity-0" 
                                            x-transition:enter-end="opacity-100"
                                            x-transition:leave="transition ease-in duration-200 transform"
                                            x-transition:leave-start="opacity-100" 
                                            x-transition:leave-end="opacity-0"
                                            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                                        >
                                            
                                        </div>

                                        <!-- ModelOpen -->

                                        <!-- ModelOpen x-cloak -->

                                        <div x-cloak x-show="modelOpen" 
                                            x-transition:enter="transition ease-out duration-300 transform"
                                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave="transition ease-in duration-200 transform"
                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                            class="bg-gray-700 inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                                        >

                                        <!-- ModelOpen x-cloak -->

                                            <!-- ModelInner -->

                                            <div class="flex items-center justify-between space-x-4">

                                                <div class="mt-4 flex">

                                                    <!-- Person -->

                                                    <a href="{{ route('profile.details', ['id' => $user->id]) }}" class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-600 focus:outline-none focus:bg-pink-500 focus:ring focus:ring-pink-300 focus:ring-opacity-50 max-h-9 transform duration-150 hover:scale-105 transition-colors mr-2">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                        </svg>

                                                        <p>Person</p>

                                                    </a>

                                                    <!-- Person -->
                                                
                                                    <!-- Anfragen -->

                                                    <form action="/messages/create/{{ $user->id }}" method="get">

                                                        {{ csrf_field() }}

                                                        <input class="py-2 px-3 bg-gray-100 border-1 w-full rounded-sm form-control form-input" placeholder="Ihr Betreff." value="Anfrage zu Angebot #{{ $user->id }}" name="subject" type="hidden">

                                                        <textarea name="message" placeholder="Ihre Nachricht." style="display:none;">Ich möchte auf Ihr Angebot #{{ $user->id }} reagieren, wobei folgende Spezifika mit angegeben wurden: Die Beschreibung Ihres Angebots lautet: Hätten Sie Interesse an meiner Unterstützung?</textarea>

                                                        <div class="checkbox">

                                                            <!-- <input name="recipients[]" value="{{ $user->id }}" type="hidden"> -->

                                                        </div>

                                                        <div class="form-group mr-2">

                                                            <button type="submit" class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-600 focus:outline-none focus:bg-pink-500 focus:ring focus:ring-pink-300 focus:ring-opacity-50 max-h-9 transform duration-150 hover:scale-105 transition-colors">          
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"></path>
                                                                </svg>

                                                                <p>Nachricht</p>
                                                                                        
                                                            </button>

                                                        </div>

                                                    </form>

                                                    <!-- Anfragen -->

                                                    <!-- E-Mail -->

                                                    <a href="mailto:{{  $user->email }}" class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-600 focus:outline-none focus:bg-pink-500 focus:ring focus:ring-pink-300 focus:ring-opacity-50 max-h-9 transform duration-150 hover:scale-105 transition-colors">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                                            </svg>

                                                        <p>E-Mail</p>

                                                    </a>

                                                    <!-- E-Mail -->

                                                </div>

                                                <button @click="modelOpen = false" class="text-gray-400 focus:outline-none hover:text-gray-100">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />

                                                    </svg>

                                                </button>

                                            </div>

                                            

                                            <p class="mt-4 text-gray-400 text-sm">

                                                Sehen Sie sich das Angebot #{{ $user->id }} genauer an. Sollten Rückfragen auftreten, scheuen Sie sich nicht davor, die Lehrkraft zu kontaktieren.

                                            </p>
                                                        
                                            <div class="mt-4">

                                                <h3 class="text-xl font-medium text-gray-200">Informationen zur Person</h3>

                                                <!-- Schulart -->

                                                <div class="w-full mt-3 text-sm text-gray-400">

                                                    <p class="text-gray-200 mb-1">

                                                        Schulart

                                                    </p>                                                   

                                                    <p>

                                                        Ich studiere für die Schulart {{ $user->survey_data->schulart }} Lehramt.

                                                    </p>

                                                </div>

                                                <!-- Schulart -->

                                                <!-- Fachsemester -->

                                                <div class="w-full mt-3 text-sm text-gray-400">

                                                    <p class="text-gray-200 mb-1">

                                                        Fachsemester

                                                    </p>                                                   

                                                    <p>

                                                         Ich befinde mich jetzt in meinen für das Matching gewählten Fächern mindestens im {{ $user->survey_data->fachsemester }} Fachsemester.

                                                    </p>

                                                </div>

                                                <!-- Fachsemester -->

                                                <!-- Faecher -->

                                                <div class="w-full mt-3 text-sm text-gray-400">

                                                    <p class="text-gray-200 mb-1">

                                                        Fächer

                                                    </p>                                                   

                                                    <p>

                                                         Ich möchte gerne in folgenden meiner studierten Fächer gematcht werden: {{ $user->survey_data->faecher }}.

                                                    </p>

                                                </div>

                                                <!-- Faecher -->

                                                <div>

                                                    <h3 class="text-xl font-medium text-gray-200 mt-4">Informationen zur Zusammenarbeit</h3>

                                                    <!-- Feedback Lehr zu Stud -->

                                                    <div class="w-full mt-3 text-sm text-gray-400">

                                                        <p class="text-gray-200 mb-1">Feedback von Lehr:mentor*in</p>

                                                        <p>

                                                            Das Feedback, das mir mein*e Lehr:mentor*in geben sollte, 

                                                            @switch($user->survey_data->feedback_von)

                                                                @case('1')

                                                                    <span class="status">ist sehr behutsam.</span>
                                                                    @break
                                                     
                                                                @case('2')

                                                                    <span class="status">ist eher behutsam.</span>
                                                                    @break

                                                                 @case('3')

                                                                    <span class="status">ist manchmal behutsam, manchmal direkt.</span>
                                                                    @break

                                                                 @case('4')

                                                                    <span class="status">ist eher direkt.</span>
                                                                    @break

                                                                 @case('5')

                                                                    <span class="status">ist sehr direkt.</span>
                                                                    @break
                                                     
                                                                @default

                                                                    <span class="status">-</span>

                                                            @endswitch

                                                        </p>

                                                    </div>

                                                    <!-- Feedback Lehr zu Stud -->

                                                    <!-- Feedback Stud zu Lehr -->

                                                    <div class="w-full mt-3 text-sm text-gray-400">

                                                        <p class="text-gray-200 mb-1">Feedback an Lehr:mentor*in</p>

                                                        <p>

                                                           Beim Feedback, das ich meinem Lehr:mentor bzw. meiner Lehr:mentorin gebe, sage ich ganz direkt, was ich von seinem bzw. ihrem Unterricht halte: 

                                                            @switch($user->survey_data->feedback_an)

                                                                @case('1')

                                                                    <span class="status">Trifft überhaupt nicht zu.</span>
                                                                    @break
                                                     
                                                                @case('2')

                                                                    <span class="status">Trifft eher nicht zu.</span>
                                                                    @break

                                                                 @case('3')

                                                                    <span class="status">Teils, teils.</span>
                                                                    @break

                                                                 @case('4')

                                                                    <span class="status">Trifft eher zu.</span>
                                                                    @break

                                                                 @case('5')

                                                                    <span class="status">Trifft voll und ganz zu.</span>
                                                                    @break
                                                     
                                                                @default

                                                                    <span class="status">-</span>

                                                            @endswitch

                                                        </p>

                                                    </div>

                                                    <!-- Feedback Stud zu Lehr -->

                                                    <!-- Eigenständigkeit -->

                                                    <div class="w-full mt-3 text-sm text-gray-400">

                                                        <p class="text-gray-200 mb-1">Eigenständigkeit</p>

                                                        <p>

                                                          Ich möchte langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen: 

                                                            @switch($user->survey_data->eigenstaendigkeit)

                                                                @case('1')

                                                                    <span class="status">Trifft überhaupt nicht zu.</span>
                                                                    @break
                                                     
                                                                @case('2')

                                                                    <span class="status">Trifft eher nicht zu.</span>
                                                                    @break

                                                                 @case('3')

                                                                    <span class="status">Teils, teils.</span>
                                                                    @break

                                                                 @case('4')

                                                                    <span class="status">Trifft eher zu.</span>
                                                                    @break

                                                                 @case('5')

                                                                    <span class="status">Trifft voll und ganz zu.</span>
                                                                    @break
                                                     
                                                                @default

                                                                    <span class="status">-</span>

                                                            @endswitch

                                                        </p>

                                                    </div>

                                                    <!-- Eigenständigkeit -->

                                                    <!-- Improvisation -->

                                                    <div class="w-full mt-3 text-sm text-gray-400">

                                                        <p class="text-gray-200 mb-1">Improvisation</p>

                                                        <p>

                                                            Situationen, in denen ich improvisieren muss, versuche ich durch intensive Planung strikt zu vermeiden: 

                                                            @switch($user->survey_data->improvisation)

                                                                @case('1')

                                                                    <span class="status">Trifft überhaupt nicht zu.</span>
                                                                    @break
                                                     
                                                                @case('2')

                                                                    <span class="status">Trifft eher nicht zu.</span>
                                                                    @break

                                                                 @case('3')

                                                                    <span class="status">Teils, teils.</span>
                                                                    @break

                                                                 @case('4')

                                                                    <span class="status">Trifft eher zu.</span>
                                                                    @break

                                                                 @case('5')

                                                                    <span class="status">Trifft voll und ganz zu.</span>
                                                                    @break
                                                     
                                                                @default

                                                                    <span class="status">-</span>

                                                            @endswitch

                                                        </p>

                                                    </div>

                                                    <!-- Improvisation -->

                                                    <!-- Freiraum -->

                                                    <div class="w-full mt-3 text-sm text-gray-400">

                                                        <p class="text-gray-200 mb-1">Freiraum</p>

                                                        <p>

                                                            Ich wünsche mir eine*n Lehr:mentor*in, die bzw. der: 

                                                            @switch($user->survey_data->freiraum)

                                                                @case('1')

                                                                    <span class="status">mir eher Freiraum für eigene Ideen und Entscheidungen lässt.</span>
                                                                    @break
                                                     
                                                                @case('2')

                                                                    <span class="status">mir teils Freiraum lässt, teils klare Anweisungen gibt.</span>
                                                                    @break

                                                                 @case('3')

                                                                    <span class="status">mir eher klare Anweisungen gibt.</span>
                                                                    @break
                                                     
                                                                @default

                                                                    <span class="status">-</span>

                                                            @endswitch

                                                        </p>

                                                    </div>

                                                    <!-- Freiraum -->

                                                    <!-- Innovationsoffenheit -->

                                                    <div class="w-full mt-3 text-sm text-gray-400">

                                                        <p class="text-gray-200 mb-1">Innovationsoffenheit</p>

                                                        <p>

                                                           Ein großer Erfahrungsschatz ist mir bei meinem Lehr:mentor bzw. meiner Lehr:mentorin wichtiger als die Neigung, Neues auszuprobieren: 

                                                            @switch($user->survey_data->innovationsoffenheit)

                                                                @case('1')

                                                                    <span class="status">Trifft überhaupt nicht zu.</span>
                                                                    @break
                                                     
                                                                @case('2')

                                                                    <span class="status">Trifft eher nicht zu.</span>
                                                                    @break

                                                                 @case('3')

                                                                    <span class="status">Teils, teils.</span>
                                                                    @break

                                                                 @case('4')

                                                                    <span class="status">Trifft eher zu.</span>
                                                                    @break

                                                                 @case('5')

                                                                    <span class="status">Trifft voll und ganz zu.</span>
                                                                    @break
                                                     
                                                                @default

                                                                    <span class="status">-</span>

                                                            @endswitch
                                                        </p>

                                                    </div>

                                                    <!-- Innovationsoffenheit -->

                                                    <!-- Belastbarkeit -->

                                                    <div class="w-full mt-3 text-sm text-gray-400">

                                                        <p class="text-gray-200 mb-1">Belastbarkeit</p>

                                                        <p>

                                                           Ich traue mir zu, mit meinem Lehr:mentor bzw. meiner Lehr:mentorin in „schwierigen“ oder höheren Klassen zu unterrichten: 

                                                            @switch($user->survey_data->belastbarkeit)

                                                                @case('1')

                                                                    <span class="status">Trifft überhaupt nicht zu.</span>
                                                                    @break
                                                     
                                                                @case('2')

                                                                    <span class="status">Trifft eher nicht zu.</span>
                                                                    @break

                                                                 @case('3')

                                                                    <span class="status">Teils, teils.</span>
                                                                    @break

                                                                 @case('4')

                                                                    <span class="status">Trifft eher zu.</span>
                                                                    @break

                                                                 @case('5')

                                                                    <span class="status">Trifft voll und ganz zu.</span>
                                                                    @break
                                                     
                                                                @default

                                                                    <span class="status">-</span>

                                                            @endswitch
                                                        </p>

                                                    </div>

                                                    <!-- Belastbarkeit -->

                                                    <!-- Praktika -->

                                                    <div class="w-full mt-3 text-sm text-gray-200 mb-1">

                                                        <p>
                                                            Welche(s) der folgenden Praktika haben Sie im Rahmen Ihres Lehramtsstudiums bereits absolviert?:
                                                        </p>
                                                        <ul>
                                                            @foreach($user->survey_data->praktika as $praktikum)
                                                                <li class="list-disc ml-6 text-gray-400"> {{ $praktikum }} </li>
                                                            @endforeach
                                                        </ul>   

                                                    </div>

                                                    <!-- Praktika -->

                                                    <!-- Aufmerksam geworden -->

                                                    <div class="w-full mt-3 text-sm text-gray-200 mb-1">
                                                        <p>
                                                            Wodurch sind Sie auf das Projekt aufmerksam geworden?
                                                        </p>
                                                        <ul>
                                                            @foreach($user->survey_data->aufmerksam_geworden as $aufmerksam)
                                                                <li class="list-disc ml-6 text-gray-400"> {{ $aufmerksam }} </li>
                                                            @endforeach
                                                        </ul>    

                                                    </div>

                                                    <!-- Aufmerksam geworden -->

                                                    <!-- Freue mich auf -->

                                                    <div class="w-full mt-3 text-sm text-gray-200 mb-1">

                                                        <p>
                                                            Ich freue mich im Rahmen der Lehr:werkstatt besonders darauf: 
                                                        </p>
                                                        <ul>
                                                            @foreach($user->survey_data->freue_auf as $freuen)
                                                                <li class="list-disc ml-6 text-gray-400"> {{ $freuen }} </li>
                                                            @endforeach
                                                        </ul>                                                        

                                                    </div>

                                                    <!-- Aufmerksam geworden -->

                                                    <!-- Anmerkungen -->

                                                    <div class="w-full mt-3 text-sm text-gray-200">

                                                        <p class="mb-1">Anmerkungen</p>

                                                        <span class="text-gray-400">{{ $user->survey_data->anmerkungen }}</span>

                                                    </div>

                                                    <!-- Anmerkungen -->

                                                </div>



                                            </div>

                                                <!-- ModelInner -->

                                            </div>

                                        </div>

                                    </div>

                                </div>
                        
                            <!-- MSE -->

                        </div>

                    </div>

                    @endif

                @endforeach
                    
            </div>

 <!-- Zeige alle offers -->

                </div>

                <!-- Tab Contents -->

            </div>

            <!-- Alle Angebote -->

        </div>

        <!-- Content -->

    </div>

@endsection