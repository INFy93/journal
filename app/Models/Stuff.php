<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    use HasFactory;

    protected $fillable = [
        'node_id',
        'stuff'
    ];

   // public $timestamps = false;
}
