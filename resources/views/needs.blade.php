@extends ('layouts.app')

@section('content')

    <div class="flex flex-row h-full mx-5 mt-10 mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->
        
        <!-- Content -->

        <div class="px-8 py-8 text-gray-700 w-screen rounded-r-lg" style="background-color: #EDF2F7;">

            <div class="overflow-hidden px-4 py-5 sm:px-6">

                <h2 class="text-lg leading-6 font-medium text-gray-900">

                    Bedarfe

                </h2>

                <p class="mt-1 max-w-2xl text-sm text-gray-500">

                    Übersicht und Erstellung von Bedarfen

                </p>

            </div>

            <div class="bg-white overflow-hidden rounded-md mb-5">

                <div class="px-4 py-5 sm:px-6">

                    <div class="grid grid-cols-1 text-sm text-gray-500 text-light">

                        <p class="font-medium text-gray-800 leading-none">Bedarfserstellung</p>

                        <p class="text-xs text-gray-500 mt-1 mb-3">Erstellen Sie einen Bedarf, um Hilfe anzufordern. Beschreiben Sie den Zeitraum sowie die wöchentiche Stundenzahl, die Art, das Fach und die konkreten Anforderungen.</p>

                    </div>

                    <!-- Bedarf erstellen -->

                    <form action="{{ route('needs') }}" method="post" class="mb-4">

                        @csrf
                      
                        <div class="mt-1">
                            
                            <label for="body" class="sr-only">Body</label><textarea name="body" id="body" cols="30" rows="4" class="py-2 px-3 bg-gray-100 border-1 w-full rounded-lg @error('body') border-red-500 @enderror" placeholder="Beschreiben Sie Ihren Bedarf."></textarea>

                            @error('body')

                                <div class="text-red-500 mt-2 text-sm">
                                    
                                    {{ 'Bitte beschreiben Sie Ihr Hilfsangebot.' }}

                                </div>

                            @enderror

                        </div>

                        <!-- Test -->

                        <div class="grid grid-cols-4 gap-4">

                            <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                <p class="font-medium text-gray-800 leading-none">Betreuungsrahmen</p>

                                <p class="text-xs text-gray-500 mt-1 mb-3">Legen Sie fest, wieviele Personen in Ihrer Klasse/Schule Betreuungsbedarf benötigen.</p>

                                <div>

                                    <label for="rahmen" class="sr-only flex items-center">rahmen</label>

                                    <select name="rahmen" id="rahmen" class="text-gray-500 text-xs py-1 rounded-sm border-2 border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent @error('rahmen') border-red-500 @enderror">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>

                                    @error('rahmen')

                                        <div class="text-red-500 mt-2 text-sm">
                                            
                                            {{ 'Bitte legen Sie fest, wieviele Personen Sie betreuen möchten.' }}

                                        </div>

                                    @enderror

                                </div>

                            </div>

                            <!-- Test -->

                            <!-- Test -->

                            <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                <p class="font-medium text-gray-800 leading-none">Fremdsprachkenntnisse</p>

                                <p class="text-xs text-gray-500 mt-1 mb-3">Bestimmen Sie, welche Fremdsprache das Betreuungsverhältnis ergänzen könnte.</p>

                                <div>

                                    <label for="sprachkenntnisse" class="sr-only flex items-center">sprachkenntnisse</label>

                                    <select name="sprachkenntnisse" id="sprachkenntnisse" class="text-gray-500 text-xs py-1 px-1 rounded-sm border-2 border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent @error('sprachkenntnisse') border-red-500 @enderror">
                                        <option>Keine</option>
                                        <option>Englisch</option>
                                        <option>Französisch</option>
                                        <option>Spanisch</option>
                                        <option>Türkisch</option>
                                        <option>Arabisch</option>
                                        <option>Chinesisch</option>
                                    </select>

                                    @error('sprachkenntnisse')

                                        <div class="text-red-500 mt-2 text-sm">
                                            
                                            {{ 'Bitte bestimmen Sie, welche Fremdsprache Ihr Betreuungsverhältnis ergänzt.' }}

                                        </div>

                                    @enderror

                                </div>

                            </div>

                            <!-- Test -->

                            <!-- Studiengang -->

                            <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                <p class="font-medium text-gray-800 leading-none">Studiengang</p>

                                <p class="text-xs text-gray-500 mt-1 mb-3">Ergänzen Sie, welchen Studiengang Sie präferieren. Sollten Sie keine Präferenz haben, wählen Sie "-" aus.</p>

                                <div>

                                    <label for="studiengang" class="sr-only flex items-center">studiengang</label>

                                    <select name="studiengang" id="studiengang" class="text-gray-500 text-xs py-1 px-1 rounded-sm border-2 border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent @error('studiengang') border-red-500 @enderror">
                                        <option>-</option>
                                        <option>Hauptfach Deutsch als Zweit- und Fremdsprache (B.A.)</option>
                                        <option>Nebenfach Deutsch als Zweit- und Fremdsprache (B.A.)</option>
                                        <option>Grundschule (LA)</option>
                                        <option>Mittelschule (LA)</option>
                                        <option>Realschule (LA)</option>
                                        <option>Gymnasium (LA)</option>
                                        <option>Sonstiges</option>
                                    </select>

                                    @error('studiengang')

                                        <div class="text-red-500 mt-2 text-sm">
                                            
                                            {{ 'Bitte ergänzen Sie Ihren Studiengang.' }}

                                        </div>

                                    @enderror

                                </div>

                            </div>

                            <!-- Studiengang -->

                            <!-- Datum -->

                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

                            <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
                            
                            <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
                            
                            <script src="https://npmcdn.com/flatpickr/dist/l10n/de.js"></script>                            
                            
                            <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">
                            
                                <p class="font-medium text-gray-800 leading-none">Betreuungszeitraum</p>
                            
                                <p class="text-xs text-gray-500 mt-1 mb-3">Geben Sie Ihren Betreuungszeitraum an.</p>
                            
                                <label for="datum" class="sr-only flex items-center">Datum</label>
                            
                                <input class="date form-control text-gray-500 text-xs py-1 px-1 rounded-sm border-2 border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent @error('sprachkenntnisse') border-red-500 @enderror"  type="text" id="datum" name="datum">
                            
                                @error('datum')
                            
                                    <div class="text-red-500 mt-2 text-sm">
                                        
                                        {{ 'Bitte wählen Sie ein Datum aus.' }}
                            
                                    </div>
                            
                                @enderror
                            
                                <script type="text/javascript">
                            
                                    flatpickr("#datum", {
                                        altInput: true,
                                        altFormat: "F Y", // was "j F, Y"
                                        dateFormat: "Y-m-d", // was "Y-F"
                                        theme: "dark",
                                        minDate: "today",
                                        mode: "range",
                                        "locale": "de",
                                    });
                                
                                </script>
                            
                            </div>
                                
                            <!-- Datum -->

                            <!-- Fachsemester -->

                            <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                <p class="font-medium text-gray-800 leading-none">Fachsemester</p>

                                <p class="text-xs text-gray-500 mt-1 mb-3">Wählen Sie aus, welches Fachsemester Ihr*e Helfer*in mindestens erreicht haben sollte.</p>

                                <div>

                                    <label for="fachsemester" class="sr-only flex items-center">fachsemester</label>

                                    <select name="fachsemester" id="fachsemester" class="text-gray-500 text-xs py-1 rounded-sm border-2 border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent @error('fachsemester') border-red-500 @enderror">
                                        <option>0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                    </select>

                                    @error('fachsemester')

                                        <div class="text-red-500 mt-2 text-sm">
                                            
                                            {{ 'Bitte wählen Sie Ihr Fachsemester aus.' }}

                                        </div>

                                    @enderror

                                </div>

                            </div>

                            <!-- Fachsemester -->
                        
                        </div>                        

                        <div class=" flex justify-end md:gap-8 gap-4 pt-1 rounded-md text-sm">

                          <button class="border border-transparent w-auto bg-purple-600 hover:bg-purple-700 rounded-lg font-medium text-white px-4 py-2 shadow">Bedarf erstellen</button>

                        </div>

                    </form>

                    <!-- Bedarf erstellen -->

                </div>

            </div>

            <!-- Zeige alle Needs -->

                    @if ($needs->count())

                        @foreach($needs as $need)

                            <div class="my-2 bg-white rounded-md">

                                <div class="px-4 sm:px-6 py-5">

                                    <!-- Informationen -->

                                    <div class="flex items-center justify-between">

                                        <a href="" class="font-bold flex">

                                            @if($need->ownedBy(auth()->user()))

                                                Ihr Bedarf

                                            @else

                                                {{ $need->user->vorname }} {{ $need->user->nachname }}

                                            @endif
                                            
                                        </a>

                                        <div>

                                            <!-- <a href="mailto:{{ $need->user->email }}" class="text-purple-500 hover:text-purple-700 text-sm mr-5">{{ $need->user->email }}</a>-->

                                            <span class="text-gray-400 text-xs"><strong>Bedarf #{{ $need->id }}</strong> erstellt {{ $need->created_at->diffForHumans() }}</span>

                                        </div>

                                    </div>

                                    <!-- Informationen -->

                                    <div class="flex flex-wrap content-start">
                                        
                                        <p class="text-gray-400 text-sm mr-5">Betreuungsrahmen: <span class="font-medium">{{ $need->rahmen }} Person/en</span></p>

                                        <p class="text-gray-400 text-sm mr-5">Fremdsprachkenntnisse: <span class="font-medium">{{ $need->sprachkenntnisse }}</span></p>

                                        <p class="text-gray-400 text-sm mr-5">Studiengang: <span class="font-medium">{{ $need->studiengang }}</span></p>

                                        <p class="text-gray-400 text-sm mr-5">Fachsemester: <span class="font-medium">{{ $need->fachsemester }}</span></p>

                                    </div>


                                    <!-- Body -->

                                    <p class="text-gray-600 text-sm my-3">{{ $need->body }}</p>

                                    <!-- Body -->

                                    <!-- Like / Unlike -->


                                    <div class="flex justify-end">

                                        @auth

                                            @if (!$need->likedBy(auth()->user()))

                                                <form action="{{ route('needs.likes', $need) }}" method="post" >

                                                    @csrf

                                                    <!-- Like -->

                                                    <button type="submit" class="py-2 text-purple-300 hover:text-purple-500 text-xs flex focus:outline-none">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                          <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                        </svg><span class="mx-1 mt-1">{{ $need->likes->count() }}</span>

                                                    </button>

                                                     <!-- Like -->

                                                </form>

                                            @else

                                                <button type="submit" class="py-2 text-purple-500 hover:text-purple-500 text-xs flex focus:outline-none">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                      <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                    </svg><span class="mx-1 mt-1">{{ $need->likes->count() }}</span>

                                                </button>

                                                <form action="{{ route('needs.likes', $need) }}" method="post" >

                                                    @csrf

                                                    @method('DELETE')

                                                     <!-- Unlike -->

                                                    <button type="submit" class="py-2 text-purple-300 hover:text-purple-500 text-xs focus:outline-none">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                          <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z" />
                                                        </svg>

                                                    </button>

                                                     <!-- Unlike -->

                                                </form>

                                            @endif

                                        <!-- Löschen -->

                                        @if(!$need->ownedBy(auth()->user()))

                                        

                                            <form action="{{ route('needs.requests', $need) }}" method="post" >

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="py-2 text-purple-300 hover:text-purple-500 text-xs flex focus:outline-none ml-8">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                    </svg><span class="mx-1 mt-1">Anfragen</span>

                                                </button>

                                            </form>

                                        

                                        @else

                                            <form action="{{ route('needs.destroy', $need) }}" method="post" >

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="py-2 px-2 rounded-md text-white bg-purple-600 hover:bg-purple-700 text-xs flex focus:outline-none ml-8">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg><span class="mx-1 mt-1">Zurückziehen</span>

                                                </button>

                                            </form>

                                            <!-- Löschen -->                                       

                                            @endif

                                        @endauth

                                    </div>

                                    <!-- Like / Unlike -->

                                </div>

                            </div>

                        @endforeach

                        <div class="mt-5">

                            {{ $needs->links() }}

                        </div>

                    @else

                        <p>Keine Einträge vorhanden.</p>

                    @endif

                    <!-- Zeige alle needs -->

        </div>

        <!-- Content -->

    </div>

@endsection