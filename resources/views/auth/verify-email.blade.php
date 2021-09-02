<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Vielen Dank für Ihre Registrierung. Ein letzter Schritt noch! Bitte verifizieren Sie Ihre E-Mail-Adresse, indem Sie auf den Bestätigungslink klicken, den wir Ihnen gerade zugesendet haben. Sollten Sie diese E-Mail nicht bekommen haben, senden wir Ihnen gerne erneut einen Bestätigungslink.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Ein neuer Bestätigungslink wurde an die E-Mail-Adresse versendet, mit der Sie sich registriert haben.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Erneut Bestätigungslink anfordern') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Ausloggen') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
