<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Device;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;

class Devices extends Component
{
    use WithPagination;

    public $device_id;

    #[Url()]
    public $filterId = '';
    #[Url()]
    public $filterName = '';
    #[Url()]
    public $filterActive = '';

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
        $this->dispatch("editDevice", $id);
    }


    public function delete($id)
    {
        $this->device_id = $id;
        Flux::modal('delete-device')->show();
    }

    public function destroy()
    {
        Device::find($this->user_id)->delete();
        $this->reloadUsers();
        Flux::modal('delete-device')->close();
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
        
        $this->filterId = '';
        $this->filterName = '';
        $this->filterActive = '';
        
        $this->resetPage();
    }

    #[Computed()]
    public function deviceList()
    {
        return Device::query()
            ->when($this->filterName, fn($query) => $query->where('name', 'like', '%' . $this->filterName . '%'))
            ->when($this->filterId, fn($query) => $query->where('device_id', 'like', '%' . $this->filterEmail . '%'))
            ->when($this->filterActive, fn($query) => $query->where('is_active', $this->filterRole))
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(5);
    }
    

    #[On("reloadDevices")]
    public function reloadDevices()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.user.devices');
    }
}
