@extends ('layouts.app')

@section('content')

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

        <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">
            <div class="mx-auto rounded">

                <!-- Schularten -->

                @include('layouts.schularten', ['routeName' => 'matchings.preferences', 'schulart' => $schulart])

                <!-- Schularten -->

                <!-- Content -->

                <div id="tab-contents">

                    <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md">

                        <div class="mx-auto rounded text-white">

                            <h1 class="font-semibold text-2xl text-gray-200">

                            Wunschpaarungen für {{ $schulart ?? 'alle Schularten' }}

                            </h1>

                            <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left flex">

                                <p>Hier erhalten Sie eine Übersicht der bisher getätigten Paarungen für die Vorauswahl. Die
                                    Berechnung
                                    erfolgt auf Basis des
                                    <em>Mean Square Errors (Mittlerer quadratischer Fehler)</em> - kurz <em>MSE</em> - auf einer
                                    Skala
                                    von 0-10. Umso kleiner dieser ist, umso geringer ist die Abweichung beziehungsweise besser
                                    die
                                    Paarung. <strong>Ein großer MSE ist demnach nicht ratsam.</strong> Zu jeder Lehrkraft werden
                                    Student*innen aufgelistet, die bezüglich Schulart, Landkreis und mindestens einem Fach
                                    kompatibel
                                    sind. Sollten Sie einen Vorschlag in die Liste aufnehmen, werden beide Partner*innen aus dem
                                    Pool
                                    der Suchenden entfernt.
                                </p>

                            </div>

                        <div class="bg-gray-800 py-1 md:py-8 rounded-md">

                            <div class="grid justify-items-center sm:justify-items-start select-none">

                                <h2 class="font-semibold text-lg text-gray-200">

                                    Vorauswahl

                                </h2>

                                <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">

                                    @if (count($matched_users) == 1)
                                        <p>Der folgende Vorschlag wurde von Ihnen übernommen. Sollten Sie den Vorschlag bestätigen, wird dieser unter <a href="route('accepted_matchings')" class="font-semibold hover:underline text-white">Paarungen</a> gelistet. Die Personen erhalten zudem eine E-Mail.</p>
                                    @elseif (count($matched_users) > 1)
                                        <p>Die folgenden <strong>{{ count($matched_users) }} Vorschläge</strong> wurden von
                                            Ihnen
                                            übernommen. Sollten Sie die Vorschläge bestätigen, werden diese unter <a
                                                href="route('accepted_matchings')"
                                                class="font-semibold hover:underline text-white">Paarungen</a> gelistet. Die
                                            Personen erhalten zudem eine E-Mail.</p>
                                    @endif

                                </div>

                            </div>



                            <x-vorauswahl :matchings="$matched_users" />

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


                        {{-- lehrer wunschtandem --}}

                        <div class="bg-gray-800 rounded-md">

                            <div class="grid justify-items-center sm:justify-items-start select-none">

                                <h2 class="font-semibold text-lg text-gray-200">

                                    Lehrkräfte mit Wunschtandem

                                </h2>

                                <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">

                                    @if (count($matchings_lehr_with_wunschtandem) == 0)
                                        <p>Keine Vorschläge vorhanden.</p>
                                    @elseif (count($matchings_lehr_with_wunschtandem) == 1)
                                        <p>
                                            Es gibt einen Vorschlag.
                                        </p>
                                    @elseif (count($matchings_lehr_with_wunschtandem) > 1)
                                        <p>
                                            Es gibt {{ count($matchings_lehr_with_wunschtandem) }} Vorschläge.
                                        </p>
                                    @endif

                                </div>

                            </div>

                            <table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

                                <tbody>

                                    @if (count($matchings_lehr_with_wunschtandem) > 0)
                                        <tr>

                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tl-md font-bold">
                                                #
                                            </th>

                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                                Lehrkraft
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                                Wunschtandem
                                            </th>

                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                                Student*in
                                            </th>
                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                                MSE
                                            </th>
                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-right text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold">
                                            </th>
                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-right text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold">
                                            </th>

                                        </tr>

                                        @foreach ($matchings_lehr_with_wunschtandem as $index => $matching)
                                            <tr class="border-t border-gray-200 bg-gray-700">

                                                <td
                                                    class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                                    {{ $index + 1 }}

                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <div class="text-xs sm:text-sm leading-5 font-medium text-white">
                                                        {{ $matching->lehr->vorname }} {{ $matching->lehr->nachname }}
                                                    </div>

                                                    <a href="mailto:{{ $matching->lehr->email }}"
                                                        class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->lehr->email }}</a>

                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <div class="text-xs sm:text-sm leading-5 text-gray-400">

                                                        {{ $matching->lehr->wunschtandem ?? '' }}

                                                    </div>

                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <div class="text-xs sm:text-sm leading-5 font-medium text-white">
                                                        {{ $matching->stud->vorname }} {{ $matching->stud->nachname }}
                                                    </div>

                                                    <a href="mailto:{{ $matching->stud->email }}"
                                                        class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->stud->email }}</a>

                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <div
                                                        class="text-sm leading-5 font-normal text-white select-none font-bold bg-gray-500 text-center p-1 w-12 rounded-sm">

                                                        {{ $matching->mse }}

                                                    </div>

                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <x-details :lehr="$matching->lehr" :stud="$matching->stud" :mse="$matching->mse">
                                                    </x-details>

                                                </td>

                                                <!-- Löschen -->

                                                <td
                                                    class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap float-right text-sm leading-5 font-medium">

                                                    <form
                                                        action="{{ route('matchings.setassigned', ['lehr' => $matching->lehr->id, 'stud' => $matching->stud->id]) }}"
                                                        method="get">

                                                        @csrf

                                                        <button type="submit"
                                                            class="py-2 px-2 rounded-full text-white text-sm flex focus:outline-none bg-green-700 has-tooltip hover:bg-green-900 border-2 border-white transition ease-in-out duration-150 hover:scale-105 transform">

                                                            <div class="grid justify-items-center">

                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                    viewBox="0 0 20 20" fill="currentColor">

                                                                    <path fill-rule="evenodd"
                                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                        clip-rule="evenodd" />

                                                                </svg>

                                                                <span
                                                                    class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150'>Aufnehmen</span>

                                                            </div>

                                                        </button>

                                                    </form>


                                                </td>

                                                <!-- Löschen -->

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>

                            </table>

                        </div>

                        {{-- lehrer wunschtandem --}}


                        {{-- studenten wunschtandem --}}

                        <div class="bg-gray-800 py-1 md:py-8 rounded-md mt-4">

                            <div class="grid justify-items-center sm:justify-items-start select-none">

                                <h2 class="font-semibold text-lg text-gray-200">

                                    Student*innen mit Wunschtandem / Wunschort

                                </h2>

                                <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">

                                    @if (count($matchings_stud_with_wunschtandem) == 0)
                                        <p>Keine Vorschläge vorhanden.</p>
                                    @elseif (count($matchings_stud_with_wunschtandem) == 1)
                                        <p>
                                            Es gibt einen Vorschlag.
                                        </p>
                                    @elseif (count($matchings_stud_with_wunschtandem) > 1)
                                        <p>
                                            Es gibt {{ count($matchings_stud_with_wunschtandem) }} Vorschläge.
                                        </p>
                                    @endif

                                </div>

                            </div>

                            <table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

                                <tbody>

                                    @if (count($matchings_stud_with_wunschtandem) > 0)
                                        <tr>

                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tl-md font-bold">
                                                #
                                            </th>

                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                                Student*in
                                            </th>
                                            <th
                                                class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                                Wunschtandem/Schule/Ort
                                            </th>

                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                                Lehrkraft
                                            </th>
                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                                MSE
                                            </th>
                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-right text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold">
                                            </th>
                                            <th
                                                class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-right text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold">
                                            </th>

                                        </tr>

                                        @foreach ($matchings_stud_with_wunschtandem as $index => $matching)
                                            <tr class="border-t border-gray-200 bg-gray-700">

                                                <td
                                                    class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                                    {{ $index + 1 }}
                                                    
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <div class="text-xs sm:text-sm leading-5 font-medium text-white">
                                                        {{ $matching->stud->vorname }} {{ $matching->stud->nachname }}
                                                    </div>

                                                    <a href="mailto:{{ $matching->stud->email }}"
                                                        class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->stud->email }}</a>

                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <div class="text-xs sm:text-sm leading-5 text-gray-400">
                                                        @if ($matching->stud->wunschtandem ?? false)
                                                            <div>{{ $matching->stud->wunschtandem }}</div>
                                                        @endif
                                                        
                                                        @if ($matching->stud->survey_data->schule_wunschtandem ?? false)
                                                            <div>{{ $matching->stud->survey_data->schule_wunschtandem }}</div>
                                                        @endif
                                                        
                                                        @if ($matching->stud->survey_data->schulort_wunschtandem ?? false)
                                                            <div>{{ $matching->stud->survey_data->schulort_wunschtandem }}</div>
                                                        @endif
                                                        @if ($matching->stud->survey_data->ehem_schulort ?? false)
                                                            <div>ehem. Schulort: {{ $matching->stud->survey_data->ehem_schulort }}</div>
                                                         @endif
                                                    </div>

                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <div class="text-xs sm:text-sm leading-5 font-medium text-white">
                                                        {{ $matching->lehr->vorname }} {{ $matching->lehr->nachname }}
                                                    </div>

                                                    <a href="mailto:{{ $matching->lehr->email }}"
                                                        class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->lehr->email }}</a>
                                                    
                                                    <div class="text-xs sm:text-sm leading-5 text-gray-400 break-words">Wunschtandem: {{ $matching->lehr->wunschtandem ?: '-' }}</div>

                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <div
                                                        class="text-sm leading-5 font-normal text-white select-none font-bold bg-gray-500 text-center p-1 w-12 rounded-sm">

                                                        {{ $matching->mse }}

                                                    </div>

                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">

                                                    <x-details :lehr="$matching->lehr" :stud="$matching->stud" :mse="$matching->mse">
                                                    </x-details>

                                                </td>

                                                <!-- Löschen -->

                                                <td
                                                    class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap float-right text-sm leading-5 font-medium">

                                                    <form
                                                        action="{{ route('matchings.setassigned', ['lehr' => $matching->lehr->id, 'stud' => $matching->stud->id]) }}"
                                                        method="get">

                                                        @csrf

                                                        <button type="submit"
                                                            class="py-2 px-2 rounded-full text-white text-sm flex focus:outline-none bg-green-700 has-tooltip hover:bg-green-900 border-2 border-white transition ease-in-out duration-150 hover:scale-105 transform">

                                                            <div class="grid justify-items-center">

                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                    viewBox="0 0 20 20" fill="currentColor">

                                                                    <path fill-rule="evenodd"
                                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                        clip-rule="evenodd" />

                                                                </svg>

                                                                <span
                                                                    class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150'>Aufnehmen</span>

                                                            </div>

                                                        </button>

                                                    </form>


                                                </td>

                                                <!-- Löschen -->

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>

                            </table>

                        </div>

                        {{-- studenten wunschtandem --}}

                    </div>

                </div>

                </div>

            </div>
        </div>

    </div>

@endsection
