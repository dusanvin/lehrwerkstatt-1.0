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

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600"><a href="{{ route('users.lehr') }}">Alle Schularten</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600"><a href="{{ route('users.lehr', ['schulart' => 'grundschule']) }}">Grundschule</a></li>

                <li class="px-4 py-2 -mb-px font-medium text-xs sm:text-sm text-gray-200 border-b-2 border-gray-700 rounded-t opacity-50 bg-gray-800 border-b-4 -mb-px opacity-100"><a href="{{ route('users.lehr', ['schulart' => 'realschule']) }}">Realschule</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600"><a href="{{ route('users.lehr', ['schulart' => 'gymnasium']) }}">Gymnasium</a></li>

            </ul>

            <!-- Tabs -->

            <!-- Tab Contents -->

            <div id="tab-contents">

                <!-- Alle Angebote -->

                <div id="first" class="px-4 pt-4 pb-2 bg-gray-800 mb-4 rounded-b-md">

                    <!-- <div class="grid grid-cols-1 text-sm text-gray-500 text-light py-1 my-2">

                        <p class="font-medium text-gray-800 leading-none text-lg leading-6">Angebotsübersicht</p>

                        <p class="text-sm text-gray-500 mt-1 mb-3 mt-2">Erhalten Sie eine Übersicht über alle aktiven Angebote. Fragen Sie ein Angebot an, um Ihr fach zu bekunden. Sollte Ihnen ein Angebot gefallen, können Sie dieses gern liken.</p>

                    </div> -->

                    <!-- Suchfilter -->

                    <div class="grid grid-cols-1 text-sm text-gray-500 text-light py-1 my-2 px-1 md:px-4">

                        <!-- Übernommene Vorschläge -->

                        <h1 class="font-semibold text-2xl text-gray-200 text-center sm:text-left">

                            Angebote

                        </h1>

                        <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left flex">

                            <p>Hier erhalten Sie eine Übersicht zu den momentan aktiven Angeboten in der <span class="font-semibold">Realschule</span>. Die Darstellung erfolgt in Abhängigkeit Ihrer Suchkriterien. Sollten keine Kriterien ausgewählt werden, erfolgt keine Filterung.</p>

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

                                    <form id="search" action="{{ route('users.lehr', ['schulart' => 'realschule']) }}" method="post">

                                    @csrf

                                    <div class="flex flex-wrap mb-6">

                                        <!-- Schulart -->

                                        <script>
                                            var schulart_select = document.getElementById("schulart");
                                            @if(isset($schulart))
                                            schulart_select.value = "realschule";
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

                                        <button class="bg-yellow-700 bg-transparent hover:bg-green-600 text-white font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-transparent focus:outline-none focus:ring ring-green-300 focus:border-green-300 rounded flex items-center transition ease-in-out duration-150" form="search">

                                            <div>

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />

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

                    @if($user->survey_data->schulart  == "Realschule")

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

                    @if($user->survey_data->schulart  == "Realschule")

                    <div class="border-b border-gray-200 bg-gray-700 flex">

                        <div class="hidden sm:table-cell text-sm pl-6 py-4 text-gray-100 w-1/8">

                            {{ $user->created_at->diffForHumans() }}

                        </div>

                        <div class="px-6 py-4 w-1/4">

                            <div class="text-xs sm:text-sm leading-5 font-medium text-white">

                                <a href="{{ route('profile.details', ['id' => $user->id]) }}" class="text-xs sm:text-sm leading-5 font-medium text-white hover:underline break-all">

                                    {{ $user->vorname }} {{ $user->nachname }}

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

                            <div class="text-xs sm:text-sm leading-5 font-medium text-white">
        
                                {{ $user->survey_data->postleitzahl }}
                                
                            </div>

                            <div class="text-xs sm:text-sm leading-5 text-gray-400">
        
                                {{ $user->survey_data->landkreis }}
                                
                            </div>

                        </div>

                        <div class="w-1/8 px-6 py-4 flex">

                            <!-- MSE -->

                            <div x-data="{ modelOpen: false }" class="flex flex-wrap mr-2 mb-2">

                                <button @click="modelOpen =!modelOpen" class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 max-h-9">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                      <path d="M9 9a2 2 0 114 0 2 2 0 01-4 0z" />
                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a4 4 0 00-3.446 6.032l-2.261 2.26a1 1 0 101.414 1.415l2.261-2.261A4 4 0 1011 5z" clip-rule="evenodd" />
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

                                                <h1 class="text-xl font-medium text-gray-100">Angebot #{{ $user->id }}</h1>

                                                <button @click="modelOpen = false" class="text-gray-400 focus:outline-none hover:text-gray-100">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />

                                                    </svg>

                                                </button>

                                            </div>

                                            <p class="mt-2 text-gray-400 text-sm">
                                                Sehen Sie sich das Angebot genauer an.
                                            </p>
                                                        
                                            <div class="mt-4">

                                                <h3 class="text-xs font-medium text-white uppercase">Informationen zur Schule</h3>

                                                <div class="pb-4 w-full mt-3">

                                                    <div class="text-xs sm:text-sm leading-5 w-full text-gray-400">

                                                        <p class="text-gray-300 text-xs text-left leading-4 uppercase font-medium mb-1">{{ $user->survey_data->schulart }}</p>

                                                        {{ $user->survey_data->schulname }}, {{ $user->survey_data->strasse }} {{ $user->survey_data->hausnummer }} in {{ $user->survey_data->postleitzahl }} {{ $user->survey_data->ort }} (Landkreis {{ $user->survey_data->landkreis }})

                                                    </div>

                                                    <div class="text-xs sm:text-sm leading-5 w-full text-gray-400">

                                                        

                                                    </div>

                                                </div>

                                                <div>

                                                    <h3 class="text-xs font-medium text-white uppercase">Informationen zur Zusammenarbeit</h3>

                                                    <!-- Feedback Lehr zu Stud -->

                                                    <div class="w-full mt-3 text-sm text-gray-400">

                                                        <p class="text-gray-300 text-xs leading-4 uppercase font-medium mb-1">Feedback von Lehrkraft</p>

                                                        <p>

                                                            Das Feedback, das ich meinem Lehr:werker bzw. meiner Lehr:werkerin gebe:

                                                            @switch($user->survey_data->feedback_an)

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

                                                        <p class="text-gray-300 text-xs leading-4 uppercase font-medium mb-1">Feedback von Tandempartner*in</p>

                                                        <p>

                                                           Ich wünsche mir von meinem Lehr:werker bzw. meiner Lehr:werkerin kritische Rückmeldungen zu meinem Unterricht: 

                                                            @switch($user->survey_data->feedback_von)

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

                                                        <p class="text-gray-300 text-xs leading-4 uppercase font-medium mb-1">Eigenständigkeit</p>

                                                        <p>

                                                           Mein*e Lehr:werker*in soll langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen:            

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

                                                        <p class="text-gray-300 text-xs leading-4 uppercase font-medium mb-1">Improvisation</p>

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

                                                        <p class="text-gray-300 text-xs leading-4 uppercase font-medium mb-1">Freiraum</p>

                                                        <p>

                                                           Ich wünsche mir eine*n Lehr:werker*in, die bzw. der            

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

                                                        <p class="text-gray-300 text-xs leading-4 uppercase font-medium mb-1">Innovationsoffenheit</p>

                                                        <p>

                                                           Ich möchte lieber meine Erfahrungen an den bzw. die Lehr:werker*in weitergeben als gemeinsam mit ihm bzw. ihr Neues auszuprobieren:         

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

                                                        <p class="text-gray-300 text-xs leading-4 uppercase font-medium mb-1">Belastbarkeit</p>

                                                        <p>

                                                           Ich wünsche mir eine*n Lehr:werker*in, die bzw. der sich das Unterrichten in schwierigen bzw. höheren Klassen zutraut:     

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

                                                </div>

                                                <!-- Anfragen -->
                                                    
                                                <div class="mt-4 flex">

                                                    <form action="/messages/create/{{ $user->id }}" method="get">

                                                        {{ csrf_field() }}

                                                        <input class="py-2 px-3 bg-gray-100 border-1 w-full rounded-sm form-control form-input" placeholder="Ihr Betreff." value="Anfrage zu Angebot #{{ $user->id }}" name="subject" type="hidden">

                                                        <textarea name="message" placeholder="Ihre Nachricht." style="display:none;">Ich möchte auf Ihr Angebot #{{ $user->id }} reagieren, wobei folgende Spezifika mit angegeben wurden: Die Beschreibung Ihres Angebots lautet: Hätten Sie Interesse an meiner Unterstützung?</textarea>

                                                        <div class="checkbox">

                                                            <!-- <input name="recipients[]" value="{{ $user->id }}" type="hidden"> -->

                                                        </div>

                                                        <div class="form-group mr-2">

                                                            <button type="submit" class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 max-h-9">          

                                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                                                    <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                                                </svg>

                                                                <p>Anfragen</p>
                                                                                        
                                                            </button>

                                                        </div>

                                                    </form>

                                                    <!-- Anfragen -->

                                                    <!-- E-Mail -->

                                                    <a href="mailto:{{  $user->email }}" class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 max-h-9">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />

                                                        </svg>

                                                        <p>E-Mail schreiben</p>

                                                    </a>

                                                    <!-- E-Mail -->

                                                </div>

                                                <p class="text-gray-400 text-xs mt-2 mb-4">Sollte Ihnen der Bedarf zusagen, scheuen Sie sich nicht davor, die Lehrkraft zu kontaktieren</p>

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