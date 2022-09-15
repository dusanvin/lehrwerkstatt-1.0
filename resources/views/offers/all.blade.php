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

                <li class="px-4 py-2 -mb-px font-medium text-xs sm:text-sm text-gray-200 border-b-2 border-gray-700 rounded-t opacity-50 bg-gray-800 border-b-4 -mb-px opacity-100"><a href="{{ route('users.lehr') }}">Alle Schularten</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600"><a href="{{ route('users.lehr', ['schulart' => 'Grundschule']) }}">Grundschule</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600"><a href="{{ route('users.lehr', ['schulart' => 'Realschule']) }}">Realschule</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600"><a href="{{ route('users.lehr', ['schulart' => 'Gymnasium']) }}">Gymnasium</a></li>

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

                            <p>Hier erhalten Sie eine Übersicht zu den <span class="font-semibold">momentan aktiven Angeboten</span>. Die Darstellung erfolgt in Abhängigkeit Ihrer Suchkriterien. Sollten keine Kriterien ausgewählt werden, erfolgt keine Filterung.</p>

                        </div>

                        <div class="flex flex-col">

                            <div class="bg-gray-700 my-4 shadow-sm rounded-md" x-data="accordion(1)">

                                <h2 @click="handleClick()" class="flex flex-row justify-between items-center px-4 cursor-pointer text-sm text-gray-300 px-6 py-6 hover:text-gray-200">

                                    <p>

                                        Suchen Sie nach <span class="font-semibold">aktiven Angeboten</span>. Filtern Sie diese bei Bedarf nach Schulart, Einsatzgebieten und Fächern. Fächer sind bei der Schulart <em>Grundschule</em> irrelevant.

                                    </p>

                                    <svg :class="handleRotate()" class="fill-current text-gray-200 h-6 w-6 transform transition-transform duration-500" viewBox="0 0 20 20">

                                        <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>

                                    </svg>

                                </h2>

                                <div x-ref="tab" :style="handleToggle()" class="overflow-hidden max-h-0 duration-500 transition-all px-6">

                                    <form id="search" action="{{ route('users.lehr') }}" method="post">

                                    @csrf

                                    <div class="flex flex-wrap mb-6">
                                        
                                        <!-- Schulart -->

                                        <div class="text-sm text-gray-500 text-light mt-3 mr-6">

                                            <p class="py-3 text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">Schulart</p>

                                            <!--<p class="text-xs text-gray-500 mt-1 mb-3">Ändern Sie, welche Schule Sie bevorzugen.</p> -->

                                            <div>

                                                <label for="schulart" class="sr-only flex items-center">schulart</label>

                                                <select name="schulart" id="schulart" class="text-gray-300 text-xs py-1 pl-2 pr-8 rounded-sm bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent @error('schulart') border-red-500 @enderror">
                                                    <option>Beliebig</option>
                                                    <option>Grundschule</option>
                                                    <option>Realschule</option>
                                                    <option>Gymnasium</option>
                                                </select>

                                                <script>
                                                    var schulart_select = document.getElementById("schulart");
                                                    @if(isset($schulart))
                                                    schulart_select.value = "{{ $schulart }}";
                                                    @endif
                                                </script>

                                                @error('schulart')

                                                <div class="text-red-500 mt-2 text-sm">

                                                    {{ 'Bitte legen Sie fest, welche Schule Sie bevorzugen.' }}

                                                </div>

                                                @enderror

                                            </div>

                                        </div>

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

                @if ($users->count() == 0)

                    <div class="mt-1 text-sm text-gray-300 text-center sm:text-left">

                        Es wurde <strong>kein Angebot</strong> gefunden.

                    </div>

                @elseif ($users->count() == 1)

                    <div class="mt-1 text-sm text-gray-300 text-center sm:text-left">

                        Das <strong>folgende Angebot</strong> wurde gefunden.

                    </div>

                @else

                    <div class="mt-1 text-sm text-gray-300 text-center sm:text-left">

                        Die folgenden <strong>{{ $users->count() }} Angebote</strong> wurden gefunden.

                    </div>

                @endif

                <!-- Anzahl -->

                <!-- Suchfilter -->

                <div class="min-w-full mt-4 mb-2 mr-4 shadow-sm">

                    <p class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 rounded-t-lg tracking-wider uppercase font-bold">Auflistung von kompatiblen Angeboten</p>

                </div>



                    <div class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

                        Angebote

                    </div>

                    <div class="shadow-sm rounded-lg" id="angebote">

                        @if ($users->count())

                            @foreach($users as $user)

                            <div class="bg-white rounded-md pb-4">

                                <div class="px-1 sm:px-4 sm:px-6 border-t border-gray-200">

                                    <!-- Informationen -->

                                    <div class="flex items-center justify-between pt-4 leading-5 sm:leading-6 mb-4 text-xs sm:text-lg font-medium">

                                        <a class="flex hover:underline" href="{{ route('profile.details', ['id' => $user->id]) }}">

                                            {{ $user->survey_data->vorname }} {{ $user->survey_data->nachname }}

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 pt-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                            </svg>

                                        </a>

                                        <div>

                                            <span class="text-gray-400 text-xs"><strong><span class="hidden sm:inline-block">Angebot </span> #{{ $user->id }}</strong> <span class="hidden sm:inline-block">erstellt </span> {{ $user->created_at->diffForHumans() }}</span>

                                        </div>

                                    </div>

                                    <!-- Informationen -->

                                    <div class="block sm:flex sm:flex-wrap content-start">

                                        <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Schulart: <span class="font-medium">{{ $user->survey_data->schulart }}</span></p>
                                        @if(isset($user->survey_data->faecher))
                                        <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Angebotene Fächer: <span class="font-medium">{{ $user->survey_data->faecher }}</span></p>
                                        @endif
                                        <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Ausübungsort: <span class="font-medium">{{ $user->survey_data->postleitzahl }} {{ $user->survey_data->ort }}</span></p>
                                        <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Gebiet: <span class="font-medium">{{ $user->survey_data->landkreis }}</span></p>

                                    </div>

                                    <!-- Informationen -->

                                </div>

                            </div>

                            @endforeach

                        @else

                        <p class="hidden">Keine Einträge vorhanden.</p>

                        @endif

                    </div>

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