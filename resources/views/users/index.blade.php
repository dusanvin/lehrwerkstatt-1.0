@extends('layouts.app')

@section('content')

<body style="background-color: white;">

    <div class="flex flex-row h-full mx-5 mt-10 mb-10">

      <!-- Nav -->

        @include('layouts.navigation')

        <div class="px-8 py-8 text-gray-700 w-screen bg-white rounded-r-lg shadow-b border-b border-gray-200" style="background-color: #EDF2F7;">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">

                <div class="px-4 py-5 sm:px-6">

                    <h2 class="text-lg leading-6 font-medium text-gray-900">

                        Personen

                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        Informationen und Anmerkungen zu Personen. Die Daten sind für <strong>Moderierende</strong> und <strong>Administrierende</strong> einsehbar.

                    </p>

                </div>

                <div class="float-right mb-4 mt-4 mr-4">

                    <a href="{{ route('users.create') }}" class="bg-transparent hover:bg-purple-600 text-purple-600 font-semibold text-sm hover:text-white py-2 px-4 border border-purple-600 hover:border-transparent rounded focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 flex items-center transition ease-in-out duration-150">

                        <div class="">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>

                        </div>

                        <div class="pl-3">

                            <p class="">Nutzende hinzufügen</p>

                        </div>

                    </a>

                </div>

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

                            <tr>

                                <td class="pl-6 py-4 whitespace-no-wrap border-t border-gray-200">{{ ++$i }}</td>

                                <td class="px-6 py-4 whitespace-no-wrap border-t border-gray-200">

                                        <div class="text-sm leading-5 font-medium text-gray-900">{{ $user->vorname }} {{ $user->nachname }}</div>

                                        <div class="text-sm leading-5 text-gray-500">{{ $user->email }}</div>

                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-t border-gray-200">

                                    @if(!empty($user->getRoleNames()))

                                        @foreach($user->getRoleNames() as $v)

                                           <label class="badge badge-success">{{ $v }}</label>

                                        @endforeach

                                    @endif

                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-t border-gray-200">

                                        <div class="text-sm leading-5 font-normal text-gray-900">

                                            @if($user->last_login_at === NULL)
                                                -
                                            @else

                                            {{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}

                                            @endif

                                        </div>

                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap text-right border-t border-gray-200 text-sm leading-5 font-medium">

                                    <a class="bg-transparent hover:bg-purple-600 text-purple-600 font-normal hover:text-white focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 py-2 px-4 rounded transition ease-in-out duration-150" href="{{ route('users.show',$user->id) }}">

                                        Anzeigen

                                    </a>

                                    <a class="bg-transparent hover:bg-purple-600 focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 text-purple-600 font-normal hover:text-white py-2 px-4 rounded transition ease-in-out duration-150" href="{{ route('users.edit',$user->id) }}">

                                        Bearbeiten

                                    </a>

                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}

                                    {!! Form::submit('Löschen', ['class' => 'bg-transparent hover:bg-red-500 text-red-500 font-normal hover:text-white py-2 px-4 rounded transition ease-in-out duration-150 focus:outline-none focus:ring ring-red-300 focus:border-red-300']) !!}

                                    {!! Form::close() !!}

                                </td>

                            </tr>

                        @endforeach

                    </table>

                </div>

                <div class="pb-4 px-4">

                    {!! $data->render() !!}

                </div>

            </div>

        </div>
        
    </div>

</body>

@endsection