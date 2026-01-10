<?php

namespace App\Livewire\Config\User;

use Livewire\Component;

use Flux\Flux;
use Livewire\Attributes\On;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserEdit extends Component
{
    public $name, $email, $password, $role,$nik_nim, $userId, $user;
    
    #[On("editUser")]
    public function editUser($id)
    {
        $this->user = User::find($id);
        $this->userId = $id;

        $this->role = $this->user->roles;

        Flux::modal('edit-user')->show();
    }

    public function update(){
        $this->validate([
            'role' => 'required|string',
        ]);

        if ($this->password !== null) {
            $this->user->password = Hash::make($this->password);
        }

        $this->user->roles = $this->role;
        
        
        $this->user->save();
    
        Flux::modal('edit-user')->close();
        Flux::toast(
            variant: 'success',
            text: 'Sukses mengedit user.',
        );
        $this->dispatch("reloadUsers");
    }
    
    public function render()
    {
        return view('livewire.config.user.user-edit');
    }
}
