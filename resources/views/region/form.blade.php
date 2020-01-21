<div class="form-group">
    <label for="name">Name</label>
    {!!  Form::text('name',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="id">city</label>
    {{--<select name="governorate_id" class="form-control">--}}
        {{--<option {{optional($model->governorate)->id}}>{{optional($model->governorate)->name}}</option>--}}
       {{--@foreach($governorates as $governorate)--}}
           {{--@if($governorate->id != optional($model->governorate)->id)--}}
                {{--<option value="{{$governorate->id}}">{{$governorate->name}}</option>--}}
           {{--@endif--}}
           {{--@endforeach--}}
    {{--</select>--}}
        {!! Form::select('city_id',$city->pluck('name','id')->toArray(),null,[
    'class' => 'form-control'
    ]) !!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">submit</button>
</div>