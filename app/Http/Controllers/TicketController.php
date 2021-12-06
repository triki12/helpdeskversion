<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use App\Models\User;
use App\Models\service;
use App\Models\notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\File;

class TicketController extends Controller
{

   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::user()->id;
        $usertype=Auth::user()->user_type;
        /** 
        $tickets = DB::table('ticket')
        ->where('ticket.user_id',$user_id)
        ->select('ticket.*','ticket.id as ticket_id')
        ->get();
        $ticket_admin=DB::table('ticket')
        ->where('ticket.status','=','en attente')
        ->select('ticket.*','ticket.status as ticket_status')
        ->get(); */
    
        
        //  $technicien=DB::table('users')
        //  ->select('*')
        //  ->where('users.user_type','=','1')
        //  ->whereNotIn('users.id',function($query) {
        //  $query->select('assignedto')->from('ticket');
        //  })
        //  ->get();
        // mysqli_query($technicien, "SELECT * FROM users WHERE user_type=1 and id NOT IN (SELECT assignedto FROM ticket)");

    


        if($usertype =="1") {


            $ticketstech = DB::table('ticket')
            
            ->where('ticket.assignedto',$user_id)
            ->select('ticket.*','ticket.id as ticket_id')
            ->paginate(5);



            $nameclientsoftickets = DB::table('users')
            ->select(
                'users.id',
                'users.name'
            )
            ->where('ticket.assignedto',$user_id)
            ->where('users.user_type','2')
            ->leftJoin('ticket','ticket.user_id','=','users.id')
            ->get();
            

            return view('technician.tickets', array('ticketstech'=>$ticketstech,'nameclientsoftickets'=>$nameclientsoftickets) ); 



        }
        elseif($usertype =="2") {
            $tickets = DB::table('ticket')
             ->where('ticket.user_id',$user_id)
             ->select('ticket.*','ticket.id as ticket_id')
             ->paginate(5);
     

             $services = DB::table('services')
             ->get();


            return view('user.tickets',  array('tickets'=>$tickets,'services'=>$services));


        }
        else {
            
            /** 
            $serviceprovidersdispo = DB::table('users')
            ->join(
                'ticket', 
                function ($join)
                {$join->on('users.id', '!=', 'ticket.assignedto');
      }
            )
            ->where('users.user_type','1')
            ->get(); */


            $serviceprovidersdispo = \DB::table('users')
            ->select(
                'users.id',
                'name'
            )
            ->where('users.user_type','1')
            ->leftJoin('ticket','ticket.dispotech','=','users.id')
            ->whereNull('ticket.dispotech')
            ->get();


            $serviceprovidersaffected = \DB::table('users')
            ->select(
                'users.id',
                'name',
                'ticket.id as ticketid',
            )
            ->where('users.user_type','1')
            ->leftJoin('ticket','ticket.assignedto','=','users.id')

            
            ->get();


            $nameclientsofticket = \DB::table('users')
            ->select(
                'users.id',
                'name',
                'ticket.id as ticketid',
            )
            ->where('users.user_type','2')
            ->leftJoin('ticket','ticket.user_id','=','users.id')
            ->get();
        

            
           

           
           $tickets = ticket::paginate(5);
           return view('admin.tickets', array('tickets'=>$tickets,'technicien'=>$serviceprovidersdispo,
           'sprovideraffected'=>$serviceprovidersaffected,'nameclientsofticket'=>$nameclientsofticket)); 

        }


       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usertype=Auth::user()->user_type;
        $services = DB::table('services')->get();


        if($usertype =="1") {
            return view('technician.tickets');


        }
        elseif($usertype =="2") {
            return view('user.newticket',array('services'=>$services));


        }
        elseif($usertype =="0")  {


            return view('admin.newticket',array('services'=>$services));

        } 
        else {
            return view('404');

        } 
    
    
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id=Auth::user()->id;
        $request->validate ([
            'sujet' => 'required',
            'description' => 'required',
            'service' => 'required',
            'criticité' => 'required',
            'image'=>'required',

        ]);
        $namef =$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images/',$namef);
    
        do {
            $refrence_id = mt_rand( 1000000000, 9999999999 );
         } while ( DB::table( 'ticket' )->where( 'ref', $refrence_id )->exists() );
        // ticket::create([
        //     'description' => $request->input('description'),
        //     'ref' => '#' . $refrence_id,
        //     'sujet' => $request->input('sujet'),
        //     'service' => $request->input('service'),
        //     'criticité' => $request->input('criticité'),
        //     'status' => "Open",
        //     'user_id' => Auth::user()->id,
        //     'gallery'=>$namef,
        // ]);
        $ticket=new Ticket();
        $ticket->ref='#' . $refrence_id;
        $ticket->description=$request->input('description');
        $ticket->sujet= $request->input('sujet');
        $ticket->service=$request->input('service');
        $ticket->criticité=$request->input('criticité');
        $ticket->status="Open";
        $ticket->user_id= Auth::user()->id;
        $ticket->gallery=$namef;
        $ticket->save();
        
        notification::create([
            'ref' => '#' . $refrence_id,
            'message' =>"New Ticket was opened ",
            'sender_id' => Auth::user()->id,
            

        ]);
     
        return redirect()->route('tickets.index')
                        ->with('toast_success','Ticket created successfully.');

    }

    function Confirmer($id){
        alert()->question('Are you sure?','You won\'t be able to delete this!')
        ->showConfirmButton('<a href="delete/' . $id . ' " class="text-white" style="text-decoration:none">Delete</a>', '#3085d6')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();
        return redirect()->route('tickets.index');
        
            }
            function delete($id){
                ticket::destroy($id);
                return redirect()->route('tickets.index')->with('toast_success','Ticket deleted successfully.');
            
            } 
            
        function confirmReopen($id){
            alert()->question('Are you sure?','You won\'t be able to Reopen this ticket!')
            ->showConfirmButton('<a href="reopenticket/' . $id . ' " class="text-white" style="text-decoration:none">Reopen</a>', '#3085d6')->toHtml()
            ->showCancelButton('Cancel', '#aaa')->reverseButtons();
            return redirect()->route('tickets.index');
            
        }

            /**
     * Display the specified resource.
     *
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function showTicket($id)
    {
        $data=ticket::find($id);
        return view('user.edit',['data'=>$data]);
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function updateTicket(Request $request)
    {
  
        $this->validate($request, [
       
            'criticité' => 'required',
         
        ]);

        $data=ticket::find($request->id);
        $data->ref=$request->ref;
        $data->description=$request->description;
        $data->sujet=$request->sujet;
        $data->service=$request->service;
        $data->criticité=$request->criticité;
        $data->save();
        return redirect()->route('tickets.index')->with('success','Ticket edited successfully.'); ;  
    }


      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function assignedTicket(Request $request)
    {
        /** 
        $data=ticket::find($id);
        $data->assignedto=$request->assignedto;
        
        $data->save();  */

        $this->validate($request, [
            'assignedto' => 'required',
            

        ]);


        $data = Ticket::find($request->id);
        $data->assignedto = $request->assignedto;
        $data->dispotech = $request->assignedto;

        $data->status = "Pending";

        $data->save();


        notification::create([
            'ref' => $request->ref,
            'message' =>"New Ticket was assigned to you Mr  ",
            'receiver_id' => $request->assignedto,
            

        ]);

        notification::create([
            'ref' => $request->ref,
            'message' =>"Your ticket was assigned to  ",
            'receiver_id' => $request->user_id,
            

        ]);
        return redirect()->route('tickets.index')->with('success','Service provider added successfully.');       
    }


         /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    function confirmResolved($id){
        alert()->question('Are you sure?','You won\'t be able to Resolve this ticket!')
        ->showConfirmButton('<a href="resolveticket/' . $id . ' " class="text-white" style="text-decoration:none">Resolve</a>', '#3085d6')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();
        return redirect()->route('tickets.index');
        
    }
    
    function confirmClose($id){
        alert()->question('Are you sure?','You won\'t be able to Close this ticket!')
        ->showConfirmButton('<a href="closeticket/' . $id . ' " class="text-white" style="text-decoration:none">Close</a>', '#3085d6')->toHtml()
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();
        return redirect()->route('tickets.index');
        
    }
    public function closeTicket(Request $request)
    {
        $data = Ticket::find($request->id);
        $data->status = "Closed";
        $data->dispotech = NULL;
        $data->save();
        return redirect()->route('tickets.index')->with('success','Ticket resolved successfully.');
        
    }
     public function confirmTicket($id)
    {
        $data = Ticket::find($id);
     
        $data->status = 'Resolved';

        $data->save();
        return redirect()->route('tickets.index')->with('success','Ticket resolved successfully.');
        
    }


             /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
   

    public function reopenTicket($id)
    {
        $data = Ticket::find($id);
        $data->status = "Pending";
        $data->save();
        return redirect()->route('tickets.index')->with('toast_success','Ticket Reopned successfully.') ;
        
    }

    public function detailTicket($id){
        $usertype=Auth::user()->user_type;
        $data=ticket::find($id);
        $services = DB::table('services')
        ->get();
        $technicienof = DB::table('users')
        ->where('users.user_type','1')
        ->select('users.*')
        ->get();

        if($usertype =="1") {
            return view('technician.detail',['data'=>$data,'services'=>$services]);


        }
        elseif($usertype =="2") {
            return view('user.detail',['data'=>$data,'services'=>$services,'technicienof'=>$technicienof]);


        }
        elseif($usertype =="0")  {
            return view('admin.detail',['data'=>$data,'services'=>$services,'technicienof'=>$technicienof]);

        } 
      }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    static function ticketopened(){
      return ticket::where('ticket.status','Open')->count();
    }

    static function ticketpending(){
        return ticket::where('ticket.status','Pending')->count();
      }

      static function ticketresolved(){
        return ticket::where('ticket.status','Resolved')->count();
      }
      static function allticket(){
        return ticket::select('*')->count();
      }
      static function nbrtechnicien(){
        return user::where('users.user_type','1')->count();
    }
    static function nbrusers(){
        return user::where('users.user_type','2')->count();
    }

    static function nbrtechniciendispo(){
        return DB::table('users')
        ->select(
            'users.id',
            'name'
        )
        ->where('users.user_type','1')
        ->leftJoin('ticket','ticket.dispotech','=','users.id')
        ->whereNull('ticket.dispotech')
        ->count();

    }

    
    static function top5(){
        $tech= DB::table('users')
            ->select('*')
            ->where('users.user_type','1')
            ->take(5)
            ->latest()
            ->get();
            return $tech;
    
          }
    
}
