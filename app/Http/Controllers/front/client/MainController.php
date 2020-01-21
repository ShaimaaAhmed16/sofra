<?php

namespace App\Http\Controllers\front\client;

use App\Models\Cart;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Stripe;

class MainController extends Controller
{
    public function listProduct(Request $request ,$id){
       // $product=$request->user()->latest()->paginate(6);
        $restaurant=Restaurant::findOrFail($id);
        $product=$restaurant->products()->paginate(4);
       // $product=Product::where('restaurant_id','=','$restaurant')->paginate(4);
        if(! $product->isEmpty()) {
            return view('front.listproduct', compact('restaurant','product'));
        }
         //$product=$restaurant->products();
        else{
            flash()->error('no product');
            return back();
        }

    }
    public function productDetails($id){
        $product=Product::findOrFail($id);
        return view('front.detilesproduct' ,compact('product'));
    }

    public function addOrder(){
        $payment=PaymentMethod::all();
        $product=Product::get();
        return view('front.addorder',compact('payment','product'));
    }

//    public function addOrderSession(Request $request){
//        $this->validate($request, [
//            'qty' => 'required',
//            'notes' => 'required',
//            'product_id'=>'required',
//        ]);
//        $cart=session()->get('cart');
//        if (! $cart){
//            session()->put('cart',[[$product_id,$quantity,$notes]]);
//            session()->put('cart',[['product_id'=>$request->product_id,'quantity'=>$request->qty,'notes'=>$request->notes]]);
//        }
//        else{
//            $cart[]=[['product_id'=>$request->product_id,'quantity'=>$request->qty,'notes'=>$request->notes]];
//        }
//    }

    public function newOrder(Request $request)
    {
        $this->validate($request, [
            'restaurant_id' => 'required|exists:restaurants,id',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required',
            'notes' => 'required',
        ]);
        $cart =session()->get('cart');
        //dd($cart->items);
        $items =$cart->items;
        $request->user()->orders()->create([
            'restaurant_id' => $request->restaurant_id,
            'quantity' => $request->qty,
       ]);
        flash()->success('added');
        return back();
//        //$items->items
//           // $product=Product::findOrFail($items->items );
//            $request->user()->orders()->products()->attach([
//                $items->items => [
//                    'quantity' => $items->items['qty'],
//                    'price' => $items->items['price'],
////                    'note' => $request->notes[$counter],
//                ]
//            ]);
//        $this->validate($request, [
//            'restaurant_id' => 'required|exists:restaurants,id',
//          //  'product' => 'required|array',
//          //  'product.*' => 'required|exists:products,id',
////            'product' => 'required',
////           'product_id' => 'required|exists:products,id',
//          //  'qty' => 'required',
//          //  'notes' => 'required',
//          //  'address' => 'required',
//           // 'payment_method_id' => 'required',
//            //'need_delivery_at' => 'required|date_format:Y-m-d',// H:i:s
//        ]);
//        $restaurant = Restaurant::findOrFail($request->restaurant_id);
//        // restaurant closed
////        if ($restaurant->is_open == false) {
////            flash()->error('Sorry, the restaurant is not available at the moment');
////            return back();
////        }
//        // client
//        // set defaults
//        $order = $request->user()->orders()->create([
//            'restaurant_id' => $request->restaurant_id,
//            'special_order' => $request->notes,
//            'status' => 'pending', // db default
//            'address' => $request->address,
//            'delivery' => $restaurant->delivery_charge,
////            'quantit' => $request->qty,
//            'payment_method_id' => $request->payment_method_id,
//        ]);
//        $cost = 0;
//        $delivery_cost = $restaurant->delivery_charge;
//        if ($request->has('product')) {
//            $counter = 0;
//            foreach ($request->product as $itemId) {
//                $item = Product::findOrFail($itemId);
//                $order->products()->attach([
//                    $itemId => [
//                        'quantity' => $request->qty[$counter],
//                        'price' => $item->price,
//                        'note' => $request->notes[$counter],
//                    ]
//                ]);
//                $cost += ($item->price * $request->qty[$counter]);
//                $counter++;
//            }
//        }
//        // minimum charge
//        if ($cost >= $restaurant->minimum) {
//            $setting = Setting::find(1);
//            $total = $cost + $delivery_cost; // 200 SAR
//            $commission = $setting->commission * $cost; // 20 SAR  // 10 // 0.1  // $total; edited to remove delivery cost from percent.
//            $net = $total - $commission;
//            $update = $order->update([
//                'cost' => $cost,
//                'total' => $total,
//                'commission' => $commission,
//                'net' => $net,
//            ]);
//            if ($update) {
//                flash()->success('تم اضافه الطلب');
//
//                return redirect('index', $order->load('client', 'restaurant'));
//            } else {
//                flash()->error('يوجد خطا في البيانات');
//                return back();
//            }
//        }
//        else{
//            flash()->error('المطلوب اقل من المبلغ المخصص للمطعم');
//            return back();
//        }
    }
    public function previousOrder(Request $request){
        $order=$request->user()->orders()->where('status','=','acceptance')->paginate(4);
        return view('front.previousorder',compact('order'));

    }
    public function viewReviews($id){
        return view('front.reviews',compact('id'));
    }
    public function reviews(Request $request){
        $this->validate($request, [
            'item' => 'required',
            'comment' => 'required',
            'restaurant_id' => 'required',
        ]);
        $review = $request->user()->reviews()->create([
            'rate' => $request->item,
            'comment' => $request->comment,
            'restaurant_id' => $request->restaurant_id,

        ]);
        if ($review){
            flash()->success('added review');
            return redirect('index');
        }
        else{
            flash()->error('no added');
            return back();
        }
    }
    public function updates($id){
        $restaurant= Restaurant::findOrFail($id);
        $num=$restaurant->star_rating;
        $updates=$restaurant->update(['rating'=>$num]);
        if($updates){
            return redirect('index');
        }
        return back();
    }

    public  function addCart(Product $product){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
            $cart = new Cart();
        }
        $cart->add($product);
        session()->put('cart',$cart);
        flash()->success('add to cart');
        //dd($cart);
        return back();
    }
    public function showCart(){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
            $cart =null;
        }
      // dd($cart->items);
        return view('front.show-cart',compact('cart'));
    }

    public function checkout($amount){
        return view('front.checkout',compact('amount'));
    }
    public function charge(Request $request){
       // dd($request->stripeToken);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => $request->amount,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        $chargeId = $Charge['id'];
        if($chargeId){
            session()->forget('cart');
            flash('success', 'Payment successful!');
            return redirect('index');
        }
      else{
            flash()->error('error data');
            return back();
      }
    }
    public function destroyCart(Product $product){
        $cart =new Cart(session()->get('cart'));
        $cart->remove($product->id);
        if($cart->totalQty <= 0){
            session()->forget('cart');
        }
        else{
            session()->put('cart',$cart);
        }
        return back();
    }
    public function updateCart(Request $request , Product $product){
        $this->validate($request,[
            'qty' =>'required|numeric|min:1'
        ]);
        $cart =new Cart(session()->get('cart'));
        $cart->updateQty($product->id ,$request->qty);
        session()->put('cart',$cart);
        return back();
    }
//    public function viewAlert(){
//        return view('front.alert');
//    }
//    public function alertYes(Request $request){
//
//        return redirect('');
//    }
}
