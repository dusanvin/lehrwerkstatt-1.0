<style type="text/css">

    .user-ring {
        background-color: #344955;
        width: 55px;
        line-height: 55px;
        border-radius: 50%;
        text-align: center;
    }

    .line-clamp {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
    }

</style>


<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="media alert {{ $class }} pb-2 px-1 sm:px-4">

        <div class="mb-2 px-2 pb-2 border-b">

            <!-- Abkürzung -->

            <div class="flex">

                <div class="flex">

                    <div class="font-semibold mr-4 text-white user-ring">

                        @php

                            $firstName = ($thread->participantsString(Auth::id(),['vorname']))[0];
                            $lastName = ($thread->participantsString(Auth::id(),['nachname']))[0];

                            $iniName = $firstName . $lastName;

                            echo $iniName;

                        @endphp
                        
                    </div>

                </div>

                <a href="{{ route('messages.show', $thread->id) }}">

                <div>

                <!-- Abkürzung -->

                    <div class="flex">

                        <p class="flex-auto font-medium leading-5 md:leading-normal mb-1 text-xs sm:text-sm">
                            
                            {{ $thread->participantsString(Auth::id(),['vorname', 'nachname']) }}

                        </p>

                        <!-- <p class="flex-initial text-sm text-gray-400">
                            
                            <small>{{ $thread->latestMessage->created_at->diffForHumans() }}</small>

                        </p> -->

                    </div>

                    <div class="flex">

                        <div class="flex-auto font-normal leading-5 md:leading-normal mb-1 text-xs sm:text-sm">
                            
                            <p class="line-clamp mb-1 text-gray-400 text-xs">    

                                {{ $thread->latestMessage->body }}
                            
                            </p>

                        </div>

                        <p class="flex-initial">
                            
                            @if ( $thread->userUnreadMessagesCount(Auth::id())  != '0')

                                <span class="bg-green-600 text-white text-xs inline-block py-1 px-3 rounded-full text-white uppercase last:mr-0 mr-1">{{ $thread->userUnreadMessagesCount(Auth::id()) }}</span>

                            @endif

                        </p>

                    </div>

                </div>

            </div>    
            
            <!-- <a href="{{ route('messages.show', $thread->id) }}" class="text-xs">{{ $thread->subject }}</a> -->

        </div>

    </a>

</div>



    <!--<p>

         <small><strong>Abgesandt durch:</strong> {{ $thread->creator()->vorname }}</small>

    </p> -->

