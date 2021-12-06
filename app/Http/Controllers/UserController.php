<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
     public function index()
    {
        $usertype=Auth::user()->user_type;
        $users= DB::table('users')
        ->where('users.user_type','=','2')
        ->select('users.*','users.user_type as user_type')
        ->paginate(5);


        

        if($usertype =="0") {
            return view('admin.users',compact('users'));
        }
    }
}
