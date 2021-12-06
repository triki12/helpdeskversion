<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ticket;
use App\Models\settings;

use Illuminate\Support\Facades\DB;


use PDF;


class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $usertype=Auth::user()->user_type;
        $nameofsender=Auth::user()->name;
        $emailofsender=Auth::user()->email;

        $data=ticket::find($id);
        $services = DB::table('services')
        ->where('services.id',$data->service)
        ->select('services.*')
        ->get();
        $technicienof = DB::table('users')
        ->where('users.user_type','1')
        ->where('users.id',$data->assignedto)
        ->select('users.*')
        ->get();
        $namef="";
        if(!empty($technicienof[0])){
            $namef=$technicienof[0]->name;
            $email=$technicienof[0]->email;


        }
        else{
            $namef="Not assinged yet";
            $email="Not assinged yet";

        }
        $ldate = date('Y-m-d H:i:s');

        $settings= DB::table('settings')
        ->select('settings.*')
        ->get();

        $websitename=$settings[0]->nameweb;

        $data = [
            'title' => 'Ticket Ref'.$data->ref,
            'date' => ''.$ldate,
            'subject' => $data->sujet,
            'description' => $data->description,
            'criticité' =>$data->criticité,
            'status' => $data->status,
            'createdat' => $data->created_at,
            'service' => $services[0]->service_name,
            'sname' => $namef,
            'email' => $email,
            'websitename' =>$websitename,
            'nameofsender' =>$nameofsender,
            'emailofsender' =>$emailofsender,


            



           
                // $data is empty
            





        ];
          
        $pdf = PDF::loadView('user.pdfticket', $data);
    
        return $pdf->download('itsolutionstuff.pdf');
    }
}
