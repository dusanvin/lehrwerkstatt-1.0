<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="media alert {{ $class }} mb-2 bg-white rounded-md px-4 py-4">

    <a href="{{ route('messages.show', $thread->id) }}" class="">

        <div>

            <div class="flex">

                <p class="flex-auto font-medium">
                    
                    {{ $thread->participantsString(Auth::id(),['vorname', 'nachname']) }}

                </p>

                <p class="flex-initial">
                    
                    @if ( $thread->userUnreadMessagesCount(Auth::id())  != '0')

                        <span class="bg-green-600 text-white text-xs inline-block py-1 px-3 rounded-full text-white uppercase last:mr-0 mr-1">{{ $thread->userUnreadMessagesCount(Auth::id()) }}</span>

                    @endif

                </p>

            </div>

            <p>    

                <span class="text-xs text-gray-400">{{ $thread->latestMessage->body }}</span>
            
            </p>
            
            <!-- <a href="{{ route('messages.show', $thread->id) }}" class="text-xs">{{ $thread->subject }}</a> -->

        </div>


            
    </a>


        </div>



    <!--<p>

         <small><strong>Abgesandt durch:</strong> {{ $thread->creator()->vorname }}</small>

    </p> -->

