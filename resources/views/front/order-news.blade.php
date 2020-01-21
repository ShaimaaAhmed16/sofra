@extends('front.navebar')
@section('content')
<section class="orders">
    <div class="order-state py-5 d-flex">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-right"><a href="">طلبات جديده</a></h5>
                </div>
                {{--<div class="col-md-6">--}}
                    {{--<h5 class="text-right"><a href="">طلبات سابقة</a></h5>--}}
                {{--</div>--}}
            </div>
        </div>
    </div><!--End order-state-->
    <div class="mt-3">
        @include('flash::message')
    </div>
    <div class="order-details">
        <div class="container">
            @foreach($order as $orders)
            <div class="order-current my-5">
                <div class="row text-center">
                    <div class="col-md-3 py-3 px-4">
                        <img src="{{asset($orders->client->image)}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-8 pt-3 text-right">
                        <p class="py-1"> العميل : <span>{{$orders->client->name}}</span></p>
                        <p class="py-1 mncolor">رقم الطلب <span>{{$orders->id}}</span></p>
                        <p class="py-1 mncolor">المجموع :  <span>{{$orders->total}}</span> ريال</p>
                        <p class="py-1 mncolor">العنوان :  <span>{{$orders->address}}</span></p>
                    </div>
                    <div class="col mb-4">
                        <button class="btn bg-mncolor mx-3 px-5">اتصال</button>
                        <a href="{{url('acceptances/'.$orders->id)}}" class="btn btn-success mx-3 px-5">استلام</a>
                        <a href="{{url('refusal/'.$orders->id)}}" class="btn btn-refuse mx-3 px-5">رفض</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div style="margin-right:45%">
        {!! $order->render()!!}
    </div>
</section>
    @endsection