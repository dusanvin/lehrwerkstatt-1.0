@extends('layouts.app')


@section('content')

<body style="">

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Inhalt -->

        <div class="px-1 md:px-8 py-8 md:py-8 text-gray-700 w-screen sm:rounded-r-lg" style="background-color: #EDF2F7;">

            <div class="overflow-hidden sm:rounded-lg mb-4">


                <div class="px-4 py-5 sm:px-6">

                    <h2 class="text-lg leading-6 font-medium text-gray-900">

                        Öffentliches Profil

                    </h2>

                    <!-- <p class="mt-1 text-sm text-gray-500">

                        Betrachten Sie die Informationen zu Ihrer Person. Die Daten sind öffentlich einsehbar.

                    </p> -->

                </div>

                <!-- Informationsanzeige -->

                <!-- Inof neu -->

                <div class="container px-2 sm:px-4">

                    <div class="md:flex no-wrap md:-mx-2 ">

                        <!-- Left Side -->

                        <div class="w-full md:w-3/12 md:mx-2">

                            <!-- Profile Card -->

                            <div class="p-3 select-none">

                                <div class="image overflow-hidden">

                                    <img class="h-auto w-full mx-auto" src="http://hosted-024-216.rz.uni-augsburg.de/img/avatar.jpg" alt="">

                                </div>

                                <h2 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $user->vorname }} {{ $user->nachname }}</h2>
                                <h2 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $user->id }}</h2>

                                <p class="text-gray-600 font-lg text-semibold text-xs">

                                        @if(!empty($user->getRoleNames()))

                                        @foreach($user->getRoleNames() as $v)

                                            <label class="badge badge-success">{{ $v }}</label>

                                        @endforeach

                                    @endif

                                </p>

                                <p class="text-sm text-gray-500 mt-2 select-none">

                                    @if($user->motivation === NULL)
                                        
                                        Es sind keine näheren Angaben zu Motivationsgründen vorhanden.

                                    @else

                                        {{ $user->motivation }}

                                    @endif

                                </p>

                                <ul class="bg-white text-gray-600 py-2 px-3 mt-3 divide-y rounded text-sm">

                                    <li class="flex items-center py-3">

                                        <span>Status</span>

                                        <span class="ml-auto">

                                            <span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Aktiv</span>

                                        </span>

                                    </li>

                                    <li class="flex items-center py-3">
                                        <span>Letzte Anmeldung</span>
                                        <span class="ml-auto">
                                            @if($user->last_login_at === NULL)
                                                -
                                            @else

                                                {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}

                                            @endif
                                        </span>
                                    </li>
                                    
                                    <li class="flex items-center py-3">
                                        <span>Registrierung</span>
                                        <span class="ml-auto">{{ $user->created_at->DiffForHumans() }}</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- End of profile card -->
                            <div class="my-4"></div>
                            
                        </div>
                        <!-- Right Side -->
                        <div class="w-full md:w-9/12 mx-2">
                            <!-- Profile tab -->
                            <!-- Experience and education -->
                            <div class="bg-white rounded rounded-sm px-3 py-2">

                                <div class="grid grid-cols-1 sm:grid-cols-2">
                                    <div>
                                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 my-3 mr-2">
                                            <span>
                                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </span>
                                            <span class="tracking-wide">Generelles</span>
                                        </div>
                                        <ul class="list-inside space-y-2">
                                            <li>
                                                <div class="text-teal-600">Vorname</div>
                                                <div class="text-gray-500 text-xs">{{ $user->vorname }}</div>
                                            </li>
                                            <li>
                                                <div class="text-teal-600">Nachname</div>
                                                <div class="text-gray-500 text-xs">{{ $user->nachname }}</div>
                                            </li>
                                            <li>
                                                <div class="text-teal-600">E-Mail</div>
                                                <div class="text-gray-500 text-xs">{{ $user->email }}</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 my-3">
                                            <span clas="text-green-500">
                                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                                    <path fill="#fff"
                                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                                </svg>
                                            </span>
                                            <span class="tracking-wide">Bildung</span>
                                        </div>
                                        <ul class="list-inside space-y-2">
                                            <li>
                                                <div class="text-teal-600">Studiengang</div>
                                                <div class="text-gray-500 text-xs">{{ $user->studiengang }}</div>
                                            </li>
                                            <li>
                                                <div class="text-teal-600">Fachsemester</div>
                                                <div class="text-gray-500 text-xs">{{ $user->fachsemester }}</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End of Experience and education grid -->
                            <div class="my-4"></div>

                            
                            </div>
                            <!-- End of profile tab -->
                        </div>
                    </div>
                </div>




                <!-- Inof neu -->

                <div>

                    <dl>

                        

                        

                        

                        

                        

                        

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Motivation</strong>

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->motivation }}

                            </dd>

                        </div>

                        

                        

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Interessen</strong>

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->interessen }}

                            </dd>

                        </div>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Erfahrungen</strong>

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->erfahrungen }}

                            </dd>

                        </div>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Treffen</strong>

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->treffen }}

                            </dd>

                        </div>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Grüße</strong>

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->gruesse }}

                            </dd>

                        </div>

                    </dl>

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