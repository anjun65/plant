<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SensorReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'soil_moisture',
        'temperature',
        'humidity',
        'light',
        'recorded_at',
    ];

    protected $casts = [
        'soil_moisture' => 'float',
        'temperature'   => 'float',
        'humidity'   => 'float',
        'light'         => 'float',
        'recorded_at'   => 'datetime',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function scopeLatestRecorded($query)
    {
        return $query->orderByDesc('recorded_at');
    }
}
