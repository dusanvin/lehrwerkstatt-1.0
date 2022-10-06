@extends('layouts.master')

@section('content')


<body class="bg-gray-500">

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

        <style type="text/css">
            input::placeholder {
                color: white !important;
            }
        </style>

        <div class="px-1 md:px-8 py-1 md:py-8 text-gray-200 w-screen rounded-r-lg bg-gray-900">

            <div class="overflow-hidden sm:rounded-lg">

                <div class="">

                    <h2 class="text-lg leading-6 font-medium text-white">

                        Nachrichten

                    </h2>

                    <p class="mt-1 text-sm text-gray-400">

                        Schreiben Sie eine neue Nachricht.

                    </p>

                </div>

                <!-- Fehlermeldung -->

                <div class="px-4 py-4 pb mx-auto mt-6 bg-gray-700 rounded-md">

                    <!-- Inhalt 2 -->

                    <form action="{{ route('messages.store') }}" method="post">

                        {{ csrf_field() }}

                        <div class="col-md-6">

                            <div class="py-2 px-3 text-white border border-gray-500 bg-gray-500 border-1 w-full rounded-sm form-control form-input focus:ring-2 focus:ring-gray-200 focus:border-transparent">
                                EmpfängerIn: {{ $users[0]->vorname }} {{ $users[0]->nachname }}
                            </div>

                            <!-- Subject Form Input -->

                            <div class="mt-1">

                                <label class="block sr-only">Ihr Betreff.</label>

                                <input class="py-2 px-3 text-white border border-gray-500 bg-gray-500 border-1 w-full rounded-sm form-control form-input focus:ring-2 focus:ring-gray-200 focus:border-transparent" placeholder="Ihr Betreff." value="{{ old('subject') }}" name="subject">

                            </div>

                            <!-- Message Form Input -->

                            <div class="mt-1">

                                <label class="block sr-only text-white">Ihre Nachricht.</label>

                                <textarea name="message" cols="30" rows="8" class="py-2 px-3 bg-gray-500 text-white border-1 border-gray-500 w-full rounded-sm form-control focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-transparent" placeholder="Ihre Nachricht.">{{ old('message') }}</textarea>

                            </div>

                            <!-- Zurück -->

                            <div class="grid sm:flex sm:justify-between mb-4 mt-4 justify-center">

                                <div class="flex my-1 justify-center">

                                    <a href="{{ route('profile.matchings') }}" class="bg-transparent bg-purple-600 hover:bg-purple-800 text-white text-xs font-semibold py-2 px-4 uppercase tracking-wide border border-purple-600 hover:border-transparent rounded focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 flex items-center justify-center transition ease-in-out duration-150 disabled:opacity-25">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-none " viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
                                        </svg>

                                        <p class="pl-3">

                                            <span class="">Zurück</span>

                                        </p>

                                    </a>

                                </div>

                                <div class="my-1 justify-center">

                                    <button type="submit" class="bg-yellow-600 bg-transparent hover:bg-yellow-700 text-white font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-yellow-700 hover:border-transparent focus:outline-none focus:ring ring-yellow-300 focus:border-yellow-300 rounded flex items-center transition-colors duration-200 transform duration-150 hover:scale-105">

                                        <div class="">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                            </svg>

                                        </div>

                                        <div class="pl-3">

                                            <span class="font-semibold">Senden</span>

                                        </div>

                                    </button>

                                </div>

                            </div>

                        </div>

                        <input id="receiver" type="hidden" name="user_id" value="{{ $users[0]->id }}"></input>

                        <!-- Zurück -->

                    </div>

                </form>

                <!-- Inhalt 2 -->

            </div>

        </div>


    </div>

    </div>

</body>

@endsection