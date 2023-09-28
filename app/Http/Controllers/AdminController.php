<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // admin register

    public function loginPage(){
        return view('login');
    }

    public function registerPage(){
        return view('register');
    }

    // admin
      // change Pass
      public function changePasswordPage(){
        return view('admin.user.changePass');
     }

     //pass change
     public function changePassword(Request $request){
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

     // account
    public function detail(){
        return view('admin.user.userDetail');
    }

     //
    public function edit(){
        return view('admin.user.userEdit');
    }

    // update acc
    public function update($id,Request $request){
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
        return redirect()->route('admin#detail')->with(['update' => 'Post updated...']);
    }
    //Account list
    public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');

        })
        ->where('role','admin')
        ->paginate(3);
        $admin->appends(request()->all());
        return view('admin.user.list',compact('admin'));
    }
    //
    public function adminUserDelete($id){
        User::where('id',$id)->delete();
        return back();
    }
    //admin dele
    public function delete($id){
       $data = User::where('id',$id)->delete();
       return back()->with(['deleteSucess' => 'Account deleted...']);
    }

    //role data
    private function requestRoleData($request){
        return [
            'role' => $request->role
        ];
    }
    //update

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
     // pass validation
     private function passValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required' ,
            'newPassword' => 'required | min:6' ,
            'comfirmPassword' => 'required | min:6 |same:newPassword' ,
        ])->validate();
     }
}
