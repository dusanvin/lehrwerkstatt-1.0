@extends('layouts.app')

@section('content')

<body style="background-color: white;">

    <div class="flex flex-row h-full mx-5 mt-10 mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

        <div class="px-8 py-8 text-gray-700 w-screen bg-white rounded-r-lg shadow-b border-b border-gray-200" style="background-color: #EDF2F7;">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">

                <!-- Navbar für Admin -->

                @include('layouts.admin_navigation_users')

                <!-- Navbar für Admin -->

                <div class="px-4 py-5 sm:px-6">

                    <h2 class="text-lg leading-6 font-medium text-gray-900">

                        Personen

                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        Informationen und Anmerkungen zu Personen. Die Daten sind für <strong>Moderierende</strong> und <strong>Administrierende</strong> einsehbar.

                    </p>

                </div>

                @can('add_users')

                <div class="float-right mb-4 mt-4 mr-4">

                    <a href="{{ route('users.create') }}" class="bg-transparent bg-purple-600 hover:bg-purple-800 text-white font-semibold text-sm py-2 px-4 border border-purple-600 hover:border-transparent rounded focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 flex items-center transition ease-in-out duration-150">

                        <div class="">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>

                        </div>

                        <div class="pl-3">

                            <p class="">Nutzende hinzufügen</p>

                        </div>

                    </a>

                </div>

                @endcan

                @if ($message = Session::get('success'))

                    <!--<p>{{ $message }}</p>-->
                    <div class="text-white px-6 py-4 mx-4 border-0 rounded relative mb-4 bg-green-600">

                        <span class="text-xl inline-block mr-2 align-middle">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                              <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />

                            </svg>

                        </span>

                        <span class="inline-block align-middle">

                            <b>Aktion erfolgreich ausgeführt.</b>

                            <!-- 53:33 -->

                        </span>

                        <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">

                        <span>×</span>

                        </button>

                    </div>

                @endif

                <div class="px-4">

                    <table class="min-w-full my-4 mr-4 shadow-sm rounded-lg">

                        <tr>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider rounded-tl-md">
                                                                    #</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                    Name</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                    Rolle</th>

                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                    Letzter Login</th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider rounded-tr-md">
                                                                    </th>

                        </tr>

                        @foreach ($data as $key => $user)

                            <tr class="border-t border-gray-200">

                                <td class="pl-6 py-4 whitespace-no-wrap ">{{ ++$i }}</td>

                                <td class="px-6 py-4 whitespace-no-wrap">

                                        <div class="text-sm leading-5 font-medium text-gray-900">{{ $user->vorname }} {{ $user->nachname }}</div>

                                        <div class="text-sm leading-5 text-gray-500">{{ $user->email }}</div>

                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap select-none">

                                    @if(!empty($user->getRoleNames()))

                                        @foreach($user->getRoleNames() as $v)

                                            @if ($v == 'Admin')

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-red-600 rounded-full">Administration</label>

                                            @elseif ($v == 'Moderierende')

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-pink-600 rounded-full">Moderation</label>

                                            @elseif ($v == 'Helfende')

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-indigo-600 rounded-full">Hilfe</label>

                                            @elseif ($v == 'Lehrende')

                                                <label class="inline-flex items-center justify-center px-3 py-2 mr-2 text-xs font-medium leading-none text-white bg-yellow-600 rounded-full">Suche</label>

                                            @endif

                                        @endforeach

                                    @endif

                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap">

                                        <div class="text-sm leading-5 font-normal text-gray-900 select-none">

                                            @if($user->last_login_at === NULL)
                                                Ausstehend
                                            @else

                                            {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}

                                            @endif

                                        </div>

                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">

                                    <a class="bg-transparent hover:bg-purple-600 text-purple-600 font-normal hover:text-white focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 py-2 px-4 rounded transition ease-in-out duration-150" href="{{ route('users.show',$user->id) }}">

                                        Anzeigen

                                    </a>

                                    <a class="bg-transparent hover:bg-purple-600 text-purple-600 font-normal hover:text-white focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 py-2 px-4 rounded transition ease-in-out duration-150" href="{{ route('users.edit',$user->id) }}">

                                        Bearbeiten

                                    </a>

                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}

                                    {!! Form::submit('Löschen', ['class' => 'bg-transparent hover:bg-red-500 text-red-500 font-normal hover:text-white py-2 px-4 ml-6 rounded transition ease-in-out duration-150 focus:outline-none focus:ring ring-red-300 focus:border-red-300']) !!}

                                    {!! Form::close() !!}

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

                    <div class="flex items-center">

                        <div class="text-gray-900">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 20 20" fill="currentColor">

                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />

                            </svg>

                        </div>

                        <div class="pl-5">

                            <p class="mt-1 text-xs text-gray-500">

                                <strong>Administration:</strong> Alle Rechte.

                            </p>

                            <p class="mt-1 text-xs text-gray-500">

                                <strong>Moderation:</strong> Darf Nutzende anlegen, bearbeiten und löschen. Hat Zugriff auf alle relevanten Seiten.

                            </p>

                            <p class="mt-1 text-xs text-gray-500">

                                <strong>Hilfe:</strong> Hat Zugriff auf die Bereiche <em>Angebote</em>, <em>Bedarfe</em> und alle nutzerrelevanten Seiten. Darf Angebote erstellen und auf Bedarfe eingehen.

                            </p>

                            <p class="mt-1 text-xs text-gray-500">

                                <strong>Suche:</strong> Hat Zugriff auf die Bereiche <em>Angebote</em>, <em>Bedarfe</em> und alle nutzerrelevanten Seiten. Darf Bedarfe erstellen und auf Angebote eingehen.

                            </p>

                        </div>

                    </div>

                </div>

                <!-- Hinweis -->

            </div>

        </div>
        
    </div>

</body>

@endsection