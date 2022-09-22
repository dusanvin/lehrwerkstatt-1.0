<!-- Nachricht schreiben -->

<script type="text/javascript">
    
    window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "smooth" });

</script>

<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}
        
    <!-- Nachrichtenbody -->

    <div class="mt-1">
                            
        <label class="block sr-only text-white">Ihre Nachricht.</label>

        <textarea name="message" cols="30" rows="8" class="py-2 px-3 bg-gray-500 text-white border-1 border-gray-500 w-full rounded-sm form-control focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent" placeholder="Ihre Nachricht.">{{ old('message') }}</textarea>        

    </div>

    <!-- Nachrichtenbody -->


    <!-- Zurück, Senden -->

    <div class="mb-4 mt-4 flex justify-between">

    <a href="{{ route('messages') }}">&#x2B9C; Zurück</a>

        <div class="my-1">

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

    <!-- Zurück, Senden -->

</form>