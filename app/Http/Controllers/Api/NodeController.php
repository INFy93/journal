<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NodeRequest;
use App\Http\Resources\NodeResource;
use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NodeResource::collection(Node::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NodeRequest $request): NodeResource
    {
        $node = Node::create($request->validated());

        return new NodeResource($node);
    }

    /**
     * Display the specified resource.
     */
    public function show(Node $node): NodeResource
    {

        return new NodeResource($node);
    }
    /**
     * Display the specified resource by city_id.
     */
    public function getNode($city_id): NodeResource
    {
        $data = Node::where('city_id', $city_id)->get();
        return new NodeResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NodeRequest $request, Node $node): NodeResource
    {
        $node->update($request->validated());

        return new NodeResource($node);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Node $node)
    {
        //
    }
}
