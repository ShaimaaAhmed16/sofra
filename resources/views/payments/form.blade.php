<div class="form-group">
    <label for="amount">Amount</label>
    {!!  Form::text('amount',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="notes">Notes</label>
    {!!  Form::text('notes',null,[
        'class'=>'form-control'
    ]) !!}
    <label for="restaurant_id">restaurant</label>
    {!!  Form::text('restaurant_id',null,[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">save</button>
</div>
