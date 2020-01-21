@extends('front.navebar')
@section('content')
    <div class="container">
        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @if($cart)

            <div class="card-text col-md-8 float-left"  >
                @foreach($cart->items as $product)
                    {{--<p>{{$product['title']}}</p>--}}
                <div class="card col-12 mt-3">
                    <div class="float-left">
                        <p class="card-title ">name : {{$product['name']}}</p>
                        <p >price: {{$product['price']}}</p>
                    </div>
                    <div class="mt-2">
                        <form action="{{url('update-cart/'.$product['id'])}}" method="post">
                           @csrf
                            @method('put')
                            <input  type="text" id="qty" name="qty" value="{{$product['qty']}}" style="width: 50% ;margin-right: 50%">
                            <button type="submit" class="btn btn-success mt-2">chang quantity</button>
                        </form>
                    </div>
                    <form action="{{url('remove-cart/'.$product['id'])}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm ml-4 float-right mb-5 text-center mt-2">Remove</button>
                    </form>
                </div>
                    @endforeach
                    {{--<button class="show-example-btn" aria-label="Try me! Example: passing a parameter, you can execute something else for 'Cancel'" onclick="executeExample('handleDismiss')">--}}
                        {{--Try me!--}}
                    {{--</button>--}}
            </div>
            <div class="col-md-4 mt-5 float-right">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h3 class="card-title">
                            Yor cart
                        </h3>
                        <div class="card-text">
                            <p>Total Amount is {{$cart->totalPrice}}</p>
                            <p>Total Quantities is {{$cart->totalQty}}</p>
                            <a href="{{url('addorder')}}" class="btn btn-success btn-sm ">checkout</a>
                            {{--<a href="{{url('checkout/'.$cart->totalPrice)}}" class="btn btn-success btn-sm ">checkout</a>--}}
                        </div>
                    </div>
                </div>
            </div>
            @else
        <p>no items</p>
            @endif
    </div>
    <div class="clearfix"></div>
    @endsection