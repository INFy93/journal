<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StuffRequest;
use App\Http\Resources\StuffResource;
use App\Models\Stuff;
use Illuminate\Http\Request;

class StuffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

   /**
 * @OA\Post(
 *     path="/api/v1/stuff",
 *     summary="Post new stuff to database",
 *     tags={"Stuff"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function store(StuffRequest $request): StuffResource
    {
        $stuff = Stuff::create($request->validated());

        return new StuffResource($stuff);
    }

    /**
 * @OA\Get(
 *     path="/api/v1/stuff/{device_id}",
 *     summary="Get a single stuff using device ID",
 *     tags={"Stuff"},
 *     @OA\Parameter(
 *         description="Device unique id",
 *         in="path",
 *         name="device_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function show($stuff): StuffResource
    {
        $data = Stuff::where('node_id', $stuff)->first();

        return new StuffResource($data);
    }

    /**
 * @OA\Put(
 *     path="/api/v1/stuff/{stuff_id}",
 *     summary="Update a single stuff",
 *     tags={"Stuff"},
 *     @OA\Parameter(
 *         description="Stuff unique id",
 *         in="path",
 *         name="stuff_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function update(StuffRequest $request, Stuff $stuff): StuffResource
    {
        $stuff->update($request->validated());

        return new StuffResource($stuff);
    }

    /**
 * @OA\Delete(
 *     path="/api/v1/stuff/{stuff_id}",
 *     summary="Delete a single stuff (not in use)",
 *     tags={"Stuff"},
 *     @OA\Parameter(
 *         description="Stuff unique id",
 *         in="path",
 *         name="stuff_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function destroy(Stuff $stuff)
    {
        //
    }
}
