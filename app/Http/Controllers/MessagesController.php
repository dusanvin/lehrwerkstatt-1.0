<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{

    public function index()
    {
        // All threads, ignore deleted/archived participants
        $threads = Thread::getAllLatest()->get();
        $threads_counter = Thread::getAllLatest()->get()->count();

        // All threads that user is participating in
        // $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        return view('messenger.index', compact('threads','threads_counter'));
    }


    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::id();
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    //public $vince = 'Vince';

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        // Suche mit Argument 'Vince' eingrenzen
        //$users = User::Where('vorname', 'LIKE', '%'. $this->vince . '%')->get();

        return view('messenger.create', compact('users'));
    }


    public function store()
    {
        $input = Request::all();

        $thread = Thread::create([
            'subject' => $input['subject'],
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $input['message'],
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Recipients
        if (Request::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }

        return redirect()->route('messages');
    }


    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => Request::input('message'),
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Request::has('recipients')) {
            $thread->addParticipant(Request::input('recipients'));
        }

        return redirect()->route('messages.show', $id);
    }

     public function delete($id)
    {
        try {
           $message = Message::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The message with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }

        if ( Auth::user()->id == $message->user_id   || Auth::user()->isAdmin() ) {
            // get thread ID and check if this was the last remaining message in the thread!
            // then we have to delete the thread as well!!!
            $thread_id = $message->thread_id;
            $message->delete();
            Session::flash('error_message', 'Message deleted.');
            $msgs = Message::where('thread_id', $thread_id)->get();
            if (count($msgs)==0) {
                $thread = Thread::find($thread_id)->delete();
                return redirect('messages');
            }
        } 
        else {
            Session::flash('error_message', 'You can only delete your own messages.');
            return redirect('messages');
        }
        
        return redirect()->back();
    }


}
