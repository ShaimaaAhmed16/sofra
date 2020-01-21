@extends('admin.home')
@inject('model','App\Models\Restaurant')
@section('page')
    Restaurant
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of restaurant</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    {!! Form::open(['action'=>'RestauranrController@index','method'=>'get']) !!}
                    <input type="text" name="name" placeholder="name">
                    <input type="text" name="region_name" placeholder="region_name">
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
                                   <th>Name</th>
                                   <th>Phone</th>
                                   <th>Email</th>
                                   <th>Image</th>
                                   <th>state</th>
                                   <th>Region</th>
                                   <th>Show</th>
                                   <th>Active</th>
                                   <th>Delete</th>
                               </tr>
                           </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <th>{{$record->name}}</th>
                                        <th>{{$record->phone}}</th>
                                        <th>{{$record->email}}</th>
                                        <th>
                                            <img  style="height: 70px;width: 70px;" src="{{asset($record->image)}}" >
                                        </th>
                                        {{--{{$record->state}}--}}
                                        <th>
                                        @if($record->is_open==0)
                                                <button class="btn btn-danger btn-xs">off</button>
                                        @else
                                                <button class="btn btn-success btn-xs">on</button>
                                            @endif
                                        </th >
                                        <th>{{optional($record->region)->name}}</th>
                                        <th> <a href="{{url(route('restaurant.show',$record->id))}}" class="btn btn-primary btn-xs"><i class="fas fa-eye"></i></a>
                                        </th>
                                        <th>
                                            @if($record->is_active==0)
                                                <a href="client/{{$record->id}}/active" class="btn btn-danger btn-xs">deactive</a>
                                                @else
                                                <a href="client/{{$record->id}}/deactive" class="btn btn-success btn-xs">active</a>
                                                @endif
                                        </th >
                                        <th>
                                            {{--{!! Form::open(['action'=>['RestauranrController@destroy',$record->id],'method'=>'delete']) !!}--}}
                                            {{--<button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>--}}
                                            {{--{!! Form::close() !!}--}}
                                            <button  data-token="{{ csrf_token() }}"
                                                     data-route="{{URL::route('restaurant.destroy',$record->id)}}"
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
