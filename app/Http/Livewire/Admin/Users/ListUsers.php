<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Admin\AdminComponent;

class ListUsers extends AdminComponent
{

  
    use WithFileUploads;
    // public $name;
    // public $email;
    // public $phone;
    // public $password;
    // public $password_confirmation;

    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;

    public $searchTerm = null;

    public $photo;

    public function changeRole(User $user, $role)
    {

        Validator::make(['role' => $role], [
            'role' => [
                'required',
                Rule::in(User::ROLE_ADMIN, User::ROLE_USER),
            ],
        
        ])->validate();
        $user->update(['role'=>$role]);
        $this->dispatchBrowserEvent('updated', ['message'=>'Role changed to '.$role.' successfully.']);
        
    }


    public function addNew(){
        // $this->state = [];
        $this->reset();
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

        if($this->photo){
            $validateData['avatar'] = $this->photo->store('/','avatars');
        }
        User::create($validateData);
        // session()->flash('message','User added successfully!');
        $this->dispatchBrowserEvent('hide-form',['message'=>'User added successfully!']);

    }

    public function edit(User $user = null)
    {
        $this->reset();
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

        if($this->photo){
            Storage::disk('avatars')->delete($this->user->avatar);
            $validateData['avatar'] = $this->photo->store('/','avatars');
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
        $users = User::query()
        ->where('name', 'like', '%'.$this->searchTerm.'%')
        ->orWhere('email', 'like', '%'.$this->searchTerm.'%')
        ->latest()->paginate(5);
        return view('livewire.admin.users.list-users',[
            'users' => $users,
        ]);
    }
}
