<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Appointment;
use App\Models\Notification;
use auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    public function index()
    {
        // $user = Session::get('admin');
        // $ticketQ = Ticket::where('created_at' , '>=', Carbon::today())->orderBy('id' , 'asc')->where('user_id' , $user->id)->whereNull('serving_time')->where('is_discarded',0)->get();
        // $ticketServing = Ticket::where('created_at' , '>=', Carbon::today())->orderBy('id' , 'asc')->where('user_id' ,  $user->id)->whereNotNull('serving_time')->whereNull('served_time')->where('is_discarded',0)->get();
        // $ticketServed= Ticket::where('created_at' , '>=', Carbon::today())->orderBy('id' , 'asc')->where('user_id' ,  $user->id)->whereNotNull('serving_time')->whereNotNull('served_time')->where('is_discarded',0)->get();
        // $ticketNos = Appointment::where('is_served' , 0)->where('created_at' , '>=', Carbon::today())->select('ticket_id')->get()->toArray();
        // //dd($ticketNos);
        // $special = Ticket::whereIn('ticket_number' , $ticketNos)->where('created_at' , '>=', Carbon::today())->whereNull('serving_time')->get();
       // dd($special);
       $users = DB::select('select * from users where role_id = 3');
        return view('user.dashboard',compact('users'));
    }
    public function index2()
    {
        // $user = Session::get('admin');
        // $ticketQ = Ticket::where('created_at' , '>=', Carbon::today())->orderBy('id' , 'asc')->where('user_id' , $user->id)->whereNull('serving_time')->where('is_discarded',0)->get();
        // $ticketServing = Ticket::where('created_at' , '>=', Carbon::today())->orderBy('id' , 'asc')->where('user_id' ,  $user->id)->whereNotNull('serving_time')->whereNull('served_time')->where('is_discarded',0)->get();
        // $ticketServed= Ticket::where('created_at' , '>=', Carbon::today())->orderBy('id' , 'asc')->where('user_id' ,  $user->id)->whereNotNull('serving_time')->whereNotNull('served_time')->where('is_discarded',0)->get();

       // dd($special);
        return view('user.dashboard2', compact('special'));
    }
    public function startServe(Ticket $ticket)
    {
        $ticket->serving_time = Carbon::now();
        $ticket->update();
        return redirect('udashboard')->with('success','Ticket Updated');
    }

    public function startServed(Ticket $ticket)
    {
        $ticket->served_time = Carbon::now();
        $ticket->update();
        return redirect('udashboard')->with('success','Ticket Updated');
    }
    public function discard(Ticket $ticket)
    {
        $ticket->is_discarded = 1;
        $ticket->update();
        return back()->with('success','Ticket Updated');
    }
     public function getTicketsDashboard()
    {

        $section = DB::select("select u.name as username, u.id as userId, s.name as section_name from users as u inner join sections as s on u.section_id = s.id");
        foreach($section as $s) {
            $tickets = DB::select('select t.* from tickets t JOIN session s ON t.session_id=s.id where s.session_status = 0 and t.served_time is null and t.section_id != 1 and t.is_discarded = 0 and t.user_id = ' . $s->userId . ' limit 4');
            for ($i = 4; $i > count($tickets); $i--){
                array_push($tickets, '--');
            }
            $s->tickets = $tickets;
        }
        return view('user.dashboard3');
    }

    public function getTicketsDashboard3()
    {
        $section = DB::select("select u.name as username, u.id as userId, s.name as section_name from users as u inner join sections as s on u.section_id = s.id");
        $divTicketData = '';
        $divDeskData = '';
        foreach ($section as $s) {
            $divDeskData .= '<p class="desk">' . $s->section_name . '</p>';
            $divTicketData .= '<div class="row">';
            $tickets = DB::select('select t.* from tickets t JOIN session s ON t.session_id=s.id where s.session_status = 0 and t.served_time is null and t.section_id != 1 and t.is_discarded = 0 and t.user_id = ' . $s->userId . ' limit 4');
            foreach ($tickets as $key => $t) {
                $mClass = $key == 0 ? 'ticketActive col-md-3' : 'ticket col-md-3';
                $type = '';
                if ($t->is_appoint == 1) $type = 'A';
                if ($t->is_appoint == 2) $type = 'S';
                $divTicketData .= '<p class="' . $mClass . '" >' . $t->ticket_number . $type . '</p >';
            }
            $arrLength = count($tickets);
            for ($i = 4; $i > $arrLength; $i--) {
//                array_push($tickets, '--');
                $divTicketData .= '<p class="ticket col-md-3">--</p>';
            }
            $divTicketData .= '</div>';
            $s->tickets = $tickets;
        }
        $divQueueData = '';
        $queueData = DB::select('select t.* from tickets t JOIN session s ON t.session_id=s.id where s.session_status = 0 and t.served_time is null and t.section_id = 1 and t.is_appoint = 0');
        foreach ($queueData as $qd) {
            $type = '';
            if ($qd->is_appoint == 2) $type = "S";
            $divQueueData .= '<p class="col ticket col-md-3">' . $qd->ticket_number . $type . '</p>';
        }
        $divAppointmentData = '';
        $appointments = DB::select('select t.* from tickets t JOIN session s ON t.session_id=s.id where s.session_status = 0 and t.served_time is null and t.section_id = 1 and t.is_appoint = 1');
        if (count($appointments) > 0){
            foreach ($appointments as $tic) {
                if (isset($tic)) {
                    $divAppointmentData .= '<p class="col ticket col-md-3">' . $tic->ticket_number . 'A</p>';
                }
            }
        }
        $showModel = false;
        $message = '';
        $notification = DB::table('notifications')->select('*')->where('id', '=', 1)->first();
        if($notification->status == 0){
            DB::table('notifications')
                ->where('id', 1)
                ->update(['status' => 1]);

            $ticket = Ticket::where('id',$notification->ticket_id)->first();
            $table = DB::table('sections')->where('id', '=',$ticket->section_id)->first();
            $type = '';
                if ($ticket->is_appoint == 1) $type = 'A';
                if ($ticket->is_appoint == 2) $type = 'S';
            $message = "Ticket no ". $ticket->ticket_number .$type." Please go to Desk ". $table->name;
            $showModel = true;
            
        }
//        if (Session::has('serveTime') && Session::get('serveTime') == 'show') {
//            Session::put('serveTime', 'hide');
//            $message = "Ticket no ". Session::get('ticketData')->ticket_number ." is on the desk no ". Session::get('ticketData')->table->name;
//            $showModel = true;
//        }
            return response()->json(['ticketData'=> $divTicketData, 'deskData'=> $divDeskData,
            'queueData'=> $divQueueData, 'appointmentData'=> $divAppointmentData, 'showModel'=>$showModel, 'message'=>$message]);
    }

    public function getTicketsByHair(Request $request)
    {
        $id= $request->id;
        $html='';
        if($id>0)
        $section = DB::select('select s.id, s.name as section_name, u.name as username from sections as s inner join users as u on s.id = u.section_id where s.id=?',[$id]);
        else
        $section = DB::select('select s.id, s.name as section_name, u.name as username from sections as s inner join users as u on s.id = u.section_id where s.is_system=0');
        foreach($section as $sec) {
        $html = '<div class="status-card" ><div class="card-header"><span class="card-header-text">'.$sec->section_name. "/".$sec->username.' </span></div>';
        $html .= '<div class="list" id="c_'.$sec->id.'" data-status-id="'.$sec->id.'"><script type="text/javascript">new Sortable.create(document.getElementById("c_'.$sec->id.'"), opt);</script>';
        $tickets = DB::select('select tickets.id, tickets.session_id, tickets.ticket_number, tickets.user_id, tickets.section_id, tickets.enqueue_time, tickets.serving_time, tickets.served_time, tickets.is_discarded, tickets.possible_serving, tickets.is_appoint, tickets.que_in from tickets inner join session on session.id=tickets.session_id where session.session_status = 0 and que_in=0  and section_id = ?',[$sec->id]);
          foreach($tickets as $ticket)
          {
            if ($ticket->is_appoint==1)
            {
              $html .= '<div class="text-row ui-sortable-handle" style="background:green!important; color:white!important;"  data-task-id="'.$ticket->id.'">'.$ticket->ticket_number.'-Appointment';
              if(is_null($ticket->serving_time))
                  $html .= '<form action="'.route('ticket.serving', ['ticket' => $ticket->id]).'" method="POST" id = "form-ap-'.$ticket->id.'" style="background:green; color:#fff;padding:5px; float: right; margin-top: -25px; font-size:12px;"> '.csrf_field().' <a href="javascript:{}" onclick="document.getElementById('."'form-ap-".$ticket->id."'".').submit(); return false;" class="row g-0 sh-10"> Serve

                         </a>
                    </form></div>';
              else
                $html .= '<form action="'.route('ticket.serveded', ['ticket' => $ticket->id]).'" method="POST" id = "form-ap_serve-'.$ticket->id.'"> '.csrf_field().' <a background:green; color:#fff!important;padding:5px; float: right; margin-top: -25px; font-size:12px;" href="javascript:{}" onclick="document.getElementById('."'form-ap_serve-".$ticket->id."'".').submit(); return false;" class="row g-0">
                            Served
                         </a>
                    </form>
                    <form action="'.route('ticket.discarded', ['ticket' => $ticket->id]).'" method="POST" id = "form-ap-discard-'.$ticket->id.'"> '.csrf_field().' <a background:red; color:#fff!important;padding:5px; float: right; margin-top: -25px; font-size:12px;" href="javascript:{}" onclick="document.getElementById('."'form-ap-discard-".$ticket->id."'".').submit(); return false;" class="row g-0">

                            Discard
                         </a>
                    </form></div>';
            }else
            {
              $html .='<div class="text-row ui-sortable-handle" style="background:#FFC000!important; color:white!important; font-size:30px;"  data-task-id="'.$ticket->id.'">'.$ticket->ticket_number;
              if($ticket->is_appoint==2)
                $html .= 'S';
              else
                $html .= '';
              if(is_null($ticket->serving_time))
                  $html .= '<form action="'.route('ticket.serving', ['ticket' => $ticket->id]).'" method="POST" id = "form-ap-'.$ticket->id.'"> '.csrf_field().' <a style="background:blue; color:#fff!important;padding:5px; float: right; margin-top: -25px; font-size:12px;" href="javascript:{}" onclick="document.getElementById('."'form-ap-".$ticket->id."'".').submit(); return false;" class="row g-0"> Serve

                         </a>
                    </form></div>';
              else
                $html .= '<form action="'.route('ticket.serveded', ['ticket' => $ticket->id]).'" method="POST" id = "form-ap_serve-'.$ticket->id.'"> '.csrf_field().' <a style="background:green; color:#fff!important;padding:5px; float: right; margin-top: -25px; font-size:12px;" href="javascript:{}" onclick="document.getElementById('."'form-ap_serve-".$ticket->id."'".').submit(); return false;" class="row g-0">
                            Served
                         </a>
                    </form>
                    <form action="'.route('ticket.discarded', ['ticket' => $ticket->id]).'" method="POST" id = "form-ap-discard-'.$ticket->id.'"> '.csrf_field().' <a style="background:red; color:#fff!important;padding:5px; float: right; margin-top: -25px; font-size:12px;" href="javascript:{}" onclick="document.getElementById('."'form-ap-discard-".$ticket->id."'".').submit(); return false;" class="row g-0">

                            Discard
                         </a>
                    </form>
                    </div>';
            }
          }
        $html.='</div></div>';
        }
        return $html;

    }

  public function store(Request $req)
    {
        $notificationData['status'] = 0;
        $notificationData['ticket_id'] = $req->get('token');
        $notificationData['time'] = \Carbon\Carbon::now();
        DB::table('notifications')->where('id', '=', 1)->update($notificationData);
        return response()->json(['res'=>$req->get('token')]);


    }
}
