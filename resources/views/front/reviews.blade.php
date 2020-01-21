@extends('front.navebar')
@section('content')
    <div class="order-state py-5 d-flex">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="text-center"><a href="">اضف تقييمك</a></h5>
                </div>
            </div>
        </div>
    </div>
    <div>
        @include('flash::message')
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
    <form action="{{url('review')}}" method="post">
        @csrf
        <div class="form-group text-center mb-4 mt-5 " id="rating-ability-wrapper">
            <label class="control-label btn-block" for="rating">
                <span class="field-label-header">اضف تقيمك</span><br>
                <span class="field-label-info"></span>
                <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
            </label>
            {{--<h2 class="bold rating-header" style="">--}}
                {{--<span  class="selected-rating">0</span>--}}
                {{--<small> / 5</small>--}}
            {{--</h2>--}}
            <span class="star-rating mt-2" id="star_rating">
<!--RADIO 1-->
                                 <input type='checkbox' class="radio_item" value="1" name="item" id="radio1"
                                        style="display: none">
                                     <label class="label_item" for="radio1"><li class="far fa-star"
                                                                                id="star1"></li></label>
                <!--RADIO 2-->
                                 <input type='checkbox' class="radio_item" value="2" name="item" id="radio2"
                                        style="display: none">
                                 <label class="label_item" for="radio2"><li class="far fa-star" id="star2"></li></label>
                <!--RADIO 3-->
                                 <input type='checkbox' class="radio_item" value="3" name="item" id="radio3"
                                        style="display: none">
                                 <label class="label_item" for="radio3"><li class="far fa-star" id="star3"></li></label>
                <!--RADIO 4-->
                                 <input type='checkbox' class="radio_item" value="4" name="item" id="radio4"
                                        style="display: none">
                                 <label class="label_item" for="radio4"><li class="far fa-star" id="star4"></li></label>
                <!--RADIO 5-->
                                 <input type='checkbox' class="radio_item" value="5" name="item" id="radio5"
                                        style="display: none">
                                 <label class="label_item" for="radio5"><li class="far fa-star" id="star5"></li></label>
                             </span>
        </div>
        <div>
            <textarea name="comment" id="rate" cols="30" rows="10" placeholder="اضف تعليك"
                      style="width: 85%;margin-right: 5% ;background: #db3745"></textarea>
            <input type="submit" value="ارسال" class="mt-2 w-25 mb-3" style="margin-right: 40%;background:#db3745"/>
            <input type="hidden" value="{{$id}}" name="restaurant_id" class="mt-2 w-25 mb-3" style="margin-right: 40%;background:#db3745"/>
        </div>
    </form>

    @push('script')
        <script>
            jQuery(document).ready(function ($) {
                $('.star-rating input').click( function(){
                    starvalue = $(this).attr('value');
                    // iterate through the checkboxes and check those with values lower than or equal to the one you selected. Uncheck any other.
                    for(i=0; i<=5; i++){
                        if (i <= starvalue){
                            $("#radio" + i).prop('checked', true);
                            $("#star" + i).css('font-weight', 'bolder');
                            // $("#star" + i).css('font-size', '20px');
                        } else {
                            $("#radio" + i).prop('checked', false);
                            $("#star" + i).css('font-weight', '100');
                            // $("#star" + i).css('font-size', '15px');
                        }
                    }
                });
                $(".btnrating").on('click', (function (e) {

                    var previous_value = $("#selected_rating").val();

                    var selected_value = $(this).attr("data-attr");
                    $("#selected_rating").val(selected_value);

                    $(".selected-rating").empty();
                    $(".selected-rating").html(selected_value);

                    for (i = 1; i <= selected_value; ++i) {
                        $("#rating-star-" + i).toggleClass('btn-warning');
                        $("#rating-star-" + i).toggleClass('btn-default');
                    }

                    for (ix = 1; ix <= previous_value; ++ix) {
                        $("#rating-star-" + ix).toggleClass('btn-warning');
                        $("#rating-star-" + ix).toggleClass('btn-default');
                    }

                }));


            });

        </script>
    @endpush
@endsection