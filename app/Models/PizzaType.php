<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PizzaType extends Model
{
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'category', 'ingredients'
    ];
}
