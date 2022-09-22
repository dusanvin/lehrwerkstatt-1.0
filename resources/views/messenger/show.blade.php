@extends('layouts.master')

@section('content')

<body>

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

        <!-- Inhalt -->

        <div class="px-3 sm:px-8 py-3 sm:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

            <!-- Header -->

            <div class="overflow-hidden sm:rounded-lg">

                <div class="">

                    <h2 class="text-lg leading-6 font-medium text-gray-300" style="user-select:none;">

                        <!-- Verlinkung zu Profil des Gegenübers -->

                        @php
                        foreach ($thread->participantsUserIds(Auth::id()) as $user) {

                        if($user != Auth::id()) {
                        $GLOBALS['target_id'] = $user;
                        break;
                        }

                        }
                        @endphp

                        <!-- Verlinkung zu Profil des Gegenübers -->

                        Gesprächsverlauf mit <a href="{{ route('profile.details', ['id' => $GLOBALS['target_id']]) }}" class="text-gray-200 hover:underline">

                            @php

                            if( !empty( $thread->participantsString(Auth::id(), ['vorname']) ) ) {
                            echo $thread->participantsString(Auth::id(),['vorname']) .' '. $thread->participantsString(Auth::id(),['nachname']);
                            }

                            else echo '-';

                            @endphp

                        </a>

                    </h2>

                    <p class="mt-1 text-sm text-gray-400" style="user-select:none;">

                        {{ $thread->subject }}

                    </p>

                </div>

                <!-- Header -->

                <!-- Main -->

                <div class="px-1 py-2 pb mx-auto mt-6 rounded-md">

                    <!-- Nachrichten -->

                    @foreach ($thread->messages as $message)

                    <div class="mb-4 block">

                        <!-- Wenn Nutzer == Creator der Nachricht -->

                        @if( Auth::id() == $message->user_id )

                        <div class="flex flex-row-reverse">

                            <div class="ml-0 sm:ml-2 md:ml-4 lg:ml-8 px-4 py-4 flex rounded-tl-2xl rounded-bl-2xl rounded-br-2xl text-gray-200 text-sm bg-gray-700">

                                @include('messenger.partials.messages', $message)

                            </div>

                        </div>

                        <!-- Wenn Nutzer == Creator der Nachricht -->

                        <!-- Wenn Nutzer != Creator der Nachricht -->

                        @elseif ( Auth::id() != $message->user_id )

                        <div class="flex">

                            <div class="mr-0 sm:mr-2 md:mr-4 lg:mr-8 px-4 py-4 flex rounded-bl-2xl rounded-br-2xl rounded-tr-2xl text-gray-100 text-sm bg-gray-700">

                                @include('messenger.partials.messages', $message)

                            </div>

                        </div>

                        <!-- Wenn Nutzer != Creator der Nachricht -->

                        @endif

                    </div>

                    @endforeach

                    <!-- Nachrichten -->

                    <!-- Nachricht schreiben -->

                    @include('messenger.partials.form-message')

                    <!-- Nachricht schreiben -->

                </div>

                <!-- Main -->

            </div>

        </div>

        <!-- Inhalt -->

    </div>

</body>

@endsection