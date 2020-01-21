@extends('front.navebar')
@section('content')
<div class="container">
    <section class=" register-page py-5 my-5">
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
        <div class="reg1 mx-auto my-5">
            <div><img src="{{asset('front/images/use-img.png')}}" alt="user"></div>
            <form action="{{url('register-restaurant')}}" class="p-5 my-3 text-center" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" class="form-control my-4" placeholder="الاسم" name="name">
                <input type="email" class="form-control my-4" placeholder="البريد الاليكترونى" name="email">
                <input type="text" class="form-control my-4" placeholder="الجوال" name="phone">
                {!!  Form::select('city_id',$city->pluck('name','id')->toArray(),null,['class'=>'form-control my-4',
                 'id'=>'cities','placeholder'=>'اخنار المدينه'
                 ]) !!}
                {!!  Form::select('region_id',[],null,['class'=>'form-control my-4',
                'id'=>'regions','placeholder'=>'اختار الحي'
                ]) !!}
                <input type="password" class="form-control my-4" placeholder="كلمة المرور" name="password">
                <input type="password" class="form-control my-4" placeholder="اعادة كلمة المرور" name="password_confirmation">

                <select class="form-control form-control-lg js-example-basic-multiple" name="category[]" multiple="multiple">
                    <option value="التصنيفات">التصنيفات</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <input type="text" class="form-control my-4" placeholder="الحد الادنى" name="minimum">
                <input type="text" class="form-control my-4" placeholder="رسوم التوصيل" name="delivery_charge">
                <input type="text" class="form-control my-4" placeholder="الواتس اب" name="whats">
                <input type="time" class="form-control my-4" placeholder="ميعاد فتح المطعم" name="opened_at">
                <input type="time" class="form-control my-4" placeholder="ميعاد غلق المطعم" name="closed_at">
                <div class="d-flex">
                    <label  for="customFileLang">صورة المتجر</label>
                    <input type="file" class="bg-transparent" id="customFileLang" name="image" >
                </div>
                <div class="form-row">
                    <div class="col new-user">
                        <p>  بإنشاء حسابك أن توافق على <a href=""> شروط الاستخدام </a> الخاصة بسفرة</p>
                    </div>
                </div>
                <button type="submit" class="btn w-75 mt-4 text-white">دخول</button>
            </form>
        </div>
    </section>
</div>

@push('script')
    <script>

        $("#cities").change(function (e) {
            e.preventDefault();
            var city_id = $("#cities").val();
            if(city_id){
                $.ajax({
                    url: 'city/'+city_id+'/regions',
                    type:'get',
                    success:function (data) {
                        console.log(data);
                        if(data.status==1){
                            $("#regions").empty();
                            $("#regions").append('<option value="">select region</option>');
                            $.each(data.data,function (index,region) {
                                $("#regions").append('<option value="'+region.id+'">'+region.name+'</option>');
                                        })
                        }
                    },
                    error: function (jqXhr, textStatus, errorMessage) { // error callback
                        alert(errorMessage);
                    }
                });
            }
            else{
                $("#regions").empty();
                $("#regions").append('<option value="">select region</option>');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
@endsection