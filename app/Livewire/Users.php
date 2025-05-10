<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

use Livewire\Attributes\Rule;

class Users extends Component
{
    #[Rule('required|string')]
    public $name = "";

    #[Rule('required|email|unique:users,email')]
    public $email = "";

    #[Rule(['required','string'])]
    public $password = "";

    public function SaveUser(){

        // $data = $this->validate([
        //     'name'=>'required|string',
        //     'email'=>'required|email|unique:users,email',
        //     'password'=>'required|string',
        // ]);

        $data = $this->validate();

        User::create($data);

        // $this->reset();
    }

    public function render()
    {
        return view('livewire.users',[
            'users' => User::all(),
        ]);
    }
}
