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

    <div class="mb-1 px-2 pb-4 border-b">

        <!-- Eine Nachricht -->

        <div class="flex justify-between">

            <!-- Name + Nachricht -->

            <div class="flex mr-2">

                <!-- Initialen -->

                <div class="font-semibold flex-none mr-4 text-white user-ring">

                    @php

                        if(!empty($thread->participantsString(Auth::id(),['vorname']))) {

                            $firstName = ($thread->participantsString(Auth::id(),['vorname']))[0];
                            $lastName = ($thread->participantsString(Auth::id(),['nachname']))[0];

                            $iniName = $firstName . $lastName;

                            echo $iniName;
                        }

                        else echo '-';

                    @endphp
                    
                </div>

                <!-- Initialen -->

                <!-- Nachrichtenkorpus -->

                <div>
                    
                    <a href="{{ route('messages.show', $thread->id) }}">

                        <div class="">

                        <!-- Abkürzung -->

                            <div class="flex">

                                <p class="flex-auto font-medium leading-5 md:leading-normal mb-1 text-xs sm:text-sm line-clamp break-all">
                                    
                                    {{ $thread->participantsString(Auth::id(),['vorname', 'nachname']) }}

                                </p>

                            </div>

                            <div class="flex">

                                <div class="flex-auto font-normal leading-5 md:leading-normal mb-1 text-xs sm:text-sm">
                                    
                                    <p class="line-clamp mb-1 text-gray-400 text-xs break-all">    

                                        {{ $thread->latestMessage->body }}
                                    
                                    </p>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>

                <!-- Nachrichtenkorpus -->
                
            </div>

            <!-- Name + Nachricht -->            

            <!-- Chatdatum + Nachrichtenzähler -->

            <div>

                <div>

                    <!-- Chatdatum -->
                    
                    <div class="hidden sm:flex ">
                        
                        <p class="flex-initial text-xs sm:text-sm text-gray-400 font-medium leading-5 md:leading-normal mb-1">
                                    
                            <small>{{ $thread->latestMessage->created_at->diffForHumans() }}</small>

                        </p>

                    </div>

                    <!-- Chatdatum -->

                    <!-- Nachrichtenzähler -->

                    <div class="flex justify-around">

                        @if ( $thread->userUnreadMessagesCount(Auth::id())  != '0')

                            <span class="bg-green-600 text-white text-xs inline-block py-1 px-3 rounded-full text-white uppercase last:mr-0 mr-1">{{ $thread->userUnreadMessagesCount(Auth::id()) }}</span>

                        @endif
                        
                    </div>

                    <!-- Nachrichtenzähler -->

                </div>

            </div>

            <!-- Chatdatum + Nachrichtenzähler -->

        </div>

        <!-- Eine Nachricht -->    
        
        <!-- <a href="{{ route('messages.show', $thread->id) }}" class="text-xs">{{ $thread->subject }}</a> -->

    </div>

</div>