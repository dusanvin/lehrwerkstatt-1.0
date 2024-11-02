<ul id="tabs" class="inline-flex w-full">

    @php
        $selected = 'border-gray-700  bg-gray-800 border-b-4 -mb-px opacity-100';
        $not_selected = 'opacity-50 bg-gray-800 border-gray-800 hover:bg-gray-600';

        $schularten = [
            'Grundschule',
            'Mittelschule',
            'Realschule',
            'Gymnasium',
        ];
    @endphp

    <li
        class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t {{ isset($schulart) ? $not_selected : $selected }}">
        <a href="{{ route($routeName) }}">Alle Schularten</a>
    </li>

    @foreach ($schularten as $_schulart)
        <li class="px-4 py-2 font-medium text-xs sm:text-sm text-gray-200 rounded-t {{ isset($schulart) && $schulart == $_schulart ? $selected : $not_selected }}">
            <a href="{{ route($routeName, ['schulart' => $_schulart]) }}">{{ $_schulart }}</a>
        </li>
    @endforeach

</ul>