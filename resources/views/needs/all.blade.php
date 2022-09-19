@extends ('layouts.app')

@section('content')

<div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->

    <!-- Content -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-600">

        <div class="mx-auto rounded">

            <!-- Tabs -->

            <ul id="tabs" class="inline-flex w-full">

                <li class="px-4 py-2 -mb-px font-medium text-xs sm:text-sm text-gray-800 border-b-2 border-gray-700 rounded-t opacity-50 bg-white border-b-4 -mb-px opacity-100"><a href="{{ route('users.stud') }}">Alle Schularten</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-800 rounded-t opacity-50 bg-white border-gray-400"><a href="{{ route('users.stud', ['schulart' => 'grundschule']) }}">Grundschule</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-800 rounded-t opacity-50 bg-white border-gray-400"><a href="{{ route('users.stud', ['schulart' => 'realschule']) }}">Realschule</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-800 rounded-t opacity-50 bg-white border-gray-400"><a href="{{ route('users.stud', ['schulart' => 'gymnasium']) }}">Gymnasium</a></li>

            </ul>

            <!-- Tabs -->

            <!-- Tab Contents -->

            <div id="tab-contents">

                <!-- Alle Angebote -->

                <div id="first" class="px-4 pt-4 pb-2 bg-white mb-4 rounded-b-md">

                    <!-- <div class="grid grid-cols-1 text-sm text-gray-500 text-light py-1 my-2">

                        <p class="font-medium text-gray-800 leading-none text-lg leading-6">Angebotsübersicht</p>

                        <p class="text-sm text-gray-500 mt-1 mb-3 mt-2">Erhalten Sie eine Übersicht über alle aktiven Angebote. Fragen Sie ein Angebot an, um Ihr fach zu bekunden. Sollte Ihnen ein Angebot gefallen, können Sie dieses gern liken.</p>

                    </div> -->

                    <!-- Suchfilter -->

                    <div class="grid grid-cols-1 text-sm text-gray-500 text-light py-1 my-2">

                        <p class="font-medium text-gray-800 leading-none text-lg leading-6">

                            Suchfilter

                        </p>

                        <!-- Jumbatron -->

                        <div class="rounded-sm flex flex-row-reverse">

                            <details class="flex-auto">

                                <summary class="cursor-pointer text-sm text-gray-500 mt-1 mb-3 mt-2">

                                    Suchen Sie nach aktiven Angeboten.

                                </summary>

                                <!-- Details -->

                                <form id="search" action="{{ route('users.stud') }}" method="post">

                                    @csrf

                                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 mb-6">
                                        <div>
                                            <!-- Schulart -->

                                            <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                                <p class="font-medium text-gray-800 leading-none mb-3">Schulart</p>

                                                <!--<p class="text-xs text-gray-500 mt-1 mb-3">Ändern Sie, welche Schule Sie bevorzugen.</p> -->

                                                <div>

                                                    <label for="schulart" class="sr-only flex items-center">schulart</label>

                                                    <select name="schulart" id="schulart" class="text-gray-500 text-xs py-1 px-2 rounded-sm border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent @error('schulart') border-red-500 @enderror">
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

                                            <!-- Fächer -->

                                            <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                                <p class="font-medium text-gray-800 leading-none mb-3">Fächer (nur relevant für Realschule und Gymnasium)</p>

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

                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox" value="{{ $fach }}" id="{{ $fach }}" onclick="addToSelection(this.value, this.checked)">
                                                            {{ $fach }}
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

                                        <!-- Landkreise -->

                                        <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                            <p class="font-medium text-gray-800 leading-none mb-3">Gebiete</p>

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

                                                    <li class="list-group-item">
                                                        <input class="form-check-input me-1" type="checkbox" value="{{ $landkreis }}" id="{{ $landkreis }}" onclick="addLandkreisToSelection(this.value, this.checked)">
                                                        {{ $landkreis }}
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

                                        <!-- Landkreise -->

                                        <!-- Suchen -->

                                        <div class="flex justify-end md:gap-8 gap-4 pt-1 rounded-md text-sm">

                                            <button class="flex items-center w-auto bg-gray-700 hover:bg-gray-900 rounded-lg font-medium text-white px-4 py-2" form="search">

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

                            </details>

                            <!-- Details -->

                        </div>

                        <!-- Jumbatron -->

                    </div>

                    <!-- Kontakt -->

                </div>

                <!-- Anzahl -->

                @if ($users->count() == 0)

                <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                    Kein Angebot gefunden.

                </div>

                @elseif ($users->count() == 1)

                <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                    {{ $users->count() }} Angebot gefunden.

                </div>

                @else

                <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                    {{ $users->count() }} Angebote gefunden.

                </div>

                @endif

                <!-- Anzahl -->

                <!-- Suchfilter -->

                <div class="px-2 sm:px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider rounded-tl-md">

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
                                <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Mögliche Ausübungsorte: <span class="font-medium">{{ $user->survey_data->landkreise }}</span></p>
                                
                            </div>

                            <!-- Informationen -->

                        </div>

                    </div>

                    </script>

                    @endforeach

                </div>

                @else

                <p class="hidden">Keine Einträge vorhanden.</p>

                @endif

                <!-- Zeige alle needs -->

            </div>

        </div>

        <!-- Alle Angebote -->

    </div>

</div>

<!-- Tab Contents -->

</div>

</div>

</div>

<!-- Content -->

@endsection