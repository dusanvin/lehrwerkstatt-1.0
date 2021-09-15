@extends('layouts.master')

@section('content')


<body style="background-color: white;">

    <div class="flex flex-row h-full mx-5 mt-10 mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

        <!-- Inhalt -->

        <div class="px-8 py-8 text-gray-700 w-screen bg-white sm:rounded-r-lg" style="background-color: #EDF2F7;">

            <div class="overflow-hidden sm:rounded-lg">

                <div class="px-4 py-5 sm:px-6">

                    <h2 class="text-lg leading-6 font-medium text-gray-900">

                        Nachrichten

                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        Schreiben Sie eine neue Nachricht.

                    </p>

                </div>

                <!-- Fehlermeldung -->

                <div class="px-4 py-4 pb mx-auto mt-6 bg-white rounded-md">

                    <div class="grid justify-items-end">

                        <div class="float-right mb-4 mt-4 mr-4">

                            <a href="/messages/create" class="bg-transparent hover:bg-purple-600 text-purple-600 font-semibold text-sm hover:text-white py-2 px-4 border border-purple-600 hover:border-transparent rounded focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 flex items-center transition ease-in-out duration-150">

                                <div class="">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>

                                </div>

                                <div class="pl-3">

                                    <p class="">Neue Nachricht schreiben</p>

                                </div>

                            </a>

                        </div>

                    </div>

                    <!-- Inhalt 2 -->

                    <form action="{{ route('messages.store') }}" method="post">

                        {{ csrf_field() }}

                        <div class="col-md-6">

                            <!-- Subject Form Input -->


                            <label class="block">

                                <span class="text-gray-700">Betreff</span>

                                <input class="form-input mt-1 block w-full" placeholder="Schreiben Sie einen Betreff" value="{{ old('subject') }}" name="subject">

                            </label>

                            <!-- Message Form Input -->
                            <div class="form-group">

                                <label class="control-label">Message</label>

                                <textarea name="message" class="form-control">{{ old('message') }}</textarea>

                            </div>

                            @if($users->count() > 0)

                                <div class="checkbox">

                                    @foreach($users as $user)

                                        <label title="{{ $user->vorname }} {{ $user->nachname }}" class="block items-center">

                                            <input type="radio" class="form-radio" name="recipients[]" value="{{ $user->id }}">

                                                <span class="ml-2">{{ $user->vorname }} {{ $user->nachname }}</span>

                                        </label>

                                    @endforeach

                                </div>

                            @endif
                    
                            <!-- Submit Form Input -->

                            <div class="px-4 py-4 pb mx-auto mt-6 bg-white rounded-md">

                                <div class="grid justify-items-end">

                                    <div class="float-right mb-4 mt-4 mr-4">

                                        <button type="submit" class="bg-transparent hover:bg-green-600 text-green-600 font-semibold text-sm hover:text-white py-2 px-4 border border-green-600 hover:border-transparent rounded focus:outline-none focus:ring ring-green-300 focus:border-green-300 flex items-center transition ease-in-out duration-150">

                                            <div class="">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                                </svg>

                                            </div>

                                            <div class="pl-3">

                                                <span class="">Nachricht senden</span>

                                            </div>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>

                    <!-- Inhalt 2 -->

                </div>

            </div>

        </div>

    </div>

</body>

@endsection