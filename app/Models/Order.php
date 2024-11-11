<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product associated with the order.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}