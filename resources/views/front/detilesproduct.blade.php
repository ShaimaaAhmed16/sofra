@extends('front.navebar')
@section('content')
    <section class="food">
        <div class="container">
            <div class="mt-3">
                @include('flash::message')
            </div>
            <div class="row">
                    <div class="col-sm-4">
                        <div class="item-holder">
                            <img src="{{asset($product->image)}}" alt="item-image" width="100%" height="300px">
                            <div class="item-data text-center">
                                <h3 class="item-title">{{$product->name}}</h3>
                                <p class="item-description">{{$product->content}}</p>
                            </div>
                            <div class="features">
                                <div>
                                    <i class="fas fa-money-bill-alt" style="font-size:24px"></i>
                                    <span class="delevery-time">
                                    {{$product->price}} SR
                                </span>
                                </div>
                            </div>
                            <div class="features">
                                <div>
                                    {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                                    <i class="far fa-clock" style="font-size:24px"></i>
                                    <span class="delevery-time">
                                    {{$product->processing_time}} Almost accurate
                                </span>
                                </div>
                                <div>
                                    {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                                    <i class="fas fa-utensils" style="font-size:24px"></i>
                                    <span class="delevery-time">
                                    {{$product->restaurant->name}}
                                </span>
                                </div>
                         <div>
                            <div class="closed"><i class="fas fa-times-circle"></i></div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    @endsection