@extends('layouts.app')

@section('content')



<body style="background-color: white;">

    <div class="flex flex-row h-full ml-20 mr-20 mt-10 mb-10">

      <!-- Nav -->

        @include('layouts.navigation')

        <div class="px-8 py-8 text-gray-700 w-screen bg-white rounded-r-lg shadow-b border-b border-gray-200" style="background-color: #EDF2F7;">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">

                <div class="px-4 py-5 sm:px-6">

                    <h2 class="text-lg leading-6 font-medium text-gray-900">

                        Statistiken

                    </h2>

                    <p class="mt-1 max-w-2xl text-sm text-gray-500">

                        Nutzungsstatistiken des Portals.

                    </p>

                </div>

                <div class="float-right mb-8 mt-4 mr-8">

                    <a href="{{ route('users.create') }}" class="bg-transparent hover:bg-purple-600 text-purple-600 font-semibold text-sm hover:text-white py-2 px-4 border border-purple-600 hover:border-transparent rounded flex items-center">

                        <div class="">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>

                        </div>

                        <div class="pl-3">

                            <p class="">Nutzende hinzufügen</p>

                        </div>

                    </a>

                </div>


@if ($message = Session::get('success'))

<div class="alert alert-success">

  <p>{{ $message }}</p>

</div>

@endif


<table class="min-w-full mt-4">

    <tr>

        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                #</th>

        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Name</th>

        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Rolle</th>

                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Registrierung</th>

        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                </th>

    </tr>

    @foreach ($data as $key => $user)

        <tr>

            <td class="pl-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ ++$i }}</td>

            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                    <div class="text-sm leading-5 font-medium text-gray-900">{{ $user->vorname }} {{ $user->nachname }}</div>

                    <div class="text-sm leading-5 text-gray-500">{{ $user->email }}</div>

            </td>

            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                @if(!empty($user->getRoleNames()))

                    @foreach($user->getRoleNames() as $v)

                       <label class="badge badge-success">{{ $v }}</label>

                    @endforeach

                @endif

            </td>

            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                    <div class="text-sm leading-5 font-normal text-gray-900">{{  $user->created_at->diffForHumans() }}</div>

            </td>

            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">

                <a class="bg-transparent hover:bg-purple-600 text-purple-600 font-normal hover:text-white py-2 px-4 rounded" href="{{ route('users.show',$user->id) }}">

                    Anzeigen

                </a>

                <a class="bg-transparent hover:bg-purple-600 text-purple-600 font-normal hover:text-white py-2 px-4 rounded" href="{{ route('users.edit',$user->id) }}">

                    Bearbeiten

                </a>

                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}

                {!! Form::submit('Löschen', ['class' => 'bg-transparent hover:bg-red-500 text-red-500 font-normal hover:text-white py-2 px-4 rounded']) !!}

                {!! Form::close() !!}

            </td>

        </tr>

    @endforeach

</table>


{!! $data->render() !!}

</div>
</div>
</div>
</body>

@endsection