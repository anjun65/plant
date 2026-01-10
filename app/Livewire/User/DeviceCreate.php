<?php

namespace App\Livewire\User;

use Livewire\Component;
use Flux\Flux;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

class DeviceCreate extends Component
{
    public $device_id;
    public $name;
    public $latitude;
    public $longitude;

    protected function rules()
    {
        return [
            'device_id' => 'required',
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }

    public function submit() {
        $this->validate();
        
        Device::create([
            'user_id' => Auth::id(),
            'device_id' => $this->device_id,
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_active' => 0,
        ]);

        $this->resetForm();
        Flux::modal("create-device")->close();
        Flux::toast(
            variant: 'success',
            text: 'Sukses menambahkan perangkat.',
        );
        $this->dispatch("reloadDevices");
    }

    public function resetForm(){
        $this->device_id = "";
        $this->name = "";
        $this->latitude = "";
        $this->longitude = "";
    }

    public function render()
    {
        return view('livewire.user.device-create');
    }
}
