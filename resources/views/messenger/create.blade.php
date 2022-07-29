@extends('layouts.master')

@section('content')

<head>
    @livewireStyles
</head>


<body class="bg-gray-500">
    @livewireScripts

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

        <livewire:message />


    </div>

    </div>

</body>

@endsection