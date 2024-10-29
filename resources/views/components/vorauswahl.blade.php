<table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

    <tbody>

        @if (count($matchings) == 0)
            <p
                class="px-6 py-3 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider mt-4 rounded-md">
                Bisher wurden keine Vorschläge von Ihnen übernommen. Suchen Sie auf Basis des MSE nach Paarungen.</p>

        @elseif (count($matchings) > 0)
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
                    class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                    Student*in
                </th>
                <th
                    class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                    Wunschtandem/Schule/Ort
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

            @foreach ($matchings as $index => $matching)
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
                            class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->lehr->email }}
                        </a>

                        <div class="text-xs sm:text-sm leading-5 text-gray-400 break-words">Wunschtandem: {{ $matching->lehr->wunschtandem ?: '-' }}</div>

                    </td>

                    <td class="px-6 py-4 whitespace-no-wrap">

                        <div class="text-xs sm:text-sm leading-5 font-medium text-white">
                            {{ $matching->stud->vorname }}
                            {{ $matching->stud->nachname }}
                        </div>

                        <a href="mailto:{{ $matching->stud->email }}"
                            class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->stud->email }}
                        </a>

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

                        <div
                            class="text-sm leading-5 font-normal text-white select-none font-bold bg-gray-500 text-center p-1 w-12 rounded-sm">

                            {{ $matching->mse }}

                        </div>

                    </td>


                    <!-- Details -->

                    <td class="px-6 py-4 whitespace-no-wrap">

                        <x-details :lehr="$matching->lehr" :stud="$matching->stud" :mse="$matching->mse">
                        </x-details>

                    </td>

                    <!-- Details -->

                    <!-- Löschen -->

                    <td
                        class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap float-right text-sm leading-5 font-medium">

                        <form
                            action="{{ route('matchings.setunassigned', ['lehr' => $matching->lehr->id, 'stud' => $matching->stud->id]) }}"
                            method="get">

                            @csrf

                            <button type="submit"
                                class="py-2 px-2 rounded-full text-white text-sm flex focus:outline-none bg-yellow-700 has-tooltip hover:bg-yellow-900 border-2 border-white transition ease-in-out duration-150 hover:scale-105 transform">

                                <div class="grid justify-items-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        viewBox="0 0 20 20" fill="currentColor">

                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />

                                    </svg>

                                    <span
                                        class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150'>Entfernen</span>

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
