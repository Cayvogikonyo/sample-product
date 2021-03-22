<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the order for the order detail.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /*
     * Get the product for the order detail.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
