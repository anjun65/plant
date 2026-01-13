<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SensorReading;
use Illuminate\Support\Carbon;

class SensorController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id'     => 'required|exists:devices,device_id',
            'soil_moisture' => 'required|numeric',
            'temperature'   => 'required|numeric',
            'light'         => 'required|numeric',
            'humidity'      => 'required|numeric',
            'recorded_at'   => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // Ambil device berdasarkan device_id eksternal
        $device = Device::where('device_id', $data['device_id'])->first();

        // Ganti device_id eksternal → id PK
        $data['device_id'] = $device->id;

        $data['recorded_at'] ??= Carbon::now('Asia/Jakarta');

        $reading = SensorReading::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Sensor data saved',
            'data'    => $reading,
        ], 201);
    }
}
