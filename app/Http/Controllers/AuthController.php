<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function get_login()
    {
        if(!auth()->user())
        return view('admin.login');
        else
        return redirect()->route('admin.signin');
    }
    public function create_user(Request $request)
    {
        $user = new User();
        $user->role_id = $request->role_id;
        $user->section_id = $request->section_id;
        $user->name = $request->name;
        $user->email  = $request->email ;
        $user->password = bcrypt($request->password);
        $user->save();
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->where('is_active' , '0')->where('is_deleted' , '0')->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['msg' => 'Invalid Password']);
        }else
        {
            $setting = Setting::all();
            $request->session()->put('setting', $user[0]);
            if($user->role_id==1)
            {
                $request->session()->put('admin', $user);
                return redirect('/admin/dashboard')->with('success','Login successfully');
            }else 
            {
                return back()->with('error','Invalid User');
            }
        }
    }

    public function UpdatePassword(Request $request)
    {
        $user = User::where('email', $request->email)->where('is_active' , '0')->where('is_deleted' , '0')->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'status' => 'failed',
                'message' => 'Email or Password is not correct',
            ], 401);
        }
        $user->password = bcrypt($request->new_password);
        $user->update();
    }

    public function checkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->where('is_active' , '0')->where('is_deleted' , '0')->first();
        if (!$user) {
            return true;
        }else
        {
            return false;
        }
    }

    
}
