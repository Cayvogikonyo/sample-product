<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyStatistic extends Model
{
    use HasFactory;

    //Get dashboard element stats
    public static function dashboardStat(){

        $from = date('Y-m-d 00:00:00');
        $to = date('Y-m-d 23:59:59');
        return $elements = [
            [
                'title' => 'Orders',
                'icon' => 'sales.png',
                'value' => Order::whereBetween('created_at', array($from, $to))->count(),
                'percentage' =>  0,
                'link' => 'orders'
            ],
            [
                'title' => 'Suppliers',
                'icon' => 'supplier.png',
                'value' => Supplier::count(),
                'percentage' =>  0,
                'link' => 'suppliers'
            ],
            [
                'title' => 'Products',
                'icon' => 'orders.png',
                'value' => Product::count(),
                'percentage' =>  0,
                'link' => 'products'
            ],
        ];
    }

}
