@extends ('layouts.app')

@section('content')

<div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->

    <!-- Content -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-600">

        <div class="mx-auto rounded">

            <!-- Liste -->

            <ul id="tabs" class="inline-flex w-full">

                <li class="px-4 py-2 -mb-px font-medium text-xs sm:text-sm text-gray-800 border-b-2 border-gray-700 rounded-t opacity-50 bg-white border-b-4 -mb-px opacity-100">Übernommene Vorschläge (Lehrkräfte, Student*innen, MSE)</li>

            </ul>

            <div id="first" class="px-4 pt-4 pb-2 bg-white mb-4 rounded-b-md">

                <ul>

                    @if (count($assigned_matchings) == 0)
                    List ist leer.
                    @elseif (count($assigned_matchings) > 0)
                    @foreach($assigned_matchings as $matching)
                    <li>
                        {{ $matching['lehr']->vorname }} {{ $matching['lehr']->nachname }} {{ $matching['lehr']->email }},
                        {{ $matching['stud']->vorname }} {{ $matching['stud']->nachname }} {{ $matching['stud']->email }} (MSE {{ $matching['mse'] }})
                        <form action="{{ route('matchings.setunassigned', ['lehr' => $matching['lehr']->id, 'stud' => $matching['stud']->id]) }}" method="get">

                            @csrf

                            <button type="submit" class="py-2 px-2 rounded-full bg-yellow-700 text-white text-sm flex focus:outline-none ml-4 transition ease-in-out duration-150 has-tooltip hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300">

                                <div class="grid justify-items-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                    <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Aus Liste entfernen.</span>

                                </div>

                            </button>

                        </form>
                    </li>
                    @endforeach
                    @endif



                </ul>

            </div>

            <!-- Liste -->

            <!-- Tabs -->

            <ul id="tabs" class="inline-flex w-full">

                <li class="px-4 py-2 -mb-px font-medium text-xs sm:text-sm text-gray-800 border-b-2 border-gray-700 rounded-t opacity-50 bg-white border-b-4 -mb-px opacity-100">Folgende Vorschläge sind derzeit alternativlos (Lehrkräfte, Student*innen, MSE)</li>

            </ul>

            <!-- Tabs -->

            <!-- Tab Contents -->

            <div id="tab-contents">

                <!-- Alle Angebote -->

                <div id="first" class="px-4 pt-4 pb-2 bg-white mb-4 rounded-b-md">

                    <ul>

                        @if (count($matchings) == 0)
                        Keine Lehrkraft konnte vorab gematched werden.
                        @elseif (count($matchings) > 0)
                        @foreach($matchings as $matching)
                        <li>
                            {{ $matching['lehr']->vorname }} {{ $matching['lehr']->nachname }} {{ $matching['lehr']->email }},
                            {{ $matching['stud']->vorname }} {{ $matching['stud']->nachname }} {{ $matching['stud']->email }} (MSE {{ $matching['stud']->mse }})
                            <form action="{{ route('matchings.setassigned', ['lehr' => $matching['lehr']->id, 'stud' => $matching['stud']->id, 'mse' => $matching['stud']->mse]) }}" method="get">

                                @csrf

                                <button type="submit" class="py-2 px-2 rounded-full bg-yellow-700 text-white text-sm flex focus:outline-none ml-4 transition ease-in-out duration-150 has-tooltip hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300">

                                    <div class="grid justify-items-center">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>

                                        <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Vorschlag in Liste aufnehmen</span>

                                    </div>

                                </button>

                            </form>
                        </li>
                        @endforeach
                        @endif



                    </ul>


                    <!-- Kontakt -->

                </div>

                <!-- Anzahl -->

                @if ($users->count() == 0)

                <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                    Keine weiteren Matchings möglich.

                </div>

                @elseif ($users->count() == 1)

                <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                    {{ $users->count() }} ungematchte Lehrkraft.

                </div>

                @else

                <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                    {{ $users->count() }} ungematchte Lehrkräfte.

                </div>

                @endif

                <!-- Anzahl -->

                <!-- Suchfilter -->

                <div class="px-2 sm:px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider rounded-tl-md">

                    Zu jeder Lehrkraft werden Student*innen aufgelistet, die bezüglich Schulart, Landkreis und mindestens einem Fach kompatibel sind, sortiert nach dem Mean Squared Error.

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

                            @foreach($user->matchings as $count=>$matching)

                            <!-- Jumbatron -->

                            <div class="rounded-sm flex flex-row-reverse">

                                <details class="flex-auto">

                                    <summary class="cursor-pointer text-sm text-gray-500 mt-1 mb-3 mt-2">

                                        {{ $matching->survey_data->vorname }} {{ $matching->survey_data->nachname }}, <span @if($user->mses[$count] < 2.5) class="bg-green-400" @elseif($user->mses[$count] < 4) class="bg-yellow-400" @else class="bg-red-400" @endif>MSE: {{ $user->mses[$count] }}</span>, @if($matching->count_matchings == 1) <span class="bg-yellow-400"><b>Kann nur mit dieser Lehrkraft gematcht werden</b></span> @else Kann mit {{ $matching->count_matchings }} Lehrkräften gematcht werden. @endif
                                        <form action="{{ route('matchings.setassigned', ['lehr' => $user->id, 'stud' => $matching->id, 'mse' => $matching->mse]) }}" method="get">

                                            @csrf

                                            <button type="submit" class="py-2 px-2 rounded-full bg-yellow-700 text-white text-sm flex focus:outline-none ml-4 transition ease-in-out duration-150 has-tooltip hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300">

                                                <div class="grid justify-items-center">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>

                                                    <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Vorschlag in Liste aufnehmen</span>

                                                </div>

                                            </button>

                                        </form>
                                    </summary>


                                    <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Feedback Lehrkraft zu Student*in [Abweichung 0 bis 5]: <span class="font-medium">{{ abs($user->survey_data->feedback_an - $matching->survey_data->feedback_von) }}</span></p>
                                    <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Feedback Student*in zu Lehrkraft [Abweichung 0 bis 5]: <span class="font-medium">{{ abs($user->survey_data->feedback_von - $matching->survey_data->feedback_an) }}</span></p>
                                    <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Eigenstaendigkeit** [Abweichung 0 bis 5]: <span class="font-medium">{{ abs($user->survey_data->eigenstaendigkeit - $matching->survey_data->eigenstaendigkeit) }}</span></p>
                                    <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Improvisation [Abweichung 0 bis 5]: <span class="font-medium">{{ abs($user->survey_data->improvisation - $matching->survey_data->improvisation) }}</span></p>
                                    <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Freiraum [Abweichung 0 bis 3]: <span class="font-medium">{{ abs($user->survey_data->freiraum - $matching->survey_data->freiraum) }}</span></p>
                                    <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Innovationsoffenheit [Abweichung 0 bis 5]: <span class="font-medium">{{ abs($user->survey_data->innovationsoffenheit - $matching->survey_data->innovationsoffenheit) }}</span></p>
                                    <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Belastbarkeit** [Abweichung 0 bis 5]: <span class="font-medium">{{ abs($user->survey_data->belastbarkeit - $matching->survey_data->belastbarkeit) }}</span></p>
                                    <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5"><span class="font-medium"><em>** Attribute fließen stärker in die Gewichtung mit ein</em></span></p>
                                </details>

                            </div>

                            <!-- Jumbatron -->

                            @endforeach

                            <!-- Informationen -->

                        </div>

                    </div>

                    </script>

                    @endforeach

                </div>

                @else

                <p class="hidden">Keine Einträge vorhanden.</p>

                @endif

                <!-- Zeige alle offers -->

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