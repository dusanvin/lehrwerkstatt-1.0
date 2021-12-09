@extends ('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div class="flex flex-row h-full mx-5 mt-10 mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->
        
        <!-- Content -->

        <div class="px-8 py-8 text-gray-700 w-screen rounded-r-lg" style="background-color: #EDF2F7;">

            <!-- <div class="overflow-hidden px-4 py-5 sm:px-6">

                <h2 class="text-lg leading-6 font-medium text-gray-900">

                    Bedarfe

                </h2>

                <p class="mt-1 max-w-2xl text-sm text-gray-500">

                    Übersicht und Erstellung von Bedarfen

                </p>

            </div>

            <!-- Test -->

            <div class="mx-auto rounded">

            <!-- Tabs -->

            <ul id="tabs" class="inline-flex w-full">

                <li class="px-4 py-2 -mb-px font-medium text-sm text-gray-800 border-b-2 border-purple-400 rounded-t opacity-50 bg-white"><a id="default-tab" href="#first">Alle Bedarfe</a></li>

                <li class="px-4 py-2 font-medium text-sm text-gray-800 rounded-t opacity-50 bg-white"><a href="#second">Meine Bedarfe</a></li>

                <li class="px-4 py-2 font-medium text-sm text-gray-800 rounded-t opacity-50 bg-white"><a href="#third">Bedarf erstellen</a></li>

            </ul>

            <!-- Tabs -->

            <!-- Tab Contents -->

            <div id="tab-contents">

                <!-- Alle Bedarfe -->

                <div id="first" class="p-4 bg-white">

                    <!-- Zeige alle Needs -->

                    @if ($needs->count())

                        @foreach($needs as $need)

                             @if($need->ownedBy(auth()->user()))

                                

                                    <div x-data={show:false} class="mb-2 shadow-lg">

                                        <p class="flex">

                                            <a x-on:click.prevent="show=!show" class="bg-gray-800 hover:bg-gray-900 px-4 py-3 cursor-pointer focus:outline-none text-sm text-gray-200 w-full">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 mb-1" viewBox="0 0 20 20" fill="currentColor">
                                                
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />

                                                </svg>

                                                <span class="font-medium">Ihr Bedarf #{{ $need->id }}</span> erstellt {{ $need->created_at->diffForHumans() }} 

                                            </a>

                                        </p> 

                                        <div x-show="show" class="px-4 py-3 bg-gray-800 text-gray-400 text-sm transition-all duration-500 ease-in-out">
                                            <!-- Informationen -->

                                            <div class="flex flex-wrap content-start select-none">
                                                
                                                <p class="mr-3">Betreuungsrahmen: <span class="font-medium">{{ $need->rahmen }} Person/en</span></p>

                                                <p class="mr-3">Fremdsprachkenntnisse: <span class="font-medium">{{ $need->sprachkenntnisse }}</span></p>

                                                <p class="mr-3">Studiengang: <span class="font-medium">{{ $need->studiengang }}</span></p>

                                                <p class="mr-3">Fachsemester: <span class="font-medium">{{ $need->fachsemester }}</span></p>

                                            </div>

                                            <div>

                                                <p>{{ $need->body }}</p>

                                            </div>

                                            <div class="flex justify-end">
                                                
                                                <!-- Löschen -->  

                                                <form action="{{ route('needs.destroy', $need) }}" method="post" >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit" class="py-2 px-2 rounded-full bg-gray-700 text-white hover:bg-black text-sm flex focus:outline-none ml-4">

                                                        <div class="grid justify-items-center">

                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                            </svg>

                                                            <!-- <span class="mx-3 mt-1">Zurückziehen</span> -->

                                                        </div>

                                                    </button>

                                                </form>

                                                <!-- Löschen -->

                                            </div>

                                        <!-- Informationen -->
                                        </div>

                                    </div>

                            @else

                            <div class="my-2 bg-white rounded-md">

                                <div class="px-4 sm:px-6 py-5 shadow-lg">

                                    <!-- Informationen -->

                                    <div class="flex items-center justify-between">

                                        {{ $need->user->vorname }} {{ $need->user->nachname }}                                        

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

                                    <!-- Informationen -->

                                    <!-- Body -->
                                    
                                    <p class="text-gray-600 text-sm my-3">{{ $need->body }}</p>

                                    <!-- Body -->

                                    <!-- Buttons -->

                                    <div class="flex justify-end">

                                        @auth

                                            @if(!$need->ownedBy(auth()->user()))                                               

                                                <!-- Anfragen --> 

                                                <form action="{{ route('messages.store') }}" method="post">

                                                    {{ csrf_field() }}

                                                    <input class="py-2 px-3 bg-gray-100 border-1 w-full rounded-sm form-control form-input" placeholder="Ihr Betreff." value="Anfrage zu Bedarf #{{ $need->id }}" name="subject" type="hidden">

                                                    <textarea name="message" placeholder="Ihre Nachricht." style="display:none;">Ich möchte auf Ihren Bedarf #{{ $need->id }} reagieren. Sie suchen {{ $need->rahmen }} Person/en, wobei folgende Spezifika mit angegeben wurden: Sprachkenntnisse: {{ $need->sprachkenntnisse }}, Studiengang {{ $need->studiengang }} und Fachsemester: {{ $need->fachsemester }}. Der Betreuungszeitraum geht vom {{ date('d.m.Y', strtotime($need->datum_start)) }} bis zum {{ date('d.m.Y', strtotime($need->datum_end)) }}. Die Beschreibung Ihres Angebots lautet: {{ $need->body }} - Hätten Sie Interesse an meinem Angebot?</textarea>
                                                    
                                                        <div class="checkbox">
                                                                
                                                            <input name="recipients[]" value="{{  $need->user->id }}" type="hidden">
                                                                
                                                        </div>

                                                        <div class="form-group">

                                                            <button type="submit" class="ml-4 py-2 px-2 rounded-full bg-gray-700 text-white hover:bg-gray-900 text-sm flex focus:outline-none">

                                                                <div class="grid justify-items-center">
                                                                
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />

                                                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />

                                                                    </svg>

                                                                    <!-- <span class="mt-1 mx-3">Anfragen</span> -->

                                                                </div>

                                                            </button>

                                                        </div>

                                                </form>

                                                <!-- Anfragen --> 

                                            @else                                       

                                            @endif

                                            <!-- Like / Unlike -->

                                            <div class="grid justify-items-center ml-2">

                                            @if (!$need->likedBy(auth()->user()))

                                                <form action="{{ route('needs.likes', $need) }}" method="post" >

                                                    @csrf

                                                    <!-- Like -->

                                                    <button type="submit" class="pt-2 pb-1 text-gray-400 hover:text-gray-700 text-xs flex focus:outline-none">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                          <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                        </svg><span class="mx-1 mt-1">{{ $need->likes->count() }}</span>

                                                    </button>

                                                     <!-- Like -->

                                                </form>

                                            @else

                                                <form action="{{ route('needs.likes', $need) }}" method="post" >

                                                    @csrf

                                                    @method('DELETE')

                                                     <!-- Unlike -->

                                                    <button type="submit" class="pt-2 text-gray-400 hover:text-gray-700 text-xs flex focus:outline-none">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                          <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                        </svg><span class="mx-1 mt-1">{{ $need->likes->count() }}</span>

                                                    </button>

                                                     <!-- Unlike -->

                                                </form>

                                            @endif

                                            <!-- Like / Unlike -->

                                            <!-- <div class="text-xs grid justify-center text-purple-300">Gefällt mir</div> -->

                                        </div>

                                        @endauth

                                    </div>

                                    <!-- Buttons -->

                                </div>

                            </div>

                            @endif

                        @endforeach

                        <div class="mt-5">

                            {{ $needs->links() }}

                        </div>

                    @else

                        <p>Keine Einträge vorhanden.</p>

                    @endif

                    <!-- Zeige alle needs -->

                </div>

                <!-- Alle Bedarfe -->

                <!-- Meine Bedarfe -->

                <div id="second" class="hidden">

                    Second tab

                </div>

                <!-- Meine Bedarfe -->

                <!-- Bedarf erstellen -->

                <div id="third" class="hidden">

                    <div class="bg-white overflow-hidden rounded-b-md mb-5">

                        <div class="px-4 py-5 sm:px-6">

                            <div class="grid grid-cols-1 text-sm text-gray-500 text-light">

                                <p class="font-medium text-gray-800 leading-none">Bedarfserstellung</p>

                                <p class="text-xs text-gray-500 mt-1 mb-3">Erstellen Sie einen Bedarf, um Hilfe anzufordern. Beschreiben Sie den Zeitraum sowie die wöchentliche Stundenzahl, die Art, das Fach und die konkreten Anforderungen. Bitte gehen Sie auch auf die technische Ausstattung ein, mit der gearbeitet wird.</p>

                            </div>

                            <form action="{{ route('needs') }}" method="post" class="mb-4">

                                @csrf
                              
                                <div class="mt-1">
                                    
                                    <label for="body" class="sr-only">Body</label><textarea name="body" id="body" cols="30" rows="4" class="py-2 px-3 bg-gray-100 border-2 border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent w-full rounded-lg @error('body') border-red-500 @enderror" placeholder="Beschreiben Sie Ihren Bedarf."></textarea>

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

                                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/plugins/monthSelect/style.css">
                                    
                                    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/plugins/monthSelect/index.js"></script>
                                    
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

                                <div class="flex justify-end md:gap-8 gap-4 pt-1 rounded-md text-sm">

                                  <button class="flex items-center border border-transparent w-auto bg-purple-600 hover:bg-purple-700 rounded-lg font-medium text-white px-4 py-2">

                                   <div>

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>

                                    </div>

                                    <div class="pl-3">

                                        <p>Bedarf erstellen</p>

                                    </div>

                                </div>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                <!-- Bedarf erstellen -->

            </div>

            <!-- Tab Contents -->

          </div>

                <script>

                    let tabsContainer = document.querySelector("#tabs");

                    let tabTogglers = tabsContainer.querySelectorAll("a");
                    console.log(tabTogglers);

                    tabTogglers.forEach(function(toggler) {
                      toggler.addEventListener("click", function(e) {
                        e.preventDefault();

                        let tabName = this.getAttribute("href");

                        let tabContents = document.querySelector("#tab-contents");

                        for (let i = 0; i < tabContents.children.length; i++) {

                          tabTogglers[i].parentElement.classList.remove("border-purple-400", "border-b",  "-mb-px", "opacity-100");  tabContents.children[i].classList.remove("hidden");
                          if ("#" + tabContents.children[i].id === tabName) {
                            continue;
                          }
                          tabContents.children[i].classList.add("hidden");

                        }
                        e.target.parentElement.classList.add("border-purple-400", "border-b-4", "-mb-px", "opacity-100");
                      });
                    });

                    document.getElementById("default-tab").click();

                </script>

            <!-- Test -->

















            

            

        </div>

        <!-- Content -->

    </div>

@endsection