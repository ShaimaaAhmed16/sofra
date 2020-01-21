@extends('front.navebar')
@section('content')
<section class="contact-us">
    <div class="container">
        <div class="mt-3">
            @include('flash::message')
        </div>
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
        <form action="{{url('contact')}}" class="contact-info" method="post">
            @csrf
            <h1 class="text-center form-title">تواصل معنا</h1>
            <div class="input-group">
                <input type="text" placeholder="الاسم" id="offer-name" name="name">
                <input type="text" placeholder="البريد" id="email" name="email">
                <input type="text" placeholder="الجوال" id="phone" name="phone">
                <textarea name="message" id="msg" rows="10" placeholder="ما هي رسالتك"></textarea>
            </div>
            <div class="input-group buttons">
                <label class="d-flex flex-row"><span>شكوى </span>
                <input type="radio" name="type" class="w-auto ml-2"
                       <?php if (isset($type) && $type=="complaint") echo "checked";?>
                       value="complaint"></label>
                <label class="d-flex flex-row"><span>اقتراح </span>
                <input type="radio" name="type" class="w-auto ml-2"
                       <?php if (isset($type) && $type=="suggestion") echo "checked";?>
                       value="suggestion"></label>
                <label class="d-flex flex-row"><span>استعلام </span>
                    <input type="radio" name="type" class="w-auto ml-2"
                           <?php if (isset($type) && $type=="enquiry") echo "checked";?>
                           value="enquiry"></label>
                {{--<label class="radio inline">--}}
                    {{--{!! Form ::radio('type','complaint',($type == 'complaint' ? true : false)) !!}--}}
                    {{--شكوى--}}
                {{--</label>--}}
                {{--<label class="radio inline">--}}
                    {{--{!! Form ::radio('type','suggestion',($type == 'suggestion' ? true : false)) !!}--}}
                    {{--اقتراح--}}
                {{--</label>--}}
                {{--<label class="radio inline">--}}
                    {{--{!! Form ::radio('type','enquiry',($type == 'enquiry' ? true : false)) !!}--}}
                    {{--استعلام--}}
                {{--</label>--}}
                {{--<label class="d-flex flex-row"><span>شكوى</span> <input class="w-auto ml-2" type="radio" value="complaint" name="type"></label>--}}
                {{--<label class="d-flex flex-row"><span>اقتراح</span> <input class="w-auto ml-2" type="radio" value="suggestion" name="type"></label>--}}
                {{--<label class="d-flex flex-row"><span>استعلام</span> <input class="w-auto ml-2" type="radio" value="enquiry" name="type"></label>--}}
            </div>
            <button type="submit" class="add-new-link">اضافة</button>
        </form>
    </div>
</section>
    @endsection