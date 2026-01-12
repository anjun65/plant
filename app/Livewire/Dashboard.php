<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SensorReading;
use Illuminate\Support\Carbon;

class Dashboard extends Component
{

    public array $range;
    public array $data = [];

    public function mount()
    {
        $now = Carbon::now('Asia/Jakarta');

        $this->range = [
            'start' => $now->format('Y-m-d'),
            'end'   => $now->format('Y-m-d'),
        ];

        $this->loadData();
    }

    public function updatedRange()
    {
        $this->loadData();
    }

    public function apply()
    {
        $this->loadData();
    }

    protected function loadData()
    {
        $this->data = SensorReading::whereBetween(
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
            'light'        => (float) $row->light,
        ])
        ->values()        // 🔥 FLATTEN
        ->toArray();
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
