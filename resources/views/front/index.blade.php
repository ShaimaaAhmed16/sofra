@extends('front.navebar')
@section('content')
    <header class="text-center">
        <div class="container">
            <div class="header-content">
                <h1>سفرة</h1>
                <p>بتشتري...بتبيع؟ كله عند ام ربيع</p>
                <a class="register main-btn" href="{{url('register-client')}}">
                    <span>سجل الأن</span>
                    <i class="fa fa-code"></i>
                </a>
            </div>
        </div>
    </header>
    <!-- End Header Section -->

    <!-- Start Favs Resturants Section -->
    <section class="favs text-center bg-gry">
        <div class="container">
            @include('flash::message')
            <h2>Find your favorite restaurant</h2>
            {!! Form::open(['method'=>'get']) !!}
            <div class="row">
                <div class="col-md-5">
                    {!!  Form::select('city',$cities->pluck('name','id')->toArray(),request()->input('city'),[
               'class' => 'form-control',
            'placeholder'=>'select city','style'=>'height: 50px;border-radius: 20px',

            ]) !!}
                </div>
                <div class="col-md-5">
                    {!!  Form::select('id',$restaurant->pluck('name','id')->toArray(),request()->input('name'),[
                      'class' => 'form-control',
                       'placeholder'=>'select favorite restaurant','style'=>'height: 50px;border-radius: 20px',
                    ]) !!}
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary "><i class="fa fa-search"></i></button>
                </div>
                {!! Form:: close()!!}
            </div>
            <div class="row mt-5">
                @foreach($restaurants as $restaurant)
                <div class="col-md-6">
                    <a href="{{url('list-product/'.$restaurant->id)}} ">
                    <div class="box text-center">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset($restaurant->image)}}" alt="Favs">
                            </div>
                            <div class="col-md-4">
                                <h3>{{$restaurant->name}}</h3>
                                <span class="review-stars" style="color: #1e88e5;">
<!-- ////////////// STAR RATE CHECKER ////////////// -->
                <ul class="list-unstyled">
                @if($restaurant->rating <= 0)
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @elseif($restaurant->rating === 1)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @elseif($restaurant->rating === 2)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @elseif($restaurant->rating === 3)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @elseif($restaurant->rating === 4)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @elseif($restaurant->rating >= 5)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @endif
                </ul>
                                    <!-- ///////////////////////////////////////////// -->
</span>
                                <p>Minimum order : <span>{{$restaurant->minimum}}</span>  SR</p>
                                <p>Delivery charge : <span>{{$restaurant->delivery_charge}}</span>  SR</p>
                            </div>
                            <div class="col-md-4">
                                @if($restaurant->is_open==0)
                                    <span class="stat">off</span>
                                @else
                                    <span class="status">on</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
              @endforeach
            </div>
            <div style="margin-right: 45%">
                {!! $restaurants->render() !!}
            </div>
            </div>
        </div>
    </section>
    <!-- End Favs Resturants Section -->

    <!-- Start Featues Section -->
    <section class="feats text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="offers">
                        <img src="{{asset('front/images/Group 1036.png')}}" alt="Offers">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <p>Get 20% off your first offer</p>
                        <a class="main-btn" href="{{url('listoffer')}}">
                            Watch the offers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Featues Section -->

    <!-- Start Download Section -->
    <section class="download">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset('front/images/app mockup.png')}}" alt="Offers">
                </div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <h2>قم بتحميل التطبيق الخاص بنا الان</h2>
                        <a class="main-btn" href="#">
                            <span>حمل الأن</span>
                            <i class="fa fa-arrow-down"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
