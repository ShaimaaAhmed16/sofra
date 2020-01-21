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
            <div style="background: #7d1038" class="text-center">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-text">هل تريد اضافه طلب اخر</h3><br/>
                        <a href="{{url('alert')}}" class="btn btn-primary">نعم</a>
                        <a href="#" class="btn btn-primary">لا</a>
                    </div>

                </div>
                {{--<p style="color: white">--}}
                    {{--هل تريد اضافه طلب اخر--}}
                {{--</p>--}}
                {{--<div>--}}
                    {{--<a class="btn" >نعم</a>--}}
                    {{--<a class="btn" >لا</a>--}}
                {{--</div>--}}
            </div>

        </div>

        </div>
    </section>

@endsection