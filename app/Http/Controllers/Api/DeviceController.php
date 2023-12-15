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
 * @OA\Get(
 *     path="/api/v1/devices",
 *     summary="Get a list of devices",
 *     tags={"Device"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function index()
    {
        return DeviceResource::collection(Device::all());
    }
    /**
 * @OA\Post(
 *     path="/api/v1/devices",
 *     summary="Post new device to database",
 *     tags={"Device"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function store(DeviceRequest $request): DeviceResource
    {
        $device = Device::create($request->validated());

        return new DeviceResource($device);
    }

    /**
 * @OA\Get(
 *     path="/api/v1/devices/{device_id}",
 *     summary="Get single device",
 *     tags={"Device"},
 *     @OA\Parameter(
 *         description="Device unique id",
 *         in="path",
 *         name="device_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function show($device): DeviceResource
    {
        $data = Device::where('id', $device)
        ->with(['node'])
            ->first();

        return new DeviceResource($data);
    }

    /**
 * @OA\Get(
 *     path="/api/v1/device/{node_id}",
 *     summary="Get single device by node ID",
 *     tags={"Device"},
 *     @OA\Parameter(
 *         description="Node ID",
 *         in="path",
 *         name="node_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function getDevices($node_id): DeviceResource
    {
        $data = Device::
            where('node_id', $node_id)
            ->get();
        return new DeviceResource($data);
    }

        /**
 * @OA\Put(
 *     path="/api/v1/devices/{device_id}",
 *     summary="Update specific device",
 *     tags={"Device"},
 *     @OA\Parameter(
 *         description="Device unique id",
 *         in="path",
 *         name="device_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function update(DeviceRequest $request, Device $device): DeviceResource
    {
        $device->update($request->validated());

        return new DeviceResource($device);
    }

    /**
 * @OA\Delete(
 *     path="/api/v1/devices/{device_id}",
 *     summary="Delete specific device",
 *     tags={"Device"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function destroy(Device $device)
    {
        //
    }
}
