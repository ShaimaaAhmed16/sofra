@extends('admin.home')
@inject('model','App\Models\Order')
@section('page')
    orders
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of orders</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    {!! Form::open(['action'=>'OrderController@index','method'=>'get']) !!}
                    <input type="text" name="client_name" placeholder="client">
                    <input type="text" name="restaurant_name" placeholder="restaurant">
                    <button class="btn btn-primary " type="submit"><i class="fa fa-search"></i>search</button>
                    {!! Form::close() !!}

                </div>
                <div class="mt-3">
                    @include('flash::message')
                </div>
                @if(count($records))
                    <div class="table table-responsive">
                        <table class="table table-bordered text-center">
                           <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Address</th>
                                   <th>cost</th>
                                   <th>client</th>
                                   <th>restaurant</th>
                                   <th>Show</th>
                               </tr>
                           </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <th>{{$record->address}}</th>
                                        <th>{{$record->cost}}</th>
                                        <th>{{optional($record->client)->name}}</th>
                                        <th>{{optional($record->restaurant)->name}}</th>
                                        <th> <a href="{{url(route('order.show',$record->id))}}" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></a>
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
