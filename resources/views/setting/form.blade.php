<div class="form-group ">
    <label for="name">name</label>
    {!!  Form::text('name',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="commission">commission</label>
    {!!  Form::text('commission',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="about">about</label>
    {!!  Form::text('about',null,[
        'class'=>'form-control'
    ]) !!}
    <label for=bank_account">bank Account</label>
    {!!  Form::text('bank_account',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="app_commission">app Commission</label>
    {!!  Form::text('app_commission',null,[
        'class'=>'form-control'
    ]) !!}

</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">save</button>
</div>