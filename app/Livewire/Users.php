<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Users extends Component
{
    public $name = "";
    public $email = "";
    public $password = "";


    public function SaveUserConfirm(){
        LivewireAlert::title('Save User?')
            ->text('Are You Sure?')
            ->question()
            ->withConfirmButton('Save')
            ->onConfirm('SaveUser')
            ->withCancelButton('Cancel')
            ->onDismiss('canceled')
            ->timer(9000)
            ->show();
    }

    public function canceled(){
        LivewireAlert::title('canceled')
            ->info()
            ->position('center')
            ->toast()
            ->show();
    }

    public function SaveUser(){

        $data = $this->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string',
        ]);
        try{

            DB::beginTransaction();

            User::create($data);
            // Session::flash('success','User Created Successfully');
            LivewireAlert::title('User Created!')
                ->text('User Created Successfully.')
                ->success()
                ->show();


            DB::commit();

            $this->reset();
        }
            catch (\Exception $e) {
            DB::rollBack();

            LivewireAlert::title('Error')
                ->text('Failed to create user. Please try again.' . $e->getMessage())
                ->error()
                ->position('center')
                ->toast()
                ->show();
        }
    }

    public $confirmationText = '';
    public $deleteUserId = null;




    public function DeleteUser()
    {
            $this->validate([
                    'confirmationText' => ['string','in:Delete','required'],
                    'deleteUserId' => ['required','exists:users,id'],
                ]);


            $user = User::findOrFail($this->deleteUserId);
            $user->delete();

            $this->deleteUserId = null;
            $this->confirmationText = '';

            // Session::flash('success','User Deleted Successfully');

            LivewireAlert::title('Success')
                ->text('User deleted successfully!')
                ->success()
                ->position('center')
                ->toast()
                ->show();

            $this->modal('delete-user-modal')->close();


    }

    public function render()
    {
        return view('livewire.users',[
            'users' => User::all(),
        ]);
    }
}
