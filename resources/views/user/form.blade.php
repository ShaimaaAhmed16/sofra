@inject('role','App\Models\Role')
<?php
$roles = $role->pluck('display_name','id')->toArray();
?>
<div class="form-group">
    <label for="name">Name</label>
    {!!  Form::text('name',null,[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <label for="email">Email</label>
    {!!  Form::text('email',null,[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <label for="password">password</label>
    {!!  Form::password('password',[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <label for="password_confirmation">password</label>
    {!!  Form::password('password_confirmation',[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <label for="roles_list">role users</label>
    {!!  Form::select('roles_list[]',$roles,null,[
        'class'=>'form-control','multiple'=>'multiple'
    ]) !!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">save</button>
</div>

