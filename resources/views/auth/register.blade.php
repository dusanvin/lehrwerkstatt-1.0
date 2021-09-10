<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Vorname -->
            <div>
                <x-label for="firstname" :value="__('Vorname')" />

                <x-input id="firstname" class="block mt-2 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus />
            </div>
            
            <!-- Nachname -->
            <div class="mt-4">
                <x-label for="lastname" :value="__('Nachname')" />

                <x-input id="lastname" class="block mt-2 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus />
            </div>

            <!-- Rolle -->
            <script>
                // var formData = new FormData();

                // var defaultbackgroundColor = null;
                // function student() 
                // {
                //     console.log("student");
                //     // formData.set('role', 'student');
                //     var defaultbackgroundColor = document.getElementById('btn-student').style.backgroundColor;
                //     document.getElementById('btn-teacher').style.backgroundColor = defaultbackgroundColor;
                //     document.getElementById('btn-student').style.backgroundColor = 'blue';
                //     document.getElementById('role').value = "student";
                // }

                // function teacher()
                // {
                //     console.log("teacher");
                //     // formData.set('role', 'teacher')
                //     var defaultbackgroundColor = document.getElementById('btn-teacher').style.backgroundColor;
                //     document.getElementById('btn-student').style.backgroundColor = defaultbackgroundColor;
                //     document.getElementById('btn-teacher').style.backgroundColor = 'blue';
                //     document.getElementById('role').value = "teacher";
                // }

                var selected = null;

                role_button_ids = [
                    "btn-student",
                    "btn-teacher"
                ];

                function setRole(id) {
                    selected = id;
                    console.log(selected);
                    role_button_ids.forEach(role_button_id => document.getElementById(role_button_id).style.backgroundColor = null);
                    document.getElementById(id).style.backgroundColor = 'blue';
                    document.getElementById('role').value = id;
                }

            </script>
            <div class="mt-4">
                <x-label for="role" :value="__('Wählen sie Ihre Rolle')" />
                <input id="role" type="hidden" name="role"></input>

                <x-button id="btn-student" type="button" class="block mt-2" onclick=setRole(this.id)>Schüler:in</x-button>
                <x-button id="btn-teacher" type="button" class="block mt-2" onclick=setRole(this.id)>Helfer:in</x-button>
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email-Adresse')" />

                <x-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Passwort')" />

                <x-input id="password" class="block mt-2 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Passwort bestätigen')" />

                <x-input id="password_confirmation" class="block mt-2 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="hover:underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Bereits registriert?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrieren') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
