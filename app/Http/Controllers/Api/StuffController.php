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
     * Store a newly created resource in storage.
     */
    public function store(StuffRequest $request): StuffResource
    {
        $stuff = Stuff::create($request->validated());

        return new StuffResource($stuff);
    }

    /**
     * Display the specified resource.
     */
    public function show($stuff): StuffResource
    {
        $data = Stuff::where('device_id', $stuff)->first();

        return new StuffResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StuffRequest $request, Stuff $stuff): StuffResource
    {
        $stuff->update($request->validated());

        return new StuffResource($stuff);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stuff $stuff)
    {
        //
    }
}
