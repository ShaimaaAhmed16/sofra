<div class="form-group">
    <label for="name">Name</label>
    {!!  Form::text('name',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="Image" class="btn-block">Image</label>
    @if($model->image)
        <img src="<?php echo asset($model->image)?>"/>
    @endif
    <br>
    {!!  Form::file('image',null,[
        'class'=>'form-control file_upload_preview'
    ]) !!}
    <label for="content">content</label>
    {!!  Form::text('content',null,[
        'class'=>'form-control'
    ]) !!}<label for="restaurant_id">Restaurant</label>
    {!!  Form::text('restaurant_id',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="start_date">start date</label>
    {!!  Form::date('start_date',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="end_date">end date</label>
    {!!  Form::date('end_date',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="created_at">created at</label>
    {!!  Form::date('created_at',null,[
        'class'=>'form-control'
    ]) !!}
    <label for=" updated_at"> updated at</label>
    {!!  Form::date(' updated_at',null,[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">submit</button>
</div>