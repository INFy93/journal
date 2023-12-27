<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/users",
     *     summary="Get a list of users",
     *     tags={"User"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/users",
     *     summary="Post new user to database (not in use yet)",
     *     tags={"User"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users/{user_id}",
     *     summary="Get a single user",
     *     tags={"User"},
     *     @OA\Parameter(
     *         description="User unique id",
     *         in="path",
     *         name="user_id",
     *         required=true
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/users/{user}",
     *     summary="Update a single user",
     *     tags={"User"},
     *     @OA\Parameter(
     *         description="User unique id",
     *         in="path",
     *         name="user_id",
     *         required=true
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function update(UserRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/users/{user}",
     *     summary="Delete a single user (not in use)",
     *     tags={"User"},
     *     @OA\Parameter(
     *         description="User unique id",
     *         in="path",
     *         name="user_id",
     *         required=true
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function destroy(User $user)
    {
        //
    }
}
