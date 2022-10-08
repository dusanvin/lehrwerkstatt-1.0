@extends('layouts.app')


@section('content')

<body style="">

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Inhalt -->

        <div class="px-1 md:px-8 py-8 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

            <div class="overflow-hidden sm:rounded-lg mb-4">

                <!-- Informationsanzeige -->

                <!-- Inof neu -->

                <div class="px-2 sm:px-4">

                    <div class="md:flex no-wrap md:-mx-2 ">

                        <!-- Left Side -->

                        <div class="w-full md:w-3/12 md:mx-2">

                            <!-- Profile Card -->

                            <div class="p-3 select-none mx-auto">

                                <div class="">

                                    @if(isset($user->image->filename))

                                    <img src="{{ url('images/show/'.$user->id) }}" class="w-48 h-48 rounded-full object-cover border-4 border-white mx-auto">

                                    @else

                                    <img src="https://daz-buddies.digillab.uni-augsburg.de/img/avatar.jpg" class="w-48 h-48 rounded-full object-cover border-4 border-white mx-auto">

                                    @endif

                                </div>

                                <div class="text-center">

                                    <h2 class="text-gray-200 text-xl leading-8 my-1">{{ $user->vorname }} {{ $user->nachname }}</h2>

                                    <p class="text-gray-400 font-lg text-semibold text-xs">
                                    <label class="badge badge-success">{{ $user->getRoleName() }}</label>

                                </div>

                                <ul class="bg-gray-700 text-gray-400 py-2 px-3 mt-3 rounded text-sm">

                                    <li class="py-3">
                                        <div class="text-xs leading-4 font-medium text-gray-200">Letzte Anmeldung</div>
                                        <div class="text-gray-400 text-xs">
                                            @if($user->last_login_at === NULL)
                                            -
                                            @else

                                            {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}

                                            @endif
                                        </div>
                                    </li>

                                    <li class="py-3">
                                        <div class="text-xs leading-4 text-gray-200">Registrierung</div>
                                        <div class="text-gray-400 text-xs">{{ $user->created_at->DiffForHumans() }}</div>
                                    </li>

                                    <li class="py-3">
                                        <div class="text-xs leading-4 text-gray-200">E-Mail</div>
                                        <div class="text-gray-400 text-xs break-all">{{ $user->email }}</div>
                                    </li>

                                    <li class="py-3">
                                        <div class="text-xs leading-4 text-gray-200">Telefonnummer</div>
                                        <div class="text-gray-400 text-xs break-all">{{ $user->survey_data->telefonnummer }}</div>
                                    </li>

                                    
                                    @if(isset($user->survey_data->faecher))
                                    <li class="py-3">
                                        <div class="text-xs leading-4 text-gray-200">Fächer</div>
                                        <div class="text-gray-400 text-xs break-all">{{ $user->survey_data->faecher }}</div>
                                    </li>
                                    @endif
                                    @foreach($user->getRoleNames() as $v)
                                    @if($v == 'Stud')
                                    <li class="py-3">
                                        <div class="text-xs leading-4 text-gray-200">Fachsemester</div>
                                        <div class="text-gray-400 text-xs">{{ $user->survey_data->fachsemester }}</div>
                                    </li>
                                    @endif
                                    @endforeach

                                </ul>

                                <div class="mt-4 flex justify-center">

                                    <!-- Anfragen -->

                                    @if($user->id != Auth::id())
                                    <!-- <form action="{{ route('messages.store') }}" method="post"> -->
                                    <form action="/messages/create/{{ $user->id }}">

                                        {{ csrf_field() }}

                                        <input class="py-2 px-3 bg-gray-100 border-1 w-full rounded-sm form-control form-input" placeholder="Ihr Betreff." value="Neuer Chat über Profilanfrage" name="subject" type="hidden">

                                        <textarea name="message" placeholder="Ihre Nachricht." style="display:none;">Hallo, ich schreibe Ihnen über Ihr Profil. Das ist eine automatisierte Systemnachricht.</textarea>

                                        <div class="checkbox">

                                            <input name="recipients[]" value="{{ $user->id }}" type="hidden">

                                        </div>

                                        <div class="form-group">

                                            <button type="submit" class="py-2 px-2 rounded-full bg-gray-700 text-white hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300 text-sm flex focus:outline-none mx-1 transition ease-in-out duration-150 has-tooltip">

                                                <div class="grid justify-items-center">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                                        <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                                    </svg>

                                                    <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Nachricht schreiben</span>

                                                </div>

                                            </button>

                                        </div>

                                    </form>

                                    @endif

                                    <!-- Anfragen -->

                                    <!-- E-Mail -->

                                    <a href="mailto:{{  $user->email }}" class="py-2 px-2 rounded-full bg-gray-700 text-white hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300 text-sm flex focus:outline-none mx-1 transition ease-in-out duration-150 has-tooltip">

                                        <div class="grid justify-items-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>

                                            <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>E-Mail schreiben</span>

                                        </div>

                                    </a>

                                    <!-- E-Mail -->

                                </div>

                            </div>

                            <!-- End of profile card -->

                            <div class="my-4"></div>

                        </div>

                        <!-- Right Side -->

                        <script>
                            zutreffend = [
                                {value: 1, text: "Trifft überhaupt nicht zu."},
                                {value: 2, text: "Trifft eher nicht zu."},
                                {value: 3, text: "Teils, teils."},
                                {value: 4, text: "Trifft eher zu."},
                                {value: 5, text: "Trifft voll und ganz zu."}
                            ];
                            feedback = [
                                {value: 1, text: "ist sehr behutsam."},
                                {value: 2, text: "ist eher behutsam."},
                                {value: 3, text: "ist manchmal behutsam, manchmal direkt."},
                                {value: 4, text: "ist eher direkt."},
                                {value: 5, text: "ist sehr direkt."}
                                ];
                            freiraum = [
                                {value: 1, text: "mir eher Freiraum für eigene Ideen und Entscheidungen lässt."},
                                {value: 2, text: "mir teils Freiraum lässt, teils klare Anweisungen gibt."},
                                {value: 3, text: "mir eher klare Anweisungen gibt."}
                            ];        
                        </script>


                        <div class="w-full md:w-9/12 mr-2 gap-4 bg-gray-700">

                            <!-- Profile tab -->

                            <div class="px-3 py-2">

                                <!-- Schule -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Lehr')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                        Name und Adresse der Schule

                                    </dt>

                                    <dd class="text-gray-400 text-sm">

                                        {{ $user->survey_data->schulname }}<br>
                                        {{ $user->survey_data->strasse }} {{ $user->survey_data->hausnummer }}<br>
                                        {{ $user->survey_data->postleitzahl }} {{ $user->survey_data->ort }}<br>
                                        {{ $user->survey_data->landkreis }} (Landkreis)

                                    </dd>

                                </div>
                                @elseif($v == 'Stud' && isset($user->survey_data->ehem_schulname))
                                <div class="py-3">

                                <dt class="text-gray-200 text-sm">

                                        Ehemalige Schule:

                                </dt>

                                <dd class="text-gray-500 text-sm">

                                    {{ $user->survey_data->ehem_schulname }}<br>
                                    {{ $user->survey_data->ehem_schulort }}

                                </dd>

                                </div>
                                @endif
                                @endforeach
                                <!-- Schule -->


                                <!-- religionslehre -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Stud' && isset($user->survey_data->religionslehre))
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Studieren Sie das Didaktikfach ev./kath. Religionslehre?:<br> 
                                    <p id="religionslehre" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('religionslehre').innerHTML = '{{ $user->survey_data->religionslehre }}';
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- religionslehre -->


                                <!-- landkreise -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Stud' && isset($user->survey_data->landkreise))
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ich kann die Lehr:werkstatt in folgenden Landkreisen ableisten:<br> 
                                    <p id="landkreise" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('landkreise').innerHTML = '{{ $user->survey_data->landkreise }}';
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- landkreise -->


                                <!-- verkehrsmittel -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Stud' && isset($user->survey_data->verkehrsmittel))
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Mir stehen folgende Verkehrsmittel zur Verfügung:<br> 
                                    <p id="verkehrsmittel" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('verkehrsmittel').innerHTML = '{{ $user->survey_data->verkehrsmittel }}';
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- verkehrsmittel -->


                                <!-- feedback_an -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Lehr')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Das Feedback, das ich meinem Lehr:werker bzw. meiner Lehr:werkerin gebe,:<br> 
                                    <p id="feedback_an" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('feedback_an').innerHTML = feedback[{{ $user->survey_data->feedback_an }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @elseif($v == 'Stud')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Beim Feedback, das ich meinem Lehr:mentor bzw. meiner Lehr:mentorin gebe, sage ich ganz direkt, was ich von seinem bzw. ihrem Unterricht halte:<br> 
                                    <p id="feedback_an" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('feedback_an').innerHTML = zutreffend[{{ $user->survey_data->feedback_an }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- feedback_an -->


                                <!-- feedback_von -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Lehr')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ich wünsche mir von meinem Lehr:werker bzw. meiner Lehr:werkerin kritische Rückmeldungen zu meinem Unterricht:<br> 
                                    <p id="feedback_von" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('feedback_von').innerHTML = zutreffend[{{ $user->survey_data->feedback_von }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @elseif($v == 'Stud')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Das Feedback, das mir mein*e Lehr:mentor*in geben sollte,:<br> 
                                    <p id="feedback_von" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('feedback_von').innerHTML = feedback[{{ $user->survey_data->feedback_von }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- feedback_von -->


                                <!-- eigenstaendigkeit -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Lehr')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Mein*e Lehr:werker*in soll langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen:<br> 
                                    <p id="eigenstaendigkeit" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('eigenstaendigkeit').innerHTML = zutreffend[{{ $user->survey_data->eigenstaendigkeit }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @elseif($v == 'Stud')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ich möchte langsam ins selbstständige Unterrichten hineinwachsen und nicht von Anfang an Teile des Unterrichts übernehmen:<br> 
                                    <p id="eigenstaendigkeit" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('eigenstaendigkeit').innerHTML = zutreffend[{{ $user->survey_data->eigenstaendigkeit }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- eigenstaendigkeit -->


                                <!-- improvisation -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Lehr' || $v == 'Stud')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Situationen, in denen ich improvisieren muss, versuche ich durch intensive Planung strikt zu vermeiden:<br> 
                                    <p id="improvisation" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('improvisation').innerHTML = zutreffend[{{ $user->survey_data->improvisation }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- improvisation -->


                                <!-- freiraum -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Lehr')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ich wünsche mir eine*n Lehr:werker*in, die bzw. der:<br> 
                                    <p id="freiraum" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('freiraum').innerHTML = freiraum[{{ $user->survey_data->freiraum }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @elseif($v == 'Stud')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ich wünsche mir eine*n Lehr:mentor*in, die bzw. der:<br> 
                                    <p id="freiraum" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('freiraum').innerHTML = freiraum[{{ $user->survey_data->freiraum }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- freiraum -->

                                
                                <!-- innovationsoffenheit -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Lehr')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ich möchte lieber meine Erfahrungen an den bzw. die Lehr:werker*in weitergeben als gemeinsam mit ihm bzw. ihr Neues auszuprobieren:<br> 
                                    <p id="innovationsoffenheit" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('innovationsoffenheit').innerHTML = zutreffend[{{ $user->survey_data->innovationsoffenheit }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @elseif($v == 'Stud')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ein großer Erfahrungsschatz ist mir bei meinem Lehr:mentor bzw. meiner Lehr:mentorin wichtiger als die Neigung, Neues auszuprobieren:<br> 
                                    <p id="innovationsoffenheit" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('innovationsoffenheit').innerHTML = zutreffend[{{ $user->survey_data->innovationsoffenheit }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- innovationsoffenheit -->


                                <!-- belastbarkeit -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Lehr')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ich wünsche mir eine*n Lehr:werker*in, die bzw. der sich das Unterrichten in schwierigen bzw. höheren Klassen zutraut:<br> 
                                    <p id="belastbarkeit" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('belastbarkeit').innerHTML = zutreffend[{{ $user->survey_data->belastbarkeit }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @elseif($v == 'Stud')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ich traue mir zu, mit meinem Lehr:mentor bzw. meiner Lehr:mentorin in „schwierigen“ oder höheren Klassen zu unterrichten:<br> 
                                    <p id="belastbarkeit" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('belastbarkeit').innerHTML = zutreffend[{{ $user->survey_data->belastbarkeit }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- belastbarkeit -->


                                <!-- berufserfahrung -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Lehr')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Meine Berufserfahrung: Ich bin Lehrer*in seit:<br> 
                                    <p id="berufserfahrung" class="text-gray-400"></p>
                                    <script>
                                        berufserfahrung = [
                                            {value: 1, text: "maximal einem Jahr."},
                                            {value: 2, text: "mehr als einem Jahr und maximal 3 Jahren."},
                                            {value: 3, text: "mehr als drei Jahren und maximal 10 Jahren."},
                                            {value: 4, text: "mehr als 10 Jahren."},
                                        ]
                                        document.getElementById('berufserfahrung').innerHTML = berufserfahrung[{{ $user->survey_data->berufserfahrung }} - 1]['text'];
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- berufserfahrung -->


                                <!-- praktika -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Stud')
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Welche(s) der folgenden Praktika haben Sie im Rahmen Ihres Lehramtsstudiums bereits absolviert?:<br> 
                                    <p id="praktika" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('praktika').innerHTML = '{{ $user->survey_data->praktika }}';
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- praktika -->


                                <!-- freue_auf -->
                                @foreach($user->getRoleNames() as $v)
                                @if( ($v == 'Lehr' || $v == 'Stud') && isset($user->survey_data->freue_auf))
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Ich freue mich im Rahmen der Lehr:werkstatt besonders auf:<br> 
                                    <p id="freue_auf" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('freue_auf').innerHTML = '{{ $user->survey_data->freue_auf }}';
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- freue_auf -->


                                <!-- anmerkungen -->
                                @foreach($user->getRoleNames() as $v)
                                @if($v == 'Stud' && isset($user->survey_data->anmerkungen))
                                <div class="py-3">

                                    <dt class="text-gray-200 text-sm">

                                    Haben Sie sonstige Anmerkungen zu Ihrer Bewerbung?:<br> 
                                    <p id="anmerkungen" class="text-gray-400"></p>
                                    <script>
                                        document.getElementById('anmerkungen').innerHTML = '{{ $user->survey_data->anmerkungen }}';
                                    </script>
                                    </dt>

                                </div>
                                @endif
                                @endforeach
                                <!-- anmerkungen -->

                            </div>

                            <!-- End of profile tab -->

                        </div>

                    </div>

                </div>

                <!-- Informationsanzeige -->

            </div>

        </div>

    </div>

</body>

@endsection