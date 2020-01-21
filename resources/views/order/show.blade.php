@extends('admin.home')
@section('page')
    show orders
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card" id="printTable">
            <div class="card-header">
                <h3 class="card-title">show orders</h3>

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
                {!!  Form::open(['action'=>['OrderController@show',$record->id],'method'=>'put']) !!}
                <div class="row ">
                    <div class="col-12   order-md-first mt-3 mt-md-0 ">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            Address:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record->address}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            special order:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record->special_order}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            status:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record->status}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            cost:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0"><img  style="height: 100px;width: 100px;" src="{{asset($record->cost)}}" ></p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            commission:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record->commission}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            Net:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record-> net}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            total:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{$record->total}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            client:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{optional($record->client)->name}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            Restaurant:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{optional($record->restaurant)->name}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <p class="m-0 font-weight-bold">
                                            opened at:
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="m-0">{{optional($record->payment)->name}}</p>
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
        <div style="margin-top: 8px; margin-left: 50% ;">
            <button style="background: #0056b3"><i class="fa fa-print"></i>Print me</button>
        </div>
        <!-- /.card -->

    </section>
@endsection
