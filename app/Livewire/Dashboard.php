<?php

namespace App\Livewire;

use App\Models\Device;
use Livewire\Component;
use App\Models\SensorReading;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{

    public array $range;
    public array $data = [];
    public $devices;
    public $device_id;

    public function mount()
    {
        $now = Carbon::now('Asia/Jakarta');

        $this->range = [
            'start' => $now->format('Y-m-d'),
            'end'   => $now->format('Y-m-d'),
        ];

        $this->devices = Device::where('user_id', Auth::id())->get();
        $this->device_id = $this->devices->first()?->id;

        $this->loadData();
    }

    public function updatedRange()
    {
        $this->loadData();
    }

    public function apply()
    {
        $this->device_id = (int) $this->device_id;
        $this->loadData();
    }

    protected function loadData()
    {
        if (!$this->device_id) {
            $this->data = [];
            return;
        }

        $this->data = SensorReading::where('device_id', $this->device_id)
        ->whereBetween(
            'recorded_at',
            [
                $this->range['start'].' 00:00:00',
                $this->range['end'].' 23:59:59',
            ]
        )
        ->orderBy('recorded_at')
        ->get()
        ->map(fn ($row) => [
            // ⚠️ PALING AMAN: UNIX TIMESTAMP (ms)
            'time' => $row->recorded_at->timestamp * 1000,
            'time_label' => $row->recorded_at
                ->setTimezone('Asia/Jakarta')
                ->format('d M Y H:i'),
            'soil_moisture' => (float) $row->soil_moisture,
            'temperature'  => (float) $row->temperature,
            'humidity'  => (float) $row->humidity,
            'light'        => (float) $row->light,
        ])
        ->values()
        ->toArray();
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
