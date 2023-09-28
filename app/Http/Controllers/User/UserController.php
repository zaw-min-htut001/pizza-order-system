<?php

namespace App\Http\Controllers\User;

use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home page
    public function home(){
        $data = Product::get();
        $category = Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('data','category','cart','order'));
    }
    //
    public function userMessage(){
        $contact =Contact::paginate(5);
        return view('admin.message',compact('contact'));
    }
    //
    public function contactPage(){
        return view('user.contact');
    }
    //
    public function contactDataPage(Request $request){
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,

        ];
        Contact::create($data);
        return back()->with(['completed'=> 'Your Message is sent...']);
    }
    public function filter($category_id){
        $data = Product::where('category_id',$category_id)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('data','category','cart'));

    }
    //
    public function roleChange(){
        $users = User::where('role','user')->paginate(3);

        return view('admin.user.userList',compact('users'));
    }
    //
    public function role(Request $request){
        User::where('id',$request->id)->update([
            'role' => $request->status
        ]);
    }
    //cart
    public function cartList(){
        $data = Cart::select('carts.*','products.*','carts.id')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('user_id',Auth::user()->id)
                    ->get();

                    $totalPrice = 0;
                    foreach($data as $d ){
                        $totalPrice += $d->price*$d->Qty;
                    };

        return view('user.main.cart',compact('data','totalPrice'));
    }
    //pizza detail
    public function details($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }
    // pass change page
    public function passChangePage(){
        return view('user.pass.change');
    }
    //account page
    public function userPage(){
        return view('user.accunt');
    }
    //
    public function editPage(){
        return view('user.edit');
    }
    // update acc
    public function edit($id,Request $request){
        $this->updateValidation($request);
        $data = $this->updateAccount($request);
        //for image
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage =$dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;

        }
        User::where('id',$id)->update($data);
        return back()->with(['update' => 'Post updated...']);
    }
    //pass
     //pass change
     public function passChange(Request $request){
        $this->passValidationCheck($request);
        $user = User::select('password')->where('id',Auth::User()->id)->first();
        $dbValue = $user->password;
        if(Hash::check($request->oldPassword, $dbValue)){
                $data =[
                    'password' => Hash::make($request->newPassword),
                ];
                User::where('id',Auth::User()->id)->update($data);
               // Auth::logout();
                return back()->with(['PASS'=> 'PASSWORD CHANGES ... ']);
        }else{
            return back()->with(['notMatch'=> 'The Old Password is not Match. Try Again ...']);
        }

     }
     //history
     public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate('4');
        return view('user.main.history',compact('order'));
     }
     // pass validation
     private function passValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required' ,
            'newPassword' => 'required | min:6' ,
            'comfirmPassword' => 'required | min:6 |same:newPassword' ,
        ])->validate();
     }
     //
     private function updateAccount($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),

        ];
    }
    //update validation
    private function updateValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',

        ])->validate();
    }
}
