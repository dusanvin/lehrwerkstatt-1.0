@extends('layouts.app')

@section('content')

<style type="text/css">
    [type="text"],
    [type="email"],
    select,
    [type="password"] {
        border-width: 0 !important;
    }

    [type="text"]:focus,
    [type="email"]:focus,
    select:focus,
    [type="password"]:focus {
        border-width: 0 !important;
        border-color: white !important;
        --tw-ring-color: white !important;
        border-bottom-color: black !important;
    }

    input[type=file]::-webkit-file-upload-button,
    input[type=file]::file-selector-button {
        background: #344955;
        color: white !important;
        font-weight: 400;
        font-size: 0.875rem;
        line-height: 1.25rem;
        cursor: pointer;
        border: none;
        padding-left: 10px !important;
        padding-top: 10px;
        padding-bottom: 10px;
    }
</style>


@php

/* PHP-Interpreter for short_tags */
ini_set('short_open_tag',1);

$valMot = Config::get('site_vars.meinBereichMotivationDetailsPlaceholder');
$valStud = Config::get('site_vars.meinBereichStudiengangPlaceholder');
$valFachsemest = Config::get('site_vars.meinBereichFachsemesterPlaceholder');
$valFrei = Config::get('site_vars.meinBereichFreizeitPlaceholder');
$valErfahrung = Config::get('site_vars.meinBereichErfahrungPlaceholder');
$valTreffen = Config::get('site_vars.meinBereichTreffenPlaceholder');
$valGruesse = Config::get('site_vars.meinBereichGruessePlaceholder');

@endphp

<!-- 
1. Hover über die Buttons oben
2. Wenn kein Bild hochgeladen ist, Ansicht richtigstellen
-->


<body style="background-color: white;">

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

        <!-- Inhalt -->

        <div class="px-1 md:px-8 py-8 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

            <!-- Success Message -->

                    <script>
                        function removemessage() {
                            document.getElementById('success_make_offer').remove();
                        }
                    </script>

                    @if ($message = Session::get('success'))

                    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-600 text-xs sm:text-sm lg:text-lg" id="success_make_offer">

                        <span class="text-xl inline-block mr-2 align-middle">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />

                            </svg>

                        </span>

                        <span class="inline-block align-middle">

                            <b>Aktion erfolgreich ausgeführt.</b>

                        </span>

                        <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="removemessage()">

                            <span>×</span>

                        </button>

                    </div>

                    @endif

                    <!-- Success Message -->

                    <div>

                    <!-- Fehlerbehandlung -->

                    @if (count($errors) > 0)

                    <div class="alert alert-danger">

                        <ul>

                            @foreach ($errors->all() as $error)

                            <li class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-400">

                                <span class="text-xl inline-block mr-2 align-middle">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />

                                    </svg>

                                </span>

                                <span class="inline-block align-middle">

                                    {{ $error }} Bitte löschen Sie zuerst Ihr Profilbild, bevor Sie ein neues hochladen.

                                </span>

                                <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">

                                    <span>×</span>

                                </button>

                            </li>

                            @endforeach

                        </ul>

                    </div>

                    @endif

                    <!-- Fehlerbehandlung -->

            <div class="overflow-hidden mb-4">

                <div class="mb-4">

                    <h2 class="font-semibold text-lg text-gray-200 grid justify-items-center sm:justify-items-start select-none">

                        Accountdaten bearbeiten

                    </h2>

                    <div class="mt-1 text-sm text-gray-300 text-center sm:text-left">

                        Bearbeiten Sie Ihre Accountdaten. Wenden Sie sich bei Fragen zu Ihrem Account an das <a href="mailto:team@digillab.uni-augsburg.de" class="hover:underline">DigiLLab der Universität Augsburg</a>.

                    </div>

                </div>

                <div class="min-width-full block">

                    <!-- Profilbild -->

                    <div class="mt-4 mb-4 bg-gray-800 p-8 rounded-md">

                        <h2 class="font-semibold text-lg text-gray-200 sm:text-left text-center">

                            Profilbild

                        </h2>

                        <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left flex">

                            <p>Hinterlegen Sie ein Profilbild (max. 20MB mit den min. Abmessungen 300x300px), indem Sie eine Bilddatei auswählen und diese anschließend hochladen. Löschen Sie Ihr Profilbild, bevor Sie ein neues auswählen.</p>

                        </div>

                        @if(isset($user->image->filename))

                        <ul class="flex items-center">

                            <li class="">

                                <div class="pr-3">

                                    <div class="text-white flex items-center">

                                        <img src="{{ url('images/show/'.$user->id) }}" class="w-28 rounded-md object-cover border-gray-200">
                                        
                                        <span class="text-xs sm:text-sm font-semibold text-left px-4 break-words">

                                            @if (Auth::user()->vorname)

                                                {{ Auth::user()->vorname}} {{ Auth::user()->nachname }}

                                            @else

                                                Konto <!--{{ Auth::user()->vorname }} {{ Auth::user()->nachname }} -->
                                            
                                            @endif
                                        
                                            <div>

                                                @if(!empty(Auth::user()->role))

                                                    <span class="font-normal text-gray-500 capitalize">{{ Auth::user()->role }}</span>

                                                @endif

                                                <div class="flex mt-4">

                                                    <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data" class="flex items-center">

                                                        @csrf

                                                        <input type="file" name="image" id="file" class="mr-2 block w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:border-transparent text-sm rounded" />

                                                        <button type="submit" class="bg-transparent bg-purple-600 hover:bg-purple-700 text-white font-semibold text-sm py-2 pr-4 pl-3 border border-purple-600 hover:border-transparent focus:outline-none focus:ring ring-purple-600 focus:border-purple-300 rounded flex items-center transition ease-in-out duration-150">

                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-1">
                                                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                                            </svg><!-- Bild hochladen -->

                                                            @php
                                                            cache()->flush();
                                                            @endphp

                                                        </button>

                                                    </form>

                                                    <form method="POST" action="{{ route('images.destroy', ['user_id' => $user->id]) }}" class="flex">

                                                        @csrf

                                                        <button type="submit" class="ml-2 bg-transparent bg-yellow-600 hover:bg-yellow-700 text-white font-semibold text-sm py-2 pr-4 pl-3 border border-yellow-600 hover:border-transparent focus:outline-none focus:ring ring-yellow-600 focus:border-yellow-300 rounded flex items-center transition ease-in-out duration-150">

                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-1">
                                                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg><!-- Bild löschen -->

                                                            @php
                                                            cache()->flush();
                                                            @endphp

                                                        </button>

                                                    </form>

                                                </div>

                                            </div>

                                        </span>

                                    </div>

                                </div>

                            </li>

                        </ul>

                        @else

                        <img src="https://daz-buddies.digillab.uni-augsburg.de/img/avatar.jpg" class="w-32 h-32 rounded-full object-cover border-4 border-white mx-auto">

                        <div>

                            <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">

                                @csrf

                                <input type="file" name="image" id="file" class="mb-4 block w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:border-transparent text-sm rounded" />

                                <button type="submit" class="bg-transparent hover:bg-purple-600 text-purple-600 font-semibold text-sm hover:text-white py-2 pr-4 pl-3 mb-2 border border-purple-600 hover:border-transparent focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 rounded flex items-center transition ease-in-out duration-150">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">

                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />

                                    </svg>Bild hochladen

                                    @php
                                    cache()->flush();
                                    @endphp

                                </button>

                            </form>

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Hinterlegen</strong> Sie ein <strong>Profilbild</strong> (max. 20MB mit den min. Abmessungen 300x300px)

                            </dt>

                        </div>

                        @endif

                    </div>

                    <!-- Profilbild -->

                        <!-- Informationsanzeige sowie -bearbeitung -->

                        {!! Form::model($user, ['method' => 'PATCH','route' => ['profiles.update', $user->id]]) !!}

                        <div class="bg-gray-800 p-8 rounded-md">

                            <h2 class="font-semibold text-lg text-gray-200 sm:text-left text-center">

                            Account

                            </h2>

                            <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left flex">

                                <p>Ändern Sie Ihre E-Mail-Adresse sowie Ihr Passwort.</p>

                            </div>

                            <div class="mb-4">

                                <dt class="text-sm font-semibold text-gray-200 pb-2 sm:text-left text-center">

                                    E-Mail-Adresse bearbeiten

                                </dt>

                                <dd class="bg-gray-700 mt-1 text-sm text-gray-200 text-white hover:text-gray-400 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center pl-3 rounded transition ease-in-out duration-500">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>

                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'bg-gray-700 w-full px-2 py-2 ml-2 focus:outline-none focus:text-gray-400')) !!}

                                </dd>

                            </div>

                            <div class="mb-4">

                                <dt class="text-sm font-semibold text-gray-200 py-2 sm:text-left text-center">

                                    Neues Passwort vergeben

                                </dt>

                                <dd class="bg-gray-700 mt-1 text-sm text-gray-200 text-white hover:text-gray-400 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center pl-3 rounded transition ease-in-out duration-500">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>

                                    {!! Form::password('password', array('placeholder' => 'Passwort','class' => 'bg-gray-700 w-full px-2 py-2 ml-2 focus:outline-none focus:text-gray-400')) !!}

                                </dd>

                            </div>

                            <div class="mb-4">

                                <dt class="text-sm font-semibold text-gray-200 py-2 sm:text-left text-center">

                                    Neues Passwort bestätigen

                                </dt>

                                <dd class="bg-gray-700 mt-1 text-sm text-gray-200 text-white hover:text-gray-400 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center pl-3 rounded transition ease-in-out duration-500">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                    </svg>

                                    {!! Form::password('confirm-password', array('placeholder' => 'Passwort bestätigen','class' => 'bg-gray-700 w-full px-2 py-2 ml-2 focus:outline-none focus:text-gray-400')) !!}

                                </dd>

                            </div>
<!-- Zurück oder Bestätigen -->

                            <div class="flex justify-between space-x-3 mb-4">

                                <div class="mt-4 inline-flex flex-wrap">

                                    <a href="{{ route('profile.account') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-yellow-700 hover:border-transparent focus:outline-none focus:ring ring-yellow-300 focus:border-yellow-300 rounded flex items-center transition ease-in-out duration-150">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>

                                        <p class="pl-3">Abbrechen</p>

                                    </a>

                                </div>

                                <div class="mt-4 inline-flex flex-wrap">

                                    <button type="submit" class="bg-green-600 bg-transparent hover:bg-green-700 text-white font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-green-700 hover:border-transparent focus:outline-none focus:ring ring-green-300 focus:border-green-300 rounded flex items-center transition ease-in-out duration-150">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="pl-3">Bestätigen</span>

                                    </button>

                                </div>

                            </div>

                            <!-- Zurück oder Bestätigen -->

                            {!! Form::close() !!}


                        </div>

                    </div>

                    <!-- Informationsanzeige sowie -bearbeitung -->

                    

                </div>

            </div>

            

        </div>

    </div>

</body>

@endsection