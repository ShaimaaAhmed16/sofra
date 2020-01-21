@extends('admin.home')
@inject('model','App\Models\Offer')
@section('page')
    offer
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of offer</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    {!! Form::open(['action'=>'OfferController@index','method'=>'get']) !!}
                    <input type="text" name="name" placeholder="name">
                    <input type="text" name="restaurant_name" placeholder="restaurant Name">
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
                                <th>content</th>
                                <th>Image</th>
                                <th>restaurant</th>
                                <th>start date</th>
                                <th>end date</th>
                                <th>created at</th>
                                <th>updated at</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <th>{{$record->name}}</th>
                                    <th>{{$record->content}}</th>
                                   {{--<th>--}}
                                       {{--<a  class="example-image-link"  href="{{asset(optional($record)->image)}}" data-lightbox="example-set" >--}}
                                           {{--<img class="img-responsive" src="{{asset(optional($record)->image)}}" >--}}
                                        {{--</a>--}}
                                   {{--</th>--}}
                                    <th>
                                        {{--<img src="{{asset($record->image)}}" width="60" height="60">--}}
                                        <button class="btn" data-toggle="modal" data-target="#exampleModal"> <img src="{{asset($record->image)}}" width="60" height="60"></button>
                                        <!-- Modal -->
                                        <div class="modal " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><img src="{{asset('images/close.png')}}"/></span>
                                                </button>
                                                <img  style="height: 400px;width: 500px;" src="{{asset($record->image)}}" >
                                            </div>
                                        </div>
                                    </th>
                                    <th>{{($record->restaurant)->name}}</th>
                                    <th>{{$record->start_date}}</th>
                                    <th>{{$record->end_date}}</th>
                                    <th>{{$record->created_at}}</th>
                                    <th>{{$record->updated_at}}</th>
                                    <th>

                                        {{--<!-- Button trigger modal -->--}}
                                        {{--<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash"></i></button>--}}
                                        {{--<!-- Modal -->--}}
                                        {{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                                            {{--<div class="modal-dialog" role="document">--}}
                                                {{--<div class="modal-content">--}}
                                                    {{--<div class="modal-header">--}}
                                                        {{--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>--}}
                                                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                                            {{--<span aria-hidden="true">&times;</span>--}}
                                                        {{--</button>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="modal-body">--}}
                                                        {{--Are you sure you want to delete this offer?--}}
                                                    {{--</div>--}}
                                                    {{--<div class="modal-footer">--}}
                                                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                                    {{--</div>--}}
                                                    {{--{!! Form::open(['action'=>['OfferController@destroy',$record->id],'method'=>'delete']) !!}--}}
                                                    {{--<button class="btn btn-danger ">deleted</button>--}}
                                                    {{--{!! Form::close() !!}--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <button  data-token="{{ csrf_token() }}"
                                                 data-route="{{URL::route('offer.destroy',$record->id)}}"
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
