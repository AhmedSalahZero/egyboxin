@extends('layouts.admin')
@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb breadcrumb">
                <li>
                <a href="{{route('admin')}}">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Dashboard</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                    <i class="icon-calendar"></i>&nbsp;
                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                    <i class="fa fa-angle-down"></i>
                </div>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Shipping
            <small>Project</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->

        <div class="row">
            @foreach($dashboardInfo as $info=>$value)
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="@if($loop->iteration == 1 )
                    dashboard-stat dashboard-stat-v2 blue
                    @elseif($loop->iteration == 2)
                    dashboard-stat dashboard-stat-v2 red
                    @elseif($loop->iteration==3)
                    dashboard-stat dashboard-stat-v2 green
                    @else
                    dashboard-stat dashboard-stat-v2 purple
@endif " href="#">
                    <div class="visual">

                        <i class="fa
                        @if($loop->iteration == 1 )
                            fa-comments
                        @elseif($loop->iteration == 2)
                            fa-bar-chart-o
                        @elseif($loop->iteration==3)
                            fa-shopping-cart
                        @else
                            fa-globe
                            @endif
                        "></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <span data-counter="counterup" data-value="{{$value}}">

                        </span>
                        </div>
                        <div class="desc">{{ucfirst($info)}} <br>
                            @if($loop->iteration == 1 && (Auth()->user()->type == 'admin' || Auth()->user()->type == 'operator') && $count = (Auth()->user()->isAdmin() ?App\Models\Barcode::where('status','created')->get()->unique('seller_id')->count()  :App\Models\Barcode::where('status','created')->where('country_id',Auth()->user()->area_id)->get()->unique('seller_id')->count()))
                                From  {{$count}} Different
                                @if($count == 1)
                                Seller
                                @else
                                    Sellers
                                    @endif
                            @endif

                            @if($loop->iteration == 2 && (Auth()->user()->type == 'admin' || Auth()->user()->type == 'operator') && $count = Auth()->user()->CountDifferentCourierForOperator())
                                With  {{$count}} Different
                                @if($count == 1)
                                    Courier
                                @else
                                    Couriers
                                @endif
                            @endif

                        </div>
                    </div>
                </a>
            </div>
            @endforeach
{{--            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
{{--                <a class="dashboard-stat dashboard-stat-v2 red" href="#">--}}
{{--                    <div class="visual">--}}
{{--                        <i class="fa fa-bar-chart-o"></i>--}}
{{--                    </div>--}}
{{--                    <div class="details">--}}
{{--                        <div class="number">--}}
{{--                            <span data-counter="counterup" data-value="#">0</span></div>--}}
{{--                        <div class="desc">#</div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
{{--                <a class="dashboard-stat dashboard-stat-v2 green" href="#">--}}
{{--                    <div class="visual">--}}
{{--                        <i class="fa fa-shopping-cart"></i>--}}
{{--                    </div>--}}
{{--                    <div class="details">--}}
{{--                        <div class="number">--}}
{{--                            <span data-counter="counterup" data-value="#">0</span>--}}
{{--                        </div>--}}
{{--                        <div class="desc">#</div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">--}}
{{--                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">--}}
{{--                    <div class="visual">--}}
{{--                        <i class="fa fa-globe"></i>--}}
{{--                    </div>--}}
{{--                    <div class="details">--}}
{{--                        <div class="number">--}}
{{--                            <span data-counter="counterup" data-value="#">0</span></div>--}}
{{--                        <div class="desc">#</div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

@endsection
