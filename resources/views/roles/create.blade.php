@extends('layouts.app')

@section('content')

<style type="text/css">
    [type="text"], select {
        border-width: 0 !important;
    }
    [type="text"]:focus, select:focus {
        border-width: 0 !important;
        border-color: white !important;
        --tw-ring-color: white !important;
        border-bottom-color: black !important;
    }
</style>

<body style="background-color: white;">

    <div class="flex flex-row h-full mx-5 mt-10 mb-10">

      <!-- Nav -->

        @include('layouts.navigation')

        <div class="px-8 py-8 text-gray-700 w-screen bg-white rounded-r-lg shadow-b border-b border-gray-200" style="background-color: #EDF2F7;">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">

                <!-- Navbar für Admin -->

                @include('layouts.admin_navigation_roles')

                <!-- Navbar für Admin -->

                <div class="px-4 py-5 sm:px-6">

                    <h2 class="text-lg leading-6 font-medium text-gray-900">

                        Rollen - Anlegen

                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        Legen Sie eine neue Rolle an. <span class="text-red-500">Dieser Bereich ist nur für <strong>Administrierende</strong> einsehbar.</span>

                    </p>

                </div>

                <div class="min-width-full block">

                    @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                    @endif

                    <div>

                        <!-- Fehlerbehandlung -->

                        @if (count($errors) > 0)

                          <div class="alert alert-danger">

                            <ul>

                               @foreach ($errors->all() as $error)

                                <li class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-400">

                                <span class="text-xl inline-block mr-2 align-middle">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">

                                      <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />

                                    </svg>

                                </span>

                                <span class="inline-block align-middle">

                                    {{ $error }}

                                </span>

                                <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">

                                <span>×</span>

                                </button>

                            </li>

                               @endforeach

                            </ul>

                          </div>

                        @endif

                        <!-- Fehlerbehandlung -->

                        <!-- Informationsanzeige sowie -bearbeitung -->

                        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}

                        <div>

                            <dl>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                      Legen Sie den <strong>Namen</strong> der Rolle fest

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white hover:text-gray-900 active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center border-b-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                          <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                          <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>

                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'w-full px-2 py-2 ml-2 border-b-2 border-gray-200 focus:outline-none focus:text-gray-900 transition ease-in-out duration-500')) !!}

                                    </dd>

                                </div>

                                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                    <dt class="text-sm font-medium text-gray-500 py-2">

                                      <strong>Weisen</strong> Sie der Person eine <strong>Rolle</strong> zu

                                    </dt>

                                    <dd class="mt-1 text-sm text-gray-500 text-white active:text-gray-1000 sm:mt-0 sm:col-span-2">

                                        @foreach($permission as $value)

                                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}

                                                {{ $value->name }}

                                            </label>

                                        <br/>

                                        @endforeach

                                    </dd>

                                </div>

                            </dl>

                        </div>

                        <!-- Informationsanzeige sowie -bearbeitung -->

                        <!-- Zurück oder Bestätigen -->

                        <div class="block mx-2">

                            <div class="mb-4 mt-4 mx-4 float-left">

                                <a href="{{ route('roles.index') }}" class="bg-transparent hover:bg-purple-600 text-purple-600 font-semibold text-sm hover:text-white focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 py-2 pr-4 pl-3 border border-purple-600 hover:border-transparent rounded flex items-center transition ease-in-out duration-150">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>

                                    <p class="pl-3">Abbrechen</p>

                                </a>

                            </div>

                            <div class="mb-4 mt-4 mx-4 float-right">

                                <button type="submit" class="bg-transparent hover:bg-green-600 text-green-600 font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-green-600 hover:border-transparent focus:outline-none focus:ring ring-green-300 focus:border-green-300 rounded flex items-center transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                            
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />

                                    </svg>Änderungen bestätigen

                                </button>

                            </div>

                        </div>

                        <!-- Zurück oder Bestätigen -->

                        {!! Form::close() !!}

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

@endsection