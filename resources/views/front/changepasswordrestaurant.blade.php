@extends('front.navebar')
@section('content')
    <section class="contact-us">
        <div class="container">
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
            {!!  Form::open([url('restaurant-change-password'),'method'=>'post']) !!}
            @csrf
            <label for="oldPassword">oldPassword</label>
            {!!  Form::password('oldPassword',[
                'class'=>'form-control'
            ]) !!}
            <label for="password">password</label>
            {!!  Form::password('password',[
                'class'=>'form-control'
            ]) !!}
            <label for="confirmed">confirmed</label>
            {!!  Form::password('password_confirmation',[
                'class'=>'form-control'
            ]) !!}
            <button type="submit" class="add-new-link">save</button>
            {!!  Form::close() !!}
        </div>
    </section>
@endsection