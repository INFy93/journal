<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
      'node_id',
      'device_id',
      'user_id',
      'goals',
      'task',
      'consumables'
    ];

    public function devices(): BelongsTo
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nodes(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'node_id');
    }

    public function cities(): HasOneThrough
    {
        return $this->hasOneThrough(
            City::class,
            Node::class,
                    'id', //id on NODE table
                    'id', //id on CITY table
                    'node_id', // RECORDS table
                    'city_id' //NODE table

        );
    }
}
