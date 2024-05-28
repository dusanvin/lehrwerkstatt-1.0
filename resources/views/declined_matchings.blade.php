@extends ('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

    <!-- Nav -->

    @include('layouts.navigation')

    <!-- Nav -->

    <!-- Content -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

        <div class="mx-auto rounded">

            <!-- Übernommene Vorschläge -->

            <h1 class="font-semibold text-2xl text-gray-200">

                Abgelehnte Tandems

            </h1>

            <div class="mt-1 mb-6 text-sm text-gray-300 grid text-center sm:text-left block">

                <p class="block mb-4">Hier erhalten Sie eine Übersicht von allen abgelehnten Tandems.</p>

            </div>

            <!-- Übernommene Vorschläge -->

            <div class="bg-gray-800 px-1 md:px-8 py-1 md:py-8 rounded-md">

                <table class="min-w-full mt-4 mb-2 mr-4 shadow-sm rounded-lg">

                    <tbody>

                        <tr>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tl-md font-bold">
                                Abgelehnt von</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Rolle</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Schulart</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider font-bold">
                                Begründung</th>

                            <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-700 text-left text-xs leading-4 font-medium text-gray-400 uppercase tracking-wider rounded-tr-md font-bold">
                                Vorgeschlagen</th>

                        </tr>

                        @foreach($declined_matchings as $declined_matching)

                        <tr class="border-t border-gray-200 bg-gray-700">

                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="text-xs sm:text-sm leading-5 font-medium text-white">{{ $declined_matching[0] }}</div>
                                <a href="mailto:{{ $declined_matching[1] }}" class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $declined_matching[1] }}</a>
                            </td>

                            <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                {{ $declined_matching[2] }}

                            </td>

                            <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                {{ $declined_matching[3] }}

                            </td>

                            <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap text-gray-100">

                                {{ $declined_matching[4] }}

                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="text-xs sm:text-sm leading-5 font-medium text-white">{{ $declined_matching[5] }}</div>
                                <a href="mailto:{{ $declined_matching[6] }}" class="text-xs sm:text-sm leading-5 text-gray-400 hover:text-gray-100 break-words">{{ $declined_matching[6] }}</a>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <!-- Übernommene Vorschläge -->

        </div>

    </div>

</div>

<!-- Weitere Vorschläge -->

</div>

</div>

</div>

<!-- Content -->

@endsection