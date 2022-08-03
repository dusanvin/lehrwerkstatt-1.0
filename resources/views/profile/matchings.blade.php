@extends ('layouts.app')

@section('content')

<div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->

    <!-- Content -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

        <div class="mx-auto rounded">

            <!-- Übernommene Vorschläge -->

            <h1 class="font-semibold text-2xl text-gray-200">

                Vorschläge

            </h1>

            <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left flex">

                <p>Hier erhalten Sie eine Übersicht möglicher Paarungen. Die Berechnung erfolgt auf Basis der größten Übereinstimmungen. Sollte Ihnen ein Angebot zusagen, besuchen Sie das Profil Ihrer Partnerin oder Ihres Partners und <strong>kontaktieren Sie diese/diesen über das plattforminterne Nachrichtensystem</strong>. Nehmen Sie alternativ <strong>Kontakt per E-Mail</strong> auf.</p>

            </div>

            <!-- Anzahl -->

            @if ($user->matchings()->count() == 0)

            <p class="px-6 py-3 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider mt-4 rounded-md">

                Keine Vorschläge vorhanden.

            </p>

            @else

            @if ($user->matchings()->count() == 1)

            <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                {{ $user->matchings()->count() }} Vorschlag vorhanden.

            </div>

            @else

            <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left">

                {{ $user->matchings()->count() }} Vorschläge vorhanden.

            </div>

            @endif

            <!-- Anzahl -->

            <div class="shadow-sm" id="angebote">

                <table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

                    <tbody>

                        <tr>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tl-md font-bold">
                                #</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Partner*in</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Schulart</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Fach/Fächer</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Mögliche/r Ausübungsort/e</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Erstellungsdatum</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold"></th>

                        </tr>

                    </tbody>

                    @if ($user->matchings()->count())

                    @foreach($user->matchings as $index => $matching)

                    <tr class="border-t border-gray-200 bg-gray-700 text-sm text-gray-400">

                        <td class="hidden sm:table-cell pl-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                            {{ $index+1 }}

                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap align-top">

                            <a class="flex hover:underline text-white hover:text-gray-100" href="{{ route('profile.details', ['id' => $matching->id]) }}">

                                {{ $matching->vorname }} {{ $matching->nachname }}

                            </a>

                            <a href="mailto:{{  $matching->email }}" class="leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->email }}</a>

                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                            <div class="leading-5 font-normal select-none p-1 w-12 rounded-sm">

                                {{ $matching->survey_data->schulart }}

                            </div>

                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                            <div class="leading-5 font-normal select-none p-1 w-12 rounded-sm">

                                @if(isset($matching->survey_data->faecher))

                                {{ $matching->survey_data->faecher }}

                                @else

                                -

                                @endif

                            </div>

                        </td>

                        @if(strcasecmp($matching->role, 'lehr') == 0)

                        <td class="px-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                            <div class="leading-5 font-normal select-none p-1 w-12 rounded-sm w-full">

                                {{ $matching->survey_data->postleitzahl }} {{ $matching->survey_data->ort }}

                            </div>

                        </td>

                        @elseif(strcasecmp($matching->role, 'stud') == 0)

                        <td class="px-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                            <div class="leading-5 font-normal select-none p-1 w-12 rounded-sm w-full">

                                {{ $matching->survey_data->landkreise }}

                            </div>

                        </td>

                        @endif

                        <td class="px-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                            <div class="leading-5 font-normal select-none p-1 w-12 rounded-sm w-full">

                                {{ $user->created_at->diffForHumans() }}

                            </div>

                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap align-top">

                            <div class="py-2 mx-auto rounded-md">

                                <div class="flex">


                                        <a href="/messages/create/{{ $matching->id }}" class="bg-transparent bg-purple-600 hover:bg-purple-800 text-white text-xs font-semibold py-2 px-4 tracking-wide border border-purple-600 hover:border-transparent rounded focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 flex items-center transition ease-in-out duration-150 disabled:opacity-25">

                                            Kontaktieren

                                        </a>


                                </div>

                            </div>

                        </td>

                    </tr>



                    @endforeach

                    @endif

                </table>

            </div>

            @endif

        </div>

    </div>

    <!-- Alle Angebote -->

</div>

@endsection