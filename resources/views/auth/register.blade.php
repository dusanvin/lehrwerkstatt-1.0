<x-guest-layout>

    <style>

        #lehr, #stud {
            background-color: rgb(31, 41, 55);
        }
        #lehr:active, #stud:active {
            background-color: rgb(107, 114, 128) !important;
        }
        #lehr:focus, #stud:focus {
            background-color: rgb(107, 114, 128) !important;
        }
        #lehr:hover, #stud:hover {
            background-color: rgb(107, 114, 128) !important;
        }
        #privacy_statement:checked, #user_agreement:checked {
            background-color: rgb(124, 58, 237) !important;
        }
        #privacy_statement:focus, #user_agreement:focus {
            background-color: rgb(124, 58, 237) !important;
            --tw-ring-color: rgb(124, 58, 237) !important;
        }

    </style>

    <script>

        var selected = null;

        role_button_ids = [
            "Lehr",
            "Stud"
        ];

        function setRole(id) {
            selected = id;
            console.log(selected);
            role_button_ids.forEach(role_button_id => document.getElementById(role_button_id).style.backgroundColor = null);
            document.getElementById(id).style.backgroundColor = 'rgb(107, 114, 128)';
            document.getElementById('role').value = id;
        }

    </script>

    <x-auth-card>

        <x-slot name="logo">

            <a href="/">

                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />

            </a>

        </x-slot>

        <!-- Validation Errors -->

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Validation Errors -->

        <!-- Registrierungsform -->

        <form method="POST" action="{{ route('register') }}">

            @csrf

            <!-- Email Addresse -->

            <div class="mt-4">

                <x-label for="email" :value="__('Email-Adresse**')" />

                <x-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required />

            </div>

            <!-- Email Addresse -->

            <!-- Passwort -->

            <div class="mt-4">

                <x-label for="password" :value="__('Passwort*')" />

                <x-input
                    id="password"
                    class="block mt-2 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password"
                />

            </div>

            <!-- Passwort -->

            <!-- Confirm Password -->

            <div class="mt-4">

                <x-label for="password_confirmation" :value="__('Passwort bestätigen*')" />

                <x-input
                    id="password_confirmation"
                    class="block mt-2 w-full"
                    type="password"
                    name="password_confirmation" required
                />

            </div>

            <!-- Confirm Password -->

            <!-- Rolle -->

            <div class="mt-4">

                <x-label for="role" :value="__('Rolle*')" />

                <input id="role" type="hidden" name="role"></input>

                <x-button id="Lehr" type="button" class="mt-2" onclick=setRole(this.id)>Lehrkraft</x-button>

                <x-button id="Stud" type="button" class="mt-2" onclick=setRole(this.id)>Studentin**</x-button>

            </div>

            <!-- Rolle -->

            <!-- Nutzungsbedingungen -->

            <div class="mt-4">

                <div id="element_nutzungsbedingungen" class="block text-sm text-gray-700">

                    <input id="user_agreement" type="checkbox" name="user_agreement">

                    Ich habe die <a href="https://digillab.uni-augsburg.de/wp-content/uploads/2023/01/Verbindliche_TN-Bedingungen_UniA_2023.pdf" class="hover:underline text-yellow-600">Nutzungsbedingungen</a> gelesen und erkläre mich damit einverstanden.*

                </div>

            </div>

            <!-- Nutzungsbedingungen -->

            <!-- Datenschutzerklärung -->

            <div class="mt-4">

                <div id="element_datenschutz" class="block text-sm text-gray-700">

                    <input id="privacy_statement" type="checkbox" name="privacy_statement">

                        Ich bestätige, dass ich die verlinkten <a href="https://www.uni-augsburg.de/de/forschung/einrichtungen/institute/zlbib/lehrwerkstatt/datenschutzhinweise/" class="hover:underline text-yellow-600">Datenschutzhinweise</a> sowie die <a href="https://www.uni-augsburg.de/de/forschung/einrichtungen/institute/zlbib/lehrwerkstatt/datenschutzrechtliche-einwilligungserklarung/" class="hover:underline text-yellow-600">datenschutzrechtliche Einwilligungserklärung</a> zur Kenntnis genommen habe, und willige in die Verarbeitung und Speicherung meiner Daten im Rahmen der Lehr:werkstatt ein.*

                </div>

            </div>

            <!-- Datenschutzerklärung -->

            <input type=hidden id="in_nutzungsbedingungen" name="nutzungsbedingungen">
            <input type=hidden id="in_datenschutz" name="datenschutz">

            <script>
                element_nutzungsbedingungen = document.getElementById('element_nutzungsbedingungen');
                in_nutzungsbedingungen = document.getElementById('in_nutzungsbedingungen');
                in_nutzungsbedingungen.value = element_nutzungsbedingungen.innerHTML;

                element_datenschutz = document.getElementById('element_datenschutz');
                in_datenschutz = document.getElementById('in_datenschutz');
                in_datenschutz.value = element_datenschutz.innerHTML;
            </script>


            <!-- Hinweis -->

            <div class="mt-8 mb-8">

                <div class="block font-medium text-xs text-gray-700">

                    <p class="mb-1">* Alle Angaben sind zwingend für die Registrierung erforderlich.</p>
                    <p>**Als Student*in wird eine E-Mail mit Endung <em>@student.uni-augsburg.de</em> bzw. <em>@uni-a.de</em> benötigt.</p>

                </div>

            </div>

            <!-- Hinweis -->

            <div class="flex items-center justify-end mt-4">

                <a class="hover:underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">

                    {{ __('Bereits registriert?') }}

                </a>

                <x-button class="ml-4">

                    {{ __('Registrieren') }}

                </x-button>

            </div>

            <!-- Hinweis -->

        </form>

        <!-- Registrierungsform -->

    </x-auth-card>
    
</x-guest-layout>
