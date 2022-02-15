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


<body style="background-color: white;">

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg" style="background-color: #EDF2F7;">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">

                <div class="px-4 py-5 sm:px-6">

                    <h2 class="text-lg leading-6 font-medium text-gray-900">

                        Meine Daten bearbeiten

                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        {{ Config::get('site_vars.meinBereichMotivation') }} Ihr Profil ist <a href="{{ route('profile.details', ['id' => $user->id]) }}" style="color:blue;">hier</a> öffentlich einsehbar.

                    </p>

                </div>

                <div class="min-width-full block">

                    <!-- @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                    @endif -->

                    <!-- Success Message -->

                    <script>
                        function removemessage() {
                            document.getElementById('success_make_offer').remove();
                        }
                    </script>

                    @if ($message = Session::get('success'))

                    <div class="text-white px-6 mx-6 py-4 border-0 rounded relative mb-4 bg-green-600 text-xs sm:text-sm lg:text-lg" id="success_make_offer">

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

                                            {{ $error }}

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

                        <!-- Informationsanzeige sowie -bearbeitung -->

                        {!! Form::model($user, ['method' => 'PATCH','route' => ['profiles.update', $user->id]]) !!}

                        <div>

                            <dl>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        Bearbeiten Sie den <strong>Vornamen</strong>

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::text('vorname', null, array('placeholder' => 'Vorname','class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        Bearbeiten Sie den <strong>Nachnamen</strong>

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::text('nachname', null, array('placeholder' => 'Nachname','class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        Bearbeiten Sie die <strong>E-Mail-Adresse</strong>

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        Vergeben Sie ein neues <strong>Passwort</strong>

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::password('password', array('placeholder' => 'Passwort','class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 mb-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        <strong>Bestätigen</strong> Sie das <strong>neue Passwort</strong>

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::password('confirm-password', array('placeholder' => 'Passwort bestätigen','class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <!-- Profilbild -->

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 mb-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        <strong>Hinterlegen</strong> Sie ein <strong>Profilbild</strong> (max. 20MB)

                                    </dt>

                                    @if(isset($user->image->filename))              

                                        <img src="{{ url('images/show/'.$user->id) }}">

                                        <div>

                                            <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">

                                                @csrf

                                                <input type="file" name="image" id="file" class="mb-4"/>

                                                <button type="submit" class="bg-transparent hover:bg-purple-600 text-purple-600 font-semibold text-sm hover:text-white py-2 pr-4 pl-3 mb-2 border border-purple-600 hover:border-transparent focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 rounded flex items-center transition ease-in-out duration-150">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                                        
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    
                                                    </svg>Bild hochladen

                                                </button>

                                            </form>

                                            <form method="POST" action="{{ route('images.destroy', ['user_id' => $user->id]) }}">

                                                @csrf

                                                <button type="submit" class="bg-transparent hover:bg-yellow-600 text-yellow-600 font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-yellow-600 hover:border-transparent focus:outline-none focus:ring ring-yellow-300 focus:border-yellow-300 rounded flex items-center transition ease-in-out duration-150">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                                        
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />

                                                    </svg>Bild löschen

                                                </button>

                                            </form>

                                        </div>

                                    @else

                                        <div>

                                            <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">

                                                @csrf

                                                <input type="file" name="image" id="file" class="mb-4"/>

                                                <button type="submit" class="bg-transparent hover:bg-purple-600 text-purple-600 font-semibold text-sm hover:text-white py-2 pr-4 pl-3 mb-2 border border-purple-600 hover:border-transparent focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 rounded flex items-center transition ease-in-out duration-150">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                                        
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    
                                                    </svg>Bild hochladen

                                                </button>

                                            </form>

                                        </div>

                                    @endif

                                </div>

                                <!-- Profilbild -->

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        {{ Config::get('site_vars.meinBereichMotivationDetails') }}

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::text('motivation', null, array('placeholder' => "$valMot",'class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        {{ Config::get('site_vars.meinBereichStudiengang') }}

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        <!-- {!! Form::text('studiengang', null, array('placeholder' => "$valStud",'class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}  -->
                                        {!! Form::select('studiengang', array(
                                        'Hauptfach Deutsch als Zweit- und Fremdsprache (B.A.)' => 'Hauptfach Deutsch als Zweit- und Fremdsprache (B.A.)',
                                        'Nebenfach Deutsch als Zweit- und Fremdsprache (B.A.)' => 'Nebenfach Deutsch als Zweit- und Fremdsprache (B.A.)',
                                        'Grundschule (LA)' => 'Grundschule (LA)',
                                        'Mittelschule (LA)' => 'Mittelschule (LA)',
                                        'Realschule (LA)' => 'Realschule (LA)',
                                        'Gymnasium (LA)' => 'Gymnasium (LA)',
                                        'Sonstiges' => 'Sonstiges'
                                        ),
                                        null, array('class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500'))
                                        !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        {{ Config::get('site_vars.meinBereichFachsemester') }}

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        <!-- {!! Form::text('fachsemester', null, array('placeholder' => "$valFachsemest",'class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}  -->
                                        {!! Form::selectRange('fachsemester', 1, 12, null, array('class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        {{ Config::get('site_vars.meinBereichFreizeit') }}

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::text('interessen', null, array('placeholder' => "$valFrei",'class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        {{ Config::get('site_vars.meinBereichErfahrung') }}

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::text('erfahrungen', null, array('placeholder' => "$valErfahrung",'class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        {{ Config::get('site_vars.meinBereichTreffen') }}

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::text('treffen', null, array('placeholder' => "$valTreffen",'class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                        {{ Config::get('site_vars.meinBereichGruesse') }}

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::text('gruesse', null, array('placeholder' => "$valGruesse",'class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>



                            </dl>

                        </div>

                    </div>

                    <!-- Informationsanzeige sowie -bearbeitung -->

                    <!-- Zurück oder Bestätigen -->

                    <div class="block mx-2">

                        <div class="mb-4 mt-4 mx-4 float-left">

                            <a href="{{ route('profile.edit') }}" class="bg-transparent hover:bg-purple-600 text-purple-600 font-semibold text-sm hover:text-white focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 py-2 pr-4 pl-3 border border-purple-600 hover:border-transparent rounded flex items-center transition ease-in-out duration-150">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>

                                <p class="pl-3">Abbrechen</p>

                            </a>

                        </div>

                        <div class="mb-4 mt-4 mx-4 float-right">

                            <button type="submit" class="bg-transparent hover:bg-green-600 text-green-600 font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-green-600 hover:border-transparent focus:outline-none focus:ring ring-green-300 focus:border-green-300 rounded flex items-center transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">

                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />

                                </svg>Änderungen bestätigen

                            </button>

                        </div>

                    </div>

                    <!-- Zurück oder Bestätigen -->

                    {!! Form::close() !!}

                </div>

            </div>

        </div>

    </div>

</body>

@endsection