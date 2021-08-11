@extends('layouts.app')

@section('content')

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
                                                Name</th>

        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                E-Mail</th>

        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Rolle</th>

    </tr>

    @foreach ($data as $key => $user)

    <tr>

        <td>{{ $user->vorname }} {{ $user->nachname }}</td>

        <td>{{ $user->email }}</td>

        <td>

            @if(!empty($user->getRoleNames()))

                @foreach($user->getRoleNames() as $v)

                   <label class="badge badge-success">{{ $v }}</label>

                @endforeach

            @endif

        </td>

        <td>

            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Anzeigen</a>

            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Bearbeiten</a>

            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Löschen', ['class' => 'btn btn-danger']) !!}

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