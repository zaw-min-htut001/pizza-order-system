<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
      // dashboard

      public function dashboard(){
        if ( Auth::User()->role == 'admin'){
            return redirect()->route('category#list');
        } else {
            return redirect()->route('user#home');
        }
     }


}
