@extends('front.navebar')
@section('content')
    <section class="contact-us">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!!  Form::model($user,[url('restaurant-profile'),'method'=>'post','file' =>'true']) !!}
            @csrf
            <label for=image">image</label>
            <img src="{{asset($user->image)}}" name="image" width="150px" height="150px">
            {!!  Form::file('image',null,[
                'class'=>'form-control'
            ]) !!}
            <label for="name">name</label>
            {!!  Form::text('name',null,[
                'class'=>'form-control'
            ]) !!}
            <label for="phone">phone</label>
            {!!  Form::text('phone',null,[
                'class'=>'form-control'
            ]) !!}
            <label for="email">email</label>
            {!!  Form::text('email',null,[
                    'class'=>'form-control'
            ]) !!}
            <label for="minimum">minimum</label>
            {!!  Form::text('minimum',null,[
                'class'=>'form-control'
            ]) !!} <label for="delivery_charge">delivery_charge</label>
                {!!  Form::text('delivery_charge',null,[
                    'class'=>'form-control'
                ]) !!}
                <label for="whats">whats</label>
                {!!  Form::text('whats',null,[
                    'class'=>'form-control'
                ]) !!}
                <label for="region_id">region_id</label>
                {!!  Form::text('region_id',null,[
                    'class'=>'form-control'
                ]) !!}
            <button type="submit" class="add-new-link">save</button>
            {!!  Form::close() !!}
        </div>
    </section>
@endsection