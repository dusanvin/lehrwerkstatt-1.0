@extends ('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->

    <!-- Content -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg" style="background-color: #EDF2F7;">

        <div class="mx-auto rounded">

            <!-- Success Message -->

            <script>
                function removemessage() {
                    document.getElementById('success_make_offer').remove();
                }
            </script>

            @if ($message = Session::get('success'))

            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-600 text-xs sm:text-sm lg:text-lg" id="success_make_offer">

                <span class="text-xl inline-block mr-2 align-middle">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />

                    </svg>

                </span>

                <span class="inline-block align-middle">

                    <b>Aktion erfolgreich ausgeführt.</b>

                </span>

                <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="removemessage()">

                    <span>×</span>

                </button>

            </div>

            @endif

            <!-- Success Message -->

            <!-- Tabs -->

            <ul id="tabs" class="inline-flex w-full">

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-800 rounded-t opacity-50 bg-white border-gray-400"><a href="{{ route('offers.all') }}">Alle Angebote</a></li>

                <li class="px-4 py-2 -mb-px font-medium text-xs sm:text-sm text-gray-800 border-b-2 border-gray-700 rounded-t opacity-50 bg-white border-b-4 -mb-px opacity-100"><a href="{{ route('offers.user') }}">Meine Angebote</a></li>

                <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-800 rounded-t opacity-50 bg-white border-gray-400"><a href="{{ route('offers.make') }}">Angebot erstellen</a></li>

            </ul>

            <!-- Tabs -->

            <!-- Tab Contents -->

            <div id="tab-contents">

                <!-- Meine Angebote -->

                <div id="second" class="py-4 px-2 bg-white">

                    <div class="grid grid-cols-1 text-sm text-gray-500 text-light py-1 px-2 my-2">

                        <p class="font-medium text-gray-800 leading-none text-lg leading-6">Angebotsübersicht</p>

                        <p class="text-sm text-gray-500 mt-2 mb-3">Erhalten Sie eine Übersicht über Ihre Angebote. Sehen Sie sich Ihr Angebot genauer an, setzen Sie dieses auf aktiv/inaktiv oder löschen Sie dieses permanent.</p>

                    </div>

                    <div class="px-2">

                        <table class="min-w-full my-4 mr-4 shadow-sm rounded-lg">

                            <tr>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider rounded-tl-md">
                                    #</th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Datum</th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-right">
                                </th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-left">
                                </th>

                            </tr>

                            @if ($offers->count())

                                @foreach($offers as $offer)

                                    @if($offer->ownedBy(auth()->user()))

                                    <tr class="border-t border-gray-200">

                                        <!-- ID des Angebots -->

                                        <td class="pl-6 py-4 whitespace-no-wrap ">

                                            {{ $offer->id }}

                                        </td>

                                        <!-- ID des Angebots -->

                                        <!-- Status des Angebots -->

                                        <td class="px-6 py-4 whitespace-no-wrap ">

                                            @if ($offer->active == 1)

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-green-600 rounded-full">

                                                    <span class="has-tooltip">

                                                        Aktiv

                                                        <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 -ml-40 text-xs'>Ihr Angebot ist aktiv. Deaktivieren Sie es bei Bedarf.</span>

                                                    </span>

                                                </label>

                                            @else

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-red-600 rounded-full">

                                                    <span class="has-tooltip">

                                                        Inaktiv

                                                        <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 -ml-40 text-xs'>Ihr Angebot ist inaktiv. Aktivieren Sie es bei Bedarf.</span>
                                                        
                                                    </span>

                                                </label>

                                            @endif

                                        </td>

                                        <!-- Status des Angebots -->

                                        <!-- Erstellungsdatum des Angebots -->

                                        <td class="px-6 py-4 whitespace-no-wrap select-none text-sm">

                                            {{ $offer->created_at->diffForHumans() }}

                                        </td>

                                        <!-- Erstellungsdatum des Angebots -->

                                        <td class="pl-6 pr-0 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium flex">

                                            <!-- Anzeigen -->

                                            <div class="" x-data="{ open: false }">

                                                <button class="py-2 px-2 rounded-full bg-gray-700 text-white text-sm flex focus:outline-none ml-4 transition ease-in-out duration-150 has-tooltip hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300" @click="open=true">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />

                                                    </svg>

                                                    <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 -ml-5 text-xs'>Anzeigen</span>

                                                </button>

                                                <!-- Dialog (full screen) -->

                                                <div class="absolute top-0 left-0 flex items-center justify-center h-full w-full" style="background-color: rgba(0,0,0,.5);" x-cloak x-show="open">

                                                    <!-- A basic modal dialog with title, body and one button to close -->

                                                    <div class="h-auto p-4 mx-10 text-left bg-white rounded shadow-xl max-w-screen-sm" @click.away="open = false">

                                                        <div class="mt-3 text-center sm:text-left">

                                                            <h2 class="text-lg font-medium leading-6 text-gray-900">
                                                                Nähere Informationen zu Angebot #{{$offer->id}}
                                                            </h2>

                                                            <div class="mt-2">

                                                                <h3 class="text-sm">Datum</h3>

                                                                <p class="leading-5 text-gray-500 mb-2 text-xs">
                                                                    {{ $offer->created_at->diffForHumans() }}
                                                                </p>

                                                                <h3 class="text-sm">Betreuungszeitraum</h3>

                                                                <p class="leading-5 text-gray-500 mb-2 text-xs">
                                                                    <span class="font-medium">{{ date('m/Y', strtotime($offer->datum_start)) }} bis {{ date('m/Y', strtotime($offer->datum_end)) }}</span>
                                                                </p>

                                                                <h3 class="text-sm">Betreuungsrahmen</h3>

                                                                <p class="leading-5 text-gray-500 mb-2 text-xs">
                                                                    <span class="font-medium">{{ $offer->rahmen }} Person/en</span>
                                                                </p>

                                                                <h3 class="text-sm">Fremdsprachkenntnisse</h3>

                                                                <p class="leading-5 text-gray-500 mb-2 text-xs">
                                                                    <span class="font-medium">{{ $offer->sprachkenntnisse }}</span>
                                                                </p>

                                                                <h3 class="text-sm">Studiengang</h3>

                                                                <p class="leading-5 text-gray-500 mb-2 text-xs">
                                                                    <span class="font-medium">{{ $offer->studiengang }}
                                                                </p>

                                                                <h3 class="text-sm">Fachsemester</h3>

                                                                <p class="leading-5 text-gray-500 mb-2 text-xs">
                                                                    <span class="font-medium">{{ $offer->fachsemester }}
                                                                </p>

                                                                <h3 class="text-sm">Schulart</h3>

                                                                <p class="leading-5 text-gray-500 mb-2 text-xs">
                                                                    <span class="font-medium">{{ $offer->schulart }}
                                                                </p>

                                                                <h3 class="text-sm">Beschreibung</h3>

                                                                <p class="leading-5 text-gray-500 mb-2 text-xs">
                                                                    <span class="font-medium">{{ $offer->body }}
                                                                </p>

                                                            </div>

                                                        </div>

                                                        <!-- One big close button.  --->

                                                        <div class="mt-5 sm:mt-6">

                                                            <span class="flex w-full rounded-md shadow-sm">

                                                                <button @click="open = false" class="inline-flex justify-center w-full px-4 py-2 text-white bg-gray-700 rounded hover:bg-gray-900">
                                                                    Schließen
                                                                </button>

                                                            </span>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                            <!-- Anzeigen -->

                                            <!-- Bearbeiten -->

                                            <form action="{{ route('offers.edit', $offer) }}" method="post">

                                                @csrf

                                                @method('POST')

                                                <button type="submit" class="py-2 px-2 rounded-full bg-gray-700 text-white hover:ring ring-gray-300 border-2 border-white hover:border-gray-300 text-sm flex focus:outline-none ml-4 transition ease-in-out duration-150 has-tooltip hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300">

                                                    <div class="grid justify-items-center">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                          
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />

                                                        </svg>

                                                        <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Bearbeiten</span>    

                                                    </div>

                                                </button>

                                            </form>

                                            <!-- Bearbeiten -->

                                            @if ($offer->active)

                                                <!-- Angebot aktivieren -->

                                                <form action="{{ route('offers.setinactive', $offer) }}" method="post">

                                                    @csrf

                                                    <button type="submit" class="py-2 px-2 rounded-full bg-gray-700 text-white text-sm flex focus:outline-none ml-4 transition ease-in-out duration-150 has-tooltip hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300">

                                                        <div class="grid justify-items-center">

                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                                <path d="M3.707 2.293a1 1 0 00-1.414 1.414l6.921 6.922c.05.062.105.118.168.167l6.91 6.911a1 1 0 001.415-1.414l-.675-.675a9.001 9.001 0 00-.668-11.982A1 1 0 1014.95 5.05a7.002 7.002 0 01.657 9.143l-1.435-1.435a5.002 5.002 0 00-.636-6.294A1 1 0 0012.12 7.88c.924.923 1.12 2.3.587 3.415l-1.992-1.992a.922.922 0 00-.018-.018l-6.99-6.991zM3.238 8.187a1 1 0 00-1.933-.516c-.8 3-.025 6.336 2.331 8.693a1 1 0 001.414-1.415 6.997 6.997 0 01-1.812-6.762zM7.4 11.5a1 1 0 10-1.73 1c.214.371.48.72.795 1.035a1 1 0 001.414-1.414c-.191-.191-.35-.4-.478-.622z" />

                                                            </svg>

                                                            <!-- <span class="mx-3 mt-1">Angebot aktivieren</span> -->

                                                            <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Deaktivieren</span>

                                                        </div>

                                                    </button>

                                                </form>

                                                <!-- Angebot aktivieren -->

                                            @else

                                                <!-- Angebot deaktivieren -->

                                                <form action="{{ route('offers.setactive', $offer) }}" method="post">

                                                    @csrf

                                                    <button type="submit" class="py-2 px-2 rounded-full bg-gray-700 text-white text-sm flex focus:outline-none ml-4 transition ease-in-out duration-150 has-tooltip hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300">

                                                        <div class="grid justify-items-center">

                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                                <path fill-rule="evenodd" d="M5.05 3.636a1 1 0 010 1.414 7 7 0 000 9.9 1 1 0 11-1.414 1.414 9 9 0 010-12.728 1 1 0 011.414 0zm9.9 0a1 1 0 011.414 0 9 9 0 010 12.728 1 1 0 11-1.414-1.414 7 7 0 000-9.9 1 1 0 010-1.414zM7.879 6.464a1 1 0 010 1.414 3 3 0 000 4.243 1 1 0 11-1.415 1.414 5 5 0 010-7.07 1 1 0 011.415 0zm4.242 0a1 1 0 011.415 0 5 5 0 010 7.072 1 1 0 01-1.415-1.415 3 3 0 000-4.242 1 1 0 010-1.415zM10 9a1 1 0 011 1v.01a1 1 0 11-2 0V10a1 1 0 011-1z" clip-rule="evenodd" />

                                                            </svg>

                                                            <!-- <span class="mx-3 mt-1">Angebot deaktivieren</span> -->

                                                            <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Aktivieren</span>

                                                        </div>

                                                    </button>

                                                </form>

                                                <!-- Angebot deaktivieren -->

                                            @endif

                                        </td>

                                        <!-- Löschen -->

                                        <td class="px-6 py-4 whitespace-no-wrap">


                                            <form action="{{ route('offers.destroy', $offer) }}" method="post">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="py-2 px-2 rounded-full bg-gray-700 text-white text-sm flex focus:outline-none ml-4 transition ease-in-out duration-150 has-tooltip hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300">

                                                    <div class="grid justify-items-center">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>

                                                        <!-- <span class="mx-3 mt-1">Zurückziehen</span> -->
                                                        
                                                        <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Löschen</span>

                                                    </div>

                                                </button>

                                            </form>


                                        </td>
                                        
                                        <!-- Löschen -->

                                    </tr>

                                @endif

                            @endforeach

                        @endif

                    </table>

                    <div class="mt-5">

                        {{ $offers->links() }}

                    </div>

                </div>

            </div>

            <!-- Meine Angebote -->

        </div>

            <!-- Tab Contents -->

        </div>

    </div>

</div>

<!-- Content -->

@endsection