<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_name'
    ];

    public $timestamps = false;

    public function nodes(): HasMany
    {
        return $this->hasMany(Node::class);
    }

 public function stuffs(): HasManyThrough
    {
        return $this->hasManyThrough(
            Stuff::class, //целевая модель
            Node::class, //модель, через которую ищем
            'city_id', //ключ в модели Node
            'node_id', //ключ в модели Stuff
            'id', //локальный ключ в родной модели
            'id' //локальный ключ в модели Node. ETO PIZDEC
        );
    }

    public function records(): HasManyThrough
    {
        return $this->hasManyThrough(
            Record::class, //целевая модель
            Node::class, //модель, через которую ищем
            'city_id', //ключ в модели Node
            'node_id', //ключ в модели Record
            'id', //локальный ключ в родной модели
            'id' //локальный ключ в модели Node. ETO PIZDEC
        )->orderBy('created_at', 'desc');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function($query) use ($term){
            $query->where('city_name', 'like', $term);
        });
    }
}
