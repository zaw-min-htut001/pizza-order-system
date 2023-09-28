<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //
    public function pizzaList(Request $request){
        if($request->status == 'asc'){
            $data = Product::orderBy('id','asc')->get();
            return $data;
        }else{
            $data = Product::orderBy('id','desc')->get();
            return $data;
        }
       return $data;

    }
    //
    public function addCart(Request $request){
        $data =$this->getOrderData($request);
        Cart::create($data);
        $response =[
            'message' => 'Add to cart',
            'status' => 'success'
        ];
        return response()->json($response, 200);
    }
    //
    public function clear(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    public function delete(Request $request){
        Cart::where('user_id',Auth::user()->id)
        ->where('product_id' ,$request->productId)
        ->where('id',$request->id)
        ->delete();
    }
    //view count
    public function viewCount(Request $request){
       $pizza = Product::where('id',$request->product_id)->first();
       $viewCount=['view_count' => $pizza->view_count + 1];
       Product::where('id',$request->product_id)->update($viewCount);
    }
    //
    public function order(Request $request){
        $total =0;
        foreach($request->all() as $item){
          $data =  OrderList::create([
                'user_id'=> $item['user_id'],
                'product_id'=> $item['product_id'],
                'qty'=> $item['qty'],
                'total'=> $item['total'],
                'orderCode'=> $item['orderCode'],
            ]);
            $total += $data->total;
        }
         Cart::where('user_id',Auth::user()->id)->delete();

            Order::create([
                'user_id' =>Auth::user()->id,
                'order_code' => $data->orderCode,
                'total_price' => $total+3000,
            ]);
            return response()->json([
                'status' => 'true',
                'message' => 'order complete'
            ], 200);


    }

    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'Qty' =>$request->count,
        ];
    }
}
