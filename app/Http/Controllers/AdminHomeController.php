<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Sections;
use App\Models\Promotion;
use App\Models\Setting;
use App\Models\UserRole;
use App\Models\Appointment;
use App\Models\QueLog;
use Illuminate\Support\Facades\DB;
use App\Models\Sessions;
use Carbon\Carbon;
use App\Helpers\QueHelper;


class AdminHomeController extends Controller
{
    public function index()
    {
        // $served = DB::select('select count(*) as t from tickets where served_time is not null and serving_time is not null and is_discarded = 0 and created_at = ?',[Carbon::today()]);
        // $serving = DB::select('select count(*) as t from tickets where served_time is null and serving_time is not null and is_discarded = 0 and created_at = ?',[Carbon::today()]);
        // $inque = DB::select('select count(*) as t from tickets where served_time is null and serving_time is null and is_discarded = 0 and created_at = ?',[Carbon::today()]);
        $ticketQ = Ticket::join('session', 'session.id', 'tickets.session_id')
            ->where('tickets.created_at', '>=', Carbon::today())
            ->orderBy('tickets.id', 'asc')
            ->whereNull('serving_time')
            ->where('is_discarded', 0)
            ->where('session.session_status', 0)
            ->get();

        $ticketServing = Ticket::join('session', 'session.id', 'tickets.session_id')
            ->where('tickets.created_at', '>=', Carbon::today())
            ->orderBy('tickets.id', 'asc')
            ->whereNotNull('serving_time')
            ->whereNull('served_time')
            ->where('is_discarded', 0)
            ->where('session.session_status', 0)
            ->get();

        $ticketServed = Ticket::join('session', 'session.id', 'tickets.session_id')
            ->where('tickets.created_at', '>=', Carbon::today())
            ->orderBy('tickets.id', 'asc')
            ->whereNotNull('serving_time')
            ->whereNotNull('served_time')
            ->where('is_discarded', 0)
            ->where('session.session_status', 0)
            ->get();

        // dd($ticketServed);
        $ticketDicarded = DB::select('select t.* from tickets t JOIN session s ON t.session_id=s.id where s.session_status = 0 and t.served_time is null and t.section_id != 1 and t.is_discarded = 1');
        $ticketNos = Appointment::where('is_served', 0)->where('created_at', '>=', Carbon::today())->select('ticket_id')->get()->toArray();
        $sessionss = Sessions::where('session_status', 0)->first();
        $special = Ticket::join('session', 'session.id', 'tickets.session_id')->whereIn('ticket_number', $ticketNos)->where('tickets.created_at', '>=', Carbon::today())->whereNull('serving_time')->where('is_discarded', 0)->where('session.session_status', 0)->get();
        $data = [
            'served' => $ticketServed->count(),
            'serving' => $ticketServing->count(),
            'inque' => $ticketQ->count(),
        ];

        return view("admin.dashboard", compact('data', 'ticketQ', 'ticketServing', 'ticketServed', 'ticketNos', 'special', 'ticketDicarded', 'sessionss'));
    }
    public function discard(Ticket $ticket)
    {
        $ticket->is_discarded = 1;
        $ticket->update();
        return back()->with('success', 'Ticket Updated');
    }
    public function getUserList(Request $request)
    {
        $data = DB::select('select u.id , u.name,u.email, r.name as rname from users as u inner join user_role as r on r.id = u.role_id');
        return view('admin.user.list', compact('data'));
    }
    public function getHairdreseerList(Request $request)
    {
        $data = DB::select('select u.id , u.name,u.email, r.name as rname from users as u left join sections as r on u.section_id = CASE
        WHEN u.section_id > 0 then r.id End where role_id = 3');
        return view('admin.hairdresser.list', compact('data'));
    }
    public function createUser(Request $request)
    {
        $role = UserRole::all();
        return view('admin.user.add', compact('role'));
    }
    public function createHairDresser(Request $request)
    {
        $section = Sections::where('is_assigned', 0)->get();
        return view('admin.hairdresser.add', compact('section'));
    }
    public function editHairDresser(User $user)
    {
        $section = Sections::where('is_assigned', 0)->get();
        return view('admin.hairdresser.edit', compact('section', 'user'));
    }
    public function addHairDresser(Request $request)
    {
        $user = new User();
        $user->role_id = 3;
        $user->section_id = $request->section_id;
        $user->name = $request->name;
        $user->email  = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $section = Sections::where('id', $request->section_id)->first();
        $section->is_assigned = 1;
        $section->update();
        return redirect()->back()->withSuccess('Hairdresser added successfully');
    }
    public function deleteHairDresser(User $user)
    {
        $section = Sections::where('id', $user->section_id)->first();
        $section->is_assigned = 0;
        $section->update();
        $user->delete();
        return redirect()->back()->withSuccess('Hairdresser deleted successfully');
    }
    public function deletePromotion($user)
    {
        $section = promotion::where('id', $user)->delete();
        return redirect()->back()->withSuccess('Promotion deleted successfully');
    }

    public function deleteAppointments($user, $ticket)
    {

        $section = Appointment::where('id', $user)->delete();
        $section = Ticket::where('ticket_number', $ticket)->delete();
        return redirect()->back()->withSuccess('Appointment deleted successfully');
    }

    public function getDesk()
    {
        //$desk = DB::select("select u.name as username, u.id as userId, s.name as section_name from users as u inner join sections as s on u.section_id = s.id");
        return response()->json(['desks' => 'hello',]);
    }

    public function UpdateHairDresser(Request $request, User $user)
    {
        $currentSection = $user->section_id;
        $user->name = $request->name;
        $user->email  = $request->email;

        $user->save();
        // if($currentSection!=$request->section_id)
        // {
        //     $section = Sections::where('id' , $request->section_id)->first();
        //     $section->is_assigned = 1;
        //     $section->update();
        //     $section = Sections::where('id' , $currentSection)->first();
        //     $section->is_assigned = 0;
        //     $section->update();
        // }
        return redirect()->back()->withSuccess('Hairdresser updated successfully');
    }
    public function addUser(Request $request)
    {
        $user = new User();
        $user->role_id = $request->role_id;
        $user->section_id = 0;
        $user->name = $request->name;
        $user->email  = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->withSuccess('User added successfully');
    }
    public function updateUser(User $user)
    {
        $role = UserRole::all();
        return view('admin.user.edit', compact('user', 'role'));
    }
    public function deleteUser(User $user)
    {
        if ($user->section_id > 0) {
            $section = Sections::where('id', $user->section_id)->first();
            $section->is_assigned = 0;
            $section->update();
        }
        $user->delete();
        return redirect()->back()->withSuccess('User deleted successfully');
    }
    public function editUser(Request $request, User $user)
    {
        $user->role_id = $request->role_id;
        $user->email  = $request->email;
        $user->name = $request->name;
        $user->Update();
        return redirect()->back()->withSuccess('Section updated successfully');
    }

    public function sectionList()
    {
        $data = Sections::all();
        return view('admin.sections.list', compact('data'));
    }
    public function createSections()
    {
        return view('admin.sections.add');
    }
    public function addSections(Request $request)
    {
        $section = new Sections();
        $section->name = $request->name;
        $section->save();
        return redirect()->back()->withSuccess('item added successfully');
    }

    public function createPromotion(Request $request)
    {

        $promotion = new Promotion();
        $promotion->name = $request->name;
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            $extension = $files->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;
            $path = public_path() . '/img/logo/';
            $uplaod = $files->move($path, $fileName);
            $promotion->image = $fileName;
        }
        $promotion->save();
        return redirect()->back()->withSuccess('item added successfully');
    }
    public function updateSection(Request $request, Sections $sections)
    {
        $sections->name = $request->name;
        $sections->Update();
        return redirect()->back()->withSuccess('Section updated successfully');
    }
    public function editSections(Sections $sections)
    {
        return view('admin.sections.edit', compact('sections'));
    }
    public function settings()
    {
        $setting = Setting::where('id', 1)->first();
        return view('admin.setting', compact('setting'));
    }
    public function updatesettings(Request $request)
    {
        $setting = Setting::where('id', 1)->first();
        $setting->app_name = $request->app_name;
        $fileName = "";
        if ($request->hasFile('app_icon')) {
            $file = $request->file('app_icon');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;
            $path = public_path() . '/img/favicon/';
            $uplaod = $file->move($path, $fileName);
        } else {
            $fileName = $request->app_icon_hidden;
        }
        $setting->app_icon = $fileName;
        if ($request->hasFile('app_logo')) {
            $file = $request->file('app_logo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;
            $path = public_path() . '/img/logo/';
            $uplaod = $file->move($path, $fileName);
        } else {
            $fileName = $request->app_logo_hidden;
        }
        $setting->app_logo = $fileName;
        $setting->opening = $request->opening;
        $setting->closing = $request->closing;
        $setting->ticket_starts = $request->ticket_starts;
        $setting->message = $request->message;
        $setting->contact = $request->contact;
        $setting->email = $request->email;
        $setting->user_message = $request->user_message;
        $setting->update();
        return redirect()->back()->withSuccess('Settings updated successfully');
    }
    public function updateSections(Request $request)
    {
        $section = Sections::where('id', $request->id)->first();
        if (!is_null($section)) {
            $section->name = $request->name;
            $section->update();
        }
        return back()->with('message', 'item updated successfully');
    }
    public function assignSection(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->section_id = $request->section_id;
        $user->Update();
    }
    public function roleList()
    {
        $data = UserRole::all();
        return view('admin.role.list', compact('data'));
    }
    public function createRole()
    {
        return view('admin.role.add');
    }
    public function addRole(Request $request)
    {
        $section = new UserRole();
        $section->name = $request->name;
        $section->save();
        return redirect()->back()->withSuccess('item added successfully');
    }
    public function editRole(UserRole $userrole)
    {
        return view('admin.role.edit', compact('userrole'));
    }
    public function updateRole(Request $request, UserRole $userrole)
    {

        $userrole->name = $request->name;
        $userrole->update();
        return redirect()->back()->withSuccess('Role updated successfully');
    }

    public function promotionList(Request $request)
    {
        $data = DB::table('promotion')->get();
        return view("admin.promotion.list", compact('data'));
    }
    public function appointmentList(Request $request)
    {
        //        $data = Appointment::where('is_served' , 0)->orderBy('id' , 'desc')->get();
        $data = DB::table('appointments')
            ->join('tickets', 'appointments.ticket_id', '=', 'tickets.ticket_number')
            ->join('session', 'tickets.session_id', '=', 'session.id')
            ->where('session.session_status', '=', 0)
            ->orderBy('appointments.id', 'desc')
            ->select(DB::raw('appointments.*, tickets.serving_time, tickets.is_discarded, tickets.que_in , tickets.served_time'))
            ->whereDate('appointments.created_at', Carbon::today())
            ->get();



        return view("admin.appointment.list", compact('data'));
    }
    public function addAppointment()
    {
        $hairdresser = User::where('role_id', 3)->get();
        return view("admin.appointment.add", compact('hairdresser'));
    }
    public function addPromotion()
    {
        $hairdresser = User::where('role_id', 3)->get();
        return view("admin.promotion.add", compact('hairdresser'));
    }


    public function editAppoint(Appointment $appointment)
    {
        $hairdresser = User::where('role_id', 3)->get();
        return view("admin.appointment.edit", compact('appointment', 'hairdresser'));
    }
    public function updateAppointment(Request $request, Appointment $appointment)
    {
        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->hairdresser_id = $request->hairdresser_id;
        $appointment->update();
        return redirect()->back()->withSuccess('Appointment updated successfully');
    }
    public function createAppointment(Request $request)
    {
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
        $uuid = 0;
        if (!is_null($request->hairdresser)) {
            $uuid = $request->hairdresser;
        }
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
            $ticket_no = $setting->ticket_starts;
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
        $ticket = new Ticket();
        $ticket->ticket_number = $ticket_no;
        //dd($uuid);
        if ($uuid == 0) {
            $ticket->user_id = $user_id;
            $section_id = 1;
        } else {
            $ticket->user_id = $uuid;
            $hairdressers = User::where('id', $request->hairdresser)->first();
            $section_id = $hairdressers->section_id;
        }
        $ticket->section_id = $section_id;
        $ticket->session_id = $session_id;
        $ticket->possible_serving = $possibletime;
        $ticket->is_appoint = 1;
        $ticket->Save();
        $this->Que_Log($ticket->id, $user_id, $section_id, 0);
        $appointment = new Appointment();
        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->hairdresser_id = $ticket->user_id;
        $appointment->phone = $request->phone;
        $appointment->ticket_id = $ticket->ticket_number;
        $appointment->save();

        return redirect()->back()->withSuccess('Appointment created successfully');
    }
    public function assignRole(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->role_id = $request->role_id;
        $user->Update();
    }
    public static function getSetting()
    {
        $setting = Setting::first();
        return $setting;
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

    public function ticketsList()
    {
        $users = DB::select('select * from users where role_id = 3');
        $ticketQ = Ticket::where('created_at', '>=', Carbon::today())->orderBy('id', 'asc')->whereNull('serving_time')->where('is_discarded', 0)->get();
        $ticketServing = Ticket::where('created_at', '>=', Carbon::today())->orderBy('id', 'asc')->whereNotNull('serving_time')->whereNull('served_time')->where('is_discarded', 0)->get();
        $ticketServed = Ticket::where('created_at', '>=', Carbon::today())->orderBy('id', 'asc')->whereNotNull('serving_time')->whereNotNull('served_time')->where('is_discarded', 0)->get();
        $ticketNos = Appointment::where('is_served', 0)->where('created_at', '>=', Carbon::today())->select('ticket_id')->get()->toArray();
        //dd($ticketNos);
        $special = Ticket::whereIn('ticket_number', $ticketNos)->where('created_at', '>=', Carbon::today())->whereNull('serving_time')->get();
        // dd($special);
        return view('admin.tickets.list', compact('ticketQ', 'ticketServing', 'ticketServed', 'ticketNos', 'special', 'users'));
    }

    public function updatestatus(Request $request)
    {
        $ticket = Ticket::where('id', $request->ticket_id)->first();
        if ($request->section_id > 3 && $request->section_id != 9) {
            $userid = User::where('section_id', $request->section_id)->first();
            $ticket->user_id = $userid->id;
        }
        //         if($request->section_id ==9)
        //         {
        //           $ticket->serving_time = Carbon::now();
        //         }
        //         if($request->section_id ==2)
        //         {
        //           $ticket->served_time = Carbon::now();
        //         }
        $ticket->section_id = (int)$request->section_id;
        $ticket->update();
        return $ticket;
        // $result = QueHelper::editTaskStatus($request->ticket_id , $request->section_id);

    }
    public function startEndSession()
    {
        $session = Sessions::where('session_status', 0)->first();
        $message = '';
        if (!is_null($session)) {
            $session->session_end_at = Carbon::now();
            $session->session_status = 1;
            $session->update();
            $message = 'Session Ended successfully';
        } else {
            $session = new Sessions();
            $session->session_start_at = Carbon::now();
            $session->save();
            $message = 'Session Started successfully';
        }
        return redirect()->back()->withSuccess($message);
    }

    public function getSession()
    {
        $session = Sessions::where('session_status', 0)->first();
        return view('admin.session', compact('session'));
    }
    public function getReport()
    {
        $sections = Sections::where('is_system', 0)->get();
        $hairdressers = User::where('role_id', 3)->get();
        $data = [];
        return view('admin.reports.add', compact('sections', 'hairdressers', 'data'));
    }

    public function getAllTickets(Request $request)
    {
        $input = $request->all();
        $query = DB::table('tickets')->select(
            'tickets.id',
            'tickets.ticket_number',
            'tickets.enqueue_time',
            'tickets.serving_time',
            'tickets.is_appoint',
            'tickets.served_time',
            'users.name',
            'sections.name as section_name',
        )->join('session', 'session.id', 'tickets.session_id')->leftJoin('users', 'users.id', 'tickets.user_id')->leftJoin('sections', 'sections.id', 'tickets.section_id');
        if (isset($input['user_id']) && $input['user_id'])
            $query->where('users.id', '=', $input['user_id']);
        if (isset($input['section_id']) && $input['section_id'])
            $query->where('tickets.section_id', '=', $input['section_id']);
        if (isset($input['ticket_status']) && $input['ticket_status']) {

            if ($input['ticket_status'] == 0)
                $query->where('tickets.serving_time is null');
            if ($input['ticket_status'] == 1)
                $query->whereNotNull('tickets.serving_time')->whereNull('tickets.served_time');
            if ($input['ticket_status'] == 2)
                $query->whereNotNull('tickets.served_time');
            if ($input['ticket_status'] == 3)
                $query->where('tickets.is_discarded = 1 ');
        }
        if (isset($input['ticket_type'])) {
            if ($input['ticket_type'] == 0)
                $query->where('tickets.is_appoint', '=', '0');
            if ($input['ticket_type'] == 1)
                $query->where('tickets.is_appoint', '=', '1');
            if ($input['ticket_type'] == 2)
                $query->where('tickets.is_appoint', '=', '2');
        }
        if (isset($input['start_date']) && $input['start_date']) {
            $today =
                $sdate = Carbon::createFromFormat('Y-m-d H:i:s',  $input['start_date'] . ' 00:00:00');

            $edate = Carbon::createFromFormat('Y-m-d H:i:s',  $input['end_date'] . ' 23:59:59');
            $query->where("session.session_start_at", ">=", $sdate);
            $query->where("session.session_start_at", "<=", $edate);
        }

        $data = $query->get();
        $sections = Sections::where('is_system', 0)->get();
        $hairdressers = User::where('role_id', 3)->get();
        return view('admin.reports.add', compact('data', 'sections', 'hairdressers'));
    }
}