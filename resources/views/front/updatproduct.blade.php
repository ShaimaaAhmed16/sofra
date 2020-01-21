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
                    <h1 class="text-center form-title">تعديل منتج</h1>
                    {{--{!!  Form::model($product,['url'=>['updateproduct',$product->id],'method' => 'put', 'files' =>true]) !!}--}}
                    <form action="{{url('updateproduct/'.$product->id)}}"  method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="img-input">
                            <label for="customFileLang">صورة المنتج</label>
                            <img src="{{asset($product->image)}}" width="100px" height="100px"/>
                            {!!  Form::file('image',null,[
                                'class'=>'bg-transparent','id'=>'customFileLang',
                            ]) !!}
                            {{--<label  for="customFileLang">صورة المنتج</label>--}}
                            {{--<input type="file" class="bg-transparent" id="customFileLang" name="image" >--}}
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
                            {{--<input type="text" placeholder="اسم المنتج" id="product-name" name="name">--}}
                            {{--<textarea name="content" id="product-short-description" placeholder="وصف مختصر"></textarea>--}}
                            {{--<input type="text" placeholder="سعر المنتج" id="product-price" name="price">--}}
                            {{--<input type="text" id="time" placeholder="مدة التجهيز"  name="processing_time">--}}
                            <label for="name">اسم المنتج</label>
                            {!!  Form::text('name',$product->name,[
                                'id'=>'product-name',
                            ]) !!}
                            <label for="content">وصف مختصر</label>
                            {!!  Form::textarea('content',$product->content,[
                                'id'=>'product-short-description',
                            ]) !!}
                            <label for="about">سعر المنتج</label>
                            {!!  Form::text('price',$product->price,[
                                'id'=>'product-price'
                            ]) !!}
                            <label for=processing_time">مدة التجهيز</label>
                            {!!  Form::text('processing_time',$product->processing_time,[
                                'id'=>'time',
                            ]) !!}
                        </div>
                        <button type="submit" class="add-new-link">حفظ</button>
                    </form>
                    {{--{!!  Form::close() !!}--}}
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