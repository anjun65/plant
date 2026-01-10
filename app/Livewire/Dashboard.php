<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SensorReading;
use Illuminate\Support\Carbon;

class Dashboard extends Component
{

    public array $range;
    public array $data = [];
    public $now;

    public function mount()
    {
        $now = Carbon::now('asia/jakarta');

        $this->range = [
            'start' => $now->copy()->subDays(7)->format('Y-m-d'),
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
                'date' => $row->recorded_at->format('Y-m-d'),
                'soil_moisture' => $row->soil_moisture,
                'temperature'  => $row->temperature,
                'light'        => $row->light,
            ])
            ->toArray();
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
