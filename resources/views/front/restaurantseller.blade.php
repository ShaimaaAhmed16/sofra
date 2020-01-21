@extends('front.navebar')
@section('content')
<section id="header">
    <div class="container">
        <div class="header-desc">
            <img class="website-name rounded-circle" src="{{asset(auth()->user()->image)}}" alt="" style="margin: 0 auto;" height="150px" width="150px">
            {{--<img class="website-name" src="{{asset(auth()->user()->image)}}" alt="" style="margin: 0 auto;">--}}
            <h1 class="res-name">{{auth()->user()->name}}</h1>
            {{--<h1 class="res-name">{{auth()->user()->name}}</h1>--}}
            <span class="review-stars" style="color: #1e88e5;">
<!-- ////////////// STAR RATE CHECKER ////////////// -->
                <ul class="list-unstyled">
                @if(auth()->user()->rating <= 0)
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @elseif(auth()->user()->rating === 1)
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @elseif(auth()->user()->rating === 2)
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @elseif(auth()->user()->rating === 3)
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @elseif(auth()->user()->rating === 4)
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @elseif(auth()->user()->rating >= 5)
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
            @endif
                </ul>
            <!-- ///////////////////////////////////////////// -->
</span>
            {{--<ul class="list-unstyled">--}}
                {{--<li class="fa fa-star"></li>--}}
                {{--<li class="fa fa-star"></li>--}}
                {{--<li class="fa fa-star"></li>--}}
                {{--<li class="fa fa-star"></li>--}}
                {{--<li class="fa fa-star"></li>--}}
            {{--</ul>--}}
        </div>
    </div>
</section>


<section class="food">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
                <h1><a href="">قائمة الطعام</a>/ <span>منتجاتى</span></h1>
            </div>
            <div class="mt-3">
                @include('flash::message')
            </div>
            <div style="margin-right: 25%">
                <div class="col-sm-4 float-left ">
                    <a href="{{url('addproduct')}}" class="btn minu-btn my-5 px-5">اضف منتج  جديد</a>
                </div>
                <div class="col-sm-4 float-left ">
                    <a href="{{url('addoffer')}}" class="btn minu-btn my-5 px-5">اضف عرض جديد</a>
                </div>
                <div class="col-sm-4 float-left ">
                    <a href="{{url('new-order-requests')}}" class="btn minu-btn my-5 px-5">عرض الطلبات جديده</a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($product as $products)
            <div class="col-sm-4">
                <div class="item-holder">
                    <img src="{{asset($products->image)}}" alt="item-image" width="100%" height="300px">
                    <div class="item-data text-center">
                        <h3 class="item-title">{{$products->name}}</h3>
                        <p class="item-description">{{$products->content}}</p>
                    </div>
                    <div class="features">
                        <div>
                            {{--<img src="{{asset('front/images/piggy-bank.png')}}" alt="" width="30px;">--}}
                            <i class="fa fa-money" style="font-size:24px"></i>
                            <span class="delevery-time">
                                    {{$products->price}} SR
                                </span>
                        </div>
                    </div>
                    <div class="closed"><i class="fas fa-times-circle"></i></div>
                    <div>
                    <div class="col-sm-5 float-left">
                        <a href="{{url('editproduct/'.$products->id)}}"  class="btn">تعديل منتج</a>
                    </div>
                    <div class="col-sm-5 float-right ">
                        <a class="destroy btn btn-danger btn-xs" onclick="return myFunction();" href="{{url('deletproduct/'.$products->id)}}"><i class="fa fa-trash"></i></a>
                    </div>
                    </div>
                </div>

            </div>
            @endforeach
            {{--<div class="col-sm-4">--}}
                {{--<div class="item-holder">--}}
                    {{--<img src="images/burger.jpg" alt="item-image" width="100%">--}}
                    {{--<div class="item-data text-center">--}}
                        {{--<h3 class="item-title">بيف برجر</h3>--}}
                        {{--<p class="item-description">البرجر ده جامد جدا خالص</p>--}}
                    {{--</div>--}}
                    {{--<div class="features">--}}
                        {{--<div>--}}
                            {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                            {{--<span class="delevery-time">--}}
                                    {{--55 ريال--}}
                                {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="closed"><i class="fas fa-times-circle"></i></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<div class="item-holder">--}}
                    {{--<img src="images/burger.jpg" alt="item-image" width="100%">--}}
                    {{--<div class="item-data text-center">--}}
                        {{--<h3 class="item-title">بيف برجر</h3>--}}
                        {{--<p class="item-description">البرجر ده جامد جدا خالص</p>--}}
                    {{--</div>--}}
                    {{--<div class="features">--}}
                        {{--<div>--}}
                            {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                            {{--<span class="delevery-time">--}}
                                    {{--55 ريال--}}
                                {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="closed"><i class="fas fa-times-circle"></i></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-4">--}}
                {{--<div class="item-holder">--}}
                    {{--<img src="images/burger.jpg" alt="item-image" width="100%">--}}
                    {{--<div class="item-data text-center">--}}
                        {{--<h3 class="item-title">بيف برجر</h3>--}}
                        {{--<p class="item-description">البرجر ده جامد جدا خالص</p>--}}
                    {{--</div>--}}
                    {{--<div class="features">--}}
                        {{--<div>--}}
                            {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                            {{--<span class="delevery-time">--}}
                                    {{--55 ريال--}}
                                {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="closed"><i class="fas fa-times-circle"></i></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<div class="item-holder">--}}
                    {{--<img src="images/burger.jpg" alt="item-image" width="100%">--}}
                    {{--<div class="item-data text-center">--}}
                        {{--<h3 class="item-title">بيف برجر</h3>--}}
                        {{--<p class="item-description">البرجر ده جامد جدا خالص</p>--}}
                    {{--</div>--}}
                    {{--<div class="features">--}}
                        {{--<div>--}}
                            {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                            {{--<span class="delevery-time">--}}
                                    {{--55 ريال--}}
                                {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="closed"><i class="fas fa-times-circle"></i></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<div class="item-holder">--}}
                    {{--<img src="images/burger.jpg" alt="item-image" width="100%">--}}
                    {{--<div class="item-data text-center">--}}
                        {{--<h3 class="item-title">بيف برجر</h3>--}}
                        {{--<p class="item-description">البرجر ده جامد جدا خالص</p>--}}
                    {{--</div>--}}
                    {{--<div class="features">--}}
                        {{--<div>--}}
                            {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                            {{--<span class="delevery-time">--}}
                                    {{--55 ريال--}}
                                {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="closed"><i class="fas fa-times-circle"></i></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="row">--}}
            {{--<div class="col-sm-4">--}}
                {{--<div class="item-holder">--}}
                    {{--<img src="images/burger.jpg" alt="item-image" width="100%">--}}
                    {{--<div class="item-data text-center">--}}
                        {{--<h3 class="item-title">بيف برجر</h3>--}}
                        {{--<p class="item-description">البرجر ده جامد جدا خالص</p>--}}
                    {{--</div>--}}
                    {{--<div class="features">--}}
                        {{--<div>--}}
                            {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                            {{--<span class="delevery-time">--}}
                                    {{--55 ريال--}}
                                {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="closed"><i class="fas fa-times-circle"></i></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<div class="item-holder">--}}
                    {{--<img src="images/burger.jpg" alt="item-image" width="100%">--}}
                    {{--<div class="item-data text-center">--}}
                        {{--<h3 class="item-title">بيف برجر</h3>--}}
                        {{--<p class="item-description">البرجر ده جامد جدا خالص</p>--}}
                    {{--</div>--}}
                    {{--<div class="features">--}}
                        {{--<div>--}}
                            {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                            {{--<span class="delevery-time">--}}
                                    {{--55 ريال--}}
                                {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="closed"><i class="fas fa-times-circle"></i></div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<div class="item-holder">--}}
                    {{--<img src="images/burger.jpg" alt="item-image" width="100%">--}}
                    {{--<div class="item-data text-center">--}}
                        {{--<h3 class="item-title">بيف برجر</h3>--}}
                        {{--<p class="item-description">البرجر ده جامد جدا خالص</p>--}}
                    {{--</div>--}}
                    {{--<div class="features">--}}
                        {{--<div>--}}
                            {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                            {{--<span class="delevery-time">--}}
                                    {{--55 ريال--}}
                                {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="closed"><i class="fas fa-times-circle"></i></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</section>
    @push('script')
        <script>
            function myFunction() {
                if(!confirm("Are You Sure to delete this"))
                    event.preventDefault();
            }
        </script>
    @endpush
@endsection
