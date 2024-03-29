<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'node_id',
        'device_name'
    ];

    public $timestamps = false;

    public function node(): HasOne
    {
        return $this->hasOne(Node::class, 'id', 'node_id');
    }

    public function stuff(): HasOne
    {
        return $this->hasOne(Stuff::class)->withDefault([
            'stuff' => 'Ящик',
        ]);
    }

    public function nodeMoonshine(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'node_id', 'id');
    }

}
