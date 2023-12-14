<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DeviceResource::collection(Device::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviceRequest $request): DeviceResource
    {
        $device = Device::create($request->validated());

        return new DeviceResource($device);
    }

    /**
     * Display the specified resource.
     */
    public function show($device): DeviceResource
    {
        $data = Device::where('id', $device)
        ->with(['node'])
            ->first();

        return new DeviceResource($data);
    }
    /**
     * Display the specified resource by node_id.
     */
    public function getDevices($node_id): DeviceResource
    {
        $data = Device::
            where('node_id', $node_id)
            ->get();
        return new DeviceResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeviceRequest $request, Device $device): DeviceResource
    {
        $device->update($request->validated());

        return new DeviceResource($device);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        //
    }
}
