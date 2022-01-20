<style type="text/css">
    .user-ring {
        /*background-color: #344955;*/
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

    <div class="mb-1 pb-4 border-b">

        <!-- Eine Nachricht -->

        <div class="flex justify-between">

            <!-- Name + Nachricht -->

            <div class="flex mr-2">

                <!-- Initialen -->

                <!-- Verlinkung zu Profil des Gegenübers -->

                @php

                    foreach ($thread->participantsUserIds(Auth::id()) as $user) {
                        
                        if($user != Auth::id()) {

                            $id = $user;
                            break;
                        }

                    }

                @endphp

                <!-- Verlinkung zu Profil des Gegenübers -->

                <a class="font-semibold flex-none mr-4 text-white user-ring bg-gray-700 hover:bg-gray-900 transition-all" href="{{ route('profile.details', ['id' => $id]) }}">

                    @php

                        if(!empty($thread->participantsString(Auth::id(),['vorname']))) {

                            echo $thread->participantsString(Auth::id(),['vorname'])[0] . $thread->participantsString(Auth::id(),['nachname'])[0];
                        }

                        else echo '-';

                    @endphp

                </a>

                <!-- Initialen -->

                <!-- Nachrichtenkorpus -->

                <div>

                    <a href="{{ route('messages.show', $thread->id) }}" class="text-gray-500 hover:text-black transition-all">

                        <div class="">

                            <!-- Abkürzung -->

                            <div class="flex">

                                <p class="flex-auto font-semibold leading-5 md:leading-normal mb-1 text-xs sm:text-sm line-clamp break-all">

                                    {{ $thread->participantsString(Auth::id(),['vorname', 'nachname']) }}

                                </p>

                            </div>

                            <div class="flex">

                                <div class="flex-auto font-normal leading-5 md:leading-normal mb-1 text-xs sm:text-sm">

                                    <p class="line-clamp mb-1 text-xs break-all">

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



                <!-- Nachrichtenzähler -->

                <div class="flex justify-around">

                    @if ( $thread->userUnreadMessagesCount(Auth::id()) != '0')

                    <span class="bg-green-600 text-white text-xs inline-block py-1 px-3 rounded-full text-white uppercase last:mr-0 mr-1">{{ $thread->userUnreadMessagesCount(Auth::id()) }}</span>

                    @endif

                </div>

                <!-- Nachrichtenzähler -->



            </div>

            <!-- Chatdatum + Nachrichtenzähler -->

        </div>

        <!-- Eine Nachricht -->

        <!-- <a href="{{ route('messages.show', $thread->id) }}" class="text-xs">{{ $thread->subject }}</a> -->

    </div>

</div>