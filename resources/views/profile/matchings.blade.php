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

                Tandemvorschläge

            </h1>

            <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left flex">

                <p</p>

            </div>

            <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left block">

                <p class="block mb-4">Kurz nach der jeweiligen Matchingrunde (Termine siehe <a href="https://www.uni-augsburg.de/de/forschung/einrichtungen/institute/zlbib/lehrwerkstatt/" class="underline hover:text-white">Webseite</a>), teilen wir Ihnen hier Ihren Tandemvorschlag mit - insofern ein Match gebildet werden konnte. Sie erhalten eine E-Mail-Benachrichtigung, sobald dieser einsehbar ist.</p>
                
                <div class="text-gray-300 px-4 py-2 flex items-center rounded-full">

                    <div class="px-4 py-2 flex items-center rounded-full bg-gray-500 font-semibold">1</div>

                    <div class="pl-3">
                        
                        <p class="navigation-element text-sm">Bitte <strong>kontaktieren</strong> Sie dann Ihre*n potentielle*n Tandempartner*in für ein Kennenlernen.</p>

                    </div>

                </div>

                <div class="text-gray-300 px-4 py-2 flex items-center rounded-full">

                    <div class="px-4 py-2 flex items-center rounded-full bg-gray-500 font-semibold">2</div>

                    <div class="pl-3">
                        
                        <p class="navigation-element text-sm">Nach dem Kennenlernen bitten wir Sie, das Tandem per Klick auf den entsprechenden Button zu <strong>bestätigen</strong> oder <strong>abzulehnen</strong>.</p>

                    </div>

                </div>

                <p class="block my-4">Mit der Bestätigung sagen Sie der Zusammenarbeit in diesem Tandem im Rahmen der <em>Lehr:werkstatt</em> verbindlich zu.</p>

            </div>

            <!-- Anzahl -->

            @if (!isset($user->notified_user))

            <p class="px-6 py-3 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider mt-4 rounded-md font-semibold">

                Keine Vorschläge vorhanden.

            </p>

            @else

            <div class="uppercase text-gray-400 pb-1 sm:pb-2 select-none text-sm text-left font-semibold">

                Es gibt einen Vorschlag.

            </div>

            @endif

            <!-- Anzahl -->

            @if (isset($user->notified_user))

                <div class="shadow-sm" id="angebote">

                    <table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

                        <tbody>

                            <tr>

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tl-md font-bold">
                                    #</th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Partner*in</th>

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Schulart</th>

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Fach/Fächer</th>
                                
                                @if ($user->role == 'Stud')
                                    <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Schule</th>
                                @endif   

                                {{-- <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold hidden sm:table-cell ">Erstellungsdatum</th> --}}

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold"></th>

                            </tr>

                        </tbody>

                        @php
                            $index = 0;
                        @endphp

                        <tr class="border-t border-gray-200 bg-gray-700 text-sm text-gray-400">

                            <td class="hidden sm:table-cell pl-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                                {{ $index+1 }}

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap align-top">

                                <a class="flex text-white hover:text-gray-100">

                                    {{ $user->notified_user->vorname }} {{ $user->notified_user->nachname }}

                                </a>

                                <a href="mailto:{{  $user->notified_user->email }}" class="leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $user->notified_user->email }}</a>

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                                <div class="leading-5 font-normal select-none p-1 w-12 rounded-sm">

                                    {{ $user->notified_user->survey_data->schulart }}

                                </div>

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                                <div class="leading-5 font-normal select-none p-1 w-12 rounded-sm">

                                    @if(isset($user->notified_user->survey_data->faecher))

                                    {{ implode(', ', $user->notified_user->survey_data->faecher) }}

                                    @else

                                    -

                                    @endif

                                </div>

                            </td>

                            @if(strcasecmp($user->role, 'Stud') == 0)

                            <td class="px-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                                <div class="leading-5 font-normal select-none p-1 w-12 rounded-sm w-full">

                                    {{ $user->notified_user->survey_data->schulname }}<br>
                                    {{ $user->notified_user->survey_data->strasse }} {{ $user->notified_user->survey_data->hausnummer }}<br>
                                    {{ $user->notified_user->survey_data->postleitzahl }} {{ $user->notified_user->survey_data->ort }}<br>
                                    {{ $user->notified_user->survey_data->landkreis }}

                                </div>

                            </td>

                            @endif

                            {{-- <td class="px-6 py-4 whitespace-no-wrap align-top hidden sm:table-cell ">

                                <div class="leading-5 font-normal select-none p-1 w-12 rounded-sm w-full">

                                    {{ $user->created_at->diffForHumans() }}

                                </div>

                            </td> --}}

                            <td class="px-6 py-4 whitespace-no-wrap align-top">

                                <div class="py-2 mx-auto rounded-md">

                                    <div class="flex">


                                            <a href="/messages/create/{{ $user->notified_user->id }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold text-sm hover:text-white py-2 px-4 border border-purple-700 hover:border-transparent focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 rounded flex items-center transition-colors duration-200 transform duration-150 hover:scale-105 transform cursor-pointer">

                                                Kontaktieren

                                            </a>


                                    </div>

                                </div>

                                {{-- zusagen/absagen --}}

                                @if( (strcasecmp($user->role, 'lehr') == 0 && !isset($user->notified_user->pivot->is_accepted_lehr)) || (strcasecmp($user->role, 'stud') == 0 && !isset($user->notified_user->pivot->is_accepted_stud)) )
                                
                                <form action="{{ route('acceptMatching') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="role" value="{{ $user->role }}">
                                    <input type="hidden" name="lehrid" value="{{ $user->role == 'Lehr' ? $user->id : $user->notified_user->id }}">
                                    <input type="hidden" name="studid" value="{{ $user->role == 'Stud' ? $user->id : $user->notified_user->id }}">
                                    <input type="submit" value="Bestätigen" class="bg-green-600 hover:bg-green-700 text-white font-semibold text-sm hover:text-white py-2 px-4 border border-green-700 hover:border-transparent focus:outline-none focus:ring ring-green-300 focus:border-green-300 rounded flex items-center transition-colors duration-200 transform duration-150 hover:scale-105 transform cursor-pointer mt-4">
                                </form>
                                
<!-- Start des Dialogs -->
<div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden"></div>

<dialog id="textModal" class="rounded fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
    <h3 class="text-base font-semibold leading-6 text-gray-900 mb-1" id="modal-title">Vorschlag ablehnen</h3>
    <p class="mb-4 text-sm text-gray-500">Bitte teilen Sie uns mit, weshalb Sie den Vorschlag ablehnen, um zukünftige Paarungen passgenauer zu gestalten.</p>

    <script>
        const modal = document.getElementById("textModal");
        const overlay = document.getElementById("modalOverlay");

        function openDialog() {
            modal.showModal();
            overlay.classList.remove("hidden");
        }

        function closeDialog() {
            modal.close();
            overlay.classList.add("hidden");
        }
    </script>

    <form action="{{ route('declineMatching') }}" method="POST">
        @csrf
        <input type="hidden" name="role" value="{{ $user->role }}">
        <input type="hidden" name="lehrid" value="{{ $user->role == 'Lehr' ? $user->id : $user->notified_user->id }}">
        <input type="hidden" name="studid" value="{{ $user->role == 'Stud' ? $user->id : $user->notified_user->id }}">
        <textarea name="text" rows="2" cols="110" class="text-sm"></textarea>
        <button type="button" onclick="closeDialog()" style="position:absolute; top:0; right:1%;">&times;</button>
        <input type="submit" value="Absenden" class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold text-sm hover:text-white py-2 px-4 border border-yellow-700 hover:border-transparent focus:outline-none focus:ring ring-yellow-300 focus:border-yellow-300 rounded flex items-center transition-colors duration-200 transform duration-150 hover:scale-105 cursor-pointer mt-2">
    </form>
</dialog>
<!-- Ende des Dialogs -->

                                


                                </form>

                                <button onclick="openDialog()" class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold text-sm hover:text-white py-2 px-4 border border-yellow-700 hover:border-transparent focus:outline-none focus:ring ring-yellow-300 focus:border-yellow-300 rounded flex items-center transition-colors duration-200 transform duration-150 hover:scale-105 transform cursor-pointer mt-2">Ablehnen</button>
                                
                                @else
                                    @if (strcasecmp($user->role, 'lehr') == 0)
                                        {{ $user->notified_user->pivot->is_accepted_lehr == 1 ? 'Sie haben den Tandemvorschlag bestätigt.' : 'Sie haben den Tandemvorschlag abgelehnt.' }}
                                    @elseif (strcasecmp($user->role, 'stud') == 0)
                                        {{ $user->notified_user->pivot->is_accepted_stud == 1 ? 'Sie haben den Tandemvorschlag bestätigt.' : 'Sie haben den Tandemvorschlag abgelehnt.' }}
                                    @endif
                                @endif




                                {{-- zusagen/absagen --}}

                            </td>

                        </tr>


                        

                    </table>

                </div>

            @endif

        </div>

    </div>

    <!-- Alle Angebote -->

</div>

@endsection