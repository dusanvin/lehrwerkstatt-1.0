@extends('layouts.app')


@section('content')

<body style="">

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Inhalt -->

        <div class="px-1 md:px-8 py-8 md:py-8 text-gray-700 w-screen sm:rounded-r-lg" style="background-color: #EDF2F7;">

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
                                    
                                    <h2 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $user->vorname }} {{ $user->nachname }}</h2>

                                    <p class="text-gray-600 font-lg text-semibold text-xs">

                                        @if(!empty($user->getRoleNames()))

                                            @foreach($user->getRoleNames() as $v)

                                                <label class="badge badge-success">{{ $v }}</label>

                                            @endforeach

                                        @endif

                                    </p>

                                    <p class="text-sm text-gray-500 mt-2 select-none mb-6">

                                        @if($user->gruesse === NULL)
                                            
                                            Es sind keine Profilgruesse hinterlegt.

                                        @else

                                            {{ $user->gruesse }}

                                        @endif

                                    </p>

                                </div>                                

                                <ul class="bg-white text-gray-600 py-2 px-3 mt-3 divide-y rounded text-sm">

                                    <li class="py-3">
                                        <div class="text-teal-600">Letzte Anmeldung</div>
                                        <div class="text-gray-500 text-xs">
                                            @if($user->last_login_at === NULL)
                                                -
                                            @else

                                                {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}

                                            @endif
                                        </div>
                                    </li>
                                    
                                    <li class="py-3">
                                        <div class="text-teal-600">Registrierung</div>
                                        <div class="text-gray-500 text-xs">{{ $user->created_at->DiffForHumans() }}</div>
                                    </li>

                                    <li class="py-3">
                                        <div class="text-teal-600">E-Mail</div>
                                        <div class="text-gray-500 text-xs break-all">{{ $user->email }}</div>
                                    </li>

                                    <li class="py-3">
                                        <div class="text-teal-600">Studiengang</div>
                                        <div class="text-gray-500 text-xs">{{ $user->studiengang }}</div>
                                    </li>
                                    <li class="py-3">
                                        <div class="text-teal-600">Fachsemester</div>
                                        <div class="text-gray-500 text-xs">{{ $user->fachsemester }}</div>
                                    </li>

                                </ul>
                                
                                <div class="mt-4 flex justify-center">

                                <!-- Anfragen -->

                                    @if($user->id != Auth::id())

                                        <form action="{{ route('messages.store') }}" method="post">

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

                        <div class="w-full md:w-9/12 mr-2 gap-4">

                            <!-- Profile tab -->

                            <div class="px-3 py-2">

                                <!-- Motivation -->
                                
                                <div class="py-3">

                                    <dt class="text-teal-600">

                                        Motivation

                                    </dt>

                                    <dd class="text-gray-500 text-xs">

                                        @if($user->motivation === NULL)
                                                
                                            Es sind keine näheren Angaben zu Motivationsgründen vorhanden.

                                        @else

                                            {{ $user->motivation }}

                                        @endif

                                    </dd>

                                </div>

                                <!-- Motivation -->

                                <!-- Erfahrungen -->

                                <div class="py-3">

                                    <dt class="text-teal-600">

                                        Erfahrungen

                                    </dt>

                                    <dd class="text-gray-500 text-xs">

                                        @if($user->erfahrungen === NULL)
                                                
                                            Es sind keine näheren Angaben zu Erfahrungen vorhanden.

                                        @else

                                            {{ $user->erfahrungen }}

                                        @endif

                                    </dd>

                                </div>

                                <!-- Erfahrungen -->

                                <!-- Interessen -->

                                <div class="py-3">

                                    <dt class="text-teal-600">

                                        Interessen

                                    </dt>

                                    <dd class="text-gray-500 text-xs">

                                        @if($user->interessen === NULL)
                                                
                                            Es sind keine näheren Angaben zu Interessen vorhanden.

                                        @else

                                            {{ $user->interessen }}

                                        @endif

                                    </dd>

                                </div>

                                <!-- Interessen -->

                                <!-- Treffen -->

                                <div class="py-3">

                                    <dt class="text-teal-600">

                                        Möglichkeiten der Zusammenarbeit

                                    </dt>

                                    <dd class="text-gray-500 text-xs">

                                        @if($user->treffen === NULL)
                                                
                                            Es sind keine näheren Angaben zu Möglichkeiten der Zusammenarbeit vorhanden.

                                        @else

                                            {{ $user->treffen }}

                                        @endif

                                    </dd>

                                </div>

                                <!-- Treffen -->

                            </div>

                            <!-- End of profile tab -->

                        </div>

                    </div>

                </div>

                <!-- Informationsanzeige -->

                <!-- Zurück -->

                <div class="block px-2">

                    <div class="mb-4 mt-4 mx-4 float-right">

                        <a href="mailto:{{ $user->email }}" class="bg-transparent hover:bg-green-600 text-green-600 font-semibold text-sm hover:text-white py-2 pr-4 pl-4 border border-green-600 hover:border-transparent focus:outline-none focus:ring ring-green-300 focus:border-green-300 rounded flex items-center transition ease-in-out duration-150">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />

                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />

                            </svg>

                            <div class="pl-3">Kontaktieren</div>

                        </a>

                    </div>

                </div>

                <!-- Zurück -->

            </div>

        </div>

    </div>

</body>

@endsection