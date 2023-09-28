<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //
    public function apiTest(){
        $data = Product::get();
        return response()->json($data, 200);
    }

    //
    public function userList(){
        $product = Product::get();
        $user = User::get();
        $data =[
            'products' => $product,
            'users' => $user
        ];

        return response()->json($data, 200);
    }
    public function categoryLists(){
        $data = Category::get();
        return response()->json($data, 200);
    }
    public function categories(Request $requset){

        $data =[
            'name' => $requset->name,
            'created_at' =>Carbon::now(),
            'updated_at' =>Carbon::now(),

        ];
        $cate = category::create($data);
        return response()->json($cate, 200);

    }

    public function categoriesDelete($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status' => 'true','message' => 'delete success','data' => $data], 200);
        }
        return response()->json(['status' => 'false','message' => 'There is no Category...' ], 200);

    }

    public function categoriesDetail($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){

            return response()->json(['status' => 'true','message' => 'category detail','data' => $data], 200);
        }
        return response()->json(['status' => 'false','message' => 'There is no Category...' ], 200);
    }
    public function update(Request $request){
        $data=$this->getUpdateData($request);
        $db = Category::where('id',$request->category_id)->first();

        if(isset($db)){
            Category::where('id',$request->category_id)->update($data);
            $response =Category::where('id',$request->category_id)->first();

            return response()->json(['status' => 'true','message' => 'updated success','data' =>$response], 200);
        }
        return response()->json(['status' => 'false','message' => 'There is no Category...' ], 500);
    }
    private function getUpdateData($request){
        return [
            'name' => $request->category_name,
            'updated_at'=> Carbon::now(),
        ];

    }
}
