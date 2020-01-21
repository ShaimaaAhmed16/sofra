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
            <div class="col-sm-12 text-center">
                <a href="{{url('addoffer')}}" class="btn minu-btn my-5 px-5">اضف عرضا جديداً</a>
            </div>
        </div>
        <div class="row">
            @foreach($offer as $offers)
                <div class="col-sm-6"><a href="#"><img src="{{asset($offers->image)}}" alt="" width="100%" height="300px"></a>
                    <div class="mt-3">
                        <div class="col-sm-5 float-left">
                            <a href="{{url('editoffer/'.$offers->id)}}"  class="btn" style="background: #7d1038">تعديل العرض</a>
                        </div>
                        <div class="col-sm-5 float-right ">
                            <a class="destroy btn btn-danger btn-xs" onclick="return myFunction();" href="{{url('deleteoffer/'.$offers->id)}}"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>

            @endforeach
            {{--<div class="col-sm-6"><a href="#"><img src="images/offer.jpg" alt="" width="100%"></a></div>--}}
            {{--<div class="col-sm-6"><a href="#"><img src="images/offer.jpg" alt="" width="100%"></a></div>--}}
            {{--<div class="col-sm-6"><a href="#"><img src="images/offer.jpg" alt="" width="100%"></a></div>--}}
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