@extends('layouts.app')

@section('content')

<body style="background-color: white;">

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

    <div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen sm:rounded-r-lg bg-gray-900">

        <div class="mx-auto rounded">

                <!-- Navbar für Admin -->

                @include('layouts.admin_navigation_users')

                <!-- Navbar für Admin -->

                <div class="bg-white">

                    <div class="px-4 py-5 sm:px-6">

                        <h2 class="text-lg leading-6 font-medium text-gray-900">

                            Personen

                        </h2>

                        <p class="mt-1 text-sm text-gray-500">

                            Informationen und Anmerkungen zu Personen. Die Daten sind für <strong>Moderierende</strong> und <strong>Administrierende</strong> einsehbar.

                        </p>

                    </div>

                    <!-- 

                    @can('add_users')

                    <div class="float-right mb-4 mt-4 mr-4">

                        <a href="{{ route('users.create') }}" class="bg-transparent bg-purple-600 hover:bg-purple-800 text-white font-semibold text-sm py-2 px-4 border border-purple-600 hover:border-transparent rounded focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 flex items-center transition ease-in-out duration-150">

                            <div class="">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>

                            </div>

                            <div class="pl-3">

                                <p class="">Nutzende hinzufügen</p>

                            </div>

                        </a>

                    </div>

                    @endcan -->

                    <!-- Success Message -->

                    <script>
                        function removemessage() {
                            document.getElementById('success_message').remove();
                        }
                    </script>

                    @if ($message = Session::get('success'))

                    <div class="text-white px-6 py-4 mx-4 border-0 rounded relative mb-4 bg-green-600" id="success_message">

                        <span class="text-xl inline-block mr-2 align-middle">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />

                            </svg>

                        </span>

                        <span class="inline-block align-middle">

                            <b>Aktion erfolgreich ausgeführt.</b>

                        </span>

                        <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="removemessage()">

                            <span>×</span>

                        </button>

                    </div>

                    @endif

                    <!-- Success Message -->

                    <div class="px-4">

                        <table class="min-w-full my-4 mr-4 shadow-sm rounded-lg">

                            <tr>

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider rounded-tl-md">
                                    #</th>

                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Rolle</th>

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Letzter Login</th>

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider rounded-tr-md">
                                </th>

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider rounded-tr-md">
                                </th>

                                <th class="hidden sm:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider rounded-tr-md">
                                </th>

                            </tr>

                            @foreach ($data as $key => $user)

                            <tr class="border-t border-gray-200">

                                <td class="hidden sm:table-cell text-sm pl-6 py-4 whitespace-no-wrap ">{{ ++$i }}</td>

                                <td class="px-6 py-4 whitespace-no-wrap">

                                    <div class="text-xs sm:text-sm leading-5 font-medium text-gray-900">{{ $user->vorname }} {{ $user->nachname }}</div>

                                    <div class="text-xs sm:text-sm leading-5 text-gray-500">{{ $user->email }}</div>

                                </td>

                                <td class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap select-none">

                                            @if (ucfirst($user->role) == 'Admin')

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-red-600 rounded-full">Administration</label>

                                            @elseif (ucfirst($user->role) == 'Moderierende')

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-pink-600 rounded-full">Moderation</label>

                                            @elseif (ucfirst($user->role) == 'Stud')

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-indigo-600 rounded-full">Hilfe</label>

                                            @elseif (ucfirst($user->role) == 'Lehr')

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-yellow-600 rounded-full">Lehre</label>

                                            @endif

                                </td>

                                <td class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap">

                                    <div class="text-sm leading-5 font-normal text-gray-900 select-none">

                                        @if($user->last_login_at === NULL)
                                        Ausstehende Bestätigung
                                        @else

                                        {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}

                                        @endif

                                    </div>

                                </td>

                                <td class="hidden sm:table-cell py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">

                                    <!-- Person anzeigen -->

                                    <form action="{{ route('users.show',$user->id) }}" method="get">

                                        @csrf

                                        <button type="submit" class="py-2 px-2 rounded-full bg-gray-700 text-white hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300 text-sm focus:outline-none mx-1 transition ease-in-out duration-150 justify-items-end has-tooltip">

                                            <div class="grid justify-items-center">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />

                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />

                                                </svg>

                                                <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Anzeigen</span>

                                            </div>

                                        </button>

                                    </form>

                                    <!-- Person anzeigen -->

                                </td>

                                <td class="hidden sm:table-cell py-4 whitespace-no-wrap text-left text-sm leading-5 font-medium">

                                    <!-- Person bearbeiten -->

                                    <form action="{{ route('users.edit',$user->id) }}" method="get">

                                        @csrf

                                        <button type="submit" class="py-2 px-2 rounded-full bg-gray-700 text-white hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300 text-sm focus:outline-none mx-1 transition ease-in-out duration-150  has-tooltip">

                                            <div class="grid justify-items-center">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />

                                                </svg>

                                                <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Bearbeiten</span>

                                            </div>

                                        </button>

                                    </form>

                                    <!-- Person bearbeiten -->

                                </td>

                                <td class="hidden sm:table-cell px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">

                                    <!-- Löschen -->

                                    <form action="{{ route('users.destroy', $user->id) }}" method="post">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="py-2 px-2 rounded-full bg-gray-700 text-white hover:bg-gray-900 hover:ring ring-gray-300 border-2 border-white hover:border-gray-300 text-sm flex focus:outline-none mx-1 transition ease-in-out duration-150 has-tooltip">

                                            <div class="grid justify-items-center">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>

                                                <span class='tooltip rounded p-1 px-2 bg-gray-900 text-white -mt-10 text-xs'>Löschen</span>

                                            </div>

                                        </button>

                                    </form>

                                    <!-- Löschen -->

                                </td>

                            </tr>

                            @endforeach

                        </table>

                    </div>

                    <div class="pb-4 px-4">

                        {!! $data->render() !!}

                    </div>

                    <!-- Hinweis -->

                    <div class="px-4 py-5 sm:px-6">

                        <div class="hidden sm:flex items-center">

                            <div class="text-gray-900">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 20 20" fill="currentColor">

                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />

                                </svg>

                            </div>

                            <div class="pl-5">

                                <p class="mt-1 text-xs text-gray-500">

                                    <strong>Moderation:</strong> Darf Nutzende anlegen, bearbeiten und löschen. Hat Zugriff auf alle relevanten Seiten.

                                </p>

                                <p class="mt-1 text-xs text-gray-500">

                                    <strong>Hilfe:</strong> Hat Zugriff auf die Bereiche <em>Angebote</em>, <em>Bedarfe</em> und alle nutzerrelevanten Seiten. Darf Angebote erstellen und auf Bedarfe eingehen.

                                </p>

                                <p class="mt-1 text-xs text-gray-500">

                                    <strong>Lehre:</strong> Hat Zugriff auf die Bereiche <em>Angebote</em>, <em>Bedarfe</em> und alle nutzerrelevanten Seiten. Darf Bedarfe erstellen und auf Angebote eingehen.

                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- Hinweis -->

                </div>

            </div>

        </div>

    </div>

</body>

@endsection