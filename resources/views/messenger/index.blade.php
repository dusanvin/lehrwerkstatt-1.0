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

                            Gespräche zum Informationsaustausch mit Personen.

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

		                @include('messenger.partials.flash')

		                <!-- Zeige alle Threads als Schleife oder Keinen Thread -->

		           		@each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')

	           		</div>

	            </div>

	        </div>

	        <!-- Inhalt -->
	        
	    </div>

	</body>

@endsection






