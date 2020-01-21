<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }
    public function resetPassword(Request $request)
    {
        $rules=[
            'oldPassword'=>'required',
            'password'=>'required|confirmed',];
        $messages=[
            'oldPassword.required'=>'oldPassword is required',
            'password.required'=>'Password is required',
        ];
        $this->validate($request,$rules,$messages);
        $user= Auth::user();
        if(Hash::check($request->oldPassword,$user->password) ){
            $user->password = bcrypt($request->password);
            $user->save();
            flash()->success("change password");
            return view('admin.change');
        }
        else{
            flash()->error("error password");
            return view('admin.change');
        }
    }

    public function resetPasswordView()
    {
        return view('admin.change');
    }
}
