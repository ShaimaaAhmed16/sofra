<?php

namespace App\Http\Controllers\front;

use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class MainController extends Controller
{
    public function home(Request $request)
    {
        $cities = City::get();
        $restaurant = Restaurant::all();
        $restaurants = Restaurant::where(function ($query) use ($request) {
            if ($request->id) {
                $query->where('id', $request->id);
            }
            if ($request->city) {
                $query->whereHas('region', function ($que) use ($request) {
                    $que->where('city_id', $request->city);
                });
            }
        })->paginate(4);
        return view('front.index', compact('cities', 'restaurants','restaurant'));

    }

    public function viewAddProduct()
    {
        return view('front.addproduct');

    }

    public function addProduct(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'price' => 'required',
            'processing_time' => 'required',
            'image' => 'required|image',
        ]);
        $user = $request->user()->products()->create($request->all());
        // $user['restaurant_id'] =auth()->user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $directionPath = public_path() . '/uploads/product/';
            $extension = $image->getClientOriginalExtension();
            $name = rand('11111', '99999') . '.' . $extension;
            $image->move($directionPath, $name);
            $user->image = 'uploads/product/' . $name;
        }
        $user->save();
        return redirect('restaurantseller');
    }

    public function viewUpdate(Request $request, $id)
    {
        $product = $request->user()->products()->findOrFail($id);
        return view('front.updatproduct', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $record = $request->user()->products()->findOrFail($id);
        $record->update($request->except('image'));
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/product'; // upload path
            $logo = $request->file('image');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $record->update(['image' => 'uploads/product/' . $name]);
        }
        $record->save();
        flash()->success('Edited');
        return redirect('restaurantseller');
    }

    public function deleteProduct(Request $request, $id)
    {
        $record = $request->user()->products()->findOrFail($id);
        if ($record) {
            $record->delete();
            flash()->success('Deleted');
            return back();
        } else {
            flash()->success('no deleted');
            return back();
        }
    }

    public function Product(Request $request)
    {
        $product = $request->user()->products()->latest()->paginate(6);
        $restaurant = Restaurant::first();
        //  dd($restaurant->rating);
        return view('front.restaurantseller', compact('product', 'restaurant'));
    }

    public function viewContact()
    {
        return view('front.contact');
    }

    public function contact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:contacts',
            'phone' => 'required',
            'message' => 'required',
            'type' => 'required',
        ]);
        $contact = Contact::create($request->all());
        if ($contact) {
            return redirect('index');
        } else {
            flash()->error('error');
            return back();
        }
    }

    public function viewAddOffer()
    {
        return view('front.addoffer');
    }

    public function addOffer(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image',
            'content' => 'required',
            'price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $offer = $request->user()->offers()->create($request->all());
        // $offer['restaurant_id'] = auth()->user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $directionPath = public_path() . '/uploads/offer/';
            $extension = $image->getClientOriginalExtension();
            $name = time() . '' . rand(11111, 99999) . '.' . $extension;
            $image->move($directionPath, $name);
            $offer->image = 'uploads/offer/' . $name;
        }
        $offer->save();
        return redirect('addlistoffer');
    }

    public function offer(Request $request)
    {
        $offer = $request->user()->offers()->with('restaurant')->latest()->paginate(6);
        return view('front.listoffer', compact('offer'));
    }

    public function addListOffer(Request $request)
    {
        $offer = $request->user()->offers()->latest()->paginate(20);
        return view('front.addlistoffer', compact('offer'));
    }

    public function viewEditOffer(Request $request, $id)
    {
        $offer = $request->user()->offers()->findOrFail($id);
        return view('front.updateoffer', compact('offer'));
    }

    public function EditOffer(Request $request, $id)
    {
        $record = $request->user()->offers()->findOrFail($id);
        $record->update($request->except('image'));
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/product'; // upload path
            $logo = $request->file('image');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $record->update(['image' => 'uploads/product/' . $name]);
        }
        $record->save();
        flash()->success('Edited');
        return redirect('addlistoffer');
    }

    public function deleteOffer(Request $request, $id)
    {
        $record = $request->user()->offers()->findOrFail($id);
        if ($record) {
            $record->delete();
            flash()->success('Deleted');
            return back();
        } else {
            flash()->success('no deleted');
            return back();
        }
    }
    public function newOrderRequests(Request $request){
       $order = $request->user('restaurant-web')->orders()->where('status','=','pending')->latest()->paginate(4);
        return view('front.order-news',compact('order'));
    }

    public function acceptance(Request $request ,$id){
        $order = $request->user('restaurant-web')->orders()->findOrFail($id);
        if($order){
            $order->update(['status'=>'acceptance']);
            flash()->success('order acceptance');
            return back();
        }
        else{
            flash()->error('error');
            return back();
        }

    }

    public function refusal(Request $request ,$id){
        $order = $request->user('restaurant-web')->orders()->findOrFail($id);
        if($order){
            $order->update(['status'=>'refusal']);
            flash()->success('order refusal');
            return back();
        }
        else{
            flash()->error('error');
            return back();
        }

    }



}

