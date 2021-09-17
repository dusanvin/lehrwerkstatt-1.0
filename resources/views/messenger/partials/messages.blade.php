<div class="media">
    <!--<a class="pull-left" href="#">
        <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64"
             alt="{{ $message->user->name }}" class="img-circle">
    </a>
    {{ $message->user->vorname }} {{ $message->user->nachname }}-->
    <div class="media-body">
        <!--<h5 class="media-heading">{{ $message->user->name }}</h5>-->

        <p class="">{{ $message->body }}</p>

        <div class="text-muted text-sm grid justify-items-center md:justify-items-end text-gray-400 leading-none">

            <small>{{ $message->created_at->diffForHumans() }}</small>

        </div>
    </div>
</div>