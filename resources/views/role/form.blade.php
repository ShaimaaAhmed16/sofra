@inject('perm','App\Models\Permission')
<div class="form-group">
    <label for="name">Name</label>
    {!!  Form::text('name',null,[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <label for="DisplayName">DisplayName</label>
    {!!  Form::text('display_name',null,[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <label for="Direction">Direction</label>
    {!!  Form::textarea('direction',null,[
        'class'=>'form-control'
    ]) !!}
</div>
<div class="form-group">
    <label for="Permission">Permission</label><br>
        <input type="checkbox" id="select-all" > <label for="select-all">select All</label>
    <div class="row">
        @foreach($perm->all() as $permission)
            <div class="col-sm-3">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="permission_list[]" value="{{$permission->id}}"
                        @if($model->hasPermission($permission->name))
                            checked
                            @endif
                        >{{$permission->display_name}}
                    </label>
                </div>
            </div>
            @endforeach
    </div>
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">save</button>
</div>

@push('scripts')
    <script>
        $("#select-all").click(function () {
            $("input[type=checkbox]").prop('checked',$(this).prop('checked'));
        });
    </script>
@endpush