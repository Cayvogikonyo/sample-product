<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * Get the order details for the order.
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    /**
     * Get the order number for the order.
     */
    public function orderNumber()
    {
        return '#RCP-OR-'.str_pad($this->count(), 4, '0', STR_PAD_LEFT);
    }
}
