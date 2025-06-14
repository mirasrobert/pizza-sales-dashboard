<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'pizza_type_id', 'size', 'price',
    ];

    public function pizzaType()
    {
        return $this->belongsTo(PizzaType::class, 'pizza_type_id');
    }
}
