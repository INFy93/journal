<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Node extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'node_name'
    ];

    public $timestamps = false;

    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id');
    }
}
