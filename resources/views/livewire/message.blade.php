<div>
    <form>
        <input wire:model="search" type="text" placeholder="Suche nach Nutzer...">
    </form>
    <ul class="list-group">
        @if($users && $users->count() > 0)
        @foreach($users as $user)
        <li class="list-group-item">{{$user->email}}</li>
        @endforeach
        @else
        Keine Nutzer gefunden.
        @endif
    </ul>
</div>
