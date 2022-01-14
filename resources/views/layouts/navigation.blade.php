<nav class="bg-top w-80 justify-between flex flex-col sm:rounded-l-lg shadow-b transition ease-in-out duration-150" id="navigation-digillab" style="max-width: fit-content; background-color: #344955;">

    <div class="mt-10 mb-10">

    	<!-- Toggle-Menu -->

    	<style type="text/css">
    		#navigation-digillab {
    			transition: width 0.5s
    		}
    		.navigation-element {
    			transition: opacity 1s;
    		}
    	</style>

    	<script type="text/javascript">

    		function menufunction () {  

				  if (document.getElementById("navigation-digillab").style.width != "67px") {

				  	document.getElementById("navigation-digillab").style.width = "67px";

			  	  	var elements = document.getElementsByClassName('navigation-element'), i, len;
  
						for (i = 0, len = elements.length; i < len; i++) {

					    	elements[i].style.display = 'none';
					    	elements[i].style.opacity = '0';

						}

				    return;
				  }
				  else if (document.getElementById("navigation-digillab").style.width == "67px") {

				    document.getElementById("navigation-digillab").style.width = "322px";

				    var elements = document.getElementsByClassName('navigation-element'), i, len;
  
						for (i = 0, len = elements.length; i < len; i++) {

					    	elements[i].style.display = 'block';
					    	elements[i].style.opacity = '1';

						}
				    
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

      	<!-- Nutzer anzeigen -->

        @if (auth()->user())

		<div class="text-center pt-3 text-gray-200 mt-10">

			<!-- <img class="h-24 w-24 rounded-full mx-auto" src="https://randomuser.me/api/portraits/men/24.jpg" alt="Randy Robertson"> -->

<!-- {{ route('user') }} -->
			<a href="{{ route('profile.overview') }}" class="pt-2 font-medium text-sm inline-block hover:text-gray-400">

				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rounded-full mx-auto mb-1" viewBox="0 0 20 20" fill="currentColor">

				  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />

				</svg><span class="navigation-element font-semibold"> {{ Auth::user()->vorname }} {{ Auth::user()->nachname }}
				<!-- 

				$firstName = (Auth::user()->vorname)[0];
				$lastName = (Auth::user()->nachname)[0];

				$iniName = $firstName . $lastName;

				echo $iniName;

				-->

				</span>

			</a>

			<!-- 
			<p class="text-xs text-gray-400">{{ Auth::user()->role }}</p> -->

		</div>

		@endif

	<!-- Nutzer anzeigen -->

    <div class="mt-5">

        <ul>

			<p class="navigation-element mb-3 mt-10 pl-7 text-xs tracking-wider text-gray-300 antialiased uppercase font-medium">Allgemeines</p>

			<!-- Mein Bereich -->

			<li class="hover:bg-black hover:bg-opacity-60 ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

				<a href="{{ route('profile.overview') }}" class="px-4 py-2 hover:bg-gray-900 hover:text-gray-900 flex items-center rounded-l-md rounded-r-md  transition ease-in-out duration-150 @if (Request::is('dashboard')) { text-gray-900 bg-black bg-opacity-60 } @endif">

		            <div class="text-gray-100">

		              	<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5 text-gray-100" viewBox="0 0 20 20" fill="currentColor">

							<path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
							
						</svg>

		            </div>

		            <div class="pl-3">

		              <p class="navigation-element text-sm font-medium text-gray-100 leading-none mb-1 font-semibold">Mein Bereich</p>

		              <p class="navigation-element text-xs text-gray-400">Persönliche Informationen</p>

		            </div>

		        </a>

			</li>

			<!-- Mein Bereich -->

			<!-- Nachrichten -->

			<li class="hover:bg-black hover:bg-opacity-60 ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">


				<a href="{{ route('messages') }}" class="px-4 py-2 hover:bg-gray-900 hover:text-gray-900 flex items-center rounded-l-md rounded-r-md  transition ease-in-out duration-150 @if (Request::is('messages')) { text-gray-900 bg-black bg-opacity-60 } @endif">

		            <div class="text-gray-100">

		              	<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-100" viewBox="0 0 20 20" fill="currentColor">
							
							<path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
							
							<path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
						
						</svg>

		            </div>

		            <div class="pl-3">

		              <p class="navigation-element text-sm font-medium text-gray-100 leading-none mb-1 font-semibold">Nachrichten</p>

		              <p class="navigation-element text-xs text-gray-400">Gespräche und Kontakte</p>

		            </div>

		        </a>

			</li>

			<!-- Nachrichten -->

			@role('Admin|Moderierende')

	        	<p class="navigation-element mb-3 mt-10 pl-7 text-xs tracking-wider text-gray-300 antialiased uppercase font-medium">Administration</p>

	        	<!-- Statistiken -->

				<li class="hover:bg-black hover:bg-opacity-60 ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('stats') }}" class="px-4 py-2 hover:bg-gray-900 hover:text-gray-900 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('stats')) { text-gray-900 bg-black bg-opacity-60 } @endif">

			            <div class="text-gray-100">

							<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

								<path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />

								<path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />

							</svg>

			            </div>

			            <div class="pl-3">

			              <p class="navigation-element text-sm font-medium text-gray-100 leading-none mb-1 font-semibold">Statistiken</p>

			              <p class="navigation-element text-xs text-gray-400">Details zum Portal</p>

			            </div>

			        </a>

				</li>

				<!-- Statistiken -->

				<!-- Personen -->

				<li class="hover:bg-black hover:bg-opacity-60 ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

					<a href="{{ route('users.index') }}"class="px-4 py-2 hover:bg-gray-900 hover:text-gray-900 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('help')) { text-gray-900 bg-black bg-opacity-60 } @endif">

			            <div class="text-gray-100">

							<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

								<path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />

							</svg>

			            </div>

			            <div class="pl-3">

			              <p class="navigation-element text-sm font-medium text-gray-100 leading-none mb-1 font-semibold">Verwaltung</p>

			              <p class="navigation-element text-xs text-gray-400">Nutzende und Rollen</p>

			            </div>

			        </a>

				</li>

			@else
  
			@endrole

			<p class="navigation-element mb-3 mt-10 pl-7 text-xs tracking-wider text-gray-300 antialiased uppercase font-medium">Paare</p>

			<!-- Angebote -->

			<li class="hover:bg-black hover:bg-opacity-60 ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

				<a href="{{ route('offers.all') }}" class="px-4 py-2 hover:bg-gray-900 hover:text-gray-900 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('offers')) { text-gray-900 bg-black bg-opacity-60 } @endif">

		            <div class="text-gray-100">

						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

							<path fill-rule="evenodd" d="M9 3a1 1 0 012 0v5.5a.5.5 0 001 0V4a1 1 0 112 0v4.5a.5.5 0 001 0V6a1 1 0 112 0v5a7 7 0 11-14 0V9a1 1 0 012 0v2.5a.5.5 0 001 0V4a1 1 0 012 0v4.5a.5.5 0 001 0V3z" clip-rule="evenodd" />

						</svg>

		            </div>

		            <div class="pl-3">

		              <p class="navigation-element text-sm font-medium text-gray-100 leading-none mb-1 font-semibold">Angebote</p>

		              <p class="navigation-element text-xs text-gray-400">Hilfsangebot anbieten</p>

		            </div>

		        </a>

			</li>

			<!-- Angebote --> 

			<!-- Bedarfe Praktika -->

			<li class="hover:bg-black hover:bg-opacity-60 ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

				<a href="{{ route('needs.all') }}" class="px-4 py-2 hover:bg-gray-900 hover:text-gray-900 flex items-center rounded-l-md rounded-r-md transition ease-in-out duration-150 @if (Request::is('needs')) { text-gray-900 bg-black bg-opacity-60 } @endif">

		            <div class="text-gray-100">

						<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

							<path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />	
							
						</svg>

		            </div>

		            <div class="pl-3">

		              <p class="navigation-element text-sm font-medium text-gray-100 leading-none mb-1 font-semibold">Bedarfe</p>

		              <p class="navigation-element text-xs text-gray-400">Hilfsangebot ersuchen</p>

		            </div>

		        </a>

			</li>

			<!-- Bedarfe Praktika --> 

			<!-- Zuweisungen -->

			<!-- <li class="hover:bg-black hover:bg-opacity-60 ml-2 mr-2 my-1 rounded-l-lg rounded-r-lg">

				<a href="{{ route('matching') }}" class="px-4 py-2 hover:bg-gray-900 hover:text-gray-900 flex items-center rounded-l-md rounded-r-md @if (Request::is('matching')) { text-gray-900 bg-black bg-opacity-60 } @endif">

		            <div class="text-gray-100">

					<svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

						<path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
					</svg>

		            </div>

		            <div class="pl-3">

		              <p class="text-sm font-medium text-gray-100 leading-none">Zuweisungen</p>

		              <p class="text-xs text-gray-400">Übersicht und Erstellung</p>

		            </div>

		        </a>

			</li> -->

			<!-- Zuweisungen --> 

        </ul>

      </div>

    </div>

    <!-- Ausloggen Button -->

    <form action="{{ route('logout') }}" method="post" class="mb-2 mx-auto">

		@csrf

		<button class="flex text-xs items-center p-1 md:p-3 text-gray-300 hover:text-yellow-400 focus:border-transparent focus:outline-none transition ease-in-out duration-150" type="submit">

			<svg
			class="fill-current h-5 w-5 mx-auto ml-1"
			viewBox="0 0 24 24"
			fill="none"
			xmlns="http://www.w3.org/2000/svg"
			>

				<path
				  d="M13 4.00894C13.0002 3.45665 12.5527 3.00876 12.0004 3.00854C11.4481 3.00833 11.0002 3.45587 11 4.00815L10.9968 12.0116C10.9966 12.5639 11.4442 13.0118 11.9965 13.012C12.5487 13.0122 12.9966 12.5647 12.9968 12.0124L13 4.00894Z"
				  fill="currentColor"
				/>

				<path
				  d="M4 12.9917C4 10.7826 4.89541 8.7826 6.34308 7.33488L7.7573 8.7491C6.67155 9.83488 6 11.3349 6 12.9917C6 16.3054 8.68629 18.9917 12 18.9917C15.3137 18.9917 18 16.3054 18 12.9917C18 11.3348 17.3284 9.83482 16.2426 8.74903L17.6568 7.33481C19.1046 8.78253 20 10.7825 20 12.9917C20 17.41 16.4183 20.9917 12 20.9917C7.58172 20.9917 4 17.41 4 12.9917Z"
				  fill="currentColor"
				/>

			</svg><span class="navigation-element ml-1">Ausloggen</span>

		</button>

	</form>

    <!-- Ausloggen Button -->

</nav>