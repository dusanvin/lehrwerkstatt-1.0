<div class="px-1 md:px-8 py-1 md:py-8 text-gray-700 w-screen rounded-r-lg" style="background-color: #EDF2F7;">

    <div class="overflow-hidden sm:rounded-lg">

        <div class="">

            <h2 class="text-lg leading-6 font-medium text-gray-900">

                Nachrichten

            </h2>

            <p class="mt-1 text-sm text-gray-500">

                Schreiben Sie eine neue Nachricht.

            </p>

        </div>

        <!-- Fehlermeldung -->

        <div class="px-4 py-4 pb mx-auto mt-6 bg-white rounded-md">

            <div class="grid justify-items-center md:justify-items-end">

                <div class="float-right mb-4 mt-4">

                    <a href="/messages/create" class="bg-transparent bg-purple-600 hover:bg-purple-800 text-white text-xs font-semibold py-2 px-4 uppercase tracking-wide border border-purple-600 hover:border-transparent rounded focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 flex items-center transition ease-in-out duration-150 disabled:opacity-25">

                        <div class="">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>

                        </div>

                        <div class="pl-3">

                            <span class="text-xs">Neue Nachricht</span>

                        </div>

                    </a>

                </div>

            </div>

            <!-- Inhalt 2 -->

            <form action="{{ route('messages.store') }}" method="post">

                {{ csrf_field() }}

                <div class="col-md-6">


                    <!-- Search User -->

                    <div class="mt-1">

                        <script>
                            function setReceiver(id) {
                                console.log(id);
                                // document.getElementById('receiver').value = id;
                                // document.getElementById('receiver-list').innerHTML = document.getElementById(id).innerHTML;
                                @this.receivers = document.getElementById(id).innerHTML;
                                @this.receiverids = id;
                                @this.search = '';
                            }
                        </script>

                        <label class="border border-gray-100 bg-gray-100 rounded">An:{{ $receivers }}</label>
                        <form>

                            <input id="search" wire:model="search" type="text" placeholder="Suche nach Nutzer..." class="border border-gray-100 bg-gray-100 w-full rounded form-control form-input">

                        </form>

                        @if($users && $users->count() > 0)
                        <ul class="py-2 px-3 bg-gray-100 list-group absolute bg-white rounded">

                            <div class="block relative w-full mt-1">
                                <div class="select-group block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">

                                    @foreach($users as $user)

                                    <li id={{ $user->id }} onclick=setReceiver(this.id)>{{ $user->vorname }} {{ $user->nachname }} ({{ $user->id }})</li>

                                    @endforeach
                                </div>
                            </div>


                            @endif

                        </ul>

                    </div>

                    <br>

                    <!-- Search User -->


                    <!-- Subject Form Input -->

                    <div class="mt-1">

                        <label class="block sr-only">Ihr Betreff.</label>

                        <input class="py-2 px-3 bg-gray-100 border-1 w-full rounded-sm form-control form-input" placeholder="Ihr Betreff." value="{{ old('subject') }}" name="subject">

                    </div>

                    <!-- Message Form Input -->

                    <div class="mt-1">

                        <label class="block sr-only">Ihre Nachricht.</label>

                        <textarea name="message" cols="30" rows="8" class="py-2 px-3 bg-gray-100 border-1 border-gray-100 w-full rounded-sm form-control focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent" placeholder="Ihre Nachricht.">{{ old('message') }}</textarea>

                    </div>

                    <div class="mt-1 pb-6">


                        <input id="receiver" type="hidden" name="recipients[]" value="{{ $receiverids }}"></input>

                    </div>

                    <!-- Zurück -->

                    <div class="grid sm:flex sm:justify-between mb-4 mt-4 justify-center">

                        <div class="flex my-1 justify-center">

                            <a href="{{ route('messages') }}" class="bg-transparent bg-purple-600 hover:bg-purple-800 text-white text-xs font-semibold py-2 px-4 uppercase tracking-wide border border-purple-600 hover:border-transparent rounded focus:outline-none focus:ring ring-purple-300 focus:border-purple-300 flex items-center justify-center transition ease-in-out duration-150 disabled:opacity-25">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-none " viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
                                </svg>

                                <p class="pl-3">

                                    <span class="">Zurück</span>

                                </p>

                            </a>

                        </div>

                        <div class="my-1 justify-center">

                            <button type="submit" class="bg-transparent bg-green-600 hover:bg-green-800 text-white text-xs font-semibold py-2 px-4 uppercase tracking-wide border border-green-600 hover:border-transparent rounded focus:outline-none focus:ring ring-green-300 focus:border-green-300 flex items-center transition ease-in-out duration-150 disabled:opacity-25">

                                <div class="">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                    </svg>

                                </div>

                                <div class="pl-3">

                                    <span class="">Nachricht senden</span>

                                </div>

                            </button>

                        </div>

                    </div>

                </div>

                <!-- Zurück -->

        </div>

        </form>

        <!-- Inhalt 2 -->

    </div>

</div>