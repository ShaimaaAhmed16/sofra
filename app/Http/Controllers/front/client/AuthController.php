<?php

namespace App\Http\Controllers\front\client;

use App\Models\City;
use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function viewRegisterClient(){
        $city=City::get();
        return view('front.registerclient',compact('city'));

    }
    public function registerClient(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|unique:clients',
            'phone' => 'required|unique:clients',
            'password' => 'required|confirmed|min:3',
            'image' => 'required|image',
//            'region_id' => 'required',
        ]);
        $request->merge(['password'=>bcrypt($request->passwoed)]);
        $user =Client::create($request->all());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $directionPath = public_path() . '/uploads/client/';
            $extension = $image->getClientOriginalExtension();
            $name = rand('11111', '99999') . '.' . $extension;
            $image->move($directionPath, $name);
            $user->image = 'uploads/client/' . $name;
        }
        $user->save();
    return redirect('index');
    }

    public function viewLoginClient(){
        return view('front.loginclient');
    }

    public function loginClient(Request $request){
        $this->validate($request, [
            'password' => 'required',
            'email' => 'required',
        ]);
        $client=Client::where('email',$request->input('email'))->first();
        if($client){
            // $client->update(['password'=>bcrypt(123)]);
            if (Auth::guard('client-web')->attempt($request->only('email', 'password'))) {
                return redirect('index');
            }
            else{
                flash()->error('error password');
                return back();
            }
        }
        else{
            flash()->error('error name or email');
            return back();
        }
    }
    public function viewProfile(Request $request){
        $user = $request->user('client-web');
        return view('front.profileclient',compact('user'));
    }
    public function profile(Request $request){
      $user = $request->user('client-web');
      $user->update($request->all());
        if($request->hasFile('image')) {
            if (file_exists($user->image)){
                unlink($user->image);
            }
            $image = $request->file('image');
            $directionPath = public_path() . '/uploads/client';
            $extension = $image->getClientOriginalExtension();
            $name = time() . '' . rand('11111', '99999') . '.' . $extension;
            $image->move($directionPath, $name);
            $user->update(['image' => 'uploads/client/' . $name]);

        }
        $user->save();
      if($user){
          flash()->success('updated profile');
          return redirect('index');
      }
      else{
          flash()->error('error data');
          return back();
      }
    }
   public function logout() {
    Auth::guard('client-web')->logout();
    return redirect('loginclient');
  }
    public function viewChangePassword(){
        return view('front.changepasswordclient');
    }

    public function changePassword(Request $request)
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
            return redirect('index');
        }
        else{
            flash()->error("error password");
            return back();
        }
    }

}
