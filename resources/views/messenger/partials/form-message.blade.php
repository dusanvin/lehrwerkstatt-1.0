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

    <a href="{{ route('messages') }}" class="text-yellow-500 hover:text-yellow-600 hover:underline">&#x2B9C; Zurück</a>

        <div class="my-1">

            <button type="submit" class="bg-yellow-600 bg-transparent hover:bg-yellow-700 text-white font-semibold text-sm hover:text-white py-2 pr-4 pl-3 border border-yellow-700 hover:border-transparent focus:outline-none focus:ring ring-yellow-300 focus:border-yellow-300 rounded flex items-center transition-colors duration-200 transform duration-150 hover:scale-105">

                <div class="">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>

                </div>

                <div class="pl-3">

                    <span class="font-semibold">Senden</span>

                </div>

            </button>

        </div>

    </div>

    <!-- Zurück, Senden -->

</form>