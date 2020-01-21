@extends('admin.home')
@section('page')
    show client
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">show client</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!!  Form::open(['action'=>['ClientController@show',$record->id],'method'=>'put']) !!}
                <div class="row ">
                    <div class="col-12   order-md-first mt-3 mt-md-0 ">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                             Name:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record->name}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            Phone
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record->phone}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            Email:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record->email}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            Image:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0"><img  style="height: 100px;width: 100px;" src="{{asset($record->image)}}" ></p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            Region:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record->region->name}}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                {!!  Form::close() !!}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
@endsection
