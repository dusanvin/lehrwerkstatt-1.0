@extends('layouts.app')


@section('content')

<body style="background-color: white;">

    <div class="flex flex-row h-full mx-5 mt-10 mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <div class="px-8 py-8 text-gray-700 w-screen bg-white rounded-r-lg shadow-b border-b border-gray-200" style="background-color: #EDF2F7;">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">


                <div class="px-4 py-5 sm:px-6">

                    <h2 class="text-lg leading-6 font-medium text-gray-900">

                        Öffentliches Profil

                    </h2>

                    <!-- <p class="mt-1 text-sm text-gray-500">

                        Betrachten Sie die Informationen zu Ihrer Person. Die Daten sind öffentlich einsehbar.

                    </p> -->

                </div>

                <!-- Informationsanzeige -->

                <div>

                    <dl>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Vorname</strong> der Person

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->vorname }}

                            </dd>

                        </div>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Nachname</strong> der Person

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->nachname }}

                            </dd>

                        </div>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>E-Mail-Adresse</strong> der Person

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->email }}

                            </dd>

                        </div>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Rolle/n</strong> der Person

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                <div class="form-group">

                                    @if(!empty($user->getRoleNames()))

                                    @foreach($user->getRoleNames() as $v)

                                    <label class="badge badge-success">{{ $v }}</label>

                                    @endforeach

                                    @endif

                                </div>

                            </dd>

                        </div>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Registrierungsdatum</strong> der Person

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->created_at->DiffForHumans() }}

                            </dd>

                        </div>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Letzter Login</strong> der Person

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                @if($user->last_login_at === NULL)
                                -
                                @else

                                {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}

                                @endif

                            </dd>

                        </div>

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

                                <strong>Studiengang</strong>

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->studiengang }}

                            </dd>

                        </div>

                        <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                            <dt class="text-sm font-medium text-gray-500 py-2">

                                <strong>Fachsemester</strong>

                            </dt>

                            <dd class="mt-1 text-sm text-gray-500 text-white sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                {{ $user->fachsemester }}

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