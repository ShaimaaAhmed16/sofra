<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Models\City;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\Setting;
use App\Models\Token;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function city()
    {
        $city = City::paginate(10);
        return responseJson(1, 'success', $city);
    }

    public function category()
    {
        $category = Category::paginate(5);
        return responseJson(1, 'success', $category);
    }

    public function region(Request $request)
    {
        $region = Region::where(function ($query) use ($request) {
            if ($request->city_id) {
                $query->where('city_id', $request->city_id);
            }
        })->get(); //بيجيب الاماكن الخاصه بالمدينه المعبنه
        return responseJson(1, 'success', $region);
    }

    public function listRestaurant(Request $request)
    {
        $restaurant = Restaurant::whereHas('region', function ($query) use ($request) {
            $query->where('city_id', $request->city_id);

            if ($request->name) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
        })->paginate(10);
        if (count($restaurant)) {
            return responseJson(1, 'success', $restaurant);
        } else {
            return responseJson(0, 'no data');
        }
    }

    public function stateRestaurant()
    {
        $restaurant = Restaurant::find(1);
        if ( $restaurant->is_open == false) {
            return responseJson(0, 'closed');
        } else {
            return responseJson(1, 'open');
        }
    }

    //name	email	phone	message	type
    public function contacts(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:contacts',
            'phone' => 'required',
            'message' => 'required',
            'type' => 'required'
        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }
        $user = Contact::create($request->all());
        $user->save();
        return responseJson(1, 'success', $user);
    }

    public function setting(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'commission' => 'required',
            'about' => 'required',
            'message' => 'required',
            'bank_account' => 'required',
            'app_commission' => 'required'
        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }
        $user = Setting::create($request->all());
        $user->save();
        return responseJson(1, 'success', $user);
    }

//title	image	content	start_date	end_date
    public function offer()
    {
        $user = Offer::paginate(10);
        return responseJson(1, 'success', $user);
    }

    //name	image	content	price	price_offer
    public function product()
    {
        $user = Product::paginate(10);
        return responseJson(1, 'success', $user);
    }

    public function payment()
    {
        $user = PaymentMethod::paginate(10);
        return responseJson(1, 'success', $user);
    }

    //title	address	special_order	order_time	delivery	status	cost	commission	net	total	payment_method_id	client_id	restaurant_id
    public function listOrder(Request $request)
    {
        $user = Order::where('status','acceptance')->paginate(5);
        return responseJson(1, 'success', $user);
    }

//    public function requestOrder(Request $request)
//    {
//        $validation = validator()->make($request->all(), [
//            'special_order' => 'required',
//
//        ]);
//        if ($validation->fails()) {
//            return responseJson(0, $validation->errors()->first(), $validation->errors());
//        }
//        $user = Order::update([$request->all()]);
//        if ($user->save()) {
//            return responseJson(1, 'success');
//        } else {
//            return responseJson(0, 'error');
//        }
//    }

    public function newOrder(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'restaurant_id'     => 'required|exists:restaurants,id',
            'product'             => 'required|array',
            'product.*'           => 'required|exists:products,id',
            'quantities'        => 'required|array',
            'notes'             => 'required|array',
            'address'           => 'required',
            'payment_method_id' => 'required|exists:payment_methods,id',
            //            'need_delivery_at' => 'required|date_format:Y-m-d',// H:i:s
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $restaurant = Restaurant::find($request->restaurant_id);
        // restaurant closed
        if ($restaurant->is_open ==false) {
            return responseJson(0, 'عذرا المطعم غير متاح في الوقت الحالي');
        }
        // client
        // set defaults
        $order = $request->user()->orders()->create([
            'restaurant_id'     => $request->restaurant_id,
            'special_order'              => $request->note,
            'status'             => 'acceptance', // db default
            'address'           => $request->address,
            'payment_method_id' => $request->payment_method_id,
        ]);
        $cost = 0;
        $delivery_cost = $restaurant->delivery_charge;
        if ($request->has('product')) {
            $counter = 0;
            foreach ($request->product as $itemId) {
                $item = Product::find($itemId);
                $order->products()->attach([
                    $itemId => [
                        'quantity' => $request->quantities[$counter],
                        'price'    => $item->price,
                        'note'     => $request->notes[$counter],
                    ]
                ]);
                $cost += ($item->price * $request->quantities[$counter]);
                $counter++;
            }
        }
        // minimum charge
        if ($cost >= $restaurant->minimum) {
            $setting = Setting::find(1);
            $total = $cost + $delivery_cost; // 200 SAR
            $commission = $setting->commission * $cost; // 20 SAR  // 10 // 0.1  // $total; edited to remove delivery cost from percent.
            $net = $total - $commission;
            $update = $order->update([
                'cost'          => $cost,
                'total'         => $total,
                'commission'    => $commission,
                'net'           => $net,
            ]);
            if ($update){
                return responseJson(1,'تم اضافه الطلب',$order->load('client','restaurant'));
            }
            else{
                return responseJson(0,'يوجد خطا في البيانات');
            }
           // $request->user()->cart()->detach();
            /* notification */
            $notification = $restaurant->notifications()->create([
                'title'      => 'لديك طلب جديد',
                'title_en'   => 'You have New order',
                'content'    => 'لديك طلب جديد من العميل ' . $request->user()->name,
                'content_en' => 'You have New order by client ' . $request->user()->name,
                'action'     => 'new order',
                'order_id'   => $order->id,
            ]);
            $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            //dd($tokens);
            if (count($tokens)) {
                $title = $notification->title;
                $content = $notification->content;
                $data = [
                    'order_id' => $order->id,
                ];
                $send = notifyByFirebase($title, $content, $tokens, $data);
                // dd($send);
                info("fire base result: " . $send);
                //dd($send);
            }
            return responseJson(1, 'تم الطلب بنجاح', $order->fresh()->load('items', 'restaurant.region', 'restaurant.categories', 'client'));
        } else {
            $order->products()->delete();
            $order->delete();
            return responseJson(0, 'الطلب لابد أن لا يكون أقل من ' . $restaurant->minimum . ' ريال');
        }
    }
    public function confirmOrder(Request $request){
        $order =$request->user()->orders()->find($request->order_id);
        if (!$order){
            return responseJson(0,'no data');
        }
        if ($order->status=='refusal' || $order->state=='request_complete' || $order->state=='acceptance' || $order->state=='contact'){
            return responseJson(0,'The request cannot be confirmed');
        }
        $order->update(['status' => 'confirm_delivery']);
        if ($order->save()){
            return responseJson(1,'Order confirmed');
        }
        else{
            return responseJson(0,'no save');
        }
    }

    public function refusalOrder(Request $request){
        $validation = validator()->make($request->all(), [
            'state' => 'required|in:confirm_delivery,request_complete,acceptance,contact'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $order =$request->user()->orders()->find($request->order_id);
        if (!$order){
            return responseJson(0,'no data');
        }
        if ($order->status == $request->state){
            return responseJson(0,'The request cannot be refusal');
        }
        $order->update(['status' => 'refusal']);
        if ($order->save()){
            return responseJson(1,'Order refusal');
        }
        else{
            return responseJson(0,'no save');
        }
    }

    public function review(Request $request){
        $validation = validator()->make($request->all(), [
            'comment' => 'required',
            'rate' => 'required',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $user=$request->user()->reviews()->create($request->all());
        // calc avg
        return responseJson(1,'success',$user);
    }
    public function notification(Request $request){
        $user=$request->user()->notifications()->paginate(10);
        if(count($user)!= 0){
            return responseJson(1,'success',$user);
        }
        else{
            return responseJson(0,'no data');
        }
    }

    public function addProduct(Request $request){
        $validation = validator()->make($request->all(), [
           'image' => 'required|mimes:png,jpg',
           'content' => 'required',
           'name' => 'required',
           'price' => 'required',
           'processing_time' => 'required',
           'price_offer' => 'required',
           'restaurant_id' => 'required|exist:restaurants,id',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $product = Product::create($request->all());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $directionPath = public_path() . '/uploads/restaurant/';
            $extension = $image->getClientOriginalExtension();
            $name = rand('11111', '99999') . '.' . $extension;
            $image->move($directionPath, $name);
            $product->image = 'uploads/restaurant/' . $name;
        }
        $product->save();
        return responseJson(1,'Product added',$product);
    }

    public function changeProduct(Request $request){
        $validation = validator()->make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $product =$request->user()->products()->find($request->product_id);
        if($product){

            $product->update($request->all());
//        if ($request->has('name')) {
//            $product->$product->update($request->only('name'));
//        }
//        if ($request->has('content')) {
//            $product->$product->update($request->only('content'));
//        }
//        if ($request->has('price')) {
//            $product->$product->update($request->only('price'));
//        }
//        if ($request->has('processing_time')) {
//            $product->$product->update($request->only('processing_time'));
//        }
//        if ($request->has('price_offer')) {
//            $product->$product->update($request->only('price_offer'));
//        }
//       // $change = $product;
//        if ($request->hasFile('image')) {
//            if (file_exists($product->image)) {
//                unlink($product->image);
//            }
//            $path = public_path();
//            $destinationPath = $path . '/uploads/restaurant/'; // upload path
//            $photo = $request->file('image');
//            $extension = $photo->getClientOriginalExtension(); // getting image extension
//            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
//            $photo->move($destinationPath, $name); // uploading file to given path
//            $product->image = 'uploads/restaurant/' . $name;
//        }
      }
        $data = [
            'user' =>$product
        ];
        return responseJson(1, 'change data', $data);
    }

    public function deleteProduct(Request $request ){
        $validation = validator()->make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $product =$request->user()->products()->find($request->product_id);
        // if count orders
        $product->delete();
        return responseJson(1,'delete data');
    }

    public function addOffer(Request $request ){
        $validation = validator()->make($request->all(), [
            'image' => 'required|mimes:png,jpg',
            'content' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $offer = Offer::create($request->all());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $directionPath = public_path() . '/uploads/restaurant/';
            $extension = $image->getClientOriginalExtension();
            $name = rand('11111', '99999') . '.' . $extension;
            $image->move($directionPath, $name);
            $offer->image = 'uploads/restaurant/' . $name;
        }
        $offer->save();
        return responseJson(1,'Product added',$offer);
    }

    public function changeOffer(Request $request){
        $validation = validator()->make($request->all(), [
            'offer_id' => 'required|exists:offers,id',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $offer =$request->user()->offers()->find($request->offer_id);
        if($offer){

            $offer->update($request->all());
//        if ($request->has('name')) {
//            $request->user()->offers()->update($request->only('name'));
//        }
//        if ($request->has('content')) {
//            $request->user()->offers()->update($request->only('content'));
//        }
//        if ($request->has('start_date')) {
//            $request->user()->offers()->update($request->only('start_date'));
//        }
//        if ($request->has('end_date')) {
//            $request->user()->offers()->update($request->only('end_date'));
//        }
        if ($request->hasFile('image')) {
            if (file_exists($offer->image)) {
                unlink($offer->image);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurant/'; // upload path
            $photo = $request->file('image');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->image = 'uploads/restaurant/' . $name;
        }
        }
        else{
            responseJson(0,'not found id');
        }
       // $change->save();
        $data = [
            'user' => $offer
        ];
        return responseJson(1, 'change data', $data);
    }

    public function delete(Request $request ){
        $validation = validator()->make($request->all(), [
            'offer_id' => 'required|exists:offers,id',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $offer =$request->user()->offers()->find($request->offer_id);
        if($offer){
            $offer->delete();
            }
//            else{
//              responseJson(0,'not found id');
//            }
        return responseJson(1, 'deleted');

    }

    public function isReadClient(Request $request)
    { $validation = validator()->make($request->all(), [
        'notification_id' => 'required',
    ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $notification = $request->user()->notifications()->find($request->notification_id);
        if ($notification) {
            if ($notification->is_read == 0) {
                $notification->is_read = 1;
            }
            return responseJson(1, 'success',$notification);
        }
       else {
            return responseJson(0, 'read');
        }
    }


    public function notiDisplay(Request $request)
    {
        $notification = $request->user()->notifications()->with('orders')->find($request->notification_id);
        if ($notification) {
            if ($notification->is_read == 0) {
                $notification->is_read = 1;
            }
            return responseJson(1, 'success',$notification);
        }
        else {
            return responseJson(0, 'read');
        }
    }
}