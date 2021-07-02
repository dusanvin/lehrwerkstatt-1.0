<!-- Nav -->

<nav class="p-3 flex justify-between max-w-7xl mx-auto">

	@auth

	<!-- Home Link -->

	<ul class="flex items-center">

		<li class="p-1 md:p-3 text-gray-100 hover:bg-black hover:bg-opacity-60 rounded-md">

			<!-- Logo -->

			<a href="\dashboard">

				<div class="flex items-center"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 16" class="h-7 w-7 -mt-2 flex-shrink-0"><path fill-rule="evenodd" clip-rule="evenodd" d="M25.517 0C18.712 0 14.46 3.382 12.758 10.146c2.552-3.382 5.529-4.65 8.931-3.805 1.941.482 3.329 1.882 4.864 3.432 2.502 2.524 5.398 5.445 11.722 5.445 6.804 0 11.057-3.382 12.758-10.145-2.551 3.382-5.528 4.65-8.93 3.804-1.942-.482-3.33-1.882-4.865-3.431C34.736 2.92 31.841 0 25.517 0zM12.758 15.218C5.954 15.218 1.701 18.6 0 25.364c2.552-3.382 5.529-4.65 8.93-3.805 1.942.482 3.33 1.882 4.865 3.432 2.502 2.524 5.397 5.445 11.722 5.445 6.804 0 11.057-3.381 12.758-10.145-2.552 3.382-5.529 4.65-8.931 3.805-1.941-.483-3.329-1.883-4.864-3.432-2.502-2.524-5.398-5.446-11.722-5.446z" fill="#7C3AED"></path></svg> <p class="text-xl ml-2 text-white">digi:<strong>match</strong></p></div>

			</a>

			<!-- Logo -->

		</li>

	</ul>

	<!-- Home Link -->

	@endauth

	@guest

	<!-- Home Link -->

	<ul class="flex items-center">

		<li class="p-1 md:p-3">

			<!-- Logo -->

			<a href="\">

				<div class="flex items-center"><svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 16" class="h-7 w-7 -mt-2 flex-shrink-0"><path fill-rule="evenodd" clip-rule="evenodd" d="M25.517 0C18.712 0 14.46 3.382 12.758 10.146c2.552-3.382 5.529-4.65 8.931-3.805 1.941.482 3.329 1.882 4.864 3.432 2.502 2.524 5.398 5.445 11.722 5.445 6.804 0 11.057-3.382 12.758-10.145-2.551 3.382-5.528 4.65-8.93 3.804-1.942-.482-3.33-1.882-4.865-3.431C34.736 2.92 31.841 0 25.517 0zM12.758 15.218C5.954 15.218 1.701 18.6 0 25.364c2.552-3.382 5.529-4.65 8.93-3.805 1.942.482 3.33 1.882 4.865 3.432 2.502 2.524 5.397 5.445 11.722 5.445 6.804 0 11.057-3.381 12.758-10.145-2.552 3.382-5.529 4.65-8.931 3.805-1.941-.483-3.329-1.883-4.864-3.432-2.502-2.524-5.398-5.446-11.722-5.446z" fill="#7C3AED"></path></svg> <p class="text-xl ml-2 text-gray-100">digi:<strong>match</strong></p></div>

			</a>

			<!-- Logo -->

		</li>

	</ul>

	<!-- Home Link -->

	@endguest

	<!-- Auth -->

	<ul class="flex items-center">

		@auth
		
			<li class="text-gray-100 hover:bg-black hover:bg-opacity-60 rounded-md">

				<form action="{{ route('logout') }}" method="post">

					@csrf

					<button class="flex text-xs items-center p-1 md:p-3" type="submit">

						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">

					  		<path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />

						</svg>Ausloggen

					</button>

				</form>

			</li>

			<!--Ausloggen -->

		@endauth

		@guest

			<!-- Auth anzeigen -->

			<li class="p-3 text-xs text-gray-100">

				<a href="{{ route('login') }}">Anmelden</a>

			</li>

			<li class="p-3 text-xs text-gray-100">

				<a href="{{ route('register') }}">Registrieren</a>

			</li>

			<!-- Auth anzeigen -->

		@endguest

	</ul>

	<!-- Auth -->

</nav>

<!-- Nav -->