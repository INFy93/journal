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
 * @OA\Get(
 *     path="/api/v1/nodes",
 *     summary="Get a list of nodes",
 *     tags={"Node"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function index()
    {
        return NodeResource::collection(Node::all());
    }

    /**
 * @OA\Post(
 *     path="/api/v1/nodes",
 *     summary="Post new node to database",
 *     tags={"Node"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function store(NodeRequest $request): NodeResource
    {
        $node = Node::create($request->validated());

        return new NodeResource($node);
    }

    /**
 * @OA\Get(
 *     path="/api/v1/nodes/{node_id}",
 *     summary="Get a single node",
 *     tags={"Node"},
 *     @OA\Parameter(
 *         description="Node unique id",
 *         in="path",
 *         name="node_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function show(Node $node): NodeResource
    {

        return new NodeResource($node);
    }

        /**
 * @OA\Get(
 *     path="/api/v1/node/{city_id}",
 *     summary="Get all nodes in specific city",
 *     tags={"Node"},
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
    public function getNode($city_id): NodeResource
    {
        $data = Node::where('city_id', $city_id)->get();
        return new NodeResource($data);
    }

    /**
 * @OA\Put(
 *     path="/api/v1/nodes/{node_id}",
 *     summary="Update a single node",
 *     tags={"Node"},
 *     @OA\Parameter(
 *         description="Node unique id",
 *         in="path",
 *         name="node_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function update(NodeRequest $request, Node $node): NodeResource
    {
        $node->update($request->validated());

        return new NodeResource($node);
    }

    /**
 * @OA\Delete(
 *     path="/api/v1/nodes/{node_id}",
 *     summary="Delete a single node (not in use)",
 *     tags={"Node"},
 *     @OA\Parameter(
 *         description="Node unique id",
 *         in="path",
 *         name="node_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function destroy(Node $node)
    {
        //
    }
}
