<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;

class Message extends Component
{

    public $search = '';
    public $users;

    // Fügen Sie hier ihre Empfänger hinzu
    public $receivers = '';
    public $receiverids;


    public function render()
    {
        if(empty($this->search))
        {
            $this->users = User::where('vorname', $this->search)->get();
        }
        else 
        {
            $this->users = User::where('vorname', 'like', '%'.$this->search.'%')->get();
        }
        return view('livewire.message');
    }
}
