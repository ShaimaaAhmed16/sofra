@extends('admin.home')
@section('page')
    payment
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of payment</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="float-left">
                    {!! Form::open(['action'=>'RestorauntPaymentController@index','method'=>'get']) !!}
                    <input type="text" name="amount" placeholder="amount">
                    <input type="text" name="restaurant_name" placeholder="restaurant Name">
                    <button class="btn btn-primary " type="submit"><i class="fa fa-search"></i>search</button>
                    {!! Form::close() !!}

                </div>
                <div class="float-right">
                    <a href="{{url(route('payments.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i>New payment</a>
                </div>
                <div class="clearfix"></div>
                <div class="mt-3">
                    @include('flash::message')
                </div>

                @if(count($records))
                    <div class="table table-responsive mt-3">
                        <table class="table table-bordered text-center">
                           <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Amount</th>
                                   <th>Notes</th>
                                   <th>Restaurant</th>
                                   <th>Edit</th>
                                   <th>Delete</th>
                               </tr>
                           </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <th>{{$record->amount}}</th>
                                        <th>{{$record->notes}}</th>
                                        <th>{{optional($record->restaurant)->name}}</th>
                                        <th>
                                            <a href="{{url(route('payments.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                        </th >
                                        <th>
                                            <button  data-token="{{ csrf_token() }}"
                                                     data-route="{{URL::route('payments.destroy',$record->id)}}"
                                                     type="button" class="destroy btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                            </button>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        No data
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
@endsection
