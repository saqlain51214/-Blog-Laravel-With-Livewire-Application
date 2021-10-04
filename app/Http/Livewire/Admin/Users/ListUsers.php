<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class ListUsers extends Component
{

    // public $name;
    // public $email;
    // public $phone;
    // public $password;
    // public $password_confirmation;

    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;


    public function addNew(){
        $this->state = [];
        // $this->name = '';
        // $this->email = '';
        // $this->phone = '';
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser()
    {
        $validateData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();

        $validateData['password'] = bcrypt($validateData['password']);

        User::create($validateData);
        // session()->flash('message','User added successfully!');
        $this->dispatchBrowserEvent('hide-form',['message'=>'User added successfully!']);

    }

    public function edit(User $user = null)
    {
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser(User $user)
    {
        $validateData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();

        if(!empty($validateData['password'])){
            $validateData['password'] = bcrypt($validateData['password']);
        }

        $this->user->update($validateData);
        // session()->flash('message','User added successfully!');
        $this->dispatchBrowserEvent('hide-form',['message'=>'User updated successfully!']);

    }

    public function confirmUserRemoval( $userId = null)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
       
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal',['message'=>'User deleted successfully!']);
    }
    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-users',[
            'users' => $users,
        ]);
    }
}
