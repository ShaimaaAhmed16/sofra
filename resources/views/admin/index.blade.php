@extends('admin.home')
@inject('client','App\Models\Client')
@inject('product','App\Models\Product')
@inject('order','App\Models\Order')
@inject('restaurant','App\Models\Restaurant')
@inject('category','App\Models\Category')
@inject('city ','App\Models\City ')
@inject('offer ','App\Models\Offer ')
@inject('notification ','App\Models\Notification')

@section('page')
    Dashboard
@endsection
@section('small_title')
    statistics
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">clients</span>
                        <span class="info-box-number">{{$client->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fab fa-product-hunt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">products</span>
                        <span class="info-box-number">{{$product->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"> <i class="fas fa-align-justify"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"></i>orders</span>
                        <span class="info-box-number">{{$order->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fas fa-utensils"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">restaurants</span>
                        <span class="info-box-number">{{$restaurant->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"> <i class="fas fa-align-justify"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">categories</span>
                        <span class="info-box-number">{{$category->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fas fa-city"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> cities</span>
                        <span class="info-box-number">{{$city->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-hand-holding-usd"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">offers</span>
                        <span class="info-box-number">{{$offer->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fas fa-bell"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">notifications</span>
                        <span class="info-box-number">{{$notification->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <!-- Default box -->
       <!-- <div class="card">
            <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                Start creating your amazing application!
            </div>
            <!-- /.card-body -->
           <!-- <div class="card-footer">
                Footer
            </div>-->
            <!-- /.card-footer-->

        <!-- /.card -->

    </section>
@endsection
