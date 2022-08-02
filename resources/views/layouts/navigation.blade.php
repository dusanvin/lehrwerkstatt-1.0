<style type="text/css">
	#navigation-digillab {
		transition: width 0.2s
	}
</style>

<nav class="bg-top bg-gray-700 w-80 justify-between flex flex-col sm:rounded-l-lg shadow-b transition ease-in-out duration-150" id="navigation-digillab">

	<div class="mt-10 mb-10">

		<!-- Toggle-Menu -->

		<script type="text/javascript">
			function menufunction() {

				if (document.getElementById("navigation-digillab").style.width != "67px") {

					var elements = document.getElementsByClassName('navigation-element'),
						i, len;

					for (i = 0, len = elements.length; i < len; i++) {
						elements[i].style.display = 'none';
					}

					document.getElementById("navigation-digillab").style.width = "67px";
					localStorage.setItem('menu', 'false');
					return;

				} else if (document.getElementById("navigation-digillab").style.width == "67px") {

					var elements = document.getElementsByClassName('navigation-element'),
						i, len;

					setTimeout(function() {
						for (i = 0, len = elements.length; i < len; i++) {
							elements[i].style.display = 'block';
						}
					}, 100)

					document.getElementById("navigation-digillab").style.width = "322px";
					localStorage.setItem('menu', 'true');
					return;
				}
			}
		</script>

		<button onclick="menufunction()" class="float-right text-white focus:outline-none hover:text-gray-400" id="testcolor">

			<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 float-right mr-5" viewBox="0 0 20 20" fill="currentColor">

				<path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />

			</svg>

		</button>

		<!-- Toggle-Menu -->

		<div class="mt-10 pt-3">

			<p class="navigation-element mb-3 mt-10 pl-7 text-xs tracking-wider text-gray-300 antialiased uppercase font-medium">Allgemeines</p>

			<ul>

				<!-- Bewerbungsformular -->

				<li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('profile.edit') }}" class="text-gray-100 hover:text-gray-400 px-4 py-2 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('profile/edit')) { text-yellow-400 } @endif">

						<div>

							<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

							  <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />

							</svg>

						</div>

						<div class="pl-3">
						@role('Admin|Moderierende')
							<p class="navigation-element text-sm font-medium mb-1 font-semibold">Mitgliedsdaten</p>
						@endrole
						@role('Lehr|Stud')
							<p class="navigation-element text-sm font-medium mb-1 font-semibold">Bewerbungsformular</p>
						@endrole
							<!--<p class="navigation-element text-xs">Jahrgang 2022/2023</p>-->

						</div>

					</a>

				</li>

				<!-- Bewerbungsformular -->

				<!-- Account -->

				<li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('profile.account') }}" class="text-gray-100 hover:text-gray-400 px-4 py-2 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('profile/account')) { text-yellow-400 } @endif">

						<div>

							<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
							 
								<path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
							
							</svg>

						</div>

						<div class="pl-3">

							<p class="navigation-element text-sm font-medium mb-1 font-semibold">Account</p>

							<!--<p class="navigation-element text-xs">E-Mail und Passwort</p>-->

						</div>

					</a>

				</li>

				<!-- Account -->

				@role('Lehr|Stud')

				<!-- Vorschläge -->

				<li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('profile.matchings') }}" class="text-gray-100 hover:text-gray-400 px-4 py-2 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('profile/matchings')) { text-yellow-400 } @endif">

						<div>

						<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
						
							<path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
						
						</svg>

						</div>

						<div class="pl-3">

							<p class="navigation-element text-sm font-medium mb-1 font-semibold">Vorschläge</p>

							<!--<p class="navigation-element text-xs">E-Mail und Passwort</p>-->

						</div>

					</a>

				</li>

				<!-- Vorschläge -->

				@endrole

				<!-- Nachrichten -->

				<li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('messages') }}" class="text-gray-100 hover:text-gray-400 px-4 py-2 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('messages')) { text-yellow-400 } @endif @if (Request::is('messages/*')) { text-yellow-400 } @endif">

						<div>

							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

								<path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />

								<path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />

							</svg>

						</div>

						<div class="pl-3">

							<p class="navigation-element text-sm font-medium mb-1 font-semibold">{{ Config::get('site_vars.nachrichten') }}</p>

							<!--<p class="navigation-element text-xs">{{ Config::get('site_vars.nachrichtenInfo') }}</p>-->

						</div>

					</a>

				</li>

				<!-- Nachrichten -->

			</ul>

			@role('Admin|Moderierende')

			<p class="navigation-element mb-3 mt-10 pl-7 text-xs tracking-wider text-gray-300 antialiased uppercase font-medium">Administration</p>

			<ul>

				<!-- Statistiken -->

				<li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('stats') }}" class="text-gray-100 hover:text-gray-400 px-4 py-2 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150  @if (Request::is('stats')) { text-yellow-400 } @endif">

						<div>

							<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

								<path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />

								<path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />

							</svg>

						</div>

						<div class="pl-3">

							<p class="navigation-element text-sm font-medium mb-1 font-semibold">{{ Config::get('site_vars.stats') }}</p>

							<!--<p class="navigation-element text-xs">{{ Config::get('site_vars.statsInfo') }}</p>-->

						</div>

					</a>

				</li>

				<!-- Statistiken -->

				<!-- Personen -->

				<li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('users.index') }}" class="text-gray-100 hover:text-gray-400 px-4 py-2 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('users')) { text-yellow-400 } @endif @if (Request::is('roles')) { text-yellow-400 } @endif @if (Request::is('users/*')) { text-yellow-400 } @endif @if (Request::is('roles/*')) { text-yellow-400 } @endif">

						<div>

							<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

								<path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />

							</svg>

						</div>

						<div class="pl-3">

							<p class="navigation-element text-sm font-medium mb-1 font-semibold">{{ Config::get('site_vars.verwaltung') }}</p>

							<!--<p class="navigation-element text-xs">{{ Config::get('site_vars.verwaltungInfo') }}</p>-->

						</div>

					</a>

				</li>

			</ul>

			@endrole

			@role('Admin|Moderierende')

			<p class="navigation-element mb-3 mt-10 pl-7 text-xs tracking-wider text-gray-300 antialiased uppercase font-medium">Paare</p>

			<!-- Angebote -->

			<ul>

				<li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('users.lehr') }}" class="text-gray-100 hover:text-gray-400 px-4 py-2 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('offers/*')) { text-yellow-400 } @endif">

						<div>

							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

								<path fill-rule="evenodd" d="M9 3a1 1 0 012 0v5.5a.5.5 0 001 0V4a1 1 0 112 0v4.5a.5.5 0 001 0V6a1 1 0 112 0v5a7 7 0 11-14 0V9a1 1 0 012 0v2.5a.5.5 0 001 0V4a1 1 0 012 0v4.5a.5.5 0 001 0V3z" clip-rule="evenodd" />

							</svg>

						</div>

						<div class="pl-3">

							<p class="navigation-element text-sm font-medium mb-1 font-semibold">{{ Config::get('site_vars.angebote') }}</p>

							<!--<p class="navigation-element text-xs">{{ Config::get('site_vars.angeboteInfo') }}</p>-->

						</div>

					</a>

				</li>

				<!-- Angebote -->

				<!-- Bedarfe Praktika -->

				<li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('users.stud') }}" class="text-gray-100 hover:text-gray-400 px-4 py-2 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('needs/*')) { text-yellow-400 } @endif">

						<div>

							<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

								<path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />

							</svg>

						</div>

						<div class="pl-3">

							<p class="navigation-element text-sm font-medium mb-1 font-semibold">{{ Config::get('site_vars.bedarfe') }}</p>

							<!--<p class="navigation-element text-xs">{{ Config::get('site_vars.bedarfeInfo') }}</p>-->

						</div>

					</a>

				</li>

				<!-- Paarungen -->

				<li class="ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('users.matchings') }}" class="text-gray-100 hover:text-gray-400 px-4 py-2 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('offers/*')) { text-yellow-400 } @endif">

						<div>

							<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
							
								<path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
							
							</svg>
							
						</div>

						<div class="pl-3">

							<p class="navigation-element text-sm font-medium mb-1 font-semibold">{{ Config::get('site_vars.vorschlaegeInfo') }}</p>

							<!--<p class="navigation-element text-xs">{{ Config::get('site_vars.vorschlaegeInfo') }}</p>-->

						</div>

					</a>

				</li>

				<!-- Paarungen -->

			</ul>

		</div>

	</div>

	@endrole

	<!-- Ausloggen Button -->

	<form action="{{ route('logout') }}" method="post" class="mb-2 mx-auto">

		@csrf

		<button class="flex text-xs items-center p-1 md:p-3 text-gray-300 hover:text-yellow-400 focus:border-transparent focus:outline-none transition ease-in-out duration-150" type="submit">

			<svg class="fill-current h-5 w-5 mx-auto ml-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

				<path d="M13 4.00894C13.0002 3.45665 12.5527 3.00876 12.0004 3.00854C11.4481 3.00833 11.0002 3.45587 11 4.00815L10.9968 12.0116C10.9966 12.5639 11.4442 13.0118 11.9965 13.012C12.5487 13.0122 12.9966 12.5647 12.9968 12.0124L13 4.00894Z" fill="currentColor" />

				<path d="M4 12.9917C4 10.7826 4.89541 8.7826 6.34308 7.33488L7.7573 8.7491C6.67155 9.83488 6 11.3349 6 12.9917C6 16.3054 8.68629 18.9917 12 18.9917C15.3137 18.9917 18 16.3054 18 12.9917C18 11.3348 17.3284 9.83482 16.2426 8.74903L17.6568 7.33481C19.1046 8.78253 20 10.7825 20 12.9917C20 17.41 16.4183 20.9917 12 20.9917C7.58172 20.9917 4 17.41 4 12.9917Z" fill="currentColor" />

			</svg><span class="navigation-element ml-1">Ausloggen</span>

		</button>

	</form>

	<!-- Ausloggen Button -->

	<script>
		if (localStorage.getItem('menu') == null) {
			localStorage.setItem('menu', 'true');
		}

		if (localStorage.getItem('menu') == 'false') {
			menufunction();
		}
	</script>

</nav>