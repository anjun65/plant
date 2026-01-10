<?php

namespace App\Livewire\Config\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;

class Users extends Component
{
    use WithPagination;

    public $user_id;

    #[Url()]
    public $filterName = '';
    #[Url()]
    public $filterEmail = '';
    #[Url()]
    public $filterRole = '';

    public $sortBy = 'id';
    public $sortDirection = 'desc';

    public function sort($column) {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function edit($id)
    {
        $this->dispatch("editUser", $id);
    }


    public function delete($id)
    {
        $this->user_id = $id;
        Flux::modal('delete-user')->show();
    }

    public function destroy()
    {
        User::find($this->user_id)->delete();
        $this->reloadUsers();
        Flux::modal('delete-user')->close();
        Flux::toast(
            variant: 'success',
            text: 'Data berhasil dihapus.',
        );
    }
    
    public function filter()
    {
        $this->resetPage();
        Flux::toast(
            variant: 'success',
            text: 'Filter berhasil diterapkan.',
        );
    }

    public function clearFilters()
    {
        $this->filterName = '';
        $this->filterEmail = '';
        $this->filterRole = '';
        
        $this->resetPage();
    }

    #[Computed()]
    public function userList()
    {
        return User::query()
            ->when($this->filterName, fn($query) => $query->where('name', 'like', '%' . $this->filterName . '%'))
            ->when($this->filterEmail, fn($query) => $query->where('email', 'like', '%' . $this->filterEmail . '%'))
            ->when($this->filterRole, fn($query) => $query->where('roles', $this->filterRole))
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(5);
    }
    

    #[On("reloadUsers")]
    public function reloadUsers()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.config.user.users');
    }
}
