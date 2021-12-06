<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\settings;
use Illuminate\Support\File;
use Illuminate\Support\Facades\Storage;


use Hash;


class SettingsController extends Controller
{
    public function index()
    {
        // $user_id=Auth::user()->id;
        $usertype=Auth::user()->user_type;
        $userid=Auth::user()->id;

        $settings = DB::table('settings')
        ->select('*')
        ->get();

      
       
        if($usertype =="1") {
            return view('technician.settings');
        }
        elseif($usertype =="2") {
            return view('user.settings');
        }
        else {
           
            return view('admin.settings',compact('settings'));
        }


    }

    
    public function changePasswordPost(Request $request) {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");
    }


    public function changeNameandMail(Request $request)
    {
  

        $data=User::find($request->id);
        $data->email=$request->email;
        $data->name=$request->name;
        $data->save();
        return redirect()->route('settings')->with('success','Profile Information edited successfully.'); 
    }

    public function changesettings(Request $request)
    {


        $request->validate([
            'nameweb' => 'required',

        ]);

        $data=settings::find('1');


        if($request->hasFile('image')){

            $namef = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/',$namef);
            $data->logo = $namef;

        }
       
        
        $data->nameweb = $request->input('nameweb');
    

        $data->save(); 
        return redirect()->route('settings')
                        ->with('success','Settings created successfully.');
    }

  
}
