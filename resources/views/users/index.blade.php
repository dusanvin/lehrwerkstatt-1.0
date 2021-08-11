@extends('layouts.app')

@section('content')

<?php 

    $date = auth()->user()->created_at;
    $time = $date;
    $time = date("H:i");
    $date = date("d.m.y"); 

?>

<body style="background-color: white;">

    <div class="flex flex-row h-full ml-20 mr-20 mt-10 mb-10">

      <!-- Nav -->

        @include('layouts.navigation')

                    <div class="px-8 py-8 text-gray-700 w-screen bg-white rounded-r-lg shadow-b border-b border-gray-200" style="background-color: #EDF2F7;">

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Users Management</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>

        </div>

    </div>

</div>


@if ($message = Session::get('success'))

<div class="alert alert-success">

  <p>{{ $message }}</p>

</div>

@endif


<table class="min-w-full">

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