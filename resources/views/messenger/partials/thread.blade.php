<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="media alert {{ $class }} mb-8">
    <h4 class="media-heading">
        <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
        ({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)</h4>
    <p>
        {{ $thread->latestMessage->body }}
    </p>
    <p>
         <small><strong>Abgesandt durch:</strong> {{ $thread->creator()->vorname }}</small>
    </p>
    <p>
        <small><strong>Am Gespräch beteiligt:</strong> {{ $thread->participantsString(Auth::id(),['vorname']) }}</small>
    </p>
</div>