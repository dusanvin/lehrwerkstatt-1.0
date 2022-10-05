<link rel="icon" href="{{ url('img/favicon.png') }}">
<link rel="stylesheet" type="text/css" href="/css/styledigi.css">


<!-- Nav -->

<nav class="p-3 flex justify-between max-w-7xl mx-auto">

	@auth

	<!-- Home Link -->

	<ul class="flex items-center">

		<li class="p-1 md:p-3 text-gray-700 hover:text-gray-900 transition-colors duration-200 transform duration-150 hover:scale-105">

			<!-- Logo -->

			<a href="{{ route('profile.edit') }}">

				

					<div class="flex items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-7 w-7 fill-current text-yellow-600 flex-shrink-0"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 288c0 35.35-21.49 64-48 64c-32.43 0-31.72-32-55.64-32C394.9 320 384 330.9 384 344.4V480c0 17.67-14.33 32-32 32h-71.64C266.9 512 256 501.1 256 487.6C256 463.1 288 464.4 288 432c0-26.51-28.65-48-64-48s-64 21.49-64 48c0 32.43 32 31.72 32 55.64C192 501.1 181.1 512 167.6 512H32c-17.67 0-32-14.33-32-32v-135.6C0 330.9 10.91 320 24.36 320C48.05 320 47.6 352 80 352C106.5 352 128 323.3 128 288S106.5 223.1 80 223.1c-32.43 0-31.72 32-55.64 32C10.91 255.1 0 245.1 0 231.6v-71.64c0-17.67 14.33-31.1 32-31.1h135.6C181.1 127.1 192 117.1 192 103.6c0-23.69-32-23.24-32-55.64c0-26.51 28.65-47.1 64-47.1s64 21.49 64 47.1c0 32.43-32 31.72-32 55.64c0 13.45 10.91 24.36 24.36 24.36H352c17.67 0 32 14.33 32 31.1v71.64c0 13.45 10.91 24.36 24.36 24.36c23.69 0 23.24-32 55.64-32C490.5 223.1 512 252.7 512 288z"/></svg>

                        <p class="text-xl ml-2">{{ Config::get('site_vars.platformName1') }}<strong>{{ Config::get('site_vars.platformName2') }}</strong></p>

                    </div>

			</a>

			<!-- Logo -->

		</li>

	</ul>

	<!-- Home Link -->

	@endauth

	@guest

	<!-- Home Link -->

	<ul class="flex items-center">

		<li class="p-1 md:p-3 text-gray-700 hover:text-gray-900">

			<!-- Logo -->

			<a href="\">

				<div class="flex items-center">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-7 w-7 fill-current text-yellow-600 flex-shrink-0"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 288c0 35.35-21.49 64-48 64c-32.43 0-31.72-32-55.64-32C394.9 320 384 330.9 384 344.4V480c0 17.67-14.33 32-32 32h-71.64C266.9 512 256 501.1 256 487.6C256 463.1 288 464.4 288 432c0-26.51-28.65-48-64-48s-64 21.49-64 48c0 32.43 32 31.72 32 55.64C192 501.1 181.1 512 167.6 512H32c-17.67 0-32-14.33-32-32v-135.6C0 330.9 10.91 320 24.36 320C48.05 320 47.6 352 80 352C106.5 352 128 323.3 128 288S106.5 223.1 80 223.1c-32.43 0-31.72 32-55.64 32C10.91 255.1 0 245.1 0 231.6v-71.64c0-17.67 14.33-31.1 32-31.1h135.6C181.1 127.1 192 117.1 192 103.6c0-23.69-32-23.24-32-55.64c0-26.51 28.65-47.1 64-47.1s64 21.49 64 47.1c0 32.43-32 31.72-32 55.64c0 13.45 10.91 24.36 24.36 24.36H352c17.67 0 32 14.33 32 31.1v71.64c0 13.45 10.91 24.36 24.36 24.36c23.69 0 23.24-32 55.64-32C490.5 223.1 512 252.7 512 288z"/></svg>

                    <p class="text-xl ml-2">{{ Config::get('site_vars.platformName1') }}<strong>{{ Config::get('site_vars.platformName2') }}</strong></p>

                </div>

			</a>

			<!-- Logo -->

		</li>

	</ul>

	<!-- Home Link -->

	@endguest

	<!-- Auth -->

	<ul class="flex items-center">

		@auth

		@php
			$id = auth()->user()->id;
		@endphp


			<li class="mx-2">

                    <div class="px-3">

                    	<a href="{{ route('profile.details', ['id' => Auth::user()->id]) }}" class="text-gray-700 hover:text-gray-900 flex items-center transform duration-150 hover:scale-105 transition-colors">

                    		@if(isset(Auth::user()->image->filename)) 

                    			<div class="hidden relative sm:block">
							    	<img src="{{ url('images/show/'.$id) }}" class="w-10 h-10 rounded-full object-cover border-gray-200">
							    	<span class="bottom-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
								</div>

                    		@else

								<div class="hidden relative sm:block">
							    	<img src="https://daz-buddies.digillab.uni-augsburg.de/img/avatar.jpg" class="w-10 h-10 rounded-full object-cover border-gray-200">
							    	<span class="bottom-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
								</div>                    		

                    		@endif

                    		<span class="text-xs sm:text-sm font-semibold text-left px-4 break-words">

	                    		@if (Auth::user()->vorname)

	                    			{{ Auth::user()->vorname}} {{ Auth::user()->nachname }}

	                    		@else

									Konto <!--{{ Auth::user()->vorname }} {{ Auth::user()->nachname }} -->
	                    		
	                    		@endif

	                    		<div>

                               		@if (Auth::user()->role == 'admin')

                                        <span class="font-normal text-gray-500">Administration</span>

                                    @elseif (Auth::user()->role == 'Moderierende')

                                        <span class="font-normal text-gray-500">Moderation</span>

                                    @elseif (Auth::user()->role == 'Stud')

                                        <span class="font-normal text-gray-500">Studium</label>

                                    @elseif (Auth::user()->role == 'Lehr')

                                        <span class="font-normal text-gray-500">Schuldienst</label>

                                    @endif

	                    		</div>

                    		</span>

                    	</a>

                    </div>

			</li>

		@endauth

		@guest

			<!-- Auth anzeigen -->

			<li class="mr-2 mb-1">

				<a class="px-3 py-2 text-xs text-gray-700 hover:bg-gray-500 hover:bg-opacity-10 rounded-full" href="{{ route('login') }}">Anmelden</a>

			</li>

			<li class=" mb-1">

				<a class="px-3 py-2 text-xs text-white bg-gray-800 hover:bg-gray-700 rounded-full" href="{{ route('register') }}">Registrieren</a>

			</li>

			<!-- Auth anzeigen -->

		@endguest

	</ul>

	<!-- Auth -->

</nav>

<!-- Nav -->