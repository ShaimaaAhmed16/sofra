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
            <form action="{{url('register-client')}}" class="p-5 my-3 text-center" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" class="form-control my-4" placeholder="الاسم" name="name">
                <input type="email" class="form-control my-4" placeholder="البريد الاليكترونى" name="email">
                <input type="text" class="form-control my-4" placeholder="الجوال" name="phone">
                {{--{!!  Form::select('city_id',$city->pluck('name','id')->toArray(),null,['class'=>'form-control my-4',--}}
                 {{--'id'=>'cities','placeholder'=>'اخنار المدينه'--}}
                 {{--]) !!}--}}
                {{--{!!  Form::select('region_id',[],null,['class'=>'form-control my-4',--}}
                {{--'id'=>'regions','placeholder'=>'اختار الحي'--}}
                {{--]) !!}--}}
                <input type="password" class="form-control my-4" placeholder="كلمة المرور" name="password">
                <input type="password" class="form-control my-4" placeholder="اعادة كلمة المرور" name="password_confirmation">
                <div class="d-flex">
                    <label  for="customFileLang">اضافه صوره</label>
                    <input type="file" class="bg-transparent" id="customFileLang" name="image" >
                </div>
                <div class="form-row">
                    <div class="col new-user">
                        <p>  بإنشاء حسابك أن توافق على <a href=""> شروط الاستخدام </a> الخاصة بسفرة</p>
                    </div>
                </div>
                <button type="submit" class="btn w-75 mt-4 text-white">save</button>
                <div class="mt-2">
                    <a  href="{{url('login-client')}}">login</a>
                    <a class="ml-5" href="{{url('register-restaurant')}}"> تسجيل الدجول الي المطعم</a>
                </div>
            </form>

        </div>
    </section>
</div>

@push('script')
    <script>
        $("#cities").change (function (e) {
            e.preventDefault();
            var city_id = $("#regions").val();
            if(city_id){
                $.ajax({
                    url:"{{url('api/v1/cities?city_id=')}}"+ city_id,
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
@endpush
@endsection