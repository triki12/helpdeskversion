<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\File;
use Illuminate\Support\Facades\Storage;


class ServiceController extends Controller
{
    public function index()
    {
        // $user_id=Auth::user()->id;
        $usertype=Auth::user()->user_type;
        $services = DB::table('services')
        ->select('*')
        ->get();
       
        if($usertype =="1") {
            return view('technician.services', compact('services'));
        }
        elseif($usertype =="2") {
            return view('user.services', compact('services'));
        }
        else {
            return view('admin.services',compact('services'));
        }
    }
    public function create()
    {
        $usertype=Auth::user()->user_type;

        if($usertype =="1") {
            return view('technician.services');
        }
        elseif($usertype =="2") {
            return view('user.services');


        }
        elseif($usertype =="0")  {
            return view('admin.newservice');

        } 
        else {
            return view('404');

        } 

    }

    public function store(Request $request)
    {

            
        $request->validate([
            'service_name' => 'required',
            'description' => 'required',
            'image' => 'required',


        ]);
   
        $namef = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images/',$namef);
        
        $service= new Service();
        $service->service_name = $request->input('service_name');
        $service->description = $request->input('description');

        $service->gallery = $namef;
    

        $service->save(); 
        return redirect()->route('services.index')
                        ->with('success','Service created successfully.');
            

    }
    public function detailservice($id){
        $usertype=Auth::user()->user_type;
        $data=service::find($id);
        

        if($usertype =="1") {
            return view('technician.detailservice',['data'=>$data]);


        }
        elseif($usertype =="2") {
            return view('user.detailservice',['data'=>$data]);


        }
        elseif($usertype =="0")  {
            return view('admin.detailservice',['data'=>$data]);

        } 
      }

      function Confirmerservice($id){
            alert()->question('Are you sure?','You won\'t be able to delete this!')
            ->showConfirmButton('<a href="deleteservice/' . $id . ' " class="text-white" style="text-decoration:none">Delete</a>', '#3085d6')->toHtml()
            ->showCancelButton('Cancel', '#aaa')->reverseButtons();
            return redirect()->route('services.index');
      }
    function removeservice($id){
        service::destroy($id);
        return redirect()->route('services.index')->with('toast_success','Ticket deleted successfully.');
    
    } 
    public function showService($id)
    {
        $data=service::find($id);
        return view('admin.edit',['data'=>$data]);
    }
    public function updateService(Request $request){
        $data=Service::find($request->id);
        $data->description=$request->description;
        $data->service_name=$request->service_name;
        $data->gallery=$request->gallery;
        $data->save();
        return redirect()->route('services.index') ;
    }
}
