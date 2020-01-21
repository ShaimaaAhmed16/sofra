<?php

namespace App\Http\Controllers\front;
use App\Models\Category;
use App\Models\City;
use App\Models\Restaurant;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function viewRegisterRestaurant(Request $request){
       $categories=Category::get();
       $city=City::get();
       return view('front.restaurantregister',compact('categories','city'));

   }
    public function registerRestaurant(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:restaurants',
            'phone' => 'required|unique:restaurants',
            'password' => 'required|confirmed',
            'image' => 'required|image',
            'opened_at' => 'required',
            'closed_at' => 'required',
            'minimum' => 'required',
            'delivery_charge' => 'required',
            'whats' => 'required',
            'category' => 'required',
            'region_id' => 'required',
//            	name	email	phone	password	image	state	minimum	delivery_charge	whats	region_id
        ]);
      //  return $request->category;
        $request->merge(['password'=>bcrypt($request->passwoed)]);
        $user =Restaurant::create($request->all());

        $user->categories()->attach($request->category);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $directionPath = public_path() . '/uploads/restaurant/';
            $extension = $image->getClientOriginalExtension();
            $name = rand('11111', '99999') . '.' . $extension;
            $image->move($directionPath, $name);
            $user->image = 'uploads/restaurant/' . $name;
        }
        $user->save();
        return view('front.addproduct');
    }

    public function viewLoginRestaurant(){
       return view('front.loginrestaurant');
    }

    public function loginRestaurant(Request $request){
        $this->validate($request, [
            'password' => 'required',
            'email' => 'required',
            ]);
        $restaurant=Restaurant::where('email',$request->input('email'))->first();
        //dd($restaurant);
        if($restaurant){
          // $restaurant->update(['password'=>bcrypt(123)]);
            if (Auth::guard('restaurant-web')->attempt($request->only('email', 'password'))) {
               // flash()->success('hello' . \auth()->guard('restaurant-web')->user()->name);
                return redirect('restaurantseller');
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
        $user = $request->user('restaurant-web');
        return view('front.profilerestaurant',compact('user'));
    }
    public function profile(Request $request){
        $user = $request->user('restaurant-web');
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
        Auth::guard('restaurant-web')->user()->logout();
        return redirect('login-restaurant');
    }
    public function viewChangePassword(){
       return view('front.changepasswordrestaurant');
    }
    public function changePassword(Request $request)
    {
        $rules=[
            'oldPassword'=>'required',
            'password'=>'required|confirmed',
            ];
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
