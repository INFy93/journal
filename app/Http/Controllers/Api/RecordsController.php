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
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(RecordRequest $request): RecordsResource
    {
        $record = Record::create($request->validated());

        return new RecordsResource($record);
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record): RecordsResource
    {
        return new RecordsResource($record);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecordRequest $request, Record $record): RecordsResource
    {
        $record->update($request->validated());

        return new RecordsResource($record);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }
}
