@extends ('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->

    <!-- Content -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

        <div class="mx-auto rounded">

            <!-- Übernommene Vorschläge -->

            <h1 class="font-semibold text-2xl text-gray-200">

                Tandems

            </h1>

            <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left block">

                <p class="block mb-4">Hier erhalten Sie eine Übersicht über die von der Moderation vorgeschlagenen und die von den Teilnehmenden zugesagten / abgelehnten Tandems. Hinweise zum Vorgehen:</p>
                
                <div class="text-gray-300 px-4 py-2 flex items-center rounded-full">

                    <div class="px-4 py-2 flex items-center rounded-full bg-gray-500 font-semibold">1</div>

                    <div class="pl-3">
                        
                        <p class="navigation-element text-sm"><strong>Nehmen</strong> Sie auf der Unterseite <em><a href="\matchable" class="underline hover:text-white">Tandemvorschläge</a></em> ein Paar in die Liste der <em>Übernommenen Vorschläge</em> <strong>auf</strong>.</p>

                    </div>

                </div>

                <div class="text-gray-300 px-4 py-2 flex items-center rounded-full">

                    <div class="px-4 py-2 flex items-center rounded-full bg-gray-500 font-semibold">2</div>

                    <div class="pl-3">
                        
                        <p class="navigation-element text-sm"><strong>Bestätigen</strong> Sie den übernommenen Vorschlag.</p>

                    </div>

                </div>

                <div class="text-gray-300 px-4 py-2 flex items-center rounded-full">

                    <div class="px-4 py-2 flex items-center rounded-full bg-gray-500 font-semibold">3</div>

                    <div class="pl-3">
                        
                        <p class="navigation-element text-sm">Übernommene Vorschläge sind nun unter <em>Vorgeschlagene Tandems</em> sichtbar. Die Teilnehmenden haben daraufhin die Möglichkeit, den Vorschlägen zu- oder abzusagen.</p>

                    </div>

                </div>

            </div>

            <!-- Übernommene Vorschläge -->

            <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md">

                <div class="grid justify-items-center sm:justify-items-start select-none">

                    <h2 class="font-semibold text-lg text-gray-200">

                        Vorgeschlagene Tandems

                    </h2>

                    <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">

                        @if (count($notified_matchings) == 0)

                        @elseif (count($notified_matchings) == 1)

                        <p>Den Teilnehmenden wurden folgende Paarungen vorgeschlagen.</p>

                        @elseif (count($notified_matchings) > 1)

                        <p>Die folgenden <strong>{{ count($notified_matchings) }} Vorschläge</strong> wurden von Ihnen übernommen.</p>

                        @endif

                    </div>

                </div>

                <table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

                    <tbody>

                        @if (count($notified_matchings) == 0)

                        <p class="px-6 py-3 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider mt-4 rounded-md">Bisher wurden keine Vorschläge von Ihnen übernommen. Suchen Sie auf Basis des MSE nach Paarungen.</p>

                        @elseif (count($notified_matchings) > 0)

                        <tr>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tl-md font-bold">
                                #</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Lehrkraft</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Zusage</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Student*in</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Zusage</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                MSE</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Übernommen</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-right text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold">
                            </th>

                        </tr>

                        @foreach($notified_matchings as $index => $matching)

                        <tr class="border-t border-gray-200 bg-gray-700">

                            <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                {{ $index + 1 }}

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap">

                                <div class="text-xs sm:text-sm leading-5 font-medium text-white">{{ $matching->lehr->vorname }} {{ $matching->lehr->nachname }}</div>

                                <a href="mailto:{{ $matching->lehr->email }}" class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->lehr->email }}</a>

                            </td>

                            <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                @if($matching->lehr->hasMatchingAccepted($matching->stud->id) == true)

                                    <!-- Angenommen -->
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150">Angenommen</span>
                                    </div>

                                @elseif($matching->lehr->hasMatchingDeclined($matching->stud->id))
                                    
                                    <!-- Abgelehnt -->
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Abgelehnt</span>
                                    </div>

                                @else

                                    <!-- Ausstehend -->
                                    
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Ausstehend</span>
                                    </div>

                                @endif

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap">

                                <div class="text-xs sm:text-sm leading-5 font-medium text-white">{{ $matching->stud->vorname }} {{ $matching->stud->nachname }}</div>

                                <a href="mailto:{{  $matching->lehr->email }}" class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->stud->email }}</a>

                                <div class="text-white"></div>

                            </td>

                            <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                @if($matching->stud->hasMatchingAccepted($matching->lehr->id) == true)

                                    <!-- Angenommen -->
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150">Angenommen</span>
                                    </div>

                                @elseif($matching->stud->hasMatchingDeclined($matching->lehr->id))
                                    
                                    <!-- Abgelehnt -->
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Abgelehnt</span>
                                    </div>

                                @else

                                    <!-- Ausstehend -->
                                    
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Ausstehend</span>
                                    </div>

                                @endif

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap">

                                <div class="text-sm leading-5 font-normal text-white select-none font-bold bg-gray-500 text-center p-1 w-12 rounded-sm">

                                    {{ $matching->mse }}

                                </div>

                            </td>



                                <td class="px-6 py-4 whitespace-no-wrap">

                                    <div class="text-xs sm:text-sm leading-5 text-gray-400 break-words">{{ $matching->elapsed_time }}</div>

                                </td>

                            <!-- Löschen -->

                            <td class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap float-right text-sm leading-5 font-medium">

                                <form action="{{ route('resetMatching', ['lehr' => $matching->lehr->id, 'stud' => $matching->stud->id]) }}" method="get">

                                    @csrf

                                    <button type="submit" class="py-2 px-2 rounded-full text-white text-sm flex focus:outline-none bg-yellow-700 has-tooltip hover:bg-yellow-900 border-2 border-white transition ease-in-out duration-150">

                                        <div class="grid justify-items-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />

                                            </svg>

                                            <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150'>Zurücksetzen</span>

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

            <!-- Übernommene Vorschläge -->



                        <!-- feste Zusage -->

                        <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md mt-4">

                            <div class="grid justify-items-center sm:justify-items-start select-none">
            
                                <h2 class="font-semibold text-lg text-gray-200">
            
                                    Zugesagte Tandems
            
                                </h2>
            
                                <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">
            
                                    @if (count($accepted_matchings) == 0)

                                        Bis jetzt hat keine PartnerIn ihren Vorschlägen zugestimmt. Es ergab sich noch kein Tandem.
            
                                    @elseif (count($accepted_matchings) == 1)
            
                                        <p>Dem folgenden Vorschlag wurde fest zugesagt. Ein Tandem wurde gebildet.</p>
            
                                    @elseif (count($accepted_matchings) > 1)
            
                                        <p>Den folgenden <strong>{{ count($accepted_matchings) }} Vorschlägen</strong> wurde fest zugesagt. Mehrere Tandems wurden gebildet.</p>
            
                                    @endif
            
                                </div>
            
                            </div>
            
                            <table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">
            
                                <tbody>
            
                                    @if (count($accepted_matchings) == 0)
            
                                    <p class="px-6 py-3 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider mt-4 rounded-md">Bisher wurden keine Tandems gebildet.</p>
            
                                    @elseif (count($accepted_matchings) > 0)
            
                                    <tr>
            
                                        <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tl-md font-bold">
                                            #</th>
            
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                            Lehrkraft</th>
            
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                            Zusage</th>
            
                                        <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                            Student*in</th>
            
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                            Zusage</th>
            
                                        <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                            MSE</th>
            
                                        <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                            Übernommen</th>
            
                                        <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-right text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold">
                                        </th>
            
                                    </tr>
            
                                    @foreach($accepted_matchings as $index => $matching)
            
                                    <tr class="border-t border-gray-200 bg-gray-700">
            
                                        <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">
            
                                            {{ $index + 1 }}
            
                                        </td>
            
                                        <td class="px-6 py-4 whitespace-no-wrap">
            
                                            <div class="text-xs sm:text-sm leading-5 font-medium text-white">{{ $matching->lehr->vorname }} {{ $matching->lehr->nachname }}</div>
            
                                            <a href="mailto:{{ $matching->lehr->email }}" class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->lehr->email }}</a>
            
                                        </td>
            
                                        <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">
            
                                            @if($matching->lehr->hasMatchingAccepted($matching->stud->id) == true)
            
                                                <!-- Angenommen -->
                                                <div class="has-tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150">Angenommen</span>
                                                </div>
            
                                            @elseif($matching->lehr->hasMatchingDeclined($matching->stud->id))
                                                
                                                <!-- Abgelehnt -->
                                                <div class="has-tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Abgelehnt</span>
                                                </div>
            
                                            @else
            
                                                <!-- Ausstehend -->
                                                
                                                <div class="has-tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Ausstehend</span>
                                                </div>
            
                                            @endif
            
                                        </td>
            
                                        <td class="px-6 py-4 whitespace-no-wrap">
            
                                            <div class="text-xs sm:text-sm leading-5 font-medium text-white">{{ $matching->stud->vorname }} {{ $matching->stud->nachname }}</div>
            
                                            <a href="mailto:{{  $matching->lehr->email }}" class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->stud->email }}</a>
            
                                            <div class="text-white"></div>
            
                                        </td>
            
                                        <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">
            
                                            @if($matching->stud->hasMatchingAccepted($matching->lehr->id) == true)
            
                                                <!-- Angenommen -->
                                                <div class="has-tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150">Angenommen</span>
                                                </div>
            
                                            @elseif($matching->stud->hasMatchingDeclined($matching->lehr->id))
                                                
                                                <!-- Abgelehnt -->
                                                <div class="has-tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Abgelehnt</span>
                                                </div>
            
                                            @else
            
                                                <!-- Ausstehend -->
                                                
                                                <div class="has-tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Ausstehend</span>
                                                </div>
            
                                            @endif
            
                                        </td>
            
                                        <td class="px-6 py-4 whitespace-no-wrap">
            
                                            <div class="text-sm leading-5 font-normal text-white select-none font-bold bg-gray-500 text-center p-1 w-12 rounded-sm">
            
                                                {{ $matching->mse }}
            
                                            </div>
            
                                        </td>
            
            
            
                                            <td class="px-6 py-4 whitespace-no-wrap">
            
                                                <div class="text-xs sm:text-sm leading-5 text-gray-400 break-words">{{ $matching->elapsed_time }}</div>
            
                                            </td>
            
                                        <!-- Löschen -->
            
                                        <td class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap float-right text-sm leading-5 font-medium">
            
                                            <form action="{{ route('resetMatching', ['lehr' => $matching->lehr->id, 'stud' => $matching->stud->id]) }}" method="get">
            
                                                @csrf
            
                                                <button type="submit" class="py-2 px-2 rounded-full text-white text-sm flex focus:outline-none bg-yellow-700 has-tooltip hover:bg-yellow-900 border-2 border-white transition ease-in-out duration-150">
            
                                                    <div class="grid justify-items-center">
            
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            
                                                        </svg>
            
                                                        <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150'>Zurücksetzen</span>
            
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
            
                        <!-- feste Zusage -->


            <!-- abgelehnt -->

            <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md mt-4">

                <div class="grid justify-items-center sm:justify-items-start select-none">

                    <h2 class="font-semibold text-lg text-gray-200">

                        Abgelehnte Tandems

                    </h2>

                    <div class="mt-1 text-sm text-gray-300 grid text-center sm:text-left flex">

                        @if (count($declined_matchings) == 0)

                            Eine der beiden PartnerInnen hat diesen Vorschlag abgelehnt. Das Paar wurde nicht gebildet.

                        @elseif (count($declined_matchings) == 1)

                        <p>Der folgende Vorschlag kam leider nicht zustande.</p>

                        @elseif (count($declined_matchings) > 1)

                        <p>Die folgenden <strong>{{ count($declined_matchings) }} Vorschläge</strong> kamen leider nicht zustande.</p>

                        @endif

                    </div>

                </div>

                <table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

                    <tbody>

                        @if (count($declined_matchings) == 0)

                        <p class="px-6 py-3 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider mt-4 rounded-md">Bisher wurden keine Vorschläge von Ihnen übernommen. Suchen Sie auf Basis des MSE nach Paarungen.</p>

                        @elseif (count($declined_matchings) > 0)

                        <tr>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tl-md font-bold">
                                #</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Lehrkraft</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Zusage</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Student*in</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Zusage</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                MSE</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Übernommen</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-right text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold">
                            </th>

                        </tr>

                        @foreach($declined_matchings as $index => $matching)

                        <tr class="border-t border-gray-200 bg-gray-700">

                            <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                {{ $index + 1 }}

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap">

                                <div class="text-xs sm:text-sm leading-5 font-medium text-white">{{ $matching->lehr->vorname }} {{ $matching->lehr->nachname }}</div>

                                <a href="mailto:{{ $matching->lehr->email }}" class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->lehr->email }}</a>

                            </td>

                            <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                @if($matching->lehr->hasMatchingAccepted($matching->stud->id) == true)

                                    <!-- Angenommen -->
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150">Angenommen</span>
                                    </div>

                                @elseif($matching->lehr->hasMatchingDeclined($matching->stud->id))
                                    
                                    <!-- Abgelehnt -->
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Abgelehnt</span>
                                    </div>

                                @else

                                    <!-- Ausstehend -->
                                    
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Ausstehend</span>
                                    </div>

                                @endif

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap">

                                <div class="text-xs sm:text-sm leading-5 font-medium text-white">{{ $matching->stud->vorname }} {{ $matching->stud->nachname }}</div>

                                <a href="mailto:{{  $matching->lehr->email }}" class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $matching->stud->email }}</a>

                                <div class="text-white"></div>

                            </td>

                            <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                @if($matching->stud->hasMatchingAccepted($matching->lehr->id) == true)

                                    <!-- Angenommen -->
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150">Angenommen</span>
                                    </div>

                                @elseif($matching->stud->hasMatchingDeclined($matching->lehr->id))
                                    
                                    <!-- Abgelehnt -->
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Abgelehnt</span>
                                    </div>

                                @else

                                    <!-- Ausstehend -->
                                    
                                    <div class="has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="tooltip rounded p-1 px-2 bg-gray-900 text-white text-xs transition ease-in-out duration-150 -mt-14 -ml-6">Ausstehend</span>
                                    </div>

                                @endif

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap">

                                <div class="text-sm leading-5 font-normal text-white select-none font-bold bg-gray-500 text-center p-1 w-12 rounded-sm">

                                    {{ $matching->mse }}

                                </div>

                            </td>



                                <td class="px-6 py-4 whitespace-no-wrap">

                                    <div class="text-xs sm:text-sm leading-5 text-gray-400 break-words">{{ $matching->elapsed_time }}</div>

                                </td>

                            <!-- Löschen -->

                            <td class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap float-right text-sm leading-5 font-medium">

                                <form action="{{ route('resetMatching', ['lehr' => $matching->lehr->id, 'stud' => $matching->stud->id]) }}" method="get">

                                    @csrf

                                    <button type="submit" class="py-2 px-2 rounded-full text-white text-sm flex focus:outline-none bg-yellow-700 has-tooltip hover:bg-yellow-900 border-2 border-white transition ease-in-out duration-150">

                                        <div class="grid justify-items-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />

                                            </svg>

                                            <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs transition ease-in-out duration-150'>Zurücksetzen</span>

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

            <!-- abgelehnt -->


        </div>

    </div>

</div>

<!-- Weitere Vorschläge -->

</div>

</div>

</div>

<!-- Content -->

@endsection