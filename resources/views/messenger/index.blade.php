@extends('layouts.master')

@section('content')

	<body>

	    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

	        <!-- Nav -->

	        @include('layouts.navigation')

	        <!-- Nav -->

	        <!-- Inhalt -->

			<div class="px-1 md:px-8 py-8 md:py-8 text-gray-700 w-screen rounded-r-lg" style="background-color: #EDF2F7;">

                <div class="overflow-hidden sm:rounded-lg">

                    <div class="grid justify-items-center sm:justify-items-start select-none">

                        <h2 class="text-lg leading-6 font-medium text-gray-900">

                            Nachrichten

                        </h2>

                        <p class="mt-1 text-sm text-gray-500 grid text-center sm:text-left">

                            Gespräche zum Informationsaustausch. Schreiben Sie einer Person, wenn Ihnen ein Angebot oder ein Bedarf zusagt.

                        </p>

                    </div>

                    <!-- Fehlermeldung -->

                    <div class="py-4 mx-auto mt-0 md:mt-6 rounded-md">

                    	<div class="grid justify-items-center md:justify-items-end">

					        <div class="float-right mb-8 mt-4">

			                    <a href="/messages/create" class="bg-transparent bg-purple-600 hover:bg-purple-800 text-white text-xs font-semibold py-2 px-4 uppercase tracking-wide border border-purple-600 hover:border-transparent rounded focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 flex items-center transition ease-in-out duration-150 disabled:opacity-25">

			                        <div class="">

			                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>

			                        </div>

			                        <div class="pl-3">

			                            <span class="text-xs">Neue Nachricht</span>

			                        </div>

			                    </a>

			                </div>

			            </div>

		                @include('messenger.partials.flash')

		                <!-- Zeige alle Threads als Schleife oder Keinen Thread -->

		                <div>
		                	
			                @if ($threads_counter > 1)

								<p class="uppercase text-gray-400 pl-4 py-0 sm:py-4 select-none text-sm text-center sm:text-left">{{ $threads_counter }} Unterhaltungen</p>

							@endif

						</div>

						<div class="bg-white rounded-md pt-4">

			           		@each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')

		                </div>


	           		</div>

	            </div>

	            <!-- Seitenanzeige -->

	            <div class="mt-5">

	                {{ $threads->links() }}

	            </div>
	            
	            <!-- Seitenanzeige -->

	        </div>


	        <!-- Inhalt -->
	        
	    </div>

	</body>

@endsection






