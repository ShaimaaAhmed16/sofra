@extends('front.navebar')
@section('content')
    <section class="orders">
        <div class="order-state py-5 d-flex">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-left"><a href="">طلبات سابقة</a></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-right"><a href="">طلبات سابقة</a></h5>
                    </div>
                </div>
            </div>
        </div><!--End order-state-->
        <div class="order-details">
            <div class="container">
                <div class="order-current my-5">
                    <div class="row text-center">
                        <div class="col-md-3 py-3 px-4">
                            <img src="images/user-photo.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-8 pt-3 text-left">
                            <p class="py-1"> العميل : <span> مازن محمد </span></p>
                            <p class="py-1 mncolor">رقم الطلب <span>1457</span></p>
                            <p class="py-1 mncolor">المجموع :  <span>75</span> ريال</p>
                            <p class="py-1 mncolor">العنوان :  <span>127 شارع المعز بن على</span></p>
                        </div>
                        <div class="col mb-4">
                            <button class="btn bg-mncolor mx-3 px-5">01006383877</button>
                            <button class="btn btn-success mx-3 px-5">تأكيد التسليم</button>
                        </div>
                    </div>
                </div>
                <div class="order-current my-5">
                    <div class="row text-center">
                        <div class="col-md-3 py-3 px-4">
                            <img src="images/user-photo.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-8 pt-3 text-left">
                            <p class="py-1"> العميل : <span> مازن محمد </span></p>
                            <p class="py-1 mncolor">رقم الطلب <span>1457</span></p>
                            <p class="py-1 mncolor">المجموع :  <span>75</span> ريال</p>
                            <p class="py-1 mncolor">العنوان :  <span>127 شارع المعز بن على</span></p>
                        </div>
                        <div class="col mb-4">
                            <button class="btn bg-mncolor mx-3 px-5">01006383877</button>
                            <button class="btn btn-success mx-3 px-5">تأكيد التسليم</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection