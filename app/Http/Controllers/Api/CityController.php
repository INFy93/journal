<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Http\Resources\RecordsResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/v1/citiy",
 *     summary="Get a list of cities",
 *     tags={"City"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function index()
    {
        return CityResource::collection(City::all());
    }

    /**
 * @OA\Get(
 *     path="/api/v1/citiy",
 *     summary="Post new city to database",
 *     tags={"City"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function store(CityRequest $request): CityResource
    {
        $city = City::create($request->validated());

        return new CityResource($city);
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city): CityResource
    {
        return new CityResource($city);

    }

    public function getCity($id)
    {

        $city = City::where('id', $id)->first();

        return $city;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city): CityResource
    {
        $city->update($request->validated());

        return new CityResource($city);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }
}
