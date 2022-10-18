                <!--  -->

                <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md mt-4">

                    <div class="grid justify-items-center sm:justify-items-start select-none">

                        <h2 class="font-semibold text-lg text-gray-200">

                            Die maximale Anzahl an Paarungen ist derzeit {{ $max_flow }}.

                        </h2>

                        <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">

                            @if (count($strongly_recommended) == 0)
                            @elseif (count($strongly_recommended) == 1)
                                <p>Folgender Vorschlag wird dringend empfohlen, da mindestens eine daran beteiligte Person mit niemand sonst zusammengebracht werden kann. </p>
                            @elseif (count($strongly_recommended) > 1)
                                <p>Folgende Vorschläge werden dringend empfohlen, da jeweils mindestens eine daran beteiligte Person mit niemand sonst zusammengebracht werden kann.</p>
                            @endif

                        </div>

                    </div>

                    <table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

                        <tbody>

                            @if (count($strongly_recommended) == 0)
                                <p
                                    class="px-6 py-3 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider mt-4 rounded-md">
                                    Keine alternativlosen Paarungen vorhanden.</p>
                            @elseif (count($strongly_recommended) > 0)
                                <tr>

                                    <th
                                        class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tl-md font-bold">
                                        #</th>

                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                        Lehrkraft</th>
                                    <th
                                        class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                        Wunschtandem, <br>Schule</th>

                                    <th
                                        class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                        Student*in</th>
                                    <th
                                        class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                        Wunschtandem/-ort, <br>ehem. Schule</th>

                                    <th
                                        class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                        MSE</th>

                                    <th
                                        class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-right text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold">
                                    </th>

                                </tr>

                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($strongly_recommended as $lehr)
                                        
                                    @foreach ($lehr->matchable as $matchable)

                                        <tr
                                            class="border-t border-gray-200 bg-{{ $lehr->matching_state == 'matched' && $lehr->matched_user->id == $matchable->id ? 'green-900' : ($matchable->matching_state == 'matched' || $lehr->matching_state == 'matched' ? 'red-900' : 'gray-700') }}">

                                            <td
                                                class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                                {{ $index++ }}

                                            </td>

                                            <td class="px-6 py-4 whitespace-no-wrap">

                                                <div class="text-xs sm:text-sm leading-5 font-medium text-white">
                                                    {{ $lehr->vorname }} {{ $lehr->nachname }}</div>

                                                <a href="mailto:{{ $lehr->email }}"
                                                    class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $lehr->email }}</a>

                                            </td>

                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div
                                                    class="text-xs sm:text-sm leading-5 font-medium text-white text-center">
                                                    <p
                                                        class="{{ isset($lehr->data()->wunschtandem) ? 'bg-yellow-600 rounded-xl m-1' : '' }}">
                                                        {{ $lehr->data()->wunschtandem ?? '-' }}</p>
                                                    <p
                                                        class="{{ isset($lehr->data()->ort) ? 'bg-blue-500 rounded-xl m-1' : '' }}">
                                                        {{ $lehr->data()->ort ?? '-' }}</p>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-no-wrap">

                                                <div class="text-xs sm:text-sm leading-5 font-medium text-white">
                                                    {{ $matchable->vorname }} {{ $matchable->nachname }}</div>

                                                <a href="mailto:{{ $lehr->email }}"
                                                    class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matchable->email }}</a>

                                            </td>

                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <div
                                                    class="text-xs sm:text-sm leading-5 font-medium text-white text-center">
                                                    <p
                                                        class="{{ isset($matchable->data()->wunschtandem) ? 'bg-yellow-600 rounded-xl m-1' : '' }}">
                                                        {{ $matchable->data()->wunschtandem ?? '-' }}</p>
                                                    <p
                                                        class="{{ isset($matchable->data()->wunschorte) ? 'bg-blue-500 rounded-xl m-1' : '' }}">
                                                        {{ $matchable->data()->wunschorte ?? '-' }}</p>
                                                    <p
                                                        class="{{ isset($matchable->data()->ehem_schulort) ? 'bg-red-400 rounded-xl m-1' : '' }}">
                                                        {{ $matchable->data()->ehem_schulort ?? '-' }}</p>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-no-wrap">

                                                <div
                                                    class="text-sm leading-5 font-normal text-white select-none font-bold bg-gray-500 text-center p-1 w-12 rounded-sm">

                                                    {{ $matchable->pivot->mse }}

                                                </div>

                                            </td>

                                            <!-- Details -->

                                            <td class="px-6 py-4 whitespace-no-wrap">

                                                <div x-data="{ modelOpen: false }" class="flex flex-wrap mr-2 mb-2">

                                                    <button @click="modelOpen =!modelOpen"
                                                        class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50 max-h-9 hover:scale-105 transform">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                                                        </svg>

                                                        <span>Details</span>

                                                    </button>

                                                    <!-- ModelOpen -->

                                                    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto"
                                                        aria-labelledby="modal-title" role="dialog" aria-modal="true">

                                                        <div
                                                            class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

                                                            <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                                                x-transition:enter="transition ease-out duration-300 transform"
                                                                x-transition:enter-start="opacity-0"
                                                                x-transition:enter-end="opacity-100"
                                                                x-transition:leave="transition ease-in duration-200 transform"
                                                                x-transition:leave-start="opacity-100"
                                                                x-transition:leave-end="opacity-0"
                                                                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                                                                aria-hidden="true">
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
                                                                class="bg-gray-700 inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">

                                                                <!-- ModelOpen x-cloak -->

                                                                <!-- ModelInner -->

                                                                <h3 class="text-xs font-medium text-white uppercase mt-4">
                                                                    Student*in
                                                                </h3>

                                                                <div class="w-96 mt-2">

                                                                    <div
                                                                        class="text-xs sm:text-sm leading-5 font-medium text-white w-64 text-gray-400">

                                                                        <p>{{ $matchable->vorname }}
                                                                            {{ $matchable->nachname }}</p>
                                                                        <a href="mailto:{{ $matchable->email }}"
                                                                            class="text-gray-400 hover:text-gray-100 break-words">{{ $matchable->email }}</a>
                                                                        <br>
                                                                        <br>
                                                                        @if (!empty($matchable->data()->wunschtandem))
                                                                            <p> Wunschtandem:
                                                                                {{ $matchable->data()->wunschtandem }}
                                                                            </p>
                                                                        @endif
                                                                        @if (!empty($matchable->data()->wunschorte))
                                                                            <p> Wunschorte:
                                                                                {{ $matchable->data()->wunschorte }}
                                                                            </p>
                                                                        @endif
                                                                        @if (!empty($matchable->data()->ehem_schulort))
                                                                            <p> Ehem. Schulort:
                                                                                {{ $matchable->data()->ehem_schulort }}
                                                                            </p>
                                                                        @endif
                                                                        <br>
                                                                        @if (!empty($matchable->data()->anmerkungen))
                                                                            <p> Anmerkungen:
                                                                                {{ $matchable->data()->anmerkungen }}
                                                                            </p>
                                                                        @endif

                                                                    </div>

                                                                </div>

                                                                <h3 class="text-xs font-medium text-white uppercase mt-4">
                                                                    Lehrer*in
                                                                </h3>

                                                                <div class="w-96 mt-2">

                                                                    <div
                                                                        class="text-xs sm:text-sm leading-5 font-medium text-white w-64 text-gray-400">

                                                                        <p>{{ $lehr->vorname }}
                                                                            {{ $lehr->nachname }}</p>
                                                                        <a href="mailto:{{ $lehr->email }}"
                                                                            class="text-gray-400 hover:text-gray-100 break-words">{{ $lehr->email }}</a>
                                                                        <br>
                                                                        <br>
                                                                        @if (!empty($lehr->data()->wunschtandem))
                                                                            <p> Wunschtandem:
                                                                                {{ $lehr->data()->wunschtandem }}
                                                                            </p>
                                                                        @endif
                                                                        <br>
                                                                        <p> Name der Schule:</p>
                                                                        <p>
                                                                            {{ $lehr->data()->schulname }}
                                                                        </p>
                                                                        <p> Ort:
                                                                            {{ $lehr->data()->ort }}
                                                                        </p>
                                                                        <p> Landkreis:
                                                                            {{ $lehr->data()->landkreis }}
                                                                        </p>

                                                                    </div>

                                                                </div>

                                                                <div class="mt-4">

                                                                    <h3 class="text-xs font-medium text-white uppercase">
                                                                        Mean
                                                                        Square
                                                                        Error (MSE)</h3>

                                                                    <div class="pb-2 w-96 mt-2">

                                                                        <div
                                                                            class="text-xs sm:text-sm leading-5 font-medium text-white w-64 text-gray-400">

                                                                            {{ $matchable->pivot->mse }}

                                                                        </div>

                                                                    </div>

                                                                    <div>

                                                                        <h3
                                                                            class="text-xs font-medium text-white uppercase">
                                                                            Attribute zur Berechnung
                                                                            des MSE</h3>

                                                                        <div class="pb-2 w-96 text-sm text-gray-400 mt-2">

                                                                            <p>

                                                                                Feedback Lehrkraft zu Student*in [Abweichung
                                                                                0
                                                                                bis
                                                                                5]:
                                                                                {{ abs($lehr->data()->feedback_an - $matchable->data()->feedback_von) }}

                                                                            </p>

                                                                            <p>

                                                                                Feedback Student*in zu Lehrkraft [Abweichung
                                                                                0
                                                                                bis
                                                                                5]:
                                                                                {{ abs($lehr->data()->feedback_von - $matchable->data()->feedback_an) }}

                                                                            </p>

                                                                            <p>

                                                                                Eigenstaendigkeit [Abweichung 0 bis 5]**:
                                                                                {{ abs($lehr->data()->eigenstaendigkeit - $matchable->data()->eigenstaendigkeit) }}

                                                                            </p>

                                                                            <p>

                                                                                Improvisation [Abweichung 0 bis 5]:
                                                                                {{ abs($lehr->data()->improvisation - $matchable->data()->improvisation) }}

                                                                            </p>

                                                                            <p>

                                                                                Freiraum [Abweichung 0 bis 3]:
                                                                                {{ abs($lehr->data()->freiraum - $matchable->data()->freiraum) }}

                                                                            </p>

                                                                            <p>

                                                                                Innovationsoffenheit [Abweichung 0 bis 5]:
                                                                                {{ abs($lehr->data()->innovationsoffenheit - $matchable->data()->innovationsoffenheit) }}

                                                                            </p>

                                                                            <p>

                                                                                Belastbarkeit [Abweichung 0 bis 5]:**
                                                                                {{ abs($lehr->data()->belastbarkeit - $matchable->data()->belastbarkeit) }}

                                                                            </p>

                                                                        </div>

                                                                    </div>

                                                                    <p class="text-gray-400 text-xs mt-2">Umso kleiner der
                                                                        Wert,
                                                                        umso geringer die
                                                                        Abweichung. Attribute mit ** fließen stärker in die
                                                                        Gewichtung mit ein.</p>

                                                                </div>

                                                                @if ($lehr->matching_state == 'unmatched' && $matchable->matching_state == 'unmatched')
                                                                    <form
                                                                        action="{{ route('matchings.setassigned', ['lehr' => $lehr->id, 'stud' => $matchable->id, 'mse' => $matchable->pivot->mse]) }}"
                                                                        method="get">

                                                                        @csrf

                                                                        <div class="flex justify-end mt-6">

                                                                            <button type="submit"
                                                                                class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:bg-green-500 focus:ring focus:ring-green-300 focus:ring-opacity-50 max-h-9 transform duration-150 hover:scale-105 transition-colors">

                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    fill="none" viewBox="0 0 24 24"
                                                                                    stroke-width="1.5"
                                                                                    stroke="currentColor" class="w-6 h-6">
                                                                                    <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                </svg>

                                                                                <p>Aufnehmen</p>

                                                                            </button>

                                                                        </div>

                                                                    </form>
                                                                @endif

                                                                <div class="flex justify-end mt-6">

                                                                    <button @click="modelOpen =!modelOpen"
                                                                        class="text-sm flex items-center justify-center px-3 py-2 space-x-2 text-white transition-colors duration-200 transform bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:bg-green-500 focus:ring focus:ring-green-300 focus:ring-opacity-50 max-h-9 transform duration-150 hover:scale-105 transition-colors">
                                                                        <p>Schließen</p>

                                                                    </button>

                                                                </div>

                                                                <!-- ModelInner -->

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </td>

                                            <!-- Details -->

                                            <!-- Löschen -->

                                            <td
                                                class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap float-right text-sm leading-5 font-medium">

                                                @if ($lehr->matching_state == 'unmatched' && $matchable->matching_state == 'unmatched')
                                                    <form
                                                        action="{{ route('matchings.setassigned', ['lehr' => $lehr->id, 'stud' => $matchable->id, 'mse' => $matchable->pivot->mse]) }}"
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
                                                @endif


                                            </td>

                                            <!-- Löschen -->

                                        </tr>

                                    @endforeach

                                @endforeach
                            @endif

                        </tbody>

                    </table>

                </div>

                <!--  -->