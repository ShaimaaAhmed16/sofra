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
                    <h1 class="text-center form-title">تعديل العرض</h1>
                    <form action="{{url('deleteoffer/'.$offer->id)}}"  method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="img-input">
                            <label for="customFileLang">صورة العرض</label>
                            <img src="{{asset($offer->image)}}" width="100px" height="100px"/>
                            {!!  Form::file('image',null,[
                                'class'=>'bg-transparent','id'=>'customFileLang',
                            ]) !!}
                        </div>
                        <div class="input-group">
                            <label for="name">اسم العرض</label>
                            {!!  Form::text('name',$offer->name,[
                                'id'=>'product-name',
                            ]) !!}
                            <label for="content">وصف مختصر</label>
                            {!!  Form::textarea('content',$offer->content,[
                                'id'=>'product-short-description',
                            ]) !!}
                            <label for="about">سعر العرض</label>
                            {!!  Form::text('price',$offer->price,[
                                'id'=>'product-price'
                            ]) !!}
                            <label for=start_date">تاريخ العرض من</label>
                            {!!  Form::date('start_date',$offer->start_date,[
                                'class'=>'from',
                            ]) !!}
                            <label for=end_date">تاريخ العرض الي</label>
                            {!!  Form::date('end_date',$offer->end_date,[
                                'class'=>'to',
                            ]) !!}
                        </div>
                        <button type="submit" class="add-new-link">حفظ</button>
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