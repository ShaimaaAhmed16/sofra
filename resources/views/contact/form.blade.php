<div class="form-group">
    <label for="name">Name</label>
    {!!  Form::text('name',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="email">Email</label>
    {!!  Form::text('email',null,[
        'class'=>'form-control'
    ]) !!}<label for="phone">phone</label>
    {!!  Form::text('phone',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="message">Message</label>
    {!!  Form::date('message',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="type">type</label>
    {!!  Form::date('type',null,[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">submit</button>
</div>