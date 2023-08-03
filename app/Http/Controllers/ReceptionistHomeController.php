<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ReceptionistHomeController extends Controller
{
    public function index(Request $request)
    {
        // $sections = DB::select('select * from section inner join users on users.section_id = section.id');
        // if($sections)
        // {
        //     foreach($sections as $section)
        //     {

        //     }
        // }
        return view('receptionist.dashboard');
    }
}
