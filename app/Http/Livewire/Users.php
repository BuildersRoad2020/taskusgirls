<?php

namespace App\Http\Livewire;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;


class Users extends Component
{

    use AuthorizesRequests;

    public $confirmingUserAdd = false;
    public $confirmingUserEdit = false;
    public $name;
    public $email;
    public $roles_id;

    public function render()
    {
    
        return view('livewire.users', [
            'users' => User::with('RoleUser')->get(),
        ]);
    }

    public function confirmUserAdd()
    {
        $this->confirmingUserAdd = true; //User Add Modal
    }

    public function UserAdd() 
    {

        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'roles_id' => ['required'],
        ]);

        $user = new User;
        $user->name = ucwords($validatedData['name']);
        $user->email = $validatedData['email'];
        $user->password = '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6'; //Support123!
        $user->save();

        
        foreach ($validatedData['roles_id'] as $key => $value) {
            $role = new RoleUser;
            $role->roles_id = $value;
            $role->users_id = $user->id;
            $role->save();
        }

        $this->confirmingUserAdd = false;
        $this->reset('name');
        $this->reset('email');
        $this->reset('roles_id');
        session()->flash('message', 'User has been added');
    }

    public function closeModal() {
        $this->confirmingUserEdit = false;
    }

    public function confirmUserEdit(User $id)
    {
        $this->authorize('viewAny', App\Models\User::class); 
        $this->name = $id->name;
        $this->email = $id->email;
        $this->confirmingUserEdit = $id;
    }

    public function EditUser(User $id)
    {
        $this->authorize('viewAny', App\Models\User::class);
        $validatedData = $this->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'roles_id' => ['required'],
            ],
        );

        $edit = User::find($id->id);
        $edit->name = $validatedData['name'];
        $edit->save();

        $oldRole = $edit->RoleUser()->delete();

        foreach ($validatedData['roles_id'] as $key => $value) {
            $role = new RoleUser;
            $role->roles_id = $value;
            $role->users_id = $edit->id;
            $role->save();
        }


        $this->confirmingUserEdit = false;
        $this->reset('name');
        $this->reset('email');
        $this->reset('roles_id');
        session()->flash('message', 'User has been added');
    }
}
