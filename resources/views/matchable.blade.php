@extends ('layouts.app')

@section('content')

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

        <!-- Content -->

        <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

            <div class="mx-auto rounded text-white">

                <!-- Schularten -->

                @include('layouts.schularten', ['routeName' => 'users.matchable', 'schulart' => $schulart])

                <!-- Schularten -->

                <h1 class="font-semibold text-2xl text-gray-200">

                    Tandemvorschläge

                </h1>

                <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left flex">

                    <p>Hier erhalten Sie eine Übersicht der bisher getätigten Paarungen für die Vorauswahl. Die Berechnung
                        erfolgt auf Basis des
                        <em>Mean Square Errors (Mittlerer quadratischer Fehler)</em> - kurz <em>MSE</em> - auf einer Skala
                        von 0-10. Umso kleiner dieser ist, umso geringer ist die Abweichung beziehungsweise besser die
                        Paarung. <strong>Ein großer MSE ist demnach nicht ratsam.</strong> Zu jeder Lehrkraft werden
                        Student*innen aufgelistet, die bezüglich Schulart, Landkreis und mindestens einem Fach kompatibel
                        sind. Sollten Sie einen Vorschlag in die Liste aufnehmen, werden beide Partner*innen aus dem Pool
                        der Suchenden entfernt.
                    </p>

                </div>

                <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md">

                    <div class="grid justify-items-center sm:justify-items-start select-none">

                        <h2 class="font-semibold text-lg text-gray-200">

                            Vorauswahl für {{ $schulart ?? 'alle Schularten' }}

                        </h2>

                        <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">

                            @if (count($matched_users) == 0)
                            @elseif (count($matched_users) == 1)
                                <p>Der folgende Vorschlag wurde von Ihnen übernommen. Sollten Sie den Vorschlag bestätigen,
                                    wird dieser unter <a href="{{ route('acceptedMatchings') }}"
                                        class="underline hover:text-white italic">Tandems</a> gelistet. Die
                                    Personen erhalten zudem eine E-Mail.</p>
                            @elseif (count($matched_users) > 1)
                                <p>Die folgenden <strong>{{ count($matched_users) }} Vorschläge</strong> wurden von Ihnen
                                    übernommen. Sollten Sie die Vorschläge bestätigen, werden diese unter <a
                                        href="{{ route('acceptedMatchings') }}"
                                        class="underline hover:text-white italic">Tandems</a> gelistet. Die
                                    Personen erhalten zudem eine E-Mail.</p>
                            @endif

                        </div>

                    </div>

                    <x-auswahl :matchings="$matched_users" :text="'Bisher wurden keine Vorschläge von Ihnen übernommen. Suchen Sie auf Basis des MSE nach Paarungen.'" :assign="false"/>


                    @if (count($matched_users))
                        <div class="mt-4 flex justify-end">

                            <a href="{{ route('notifyMatchings', ['schulart' => $schulart]) }}"
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-green-700 hover:border-transparent focus:outline-none focus:ring ring-green-300 focus:border-green-300 rounded flex items-center transition-colors duration-200 transform duration-150 hover:scale-105 transform">


                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>

                                <p class="pl-3">Bestätigen</p>

                            </a>

                        </div>
                    @endif

                </div>


                {{-- recommended --}}

                <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md mt-4">

                    <div class="grid justify-items-center sm:justify-items-start select-none">

                        <h2 class="font-semibold text-lg text-gray-200">

                            Empfohlene Vorschläge mit denen die Anzahl der Paarungen maximiert wird.

                        </h2>

                        <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">

                            @if (count($recommended) == 0)
                                <p>Keine Vorschläge vorhanden.</p>
                            @elseif (count($recommended) == 1)
                                <p>
                                    Folgender Vorschlag muss übernommen werden, um die maximale Anzahl an Paarungen zu
                                    erreichen. Für die jeweiligen PartnerInnen gibt es nur ein/e PartnerIn. Sollten Sie sich
                                    dagegen entscheiden, kann mindestens eine Person nicht gepaart werden.
                                </p>
                            @elseif (count($recommended) > 1)
                                <p>
                                    Folgende Vorschläge werden dringend empfohlen, um die maximale Anzahl an Paarungen zu
                                    erreichen. Für die jeweiligen PartnerInnen gibt es nur ein/e PartnerIn. Sollten Sie sich
                                    dagegen entscheiden, kann mindestens eine Person nicht gepaart werden. Ziehen Sie
                                    notfalls die Visualisierung zu Rate. Die <em class="text-yellow-300">gelben Kanten</em>
                                    entsprechen den hier aufgeführten Paarungen. Der MSE wird hierbei nicht berücksichtigt.
                                </p>
                            @endif

                        </div>

                    </div>

                    <x-auswahl :matchings="$recommended" :text="'Keine alternativlosen Paarungen vorhanden.'" :assign="true"/>

                </div>

                {{-- recommended --}}


                {{-- mse sorted --}}

                <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md mt-4">

                    <div class="grid justify-items-center sm:justify-items-start select-none">

                        <h2 class="font-semibold text-lg text-gray-200">

                            Nach MSE sortierte Liste aller möglicher Paarungen.

                        </h2>

                        <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">

                            @if (count($remaining_matches) == 0)
                            @elseif (count($remaining_matches) == 1)
                                <p></p>
                            @elseif (count($remaining_matches) > 1)
                                <p>
                                </p>
                            @endif

                        </div>

                    </div>

                    <x-auswahl :matchings="$remaining_matches" :text="'Keine alternativlosen Paarungen vorhanden.'" :assign="true"/> 

                </div>

                {{-- mse sorted --}}



            </div>

        </div>

    </div>

    <!-- Content -->

@endsection
