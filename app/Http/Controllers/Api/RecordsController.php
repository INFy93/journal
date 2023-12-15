<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;
use App\Http\Resources\RecordsResource;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/v1/records",
 *     summary="Get all records with devices, nodes, users and cities. Using filter 'selectedNode' (comes from request) will show devices belonging to specific node",
 *     tags={"Record"},
 *     @OA\Parameter(
 *         description="Node ID",
 *         in="query",
 *         name="selectedNode",
 *         required=false
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function index()
    {
        //use some filters to code a lot of coding and different methods
        $selectedNode = \request('selectedNode', '');

        $records = Record::with(['devices', 'nodes', 'users', 'cities'])
            ->when($selectedNode, function ($query) use ($selectedNode) {
                $query->where('node_id', $selectedNode);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return RecordsResource::collection($records);
    }

   /**
 * @OA\Post(
 *     path="/api/v1/records",
 *     summary="Post new record to database",
 *     tags={"Record"},
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function store(RecordRequest $request): RecordsResource
    {
        $record = Record::create($request->validated());

        return new RecordsResource($record);
    }

    /**
 * @OA\Get(
 *     path="/api/v1/records/{record_id}",
 *     summary="Get a single record",
 *     tags={"Record"},
 *     @OA\Parameter(
 *         description="Record unique id",
 *         in="path",
 *         name="record_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function show(Record $record): RecordsResource
    {
        return new RecordsResource($record);
    }

    /**
 * @OA\Put(
 *     path="/api/v1/records/{record_id}",
 *     summary="Update a single record",
 *     tags={"Record"},
 *     @OA\Parameter(
 *         description="Record unique id",
 *         in="path",
 *         name="record_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request"),
 *     @OA\Response(response=422, description="Validation error")
 * )
 */
    public function update(RecordRequest $request, Record $record): RecordsResource
    {
        $record->update($request->validated());

        return new RecordsResource($record);
    }

    /**
 * @OA\Delete(
 *     path="/api/v1/records/{record_id}",
 *     summary="Delete a single record (not in use)",
 *     tags={"Record"},
 *     @OA\Parameter(
 *         description="Record unique id",
 *         in="path",
 *         name="record_id",
 *         required=true
 *     ),
 *     @OA\Response(response=200, description="Successful operation"),
 *     @OA\Response(response=400, description="Invalid request")
 * )
 */
    public function destroy(Record $record)
    {
        //
    }
}
