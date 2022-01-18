@extends ('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div class="flex flex-row h-full mx-5 mt-10 mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->

    <!-- Content -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen rounded-r-lg" style="background-color: #EDF2F7;">

        <div class="mx-auto rounded">

            <!-- Tabs -->

            <ul id="tabs" class="inline-flex w-full">

                <li class="px-4 py-2 font-medium text-sm text-gray-800 rounded-t opacity-50 bg-white border-gray-400"><a href="{{ route('needs.all') }}">Alle Bedarfe</a></li>

                <li class="px-4 py-2 font-medium text-sm text-gray-800 rounded-t opacity-50 bg-white border-gray-400"><a href="{{ route('needs.user') }}">Meine Bedarfe</a></li>

                <li class="px-4 py-2 -mb-px font-medium text-sm text-gray-800 border-b-2 border-gray-700 rounded-t opacity-50 bg-white border-b-4 -mb-px opacity-100"><a href="{{ route('needs.make') }}">Bedarf erstellen</a></li>

            </ul>

            <!-- Tabs -->

            <!-- Tab Contents -->

            <div id="tab-contents">

                <!-- Bedarf erstellen -->

                <div id="third">

                    <div class="bg-white overflow-hidden rounded-b-md mb-5">

                        <div class="px-2 py-5 sm:px-4">

                            <div class="grid grid-cols-1 text-sm text-gray-500 text-light py-1 my-1">

                                <p class="font-medium text-gray-800 leading-none text-lg leading-6">Bedarfserstellung</p>

                                <p class="text-sm text-gray-500 mt-1 mb-3 mt-2">Erstellen Sie einen Bedarf, um Hilfe anzufordern. Beschreiben Sie den Zeitraum sowie die wöchentliche Stundenzahl, die Art, das Fach und die konkreten Anforderungen. Bitte gehen Sie auch auf die technische Ausstattung des Klassenraums ein.</p>

                            </div>

                            <form action="{{ route('needs') }}" method="post" class="mb-4">

                                @csrf

                                <div class="mt-1">

                                    <label for="body" class="sr-only">Body</label><textarea name="body" id="body" cols="30" rows="4" class="py-2 px-3 bg-gray-100 border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent w-full rounded-lg @error('body') border-red-500 @enderror" placeholder="Beschreiben Sie Ihren Bedarf."></textarea>

                                    @error('body')

                                    <div class="text-red-500 mt-2 text-sm">

                                        {{ 'Bitte beschreiben Sie Ihr Hilfsangebot.' }}

                                    </div>

                                    @enderror

                                </div>

                                <!-- Test -->

                                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">

                                    <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                        <p class="font-medium text-gray-800 leading-none">Betreuungsrahmen</p>

                                        <p class="text-xs text-gray-500 mt-1 mb-3">Legen Sie fest, wieviele Personen in Ihrer Klasse/Schule Betreuungsbedarf benötigen.</p>

                                        <div>

                                            <label for="rahmen" class="sr-only flex items-center">rahmen</label>

                                            <select name="rahmen" id="rahmen" class="text-gray-500 text-xs py-1 rounded-sm border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent @error('rahmen') border-red-500 @enderror">
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

                                    <!-- Schulart -->

                                    <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                        <p class="font-medium text-gray-800 leading-none">Schulart</p>

                                        <p class="text-xs text-gray-500 mt-1 mb-3">Legen Sie fest, welche Schule Sie bevorzugen.</p>

                                        <div>

                                            <label for="rahmen" class="sr-only flex items-center">schulart</label>

                                            <select name="schulart" id="schulart" class="text-gray-500 text-xs py-1 rounded-sm border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent @error('schulart') border-red-500 @enderror">
                                                <option>Keine</option>
                                                <option>Grundschule</option>
                                                <option>Weitere</option>
                                            </select>

                                            @error('schulart')

                                            <div class="text-red-500 mt-2 text-sm">

                                                {{ 'Bitte legen Sie fest, welche Schule Sie bevorzugen.' }}

                                            </div>

                                            @enderror

                                        </div>

                                    </div>

                                    <!-- Schulart -->

                                    <!-- Test -->

                                    <div class="grid grid-cols-1 text-sm text-gray-500 text-light mt-3">

                                        <p class="font-medium text-gray-800 leading-none">Fremdsprachkenntnisse</p>

                                        <p class="text-xs text-gray-500 mt-1 mb-3">Bestimmen Sie, welche Fremdsprache das Betreuungsverhältnis ergänzen könnte.</p>

                                        <div>

                                            <label for="sprachkenntnisse" class="sr-only flex items-center">sprachkenntnisse</label>

                                            <select name="sprachkenntnisse" id="sprachkenntnisse" class="text-gray-500 text-xs py-1 px-1 rounded-sm border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent @error('sprachkenntnisse') border-red-500 @enderror">
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

                                        <p class="text-xs text-gray-500 mt-1 mb-3">Ergänzen Sie, welchen Studiengang Sie präferieren.</p>

                                        <div>

                                            <label for="studiengang" class="sr-only flex items-center">studiengang</label>

                                            <select name="studiengang" id="studiengang" class="text-gray-500 text-xs py-1 px-1 rounded-sm border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent @error('studiengang') border-red-500 @enderror">
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

                                        <input class="date form-control text-gray-500 text-xs py-1 px-1 rounded-sm border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent @error('sprachkenntnisse') border-red-500 @enderror" type="text" id="datum" name="datum">

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

                                            <select name="fachsemester" id="fachsemester" class="text-gray-500 text-xs py-1 rounded-sm border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent @error('fachsemester') border-red-500 @enderror">
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

                                    <button class="flex items-center w-auto bg-gray-700 hover:bg-gray-900 rounded-lg font-medium text-white px-4 py-2">

                                        <div>

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                            </svg>

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

        <!-- <script>

                    let tabsContainer = document.querySelector("#tabs");

                    let tabTogglers = tabsContainer.querySelectorAll("a");
                    console.log(tabTogglers);

                    tabTogglers.forEach(function(toggler) {
                      toggler.addEventListener("click", function(e) {
                        e.preventDefault();

                        let tabName = this.getAttribute("href");

                        let tabContents = document.querySelector("#tab-contents");

                        for (let i = 0; i < tabContents.children.length; i++) {

                          tabTogglers[i].parentElement.classList.remove("border-gray-700", "border-b",  "-mb-px", "opacity-100");  tabContents.children[i].classList.remove("hidden");
                          if ("#" + tabContents.children[i].id === tabName) {
                            continue;
                          }
                          tabContents.children[i].classList.add("hidden");

                        }
                        e.target.parentElement.classList.add("border-gray-700", "border-b-4", "-mb-px", "opacity-100");
                      });
                    });

                    document.getElementById("default-tab").click();

                </script> -->

    </div>

    <!-- Content -->

</div>

@endsection