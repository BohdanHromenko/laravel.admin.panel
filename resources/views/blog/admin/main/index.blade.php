@extends('layouts.app_admin')

@section('content')
    <section class="content-header">
        @component('blog.admin.components.breadcrumbs')
            @slot('title') Control Panel @endslot
            @slot('parent') Home @endslot
            @slot('active') @endslot
        @endcomponent
    </section>


    {{--Main Content--}}
    <section class="content">
        {{--Small boxes (Stat box)--}}
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                {{--small box--}}
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h4>The number of orders: {{ $countOrders }}</h4>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('blog.admin.orders.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{--./col--}}
            <div class="col-lg-3 col-xs-6">
                {{--small box--}}
                <div class="small-box bg-green">
                    <div class="inner">
                        <h4>The number of products: {{ $countProducts }}</h4>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{--./col--}}
            <div class="col-lg-3 col-xs-6">
                {{--small box--}}
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h4>The number of Users: {{ $countUsers }}</h4>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('blog.admin.users.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{--./col--}}
            <div class="col-lg-3 col-xs-6">
                {{--small box--}}
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4>The numbers of Categories: {{ $countCategories }}</h4>
                        <p>Categories</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('blog.admin.categories.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            @include('blog.admin.main.include.orders')
            @include('blog.admin.main.include.recently')
        </div>

    </section>
@endsection
