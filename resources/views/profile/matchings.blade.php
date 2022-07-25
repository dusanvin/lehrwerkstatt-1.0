@extends ('layouts.app')

@section('content')

<div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->

    <!-- Content -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg" style="background-color: #EDF2F7;">

        <div class="mx-auto rounded">

            <!-- Tab Contents -->

            <div id="tab-contents">

            </div>

            <!-- Anzahl -->

            @if ($user->matchings()->count() == 0)

            <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                Keine Vorschläge vorhanden.

            </div>

            @elseif ($user->matchings()->count() == 1)

            <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                {{ $user->matchings()->count() }} Vorschlag vorhanden.

            </div>

            @else

            <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                {{ $user->matchings()->count() }} Vorschläge vorhanden.

            </div>

            @endif

            <!-- Anzahl -->

            <div class="shadow-sm rounded-lg" id="angebote">

                @if ($user->matchings()->count())

                @foreach($user->matchings as $matching)

                <div class="bg-white rounded-md pb-4">

                    <div class="px-1 sm:px-4 sm:px-6 border-t border-gray-200">

                        <!-- Informationen -->

                        <div class="flex items-center justify-between pt-4 leading-5 sm:leading-6 mb-4 text-xs sm:text-lg font-medium">

                            <a class="flex hover:underline" href="{{ route('profile.details', ['id' => $user->id]) }}">

                                {{ $matching->vorname }} {{ $matching->nachname }}

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 pt-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                    <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                </svg>

                            </a>

                            <div>

                                <span class="text-gray-400 text-xs"><strong><span class="hidden sm:inline-block">Angebot </span> </strong> <span class="hidden sm:inline-block">erstellt </span> {{ $user->created_at->diffForHumans() }}</span>

                            </div>

                        </div>

                        <!-- Informationen -->


                        @if(strcasecmp($matching->role, 'lehr') == 0)
                        <div class="block sm:flex sm:flex-wrap content-start">

                            <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Schulart: <span class="font-medium">{{ $matching->survey_data->schulart }}</span></p>
                            @if(isset($matching->survey_data->faecher))
                            <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Angebotene Fächer: <span class="font-medium">{{ $matching->survey_data->faecher }}</span></p>
                            @endif
                            <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Ausübungsort: <span class="font-medium">{{ $matching->survey_data->postleitzahl }} {{ $matching->survey_data->ort }}</span></p>
                            <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Gebiet: <span class="font-medium">{{ $matching->survey_data->landkreis }}</span></p>

                        </div>

                        @elseif(strcasecmp($matching->role, 'stud') == 0)
                        <div class="block sm:flex sm:flex-wrap content-start">

                            <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Schulart: <span class="font-medium">{{ $matching->survey_data->schulart }}</span></p>
                            @if(isset($matching->survey_data->faecher))
                            <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Angebotene Fächer: <span class="font-medium">{{ $matching->survey_data->faecher }}</span></p>
                            @endif
                            <p class="text-gray-400 text-xs sm:text-sm mr-2 sm:mr-5">Mögliche Ausübungsorte: <span class="font-medium">{{ $matching->survey_data->landkreise }}</span></p>

                        </div>
                        @endif

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