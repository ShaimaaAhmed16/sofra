@extends('front.navebar')
@section('content')
    <section class="offers">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>العروض المتاحه الان</h1>
                </div>
            </div>
            <div class="row">
                @foreach($offer as $offers)
                <div class="col-sm-6"><a href="#"><img src="{{asset($offers->image)}}" alt="" width="100%" height="300px"></a></div>
                @endforeach
                    {{--<div class="col-sm-6"><a href="#"><img src="{{asset('front/images/offer.jpg')}}" alt="" width="100%"></a></div>--}}
                {{--<div class="col-sm-6"><a href="#"><img src="images/offer.jpg" alt="" width="100%"></a></div>--}}
                {{--<div class="col-sm-6"><a href="#"><img src="images/offer.jpg" alt="" width="100%"></a></div>--}}
            </div>
        </div>
    </section>
    @endsection