@extends('front.navebar')
@section('content')
    <section class="contact-us">
        <div class="container">
            <div class="mt-3">
                @include('flash::message')
            </div>
            <div>
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
        </div>
        <form action="{{url('addorder')}}" class="contact-info" method="post">
            @csrf
            <h1 class="text-center form-title">add order</h1>
            <div >
                <div class="item-holder" style="background: #ec3454;">
                   <img src="{{asset($product->image)}}" alt="item-image" width="100%" height="200px">
                      <div class="item-data text-center">
                          <h6 class="item-title" style="color: white">{{$product->name}}</h6>
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
                             <i class="far fa-clock" style="font-size:24px"></i>
                             <span class="delevery-time">{{$product->processing_time}}</span>
                         </div>
                          {{--<div>--}}
                             {{--<i class="fas fa-utensils" style="font-size:24px"></i>--}}
                             {{--<span class="delevery-time"> </span>--}}
                          {{--</div>--}}
                          <div>
                             <div class="closed"><i class="fas fa-times-circle"></i></div>
                          </div>
                        </div>
                    </div>
            </div>
            <div class="input-group mt-2">
                <label ><span>Special request:</span></label>
                <input type="text" name="notes" id="msg" rows="10" placeholder="Special request" />
                {{--<label ><span>الكميه: </span></label>--}}
                {{--<input type="text" placeholder="البريد" id="email" name="email">--}}
                {{--<label ><span>address: </span></label>--}}
                {{--<input type="text" placeholder="address" name="address" id="msg">--}}
            </div>
            <label ><span>payment: </span></label>
            <div class="input-group buttons">
                @foreach($payment as $payments)
                <label class="d-flex flex-row"><span>{{$payments->name}}</span>
                    <input type="radio" name="payment_method_id" class="w-auto ml-2"
                           <?php if (isset($payment_method_id) && $payment_method_id=="{{$payments->id}}") echo "checked";?>
                           value="{{$payments->id}}"></label>
                @endforeach

            </div>
                <label ><span>quantity: </span></label>
            <button class="plus button" type="button">
              +
            </button>
            <input type="number" name="qty" id="qty" maxlength="12" value="1" min="1"/>
            <button class="min button" type="button">
                -
            </button>
                {{--<div id="field1">--}}
                    {{--<button type="button" id="sub" class="sub ">-</button>--}}
                    {{--<input type="number" id="1" value="1" min="1" max="100" />--}}
                    {{--<button type="button" id="add" class="add ">+</button>--}}
                {{--</div>--}}
                <input type="hidden" value="{{$product->restaurant->id}}" name="restaurant_id" />
                <input type="hidden" value="{{$product->price}}" name="product[]" />
                <input type="hidden" value="{{$product->id}}" name="product_id[]" />
            <button type="submit" class="add-new-link">save</button>
        </form>

        </div>
    </section>

    @push('script')
        <script>
            jQuery(function(){
                var j = jQuery; //Just a variable for using jQuery without conflicts
                var addInput = '#qty'; //This is the id of the input you are changing
                var n = 1; //n is equal to 1

                //Set default value to n (n = 1)
                j(addInput).val(n);

                //On click add 1 to n
                j('.plus').on('click', function(){
                    j(addInput).val(++n);
                })

                j('.min').on('click', function(){
                    //If n is bigger or equal to 1 subtract 1 from n
                    if (n > 1) {
                        j(addInput).val(--n);
                    } else {
                        //Otherwise do nothing
                    }
                });
            });

            // $('.add').click(function () {
            //     if ($(this).prev().val() < 100) {
            //         $(this).prev().val(+$(this).prev().val() + 1);
            //     }
            // });
            // $('.sub').click(function () {
            //     if ($(this).next().val() > 1) {
            //         if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            //     }
            // });
        </script>
    @endpush
@endsection