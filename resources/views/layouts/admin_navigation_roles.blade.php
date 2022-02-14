@if (Auth::user()->getRoleNames()[0] === 'Admin')

    <ul id="tabs" class="inline-flex w-full">

        <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-800 rounded-t opacity-50 bg-white border-gray-400"><a href="{{ route('users.index') }}">Personen verwalten</a></li>

            <li class="px-4 py-2 -mb-px font-medium text-xs sm:text-sm text-gray-800 border-b-2 border-gray-700 rounded-t opacity-50 bg-white border-b-4 -mb-px opacity-100"><a href="{{ route('roles.index') }}">Rollen verwalten</a></li>

    </ul>

@endif