<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Restaurant;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function registerClient(Request $request){
        $validation = validator()->make($request ->all(), array(
            'name'=>'required',
            'email'=>'required|unique:clients',
            'password'=>'required|confirmed',
            'phone'=>'required|unique:clients',
            'image'=>'required|image|mimes:png,jpg',
            'region_id'=>'required',
            //	name	email	phone	password	image	region_id
        ));
        if ($validation->fails()){
            return responseJson(0,'validation error' ,$validation->errors());
        }
        $request->merge(['password'=>bcrypt($request->password)]);
        $client =Client::create($request->all());
        $client->api_token =str::random(60);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $directionPath = public_path() . '/uploads/client/';
            $extension = $image->getClientOriginalExtension();
            $name = rand('11111', '99999') . '.' . $extension;
            $image->move($directionPath, $name);
            $client->image = 'uploads/client/' . $name;
        }
        $client->save();
        return responseJson(1,'done' ,[
            'api_token'=>$client ->api_token,
            'client' => $client
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginClient(Request $request){
        $validation = validator()->make($request ->all(),[
            'email'=>'required',
            'password'=>'required'
        ]);
        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first() ,$validation->errors());
        }
        $client =Client::where('email',$request->email)->first();
        if($client){
            if(Hash::check($request->password ,$client->password)){
                return responseJson(1,'done' ,[
                    'api_token'=>$client ->api_token,
                    'client' => $client
                ]);

            }
            else{
                return responseJson(0,'error');
            }
        }
        else{
            return responseJson(0,'error');
        }
    }

    public function sendMessageClient(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required',
        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }
        $send = Client::where('phone', $request->phone)->first();
        //dd($send);
        if ($send) {
            $code = rand('1111','9999');
            $update = $send->update(['pin_code' => $code]);
            if ($update) {
                //send phone
                //smsMisr($request->phone ,"yor reset code is :".$code);

                //send email
                Mail::to($send->email)
                    ->bcc('ahmedshaimaa39@gmail.com')
                    ->send(new ResetPassword($code));
                return responseJson(1, 'Please check your phone', [
                    'pin_code_for_test' => $code,
                ]);
            } else {
                return responseJson(0, 'error data');
            }
        } else {
            return responseJson(0, 'error');
        }
    }

  //change password
    public function changePasswordClient(Request $request){
        $validation = validator()->make($request->all(), [
            'pin_code' => 'required',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }
        $user = Client::where('pin_code',$request->pin_code)->first();
        if($user){
            $user->password = bcrypt($request->password);
            $user->pin_code = null;
            if($user->save()){
                return responseJson(1,'success');
            }
            else{
                return responseJson(0,'error');
            }
        }
        else{
            return responseJson(0,'error');
        }

    }

    public function profileClient(Request $request)
    {
        $user = $request->user();
       // dd($user);
        if ($user) {
            $user->update($request->except('image','password'));
           $request->merge(['password'=>bcrypt($request->password)]);
            if($request->hasFile('image')) {
                if (file_exists($user->image)){
                    unlink($user->image);
                }
                $image = $request->file('image');
                $directionPath = public_path() . '/uploads/client/';
                $extension = $image->getClientOriginalExtension();
                $name = rand('11111', '99999') . '.' . $extension;
                $image->move($directionPath, $name);
                $user->image = 'uploads/client/' . $name;
            }
            if ( $user->save()) {
                return responseJson(1, 'done');
            }
            else{
                return responseJson(0,'doesnot save');
            }
        } else {
            return responseJson(0, 'no data');
        }
    }

 //registerRestaurant

    public function registerRestaurant(Request $request){
        $validation = validator()->make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:restaurants',
            'phone' => 'required|unique:restaurants',
            'password' => 'required|confirmed',
            'image' => 'required|image|mimes:png,jpg',
            'state' => 'required',
            'minimum' => 'required',
            'delivery_charge' => 'required',
            'whats' => 'required',
            'region_id' => 'required',
//            	name	email	phone	password	image	state	minimum	delivery_charge	whats	region_id
        ]);
        if($validation->fails())
        {
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }
        $request->merge(['password'=>bcrypt($request->passwoed)]);
        $user =Restaurant::create($request->all());
        $user->api_token =str::random(60);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $directionPath = public_path() . '/uploads/client/';
            $extension = $image->getClientOriginalExtension();
            $name = rand('11111', '99999') . '.' . $extension;
            $image->move($directionPath, $name);
            $user->image = 'uploads/client/' . $name;
        }
        $user->save();
        return responseJson(1,'done',[
            'api_token' =>$user->api_token,
            'user' => $user
        ]);
    }

    public function loginRestaurant(Request $request){
        $validation =validator()->make($request->all(),[
            'email' =>'required',
            'password' => 'required'
        ]);
        if($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }
        $user=Restaurant::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                return responseJson(1,'success',[
                    'api_token' =>$user->api_token,
                    'user'=>$user
                ]);
            }
            else{
                return responseJson(0,'Invalid login');
            }
        }
        else{
            return responseJson(0,'Invalid login data');
        }

    }

    public function sendMessageRestaurant(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required',
        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }
        $send = Restaurant::where('phone', $request->phone)->first();
        //dd($send);
        if ($send) {
            $code = rand('1111','9999');
            $update = $send->update(['pin_code' => $code]);
            if ($update) {
                //send email
                Mail::to($send->email)
                    ->bcc('ahmedshaimaa39@gmail.com')
                    ->send(new ResetPassword($code));
                return responseJson(1, 'Please check your phone', [
                    'pin_code_for_test' => $code,
                ]);
            } else {
                return responseJson(0, 'error data');
            }
        } else {
            return responseJson(0, 'error');
        }
    }

    public function changePasswordRestaurant(Request $request){
        $validation = validator()->make($request->all(), [
            'pin_code' => 'required',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }
        $user = Restaurant::where('pin_code',$request->pin_code)->first();
        if($user){
            $user->password = bcrypt($request->password);
            $user->pin_code = null;
            if($user->save()){
                return responseJson(1,'success');
            }
            else{
                return responseJson(0,'error');
            }
        }
        else{
            return responseJson(0,'error');
        }
    }

    public function profileRestaurant(Request $request){
        $validation = validator()->make($request->all(), [
           // 'region_id' => 'exists:regions,id',
            'password' => 'confirmed',
         //   Rule::unique('users')->ignore($request->user()->id),
           'email' => 'email|unique:restaurants,email,'.auth()->user()->id,
            'image' => 'image|mimes:png,jpg',
            ]);

            if ($validation->fails()) {
                $data = $validation->errors();
                return responseJson(0, $validation->errors()->first(), $data);
            }

            if ($request->has('name')) {
                $request->user()->update($request->only('name'));
            }
            if ($request->has('email')) {
                $request->user()->update($request->only('email'));
            }
            if ($request->has('password')) {
                $request->merge(array('password' => bcrypt($request->password)));
                $request->user()->update($request->only('password'));
            }

            if ($request->has('phone')) {
                $request->user()->update($request->only('phone'));
            }

            if ($request->has('region_id')) {
                $request->user()->update($request->only('region_id'));
            }
            if ($request->has('minimum')) {
                $request->user()->update($request->only('minimum'));
            }
        if ($request->has('delivery_charge')) {
            $request->user()->update($request->only('delivery_charge'));
        }
        if ($request->has('state')) {
            $request->user()->update($request->only('state'));
        }
        if ($request->has('whats')) {
            $request->user()->update($request->only('whats'));
        }
            $loginUser = $request->user();
            if ($request->hasFile('image')) {
                if (file_exists($loginUser->image)) {
                    unlink($loginUser->image);
                }
                $path = public_path();
                $destinationPath = $path . '/uploads/clients/'; // upload path
                $photo = $request->file('image');
                $extension = $photo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $photo->move($destinationPath, $name); // uploading file to given path
                $loginUser->image = 'uploads/clients/' . $name;
            }
            $loginUser->save();
            $data = [
                'user' => $request->user()->load('region')
            ];
            return responseJson(1, 'تم تحديث البيانات', $data);
    }

    //register Token
    public function registerToken(Request $request){
        $validation = validator()->make($request ->all(),[
            'token'=>'required',
            'type'=>'required|in:android,ios',
        ]);
        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first() ,$validation->errors());
        }
        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        /* Token::create([
             'token' =>'',
             'type' =>'',
             'client_id' =>$request->user()->id
         ]);  بتساوى السطر اللي قبله  */
        return responseJson(1,'تم التسجيل بنجاح ');
    }

    // remove Token
    public function removeToken(Request $request){
        $validation = validator()->make($request ->all(),[
            'token'=>'required',
        ]);
        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first() ,$validation->errors());
        }
        Token::where('token',$request->token)->delete();
        return responseJson(1,'تم الحذف بنجاح ');
    }
}
