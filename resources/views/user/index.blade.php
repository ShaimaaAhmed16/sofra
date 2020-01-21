@extends('admin.home')
@section('page')
    user
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of user</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <a href="{{url(route('user.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i>New user</a>

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
                                   <th>Email</th>
                                   <th>Edit</th>
                                   <th>Delete</th>
                               </tr>
                           </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <th>{{$record->name}}</th>
                                        <th>{{$record->email}}</th>
                                        <th>
                                            <a href="{{url(route('user.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                        </th >
                                        <th>
                                            {{--{!! Form::open(['action'=>['UserController@destroy',$record->id],'method'=>'delete']) !!}--}}
                                            {{--<button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>--}}
                                            {{--{!! Form::close() !!}--}}
                                            <button  data-token="{{ csrf_token() }}"
                                                     data-route="{{URL::route('user.destroy',$record->id)}}"
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
