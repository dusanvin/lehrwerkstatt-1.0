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

						<h3 class="pt-4 pb-4 text-2xl text-center font-bold">Registrieren</h3>

						<!-- Start: Form -->

						<form class="px-8 pt-6 mb-4 bg-white rounded" action="{{ route('register') }}" method="post">

							<!-- Start: Validation -->

							@csrf

							<!-- Ende: Validation -->

							<div class="mb-4 md:flex md:justify-between">

								<!-- Start: Vorname -->

								<div class="mb-4 md:mr-2 md:mb-0">

									<label class="block mb-2 text-sm font-normal text-gray-800" for="firstName">

										Vorname

									</label>
									<input

										class="transition ease-in-out w-full px-3 py-2 text-sm text-gray-800 bg-gray-100 rounded border-2 appearance-none focus:border-black focus:shadow-outline @error('vorname') border-red-500 @enderror"
										id="firstName"
										type="text"
										placeholder="Vorname"
										name="vorname"
										value="{{ old('vorname') }}"

									/>

								</div>

								<!-- Ende: Vorname -->

								<!-- Start: Nachname -->

								<div class="md:ml-2">

									<label class="block mb-2 text-sm font-normal text-gray-800" for="lastName">

										Nachname

									</label>

									<input
										class="transition ease-in-out w-full px-3 py-2 text-sm text-gray-800 bg-gray-100 rounded border-2 appearance-none focus:border-black focus:shadow-outline @error('nachname') border-red-500 @enderror"
										id="lastName"
										type="text"
										placeholder="Nachname"
										name="nachname"
										value="{{ old('nachname') }}"
									/>

								</div>

								<!-- Ende: Nachname -->

							</div>

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

							<div class="mb-4 md:flex md:justify-between">

								<!-- Start: Passwort -->

								<div class="mb-4 md:mr-2 md:mb-0">

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
									@error('password')

										<div class="text-red-500 mt-2 text-sm">
											{{ $message }}
										</div>

									@enderror

									


								</div>

								<!-- Ende: Passwort -->

								<!-- Sart: Passwort (Bestätigung) -->

								<div class="md:ml-2">

									<label class="block mb-2 text-sm font-normal text-gray-800" for="password_confirmation">

										Passwort (Bestätigung)

									</label>

									<input
										class="transition ease-in-out w-full px-3 py-2 text-sm text-gray-800 bg-gray-100 rounded border-2 appearance-none focus:border-black focus:shadow-outline @error('password') border-red-500 @enderror"
										id="c_password"
										type="password"
										placeholder="******************"
										name="password_confirmation"

									/>

								</div>

								<!-- Ende: Passwort (Bestätigung) -->

							</div>

							<!-- Start: Button Registrierung -->

							<div class="mb-6 mt-12 text-center">

								<button
									class="border-2 border-gray-100 focus:outline-none bg-purple-600 text-white font-normal tracking-wider block w-full p-2 rounded-full focus:border-gray-700 hover:bg-purple-700"
									type="submit"
								>

									Account registrieren

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

							<div class="text-center">

								<a
									class="inline-block text-xs text-purple-500 align-top hover:text-purple-800 font-medium"
									href="{{ route('login') }}"
								>

									Sie haben bereits einen Account? Melden Sie sich an!

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