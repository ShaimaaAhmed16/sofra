<div class="form-group">
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
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">submit</button>
</div>