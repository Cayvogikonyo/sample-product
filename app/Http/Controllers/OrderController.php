<?php

namespace App\Http\Controllers;
use App\Http\Resources\OrderResource;
use App\Http\Resources\SupplierResource;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\DailyStatistic;

class OrderController extends Controller
{
    /**
     * Get simple system statistics
     */
    public function stats(Request $request){
        return DailyStatistic::dashboardStat();
    }

    /**
     * Get top three orders
     */
    public function topThree(Request $request){
        //Could change selection to order with highest amount or products
        return OrderResource::collection(Order::orderBy('id', 'DESC')->limit(3)->get());
    }

    /**
     * Get all orders
     */
    public function index(Request $request){
        return OrderResource::collection(Order::all());
    }

    /**
     * Get all orders
     */
    public function orderStats(Request $request){
        $products = Product::all();
        $from = date('Y-m-d 00:00:00');
        $to = date('Y-m-d 23:59:00');
        $orderDetails = OrderDetail::whereBetween('created_at', [$from, $to])->get();
        $productArray = [];
        $products = [];
        $labels = [];
        foreach($orderDetails as $orderDetail){
            $date = date('Y-m-d', strtotime($orderDetail->created_at));
            if(key_exists($orderDetail->product_id, $productArray)){
                if(key_exists($date, $productArray[$orderDetail->product_id])){
                    $productArray[$orderDetail->product_id][$date] = $productArray[$orderDetail->product_id][$date]+1;
                }else{
                    key_exists($productArray[$orderDetail->product_id], array($date => 100));
                }
            } else {
                array_push($labels, $date);
                $productArray[$orderDetail->product_id] = array($date => 1);
                $products[$orderDetail->product_id] = $orderDetail->product->name;
            }
        }
        $datasets = [];
        foreach($products as $key => $value){
            $data = [
                'label' => $value,
                'backgroundColor' => '#35b8e0',
                'data' => $productArray[$key],
                'barThickness' => 12,
                'maxBarThickness' => 16
            ];
            array_push($datasets, $data);
        }
        $chartdata = [
            'labels' => $labels,
            'datasets' => $datasets
        ];
        return $chartdata;
    }

    /**
     * Create a new order
     */
    public function saveOrder(Request $request){

        $validatedData = $request->validateWithBag('createOrder', [
            'items' => 'required|array',
            'items.*.id' => 'required|numeric',
            'items.*.quantity' => 'required|numeric',
        ]);

        $user = $request->user();
        $order = new Order();
        $order->order_number = $order->orderNumber();
        $order->save();

        //Loop through items in order
        foreach($validatedData['items'] as $item){

            $product = Product::find($item['id']);
            if(empty($product)){
                continue; //If product not found, don't save. complete loop
            }
            $orderDetail = new OrderDetail();
            $orderDetail->product()->associate($product);
            $orderDetail->order()->associate($order);
            $orderDetail->save();   
        }


        return response()->json(['success' => 'Order created']);

    }


    /**
     * Delete order
     */
    public function delete(Request $request){
        $request->validate(
            ['id'=>'numeric|required']
        );
        $order = Order::find($request->id);
        if(empty($order)){
            abort();
        }
        $order->delete();
        return response()->json(['success' => 'order deleted.']);
    }
    
}
