@extends('front.navebar')
@section('content')
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
    <section class=" register-page py-5 my-5">
        <div class="mt-3">
            @include('flash::message')
        </div>
        <div class="reg mx-auto my-5">
            <div><img src="{{asset('front/images/use-img.png')}}" alt="user"></div>
            <form action="{{url('login-restaurant')}}" class="p-5 my-3 text-center" method="post">
                @csrf
                <input type="email" class="form-control my-4" placeholder="البريد الاليكترونى" name="email">
                <input type="password" class="form-control my-4" placeholder="الباسورد" name="password">
                <button type="submit" class="btn w-75 my-4 text-white">دخول</button>
                <div class="form-row my-3">
                    <div class="col new-user">
                    <div class="col pass">
                        <a href="">نسيت كلمة السر ؟</a>
                    </div>
                </div>
                <a class="btn w-75 my-4 text-white" href="{{url('register-restaurant')}}" style="background:#A10A4A">انشيء حساب الآن</a>
            </form>
        </div>
    </section>
</div>
@endsection