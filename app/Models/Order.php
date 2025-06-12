<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $fillable = ['date', 'time'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
