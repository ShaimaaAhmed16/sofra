@extends('admin.home')
@section('page')
    contact
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of contacts</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    {!! Form::open(['action'=>'ContactController@index','method'=>'get']) !!}
                    <input type="text" name="name" placeholder="name">
                    <input type="text" name="type" placeholder="type">
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
                                <th>Email</th>
                                <th>phone</th>
                                <th>Message</th>
                                <th>Type</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <th>{{$record->name}}</th>
                                    <th>{{$record->email}}</th>
                                    <th>{{$record->phone}}</th>
                                    <th>{{$record->message}}</th>
                                    <th>{{$record->type}}</th>
                                    <th>
                                        <button  data-token="{{ csrf_token() }}"
                                                 data-route="{{URL::route('contact.destroy',$record->id)}}"
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
