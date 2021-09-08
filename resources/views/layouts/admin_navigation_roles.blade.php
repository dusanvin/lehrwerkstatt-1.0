@if (Auth::user()->getRoleNames()[0] === 'Admin')

    <div class="bg-white px-6 py-4">

        <nav class="flex flex-col sm:flex-row text-sm border-b border-gray-300">

            <a href="{{ route('users.index') }}" class="border-b-2 font-medium text-gray-500 py-4 px-6 inline-block focus:border-purple-300 focus:text-purple-500 focus:outline-none hover:text-purple-500 hover:border-purple-300">
                Personen<span class="text-xs font-normal"><br>Datenverwaltung</span>
            </a>

            <a href="{{ route('roles.index') }}" class="font-medium text-purple-500 py-4 px-6 inline-block focus:outline-none border-b-2 border-purple-500">
                Rollen<span class="text-xs font-normal"><br>Datenverwaltung</span>
            </a>

        </nav>
        
    </div>

@endif