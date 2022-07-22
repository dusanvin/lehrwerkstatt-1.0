<div class="media">
    
    <div class="media-body">

        <p class="">{{ $message->body }}</p>

        <div class="mt-1 text-muted text-sm grid justify-items-end text-gray-400 leading-none">

            <small>{{ $message->created_at->diffForHumans() }}</small>

            <!-- Löschen der eigenen Nachricht -->

            @if ($message->user_id == Auth::id())

                <small><a class="btn btn-warning btn-sm float-right mt-1 text-xs hover:text-gray-200" title="Remove" href='{{ url('messages/'.$message->id) }}/delete'>

                Löschen

                </a></small>

            @endif

            <!-- Löschen der eigenen Nachricht -->

        </div>

    </div>
    
</div>