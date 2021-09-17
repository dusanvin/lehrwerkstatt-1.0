








@extends('layouts.master')

@section('content')


<body>

    <div class="flex flex-row h-full mx-0 sm:mx-5 mt-1 sm:mt-10 mb-1 sm:mb-10">

        <!-- Nav -->

        @include('layouts.navigation')

        <!-- Nav -->

        	<!-- Inhalt -->

            <div class="px-3 sm:px-8 py-8 text-gray-700 w-screen sm:rounded-r-lg" style="background-color: #EDF2F7;">

            	<!-- Header -->

                <div class="overflow-hidden sm:rounded-lg">

                    <div class="">

                        <h2 class="text-lg leading-6 font-medium text-gray-900">

                        Gesprächsverlauf

                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        {{ $thread->subject }}

                    </p>

                </div>

                <!-- Header -->

                <!-- Main -->

                <div class="px-4 py-4 pb mx-auto mt-6 rounded-md">

                    <!-- Nachrichten -->

                    

                    @foreach ($thread->messages as $message)

                    	<div class="mb-2 grid grid-cols-3 gap-4">
                    		
                    	

                    	<!--Creator: {{ Auth::id() }}<br>

                    	Vorname: {{ $message->user_id }}<br> -->

                    	

	                    	@if( Auth::id() == $message->user_id )

	                    		<div class="px-4 py-4 col-start-2 col-end-4 rounded-tl-2xl rounded-bl-2xl rounded-br-2xl bg-white">
	                    			
	                    			@include('messenger.partials.messages', $message)

	                    		</div>

	                    	@elseif ( Auth::id() != $message->user_id )
	                    		
	                    		<div class="px-4 py-4 col-start-1 col-end-3 rounded-tr-2xl rounded-bl-2xl rounded-br-2xl text-white" style="background-color: #3A4049;">
	                    			
	                    			@include('messenger.partials.messages', $message)

	                    		</div>

	                    	@endif

	                    	</div>

                    @endforeach

                    <!-- Nachrichten -->

                    <!-- Nachricht schreiben -->

                    @include('messenger.partials.form-message')

                    <!-- Nachricht schreiben -->

                </div>

                <!-- Main -->

            </div>

        </div>

        <!-- Inhalt -->

    </div>

</body>

@endsection