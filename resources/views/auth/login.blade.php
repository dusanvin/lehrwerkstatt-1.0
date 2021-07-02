@extends ('layouts.app')

@section('content')

<!-- component -->

<body class="font-mono bg-gray-400">

		<!-- Container -->

		<div class="container mx-auto">

			<div class="flex justify-center px-6 my-12">

				<!-- Row -->

				<div class="w-full xl:w-3/4 lg:w-11/12 flex">

					<!-- Start: Col Hintergrundbild-->

					<div
						class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg shadow border-b border-gray-200"
						style="background-image: url('https://digidev.zlbib.uni-augsburg.de/laravel/img/start.jpg')"
					></div>

					<!-- Ende: Col Hintergrundbild -->

					<!-- Start: Col Registrierung -->

					<div class="w-full lg:w-7/12 bg-white sm:p-0 md:p-3 lg:p-5 xl:p-5 rounded-lg lg:rounded-l-none shadow border-b border-gray-200">

						@if (session('status'))

							<div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-400">

								<span class="text-xl inline-block mr-2 align-middle">

									<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

									  <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />

									</svg>

								</span>

								<span class="inline-block align-middle">

									<b class="capitalize">Huch!</b> {{ session('status') }}.

									<!-- 53:33 -->

								</span>

								<button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">

								<span>×</span>

								</button>

							</div>

						@endif

						<h3 class="pt-4 pb-4 text-2xl text-center font-bold">Anmelden</h3>

						<!-- Start: Form -->

						<form class="px-8 pt-6 mb-4 bg-white rounded" action="{{ route('login') }}" method="post">

							<!-- Start: Validation -->

							@csrf

							<!-- Ende: Validation -->

							<!-- Start: Email -->

							<div class="mb-4">

								<label class="block mb-2 text-sm font-normal text-gray-800" for="email">

									Email

								</label>

								<input
									class="transition ease-in-out w-full px-3 py-2 text-sm text-gray-800 bg-gray-100 rounded border-2 appearance-none focus:border-black focus:shadow-outline @error('email') border-red-500 @enderror"
									id="email"
									type="email"
									placeholder="Email"
									name="email"
									value="{{ old('email') }}"
								/>
								@error('email')

									<div class="text-red-500 mt-2 text-sm">

										{{ $message }}

									</div>

								@enderror

							</div>

							<!-- Ende: Email -->

							<!-- Start: Passwort -->

							<div class="mb-4">


								<label class="block mb-2 text-sm font-normal text-gray-800" for="password">

									Passwort

								</label>

								<input
									class="transition ease-in-out w-full px-3 py-2 text-sm text-gray-800 bg-gray-100 rounded border-2 appearance-none focus:border-black focus:shadow-outline @error('password') border-red-500 @enderror"
									id="password"
									type="password"
									placeholder="******************"
									name="password"
									
								/>

							</div>

							<!-- Ende: Passwort -->

							<div class="mb-4 text-sm">
								
								<input type="checkbox" name="remember" id="remember" class="mr-1">

								<label for="remember" class="text-base font-medium text-gray-600">Angemeldet bleiben</label>

							</div>

							<!-- Start: Button Registrierung -->

							<div class="mb-6 mt-12 text-center">

								<button
									class="border-2 border-gray-100 focus:outline-none bg-purple-600 text-white font-normal tracking-wider block w-full p-2 rounded-full focus:border-gray-700 hover:bg-purple-700"
									type="submit"
								>

									Einloggen

								</button>

							</div>

							<!-- Ende: Button Registrierung -->

							<!-- Start: Info -->

							<div class="text-center">

								<a
									class="inline-block text-xs text-purple-500 align-baseline hover:text-purple-800"
									href="{{ $mail_to_digillab }}"
								>

									Passwort vergessen? Nehmen Sie Kontakt mit uns auf.

								</a>

							</div>

							<!-- Ende: Info -->

						</form>

						<!-- Ende: Form -->

					</div>

					<!-- Ende: Col Registrierung -->

				</div>

			</div>

		</div>

	</body>

	@endsection