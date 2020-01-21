@extends('front.navebar')
@section('content')
<section class="add-new-section product">
    <div class="container">
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
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <h1 class="text-center form-title">اضف منتج جديد</h1>
                <form action="{{url('addproduct')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="img-input">
                        <label  for="customFileLang">صورة المنتج</label>
                        <input type="file" class="bg-transparent" id="customFileLang" name="image" >
                    </div>
                    {{--<div class="img-input">--}}
                        {{----}}
                        {{--<div class="img">--}}
                            {{--<img src="{{asset('front/images/default-image.jpg')}}" alt="">--}}
                            {{--<input type="file" name="image" id="product_image">--}}
                            {{--<input type="file" class="bg-transparent" id="customFileLang" name="image" >--}}
                        {{--</div>--}}
                        {{--<p>صورة المنتج</p>--}}
                    {{--</div>--}}
                    <div class="input-group">
                        <input type="text" placeholder="اسم المنتج" id="product-name" name="name">
                        <textarea name="content" id="product-short-description" placeholder="وصف مختصر"></textarea>
                        <input type="text" placeholder="سعر المنتج" id="product-price" name="price">
                        <input type="text" id="time" placeholder="مدة التجهيز"  name="processing_time">
                    </div>
                    <button type="submit" class="add-new-link">دخول</button>
                </form>
            </div>
        </div>
    </div>
</section>
    @push('script')
        <script>
            var timepicker = new TimePicker('time', {
                lang: 'en',
                theme: 'dark'
            });
            timepicker.on('change', function(evt) {

                var value = (evt.hour || '00') + ':' + (evt.minute || '00');
                evt.element.value = value;

            });
        </script>
    @endpush
@endsection