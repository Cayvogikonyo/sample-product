<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierProduct extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the supllier for the supplier product.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /*
     * Get the product for the supplier product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
