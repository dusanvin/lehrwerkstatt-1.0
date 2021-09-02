<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'digi:match') }}</title>
    </head>
    <body>

    	<!-- Auth -->

	<ul class="flex items-center">

		@if (auth()->user())
		
			<!-- Nutzer anzeigen -->

			<li class="p-3">

				<p class="flex text-xs items-center">

					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">

					  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />

					</svg>

					{{ Auth::user()->vorname }} {{ Auth::user()->nachname }}

				</p>

			</li>

			<!-- Nutzer anzeigen -->

			<!--Ausloggen -->

			<li class="p-3">

				<a href="" class="flex text-xs items-center">

					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">

				  		<path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />

					</svg>

					Ausloggen

				</a>

			</li>

			<!--Ausloggen -->

		@else

			<!-- Auth anzeigen -->

			<li class="p-3 text-xs">

				<a href="">Einloggen</a>

			</li>

			<li class="p-3 text-xs">

				<a href="{{ route('register') }}">Registrieren</a>

			</li>

			<!-- Auth anzeigen -->

		@endif

	</ul>

	<!-- Auth -->
    	
    </body>
</html>