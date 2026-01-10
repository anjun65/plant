<?php

namespace App\Livewire\User;

use Livewire\Component;

use Flux\Flux;
use Livewire\Attributes\On;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

class DeviceEdit extends Component
{
    public $device_id, $name, $latitude, $longitude, $is_active, $deviceId, $device;
    
    #[On("editDevice")]
    public function editDevice($id)
    {
        $this->device = Device::find($id);
        $this->deviceId = $id;
        
        $this->device_id = $this->device->device_id;
        $this->name = $this->device->name;
        $this->latitude = $this->device->latitude;
        $this->longitude = $this->device->longitude;

        Flux::modal('edit-device')->show();
    }

    public function update(){
        $this->validate([
            'device_id' => 'required',
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        
        $this->device->user_id = Auth::id();
        $this->device->device_id = $this->device_id;
        $this->device->name = $this->name;
        $this->device->latitude = $this->latitude;
        $this->device->longitude = $this->longitude;

        $this->device->save();
    
        Flux::modal('edit-device')->close();
        Flux::toast(
            variant: 'success',
            text: 'Sukses mengedit perangkat.',
        );
        $this->dispatch("reloadDevices");
    }

    public function render()
    {
        return view('livewire.user.device-edit');
    }
}
