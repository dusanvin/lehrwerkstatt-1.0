@extends('layouts.app')

@section('content')

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

                        Rollen - Details

                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        Betrachten Sie die Rechte, die der Rolle <strong>{{ $role->name }}</strong> zugehörig sind. Die Daten sind nur für <strong>Moderierende</strong> und <strong>Administrierende</strong> einsehbar.

                    </p>

                </div>

                <!-- Informationsanzeige -->

                <div>

                    <dl>

                        <div class="px-4 py-5 mx-2">

                            <dd class="mt-1 text-sm text-gray-500 text-white active:text-gray-1000 sm:mt-0 sm:col-span-2 flex items-center">

                                <div class="form-group select-none">

                                    <!-- Rechteverwaltung -->

                                    @if(!empty($rolePermissions))

                                        @foreach($rolePermissions as $v)

                                            @if ($v->name == 'view_users')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-black rounded-full">Nutzende: Anzeigen</span>

                                            @endif

                                            @if ($v->name == 'add_users')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-black rounded-full">Nutzende: Hinzufügen</span>

                                            @endif

                                            @if ($v->name == 'edit_users')
                                                
                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-black rounded-full">Nutzende: Bearbeiten</span>
                                                
                                            @endif

                                            @if ($v->name == 'delete_users')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-black rounded-full">Nutzende: Löschen</span>

                                            @endif

                                            @if ($v->name == 'view_needs')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-pink-600 rounded-full">Bedarfe: Anzeigen</span>

                                            @endif

                                            @if ($v->name == 'add_needs')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-pink-600 rounded-full">Bedarfe: Hinzufügen</span>

                                            @endif

                                            @if ($v->name == 'edit_needs')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-pink-600 rounded-full">Bedarfe: Bearbeiten</span>

                                            @endif

                                            @if ($v->name == 'delete_needs')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-pink-600 rounded-full">Bedarfe: Löschen</span>

                                            @endif

                                            @if ($v->name == 'view_offers')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-green-600 rounded-full">Angebote: Anzeigen</span>

                                            @endif

                                            @if ($v->name == 'add_offers')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-green-600 rounded-full">Angebote: Hinzufügen</span>

                                            @endif

                                            @if ($v->name == 'edit_offers')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-green-600 rounded-full">Angebote: Bearbeiten</span>

                                            @endif

                                            @if ($v->name == 'delete_offers')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-green-600 rounded-full">Angebote: Löschen</span>

                                            @endif

                                            @if ($v->name == 'role-list')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-yellow-600 rounded-full">Rollen: Anzeigen</span>

                                            @endif

                                            @if ($v->name == 'role-create')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-yellow-600 rounded-full">Rollen: Hinzufügen</span>

                                            @endif

                                            @if ($v->name == 'role-edit')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-yellow-600 rounded-full">Rollen: Bearbeiten</span>

                                            @endif

                                            @if ($v->name == 'role-delete')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-yellow-600 rounded-full">Rollen: Löschen</span>

                                            @endif

                                            @if ($v->name == 'view-stats')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-indigo-600 rounded-full">Seiten: Statistiken</span>

                                            @endif

                                            @if ($v->name == 'view-persons')

                                                <span class="inline-flex items-center justify-center px-3 py-2 mr-2 my-1 text-xs font-medium leading-none text-white bg-indigo-600 rounded-full">Seiten: Verwaltung</span>

                                            @endif

                                        @endforeach

                                    @endif

                                </div>

                            </dd>

                        </div>

                    </dl>

                </div>

                <!-- Informationsanzeige -->

                <!-- Zurück -->

                <div class="block px-2">

                    <div class="mb-4 mt-4 mx-4 float-left">

                        <a href="{{ route('roles.index') }}" class="bg-transparent hover:bg-purple-600 text-purple-600 font-semibold text-sm hover:text-white focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 py-2 pr-4 pl-4 border border-purple-600 hover:border-transparent rounded flex items-center transition ease-in-out duration-150">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
                            </svg>                           

                            <p class="pl-3">Zurück</p>

                        </a>

                    </div>

                </div>

                <!-- Zurück -->

            </div>

        </div>

    </div>

</body>

@endsection