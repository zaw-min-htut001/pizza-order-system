<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function orderList(){
        $order =Order::select('orders.*','users.name')
        ->when(request('key'),function($query){
            $query->where('orders.order_code','like','%'.request("key").'%');
        })
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('id','desc')
        ->get();
        return view('admin.orderList',compact('order'));
    }
    public function filter(Request $request){
        $order =Order::select('orders.*','users.name')

        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('id','desc');
        if($request->filterStatus == null ){
            $order =$order->get();
        }else{
            $order =$order->where('orders.status',$request->filterStatus)->get();
        }
        return view('admin.orderList',compact('order'));
    }

    //
    public function change(Request $request){

       Order::where('id',$request->id)->update([
            'status' => $request->status
       ]);
    }
    //
    public function orderInfo($orderCode){
        $data =Order::select('orders.*','users.name')
        ->leftJoin('users','users.id','orders.user_id')
        ->where('order_code',$orderCode)->first();
        $order =OrderList::select('order_lists.*','orders.user_id','users.name','products.name as product_name','products.image')
        ->leftJoin('orders','orders.order_code','order_lists.orderCode')
        ->leftJoin('users','users.id','orders.user_id')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->where('orderCode',$orderCode)->get();
       return  view('admin.orderInfo',compact('order','data'));
    }

}
