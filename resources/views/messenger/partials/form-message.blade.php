<!-- Nachricht schreiben -->

<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}
        
    <!-- Nachrichtenbody -->

    <div class="mt-1">
                            
        <label class="block sr-only">Ihre Nachricht.</label>

        <textarea name="message" cols="30" rows="8" class="py-2 px-3 bg-white text-gray-600 border-1 border-gray-100 w-full rounded-sm form-control focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent" placeholder="Ihre Nachricht.">{{ old('message') }}</textarea>        

    </div>

    <!-- Nachrichtenbody -->

    <!-- <h2>Gesprächsbeteiligte hinzufügen</h2>

    @if($users->count() > 0)
        <div class="checkbox">
            @foreach($users as $user)
                <label title="{{ $user->name }}">
                    <input type="checkbox" name="recipients[]" value="{{ $user->id }}">{{ $user->name }}
                </label>
            @endforeach
        </div>
    @endif -->

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
</form>