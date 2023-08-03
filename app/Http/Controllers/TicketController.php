<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Setting;
use App\Models\QueLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Sessions;
use Illuminate\Support\Facades\Session;
use Rawilk\Printing\Contracts\Printer;
use Rawilk\Printing\Facades\Printing;

class TicketController extends Controller
{
    public function CreateTicket(Request $request)
    {
        $printers = Printing::printers();

        foreach ($printers as $printer) {
            echo $printer->name();
        }

        $printerId = 72531126;
        $printJob = Printing::newPrintTask()
            ->printer($printerId)
            ->file('pdf-sample.pdf')
            ->send();

        $printJob->id(); // the id number returned from the print server

        dd($printJob->id());

        $session =  Sessions::where('session_status', 0)->first();
        $session_id = 0;
        if (!is_null($session))
            $session_id = $session->id;
        else {
            $session = new Sessions();
            $session->session_start_at = Carbon::now();
            $session->save();
            $session_id = $session->id;
        }
        $thisDayTicket = Ticket::where('created_at', '>=', Carbon::today())->orderBy('id', 'desc')->get();
        $lastOne = $thisDayTicket->first();
        $setting = Setting::first();
        $ticket_no = $setting->ticket_starts;
        $hairdressers = User::where('role_id', 3)->where('section_id', '>', 0)->get();
        $u = array();
        $possibletime = "";
        if ($thisDayTicket->count()) {
            $user_id = 0;
            $count = 0;
            $section_id = 0;
            $ticket_no = $setting->ticket_starts + $thisDayTicket->count() + 1;
            foreach ($hairdressers as $hairdresser) {
                $getQ = Ticket::where('user_id', $hairdresser->id)->whereNull('served_time')->whereNull('serving_time')->whereDate('created_at', Carbon::today())->get();
                if ($getQ->count()) {
                    array_push($u, ['uid' => $hairdresser->id, 'sid' => $hairdresser->section_id, 'q' => $getQ->count()]);
                } else {
                    array_push($u, ['uid' => $hairdresser->id, 'sid' => $hairdresser->section_id, 'q' => $getQ->count()]);
                }
            }
            if (!is_null($lastOne->possible_serving))
                $possibletime = Carbon::parse($lastOne->possible_serving)->addMinutes(30);
            else
                $possibletime = Carbon::now()->addMinutes(30);
        } else {
            $ticket_no = $setting->ticket_starts + 1;
            $uId = DB::select('select users.id , section_id from users inner join sections on users.section_id = sections.id LIMIT 1');
            array_push($u, ['uid' => $uId[0]->id, 'sid' => $uId[0]->section_id, 'q' => 0]);
            $user_id = $uId[0]->id;
            $section_id = $uId[0]->section_id;
            $possibletime = Carbon::now()->addMinutes(30);
        }
        $min = PHP_INT_MAX;
        foreach ($u as $value) {
            if ($value['q'] < $min) {
                $user_id = $value['uid'];
                $section_id = $value['sid'];
                $min = $value['q'];
            }
        }
        $is_appoint = 0;
        if ($request->filled('section_id')) {
            $section_id = $request->section_id;
            $is_appoint = 2;
        } else {
            $section_id = 1;
            $is_appoint = 0;
        }
        $ticket = new Ticket();
        $ticket->ticket_number = $ticket_no;
        $ticket->user_id = isset($_POST['user_id']) ? $request->get('user_id') : $user_id;
        $ticket->section_id = $section_id;
        $ticket->is_appoint = $is_appoint;
        $ticket->session_id = $session_id;
        $ticket->possible_serving = $possibletime;
        $ticket->Save();

        $this->Que_Log($ticket->id, $user_id, $section_id, 0);
        $data = DB::select('select t.ticket_number,t.possible_serving, t.is_appoint, u.name as uname , s.name from tickets as t inner join users as u on u.id = t.user_id inner join sections as s on s.id = t.section_id where t.id = ?', [$ticket->id]);

        $setting = Setting::all();


        // Here we will write the code for printing a document.

        return view('receptionist.ticket', compact('data', 'setting'));
    }
    public function PrintTicket($ticketid)
    {
        $ticket = Ticket::where('id', $ticketid)->first();
        return $ticket;
    }
    public function StartTicketServingTime($ticketid)
    {
        $ticket = Ticket::where('id', $ticketid)->first();
        $ticket->serving_time = Carbon::now()->timestamp;
        $ticket->save();
        return $ticket;
    }
    public function EndTicketServingTime($ticketid)
    {
        $ticket = Ticket::where('id', $ticketid)->first();
        $ticket->served_time = Carbon::now()->timestamp;
        $ticket->update();
        $this->Que_Log($ticket->id, $ticket->user_id, $ticket->section_id, 1);
        return $ticket;
    }
    public function DiscardTicket($ticketid)
    {
        $ticket = Ticket::where('id', $ticketid)->first();
        $ticket->is_discarded = 1;
        $ticket->update();
        $this->Que_Log($ticket->id, $ticket->user_id, $ticket->section_id, 1);
        return $ticket;
    }
    public function StartTicketServingTimee(Ticket $ticket)
    {
        $ticket = Ticket::where('id', $ticket->id)->first();
        $ticket->serving_time = Carbon::now();
        $ticket->save();
        //        $ticket->table = DB::table('sections')->where('id', '=',$ticket->section_id)->first();
        //         $notificationData['status'] = 0;
        //         $notificationData['ticket_id'] = $ticket->id;
        //         $notificationData['time'] = Carbon::now();
        //         DB::table('notifications')->where('id', '=', 1)->update($notificationData);
        //        Session::put('serveTime', 'show');
        //        Session::put('ticketData', $ticket);
        return redirect()->back()->withSuccess('Hairdresser added successfully');
    }
    public function EndTicketServingTimee(Ticket $ticket)
    {
        $ticket = Ticket::where('id', $ticket->id)->first();
        $ticket->served_time = Carbon::now();
        $ticket->que_in = 2;
        $ticket->update();
        $this->Que_Log($ticket->id, $ticket->user_id, $ticket->section_id, 1);
        return redirect()->back()->withSuccess('Hairdresser added successfully');
    }
    public function DiscardTickete(Ticket $ticket)
    {
        $ticket = Ticket::where('id', $ticket->id)->first();
        $ticket->is_discarded = 1;
        $ticket->que_in = 3;
        $ticket->update();
        $this->Que_Log($ticket->id, $ticket->user_id, $ticket->section_id, 1);
        return redirect()->back()->withSuccess('Hairdresser added successfully');
    }
    private function Que_Log($ticket_id, $user_id, $section_id, $que_status)
    {
        $quelog = new QueLog();
        $quelog->ticket_id = $ticket_id;
        $quelog->user_id = $user_id;
        $quelog->section_id = $section_id;
        $quelog->que_status = $que_status;
        $quelog->save();
    }

    public function getAllTickets(Request $request)
    {
        // $input = $request->all();
        // $query = Ticket::rightJoin('users' , 'users.id' ,'ticket.user_id')->
        // rightJoin('sections' , 'sections.id' ,'ticket.section_id')->select(
        //     'ticket.id','ticket.ticket_number','ticket.enqueue_time','ticket.serving_time'
        //     ,'ticket.served_time','users.name','sections.name as section'
        // );
        // if (isset($input['user_id']) && $input['user_id'])
        //     $query->where('users.id', '=', $input['user_id']);
        // if (isset($input['section_id']) && $input['section_id'])
        //     $query->where('ticket.section_id', '=', $input['section_id']);
        // if (isset($input['qued']) && $input['qued'])
        //     $query->where('ticket.serving_time is null');
        // if (isset($input['serving']) && $input['serving'])
        //     $query->where('ticket.served_time is null and ticket.serving_time is not null');
        // // if (isset($input['u']) && $input['u'])
        // //     $query->where('users.username', '=', $input['u']);
        // // if (isset($input['u']) && $input['u'])
        // //     $query->where('users.username', '=', $input['u']);
        // // if (isset($input['u']) && $input['u'])
        // //     $query->where('users.username', '=', $input['u']);
        // // if (isset($input['u']) && $input['u'])
        // //     $query->where('users.username', '=', $input['u']);
        // $data = $query->get();
        // return $data;
        return view('admin.tickets.list');
    }
}