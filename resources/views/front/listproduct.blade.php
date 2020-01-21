@extends('front.navebar')
@section('content')
    <section id="header">
        <div class="container">
            <div class="header-desc">
                <img class="website-name rounded-circle" src="{{asset($restaurant->image)}}" alt=""
                     style="margin: 0 auto;" width="150px" height="150px">
                {{--<img class="website-name" src="{{asset(auth()->user()->image)}}" alt="" style="margin: 0 auto;">--}}
                <h1 class="res-name">{{$restaurant->name}}</h1>
                {{--<h1 class="res-name">{{auth()->user()->name}}</h1>--}}
                <span class="review-stars" style="color: #1e88e5;">
<!-- ////////////// STAR RATE CHECKER ////////////// -->
                <ul class="list-unstyled">
                    @php
                        $rate=floor($restaurant->reviews->avg('rate'));
                    @endphp
                          @for($i=0; $i<5; $i++)
                        <i class="fa fa-star{{ $rate<=$i?'-o':'' }}" aria-hidden="true"></i>
                    @endfor
                    {{----}}

                </ul>
                    <!-- ///////////////////////////////////////////// -->
</span>
            </div>
        </div>
    </section>

    <section class="food">
        <div class="container">
            <div class="row">
                @include('flash::message')
                <div class="col-sm-12 text-center">
                    <a href="{{url('reviews/'.$restaurant->id)}}" class="btn minu-btn px-5">اضف تقيمك</a>
                    {{--<a href="{{url('update/'.$restaurant->id)}}" class="btn minu-btn px-5">update</a>--}}
                </div>
            </div>
            <div class="row text-center mt-3">
                <div class="col-sm-12">
                    <h1><a href="">قائمة الطعام</a>/ <span>منتجاتى</span></h1>
                </div>
            </div>
            <div class="row">
                @foreach($product as $products)
                    <div class="col-sm-4">
                        <div class="item-holder">
                            <img src="{{asset($products->image)}}" alt="item-image" width="100%" height="300px">
                            <div class="item-data text-center">
                                <h3 class="item-title">{{$products->name}}</h3>
                                {{--<p class="item-description">{{optional($products->content)}}</p>--}}
                            </div>
                            <div class="features">
                                <div>
                                    {{--<img src="images/piggy-bank.png" alt="" width="30px;">--}}
                                    <i class="far fa-clock" style="font-size:24px"></i>
                                    <span class="delevery-time">
                                    {{$products->processing_time}} Almost accurate
                                </span>
                                </div>
                                <div>
                                    {{--<img src="{{asset('front/images/piggy-bank.png')}}" alt="" width="30px;">--}}
                                    <i class="fas fa-money-bill-alt" style="font-size:24px"></i>
                                    <span class="delevery-time">
                                    {{$products->price}} SR
                                </span>
                                </div>
                                <a href="{{url('product-details/'.$products->id)}}" >اضغط للتفاصيل</a>
                                <a class="btn " href="{{url('add-cart/'.$products->id)}}">اضف الي العربه</a>
                            </div>
                            <div class="closed"><i class="fas fa-times-circle"></i></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
