@extends ('layouts.app')

@section('content')

<div class="flex flex-row h-full ml-20 mr-20 mt-10 mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->
    
    <!-- Content -->

    <div class="px-8 py-8 text-gray-700 w-screen rounded-r-lg bg-gray-600">

        <div class="overflow-hidden px-4 py-5 sm:px-6">

            <h2 class="text-lg leading-6 font-medium text-gray-900">

                Mögliche Zuweisungen

            </h2>

            <p class="mt-1 max-w-2xl text-sm text-gray-500">

                Übersicht möglicher Zuweisungen

            </p>

        </div>

        <!-- Zeige alle Matches -->

        @foreach ($needs as $need)

            @foreach ($offers as $offer)

                <div class="rounded-lg bg-white my-4">

                    <div class="flex container mx-auto">

                        <div class="p-4 w-1/2">

                            <div class="flex h-full p-4 flex-col">

                                <div class="flex items-center mb-3">

                                    <div class="flex flex-wrap ">

                                        <div class="w-full flex-none text-xs bg-green-600 text-white rounded-md font-medium p-2 shadow-md">

                                            Bedarf #{{ $need->id }} von {{ $need->user->vorname }} {{ $need->user->nachname }}

                                        </div>

                                     </div>

                                </div>

                                <div class="flex-grow">

                                    <!-- Informationen -->

                                    <div class="flex flex-wrap content-start mb-3">
                                        
                                        <p class="text-gray-400 text-sm mr-5">Betreuungsrahmen: <span class="font-medium">{{ $need->rahmen }} Person/en</span></p>

                                        <p class="text-gray-400 text-sm mr-5">Fremdsprachkenntnisse: <span class="font-medium">{{ $need->sprachkenntnisse }}</span></p>

                                        <p class="text-gray-400 text-sm mr-5">Studiengang: <span class="font-medium">{{ $need->studiengang }}</span></p>

                                        <p class="text-gray-400 text-sm mr-5">Fachsemester: <span class="font-medium">{{ $need->fachsemester }}</span></p>

                                    </div>

                                    <!-- Informationen -->

                                    <h3 class="text-md leading-6 font-medium text-gray-400">

                                        Details

                                    </h3>

                                    <p class="leading-relaxed text-sm text-gray-400">{{ $need->body }}</p>

                                </div>

                            </div>

                        </div>

                        <div class="p-4 w-1/2">

                            <div class="flex rounded-lg h-full bg-white p-4 flex-col">

                                <div class="flex items-center mb-3">

                                    <div class="flex flex-wrap ">

                                        <div class="w-full flex-none text-xs bg-yellow-600 text-white p-2 rounded-md font-medium shadow-md">

                                            Angebot #{{ $offer->id }} von {{ $offer->user->vorname }} {{ $offer->user->nachname }}

                                        </div>

                                     </div>

                                </div>

                                <!-- Informationen -->

                                <div class="flex flex-wrap content-start mb-3">
                                    
                                    <p class="text-gray-400 text-sm mr-5">Betreuungsrahmen: <span class="font-medium">{{ $offer->rahmen }} Person/en</span></p>

                                    <p class="text-gray-400 text-sm mr-5">Fremdsprachkenntnisse: <span class="font-medium">{{ $offer->sprachkenntnisse }}</span></p>

                                    <p class="text-gray-400 text-sm mr-5">Studiengang: <span class="font-medium">{{ $offer->studiengang }}</span></p>

                                    <p class="text-gray-400 text-sm mr-5">Fachsemester: <span class="font-medium">{{ $offer->fachsemester }}</span></p>

                                </div>

                                <!-- Informationen -->

                                <h3 class="text-md leading-6 font-medium text-gray-400">Details</h3>

                                <p class="leading-relaxed text-sm text-gray-400">{{ $offer->body }}</p>

                            </div>

                        </div>
                        
                    </div>

                    <div class="container mx-auto rounded-lg bg-white px-8 pb-8">
                        
                        <h3 class="text-md leading-6 font-medium text-gray-600">Übereinstimmungsmerkmale</h3>

                        @if ($need->fachsemester == $offer->fachsemester)

                            @php

                                $zahl+=1;
                                $fachsemester+=1;
                                
                            @endphp

                            <div>

                                <p class="text-gray-600 text-sm mr-5">Fachsemester: <span class="font-medium">{{ $offer->fachsemester }}</span></p>

                            </div>

                        @endif

                        @if ($need->rahmen == $offer->rahmen)                   

                            @php

                                $zahl+=1;
                                $rahmen+=1;
                                
                            @endphp

                            <div>

                                <p class="text-gray-600 text-sm mr-5">Betreuungsrahmen: <span class="font-medium">{{ $need->rahmen }} Person/en</span></p>

                            </div>

                        @endif

                        @if ($need->sprachkenntnisse == $offer->sprachkenntnisse)                   

                            @php

                                $zahl+=1;
                                $sprache+=1;
                                
                            @endphp

                            <div>

                                <p class="text-gray-600 text-sm mr-5">Sprachkenntnisse: <span class="font-medium">{{ $need->sprachkenntnisse }}</span></p>

                            </div>                            

                        @endif

                        @if ($need->studiengang == $offer->studiengang)                   

                            @php

                                $zahl+=1;
                                $studium+=1;
                                
                            @endphp

                           <div>

                                <p class="text-gray-600 text-sm mr-5">Studiengang: <span class="font-medium">{{ $need->studiengang }}</span></p>

                            </div>  

                        @endif

                        <div class="grid justify-items-end">
                            
                                <div class="px-4 py-6 bg-purple-600 rounded-lg grid justify-items-center text-white shadow-lg">
                                    
                                    <h2 class="title-font font-medium text-3xl">{{ $zahl }}</h2>

                                    <p class="leading-relaxed">Übereinstimmungsmerkmale</p>
                                </div>
                            
                        </div>

                    </div>

                </div>

                @php

                    $zahl=0;

                @endphp

            @endforeach

            @php

                $zahl=0;

            @endphp

        @endforeach

        <!-- Zeige alle Needs -->

  	</div>

</div>

@endsection