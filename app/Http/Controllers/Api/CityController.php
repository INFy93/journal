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
 *     path="/api/v1/city",
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
 * @OA\Post(
 *     path="/api/v1/city",
 *     summary="Post new city to database",
 *     tags={"City"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function store(CityRequest $request): CityResource
    {
        $city = City::create($request->validated());

        return new CityResource($city);
    }

    /**
 * @OA\Get(
 *     path="/api/v1/city/{city_id}",
 *     summary="Get single city",
 *     tags={"City"},
 *     @OA\Parameter(
 *         description="City unique id",
 *         in="path",
 *         name="city_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function show(City $city): CityResource
    {
        return new CityResource($city);

    }

        /**
 * @OA\Put(
 *     path="/api/v1/city/{city_id}",
 *     summary="Update specific city",
 *     tags={"City"},
 *     @OA\Parameter(
 *         description="City unique id",
 *         in="path",
 *         name="city_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function update(CityRequest $request, City $city): CityResource
    {
        $city->update($request->validated());

        return new CityResource($city);
    }

        /**
 * @OA\Delete(
 *     path="/api/v1/city/{city_id}",
 *     summary="Delete specific city",
 *     tags={"City"},
 *     @OA\Parameter(
 *         description="City unique id",
 *         in="path",
 *         name="city_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function destroy(City $city)
    {
        //
    }
}
