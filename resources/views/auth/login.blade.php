<x-guest-layout>

    <x-auth-card>

        <!-- Session Status -->

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Session Status -->

        <!-- Validation Fehler -->

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Validation Fehler -->

        <!-- Form -->

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- Email Addresse -->

            <div>

                <x-label for="email" :value="__('E-Mail-Adresse')" class="mb-2"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

            </div>

            <!-- Email Addresse -->

            <!-- Passwort -->

            <div class="mt-4">

                <x-label for="password" :value="__('Passwort')" class="mb-2"/>

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Passwort -->

            <!-- Angemeldet bleiben-->

            <div class="block mt-4">

                <label for="remember_me" class="inline-flex items-center">

                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">

                    <span class="ml-2 text-sm text-gray-600">{{ __('Angemeldet bleiben') }}</span>

                </label>

            </div>

            <!-- Angemeldet bleiben-->

            <!-- Passwort vergessen? -->

            <div class="flex items-center justify-end mt-4">

                @if (Route::has('password.request'))

                    <a class="hover:underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">

                        {{ __('Passwort vergessen?') }}

                    </a>

                @endif

                <x-button class="ml-3 ">

                    {{ __('Anmelden') }}

                </x-button>

            </div>

            <!-- Passwort vergessen? -->

        </form>

        <!-- Form -->

    </x-auth-card>

</x-guest-layout>