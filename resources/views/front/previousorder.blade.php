@extends('front.navebar')
@section('content')
    <section class="orders">
        <div class="order-state py-5 d-flex">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-left"><a href="">طلبات سابقة</a></h5>
                    </div>
                </div>
            </div>
        </div><!--End order-state-->
        <div class="order-details">
            <div class="container">
                @foreach($order as $orders)
                <div class="order-info my-5">
                    <div class="row text-center">
                        <div class="col-md-3 py-3 px-4">
                            <img src="{{asset('front/images/burger.jpg')}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-8 py-3 text-left">
                            <h4 class="py-2">بيف برجر 250 جرام</h4>
                            <p class="py-1">رقم الطلب <span>{{$orders->id}}</span></p>
                            <p class="py-1">المجموع :  <span>{{$orders->net}}</span> ريال</p>
                            <p class="py-1"> التوصيل <span>{{$orders->delivery}}</span></p>
                            <p class="py-1">الإجمالى :  <span>{{$orders->total}}</span> ريال</p>
                        </div>
                    </div>
                </div>
                @endforeach
                {{--<div class="order-info my-5">--}}
                    {{--<div class="row text-center">--}}
                        {{--<div class="col-md-3 py-3 px-4">--}}
                            {{--<img src="images/burger.jpg" class="img-fluid" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="col-md-8 py-3 text-left">--}}
                            {{--<h4 class="py-1">بيف برجر 250 جرام</h4>--}}
                            {{--<p class="py-1">رقم الطلب <span>1457</span></p>--}}
                            {{--<p class="py-1">المجموع :  <span>75</span> ريال</p>--}}
                            {{--<p class="py-1"> التوصيل <span>10</span></p>--}}
                            {{--<p class="py-1">الإجمالى :  <span>85</span> ريال</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </section>
    @endsection