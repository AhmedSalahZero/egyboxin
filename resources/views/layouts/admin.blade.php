<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>EGY Boxing Shipping</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{url('backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{url('backend/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{url('backend/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{url('backend/assets/layouts/layout4/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/layouts/layout4/css/themes/light.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{url('backend/assets/layouts/layout4/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{url('backend/assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('backend/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
{{--        <script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>--}}
        @yield('css')
        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <link href="{{url('backend/assets/global/css/components-rounded.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="https://printjs-4de6.kxcdn.com/print.min.css" rel="stylesheet">


        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <?php
    $currentUser = Auth()->user();
    ?>

        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{route('admin')}}">
                        <img style="
    height: 45px;
    width: 175px;
    position: relative;
    top: -15px;

" src="{{url('backend/assets/layouts/layout4/img/logo-light.png')}}" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="username username-hide-on-mobile">{{Auth::user()->name}}</span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <img alt="" class="img-circle" src="{{url('storage/'.Auth::user()->image)}}" /> </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="{{Route('my.profile')}}">
                                            <i class="icon-user"></i>
                                       MyProfile
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-envelope-square"></i>{{Auth::user()->email}}</a>
                                    </li>
                                    <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            <i class="icon-key"></i> Log Out </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
{{--                            <li class="dropdown dropdown-extended quick-sidebar-toggler">--}}
{{--                                <span class="sr-only">Toggle Quick Sidebar</span>--}}
{{--                                <i class="icon-logout"></i>--}}
{{--                            </li>--}}
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Shipping</h3>
                        </li>
                        @if(auth()->check() == true && auth()->user()->type == 'admin')
                        <!--done Languages-->
{{--                        <li class="nav-item  ">--}}
{{--                            <a href="javascript:;" class="nav-link nav-toggle">--}}
{{--                                <i class="fa fa-language"></i>--}}
{{--                                <span class="title">Languages</span>--}}
{{--                                <span class="arrow"></span>--}}
{{--                            </a>--}}
{{--                            <ul class="sub-menu">--}}
{{--                                <li class="nav-item  ">--}}
{{--                                    <a href="{{route('languages.index')}}" class="nav-link ">--}}
{{--                                        <span class="title"><i class="fa fa-eye"></i> View Languages</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item  ">--}}
{{--                                    <a href="{{route('languages.create')}}" class="nav-link ">--}}
{{--                                        <span class="title"><i class="fa fa-plus"></i> Add Languages</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                        <!--done Users-->
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-users"></i>
                                <span class="title">Users</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link ">
                                        <span class="title"><i class="fa fa-eye"></i> View Users</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{route('users.create')}}" class="nav-link ">
                                        <span class="title"><i class="fa fa-plus"></i> Add Users</span>
                                    </a>
                                </li>
                            </ul>
                        </li>







                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-flag" aria-hidden="true"></i>
                                <span class="title">Hubs</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                <a href="{{route('countries.index')}}" class="nav-link ">
                                        <span class="title"><i class="fa fa-eye"></i> View Hubs </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                <a href="{{route('countries.create')}}" class="nav-link ">
                                        <span class="title"><i class="fa fa-plus"></i> Add Hub</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if($currentUser->isAdmin() || $currentUser->isSeller())

                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                    <span class="title">Shipments</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item ">
                                        <a href="{{route('barcodes.create')}}" class="nav-link ">
                                            <span class="title"><i class="fa fa-plus"></i> Add Shipment</span>
                                        </a>
                                    </li>
                                    @if(Auth()->user()->isSeller() || Auth()->user()->isAdmin())
                                        @if(Auth()->user()->isSeller())
                                        <li class="nav-item">
                                            <a href="{{route('barcodes.view.pending')}}" class="nav-link ">
                                                <span class="title"><i class="fa fa-eye"></i> View Pending Shipments</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('barcodes.view.created')}}" class="nav-link ">
                                                <span class="title"><i class="fa fa-eye"></i> View Created Shipments</span>
                                            </a>
                                        </li>
                                        @endif
                                        <li class="nav-item">
                                            <a href="{{route('barcodes.view.progress')}}" class="nav-link ">
                                                <span class="title"><i class="fa fa-eye"></i>In Progress Shipments</span>
                                            </a>
                                        </li>

                                        <li class="nav-item ">
                                            <a href="{{route('seller.finished')}}" class="nav-link ">
                                                <span class="title"><i class="fa fa-check"></i> Finished </span>
                                            </a>
                                        </li>



                                        @endif
                                    <li class="nav-item">
                                        <a href="{{route('barcodes.all')}}" class="nav-link ">
                                            <span class="title"><i class="fa fa-eye"></i>View All Shipments</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>

{{--                        <!--Barcodes Items-->--}}
{{--                        <li class="nav-item  ">--}}
{{--                            <a href="{{route('barcodes.create')}}" class="nav-link ">--}}
{{--                                <i class="fa fa-flag" aria-hidden="true"></i>--}}
{{--                                <span class="title">Add Product</span>--}}

{{--                            </a>--}}

{{--                        </li>--}}







                        @endif
                    @if($currentUser->isAdmin()|| $currentUser->isOperator())
                            <li class="nav-item">
                                <a href="{{route('operator.new.orders')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-shopping-cart"></i> New Orders </span>
                                </a>
                            </li>

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('operator.received.order')}}" class="nav-link ">--}}
{{--                                    <span class="title"><i class="fa fa-eye"></i> Receive Orders </span>--}}
{{--                                </a>--}}
{{--                            </li>--}}

                            <li class="nav-item">
                                <a href="{{route('show.receive.orders')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-archive"></i> Receive Orders </span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('assign.to.courier')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-taxi"></i> Assign To Courier </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('return.to.seller')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-taxi"></i> Return To Seller </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('transfer.orders')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-bus"></i> Transfer </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('tracking.orders')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-bus"></i> Tracking Orders </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('tracking.by.tracking.number')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-bus"></i> Filter Orders </span>
                                </a>
                            </li>

                            {{--                        <li class="nav-item  ">--}}
{{--                            <a href="javascript:;" class="nav-link nav-toggle">--}}
{{--                                <i class="fa fa-flag" aria-hidden="true"></i>--}}
{{--                                <span class="title">Items</span>--}}
{{--                                <span class="arrow"></span>--}}
{{--                            </a>--}}
{{--                            <ul class="sub-menu">--}}
{{--                                <li class="nav-item">--}}
{{--                                <a href="{{route('items.index')}}" class="nav-link ">--}}
{{--                                        <span class="title"><i class="fa fa-eye"></i> View Items</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item ">--}}
{{--                                    <a href="{{route('items.create')}}" class="nav-link ">--}}
{{--                                            <span class="title"><i class="fa fa-plus"></i> Add Items</span>--}}
{{--                                        </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                        @endif
                        @if($currentUser->isAdmin()  || $currentUser->isAccountant() || $currentUser->isOperator())
                            <li class="nav-item">
                                <a href="{{route('courier.debrief')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-eye"></i> Courier Debrief </span>
                                </a>
                            </li>
                        @if($currentUser->isAdmin()  || $currentUser->isAccountant() )
                            <li class="nav-item">
                                <a href="{{route('seller.debrief')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-eye"></i>Seller Debrief</span>
                                </a>
                            </li>
                            @endif
                            @endif
                        @if($currentUser->isAdmin() ||$currentUser->isCourier())
                            @if($currentUser->isCourier())
                                <li class="nav-item">
                                    <a href="{{route('courier.show.deliver.item',$currentUser->id)}}" class="nav-link ">
                                        <span class="title"><i class="fa fa-taxi"></i> Deliver Items </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('courier.show.return.to.sellers.items',$currentUser->id)}}" class="nav-link ">
                                        <span class="title"><i class="fa fa-taxi"></i> Return To Seller </span>
                                    </a>
                                </li>

                            @else
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('courier.index')}}" class="nav-link ">--}}
{{--                                        <span class="title"><i class="fa fa-eye"></i> Couriers </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                                @endif

                            @endif

                        @if($currentUser->isCourier())
                            <li class="nav-item">
                                <a href="{{route('courier.show.unDebriefed',$currentUser->id)}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-taxi"></i> Debriefed </span>
                                </a>
                            </li>
                            @endif
                        @if($currentUser->isSeller())
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                    <span class="title">Debrief</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="{{route('seller.unfinished')}}" class="nav-link ">
                                            <span class="title"><i class="fa fa-clock-o"></i> In Progress </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('invoices')}}" class="nav-link ">
                                            <span class="title"><i class="fa fa-bus"></i> Invoices </span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif
                        @if($currentUser->isAdmin())

                            <li class="nav-item">
                                <a href="{{route('invoices')}}" class="nav-link ">
                                    <span class="title"><i class="fa fa-bus"></i> Invoices </span>
                                </a>
                            </li>

                            @endif

                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->

            <!-- BEGIN QUICK SIDEBAR -->
{{--            <a href="javascript:;" class="page-quick-sidebar-toggler">--}}
{{--                <i class="icon-login"></i>--}}
{{--            </a>--}}
{{--            <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">--}}
{{--                <div class="page-quick-sidebar">--}}
{{--                    <ul class="nav nav-tabs">--}}
{{--                        <li class="active">--}}
{{--                            <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Users--}}
{{--                                <span class="badge badge-danger">2</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:;" data-target="#quick_sidebar_tab_2" data-toggle="tab"> Alerts--}}
{{--                                <span class="badge badge-success">7</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="dropdown">--}}
{{--                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> More--}}
{{--                                <i class="fa fa-angle-down"></i>--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu pull-right">--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">--}}
{{--                                        <i class="icon-bell"></i> Alerts </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">--}}
{{--                                        <i class="icon-info"></i> Notifications </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">--}}
{{--                                        <i class="icon-speech"></i> Activities </a>--}}
{{--                                </li>--}}
{{--                                <li class="divider"></li>--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">--}}
{{--                                        <i class="icon-settings"></i> Settings </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <div class="tab-content">--}}
{{--                        <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">--}}
{{--                            <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">--}}
{{--                                <h3 class="list-heading">Staff</h3>--}}
{{--                                <ul class="media-list list-items">--}}
{{--                                    <li class="media">--}}
{{--                                        <div class="media-status">--}}
{{--                                            <span class="badge badge-success">8</span>--}}
{{--                                        </div>--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar3.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Bob Nilson</h4>--}}
{{--                                            <div class="media-heading-sub"> Project Manager </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="media">--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar1.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Nick Larson</h4>--}}
{{--                                            <div class="media-heading-sub"> Art Director </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="media">--}}
{{--                                        <div class="media-status">--}}
{{--                                            <span class="badge badge-danger">3</span>--}}
{{--                                        </div>--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar4.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Deon Hubert</h4>--}}
{{--                                            <div class="media-heading-sub"> CTO </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="media">--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar2.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Ella Wong</h4>--}}
{{--                                            <div class="media-heading-sub"> CEO </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <h3 class="list-heading">Customers</h3>--}}
{{--                                <ul class="media-list list-items">--}}
{{--                                    <li class="media">--}}
{{--                                        <div class="media-status">--}}
{{--                                            <span class="badge badge-warning">2</span>--}}
{{--                                        </div>--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar6.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Lara Kunis</h4>--}}
{{--                                            <div class="media-heading-sub"> CEO, Loop Inc </div>--}}
{{--                                            <div class="media-heading-small"> Last seen 03:10 AM </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="media">--}}
{{--                                        <div class="media-status">--}}
{{--                                            <span class="label label-sm label-success">new</span>--}}
{{--                                        </div>--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar7.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Ernie Kyllonen</h4>--}}
{{--                                            <div class="media-heading-sub"> Project Manager,--}}
{{--                                                <br> SmartBizz PTL </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="media">--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar8.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Lisa Stone</h4>--}}
{{--                                            <div class="media-heading-sub"> CTO, Keort Inc </div>--}}
{{--                                            <div class="media-heading-small"> Last seen 13:10 PM </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="media">--}}
{{--                                        <div class="media-status">--}}
{{--                                            <span class="badge badge-success">7</span>--}}
{{--                                        </div>--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar9.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Deon Portalatin</h4>--}}
{{--                                            <div class="media-heading-sub"> CFO, H&D LTD </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="media">--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar10.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Irina Savikova</h4>--}}
{{--                                            <div class="media-heading-sub"> CEO, Tizda Motors Inc </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="media">--}}
{{--                                        <div class="media-status">--}}
{{--                                            <span class="badge badge-danger">4</span>--}}
{{--                                        </div>--}}
{{--                                        <img class="media-object" src="{{url('backend/assets/layouts/layout/img/avatar11.jpg')}}" alt="...">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h4 class="media-heading">Maria Gomez</h4>--}}
{{--                                            <div class="media-heading-sub"> Manager, Infomatic Inc </div>--}}
{{--                                            <div class="media-heading-small"> Last seen 03:10 AM </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="page-quick-sidebar-item">--}}
{{--                                <div class="page-quick-sidebar-chat-user">--}}
{{--                                    <div class="page-quick-sidebar-nav">--}}
{{--                                        <a href="javascript:;" class="page-quick-sidebar-back-to-list">--}}
{{--                                            <i class="icon-arrow-left"></i>Back</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="page-quick-sidebar-chat-user-messages">--}}
{{--                                        <div class="post out">--}}
{{--                                            <img class="avatar" alt="" src="{{url('backend/assets/layouts/layout/img/avatar3.jpg')}}" />--}}
{{--                                            <div class="message">--}}
{{--                                                <span class="arrow"></span>--}}
{{--                                                <a href="javascript:;" class="name">Bob Nilson</a>--}}
{{--                                                <span class="datetime">20:15</span>--}}
{{--                                                <span class="body"> When could you send me the report ? </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="post in">--}}
{{--                                            <img class="avatar" alt="" src="{{url('backend/assets/layouts/layout/img/avatar2.jpg')}}" />--}}
{{--                                            <div class="message">--}}
{{--                                                <span class="arrow"></span>--}}
{{--                                                <a href="javascript:;" class="name">Ella Wong</a>--}}
{{--                                                <span class="datetime">20:15</span>--}}
{{--                                                <span class="body"> Its almost done. I will be sending it shortly </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="post out">--}}
{{--                                            <img class="avatar" alt="" src="{{url('backend/assets/layouts/layout/img/avatar3.jpg')}}" />--}}
{{--                                            <div class="message">--}}
{{--                                                <span class="arrow"></span>--}}
{{--                                                <a href="javascript:;" class="name">Bob Nilson</a>--}}
{{--                                                <span class="datetime">20:15</span>--}}
{{--                                                <span class="body"> Alright. Thanks! :) </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="post in">--}}
{{--                                            <img class="avatar" alt="" src="{{url('backend/assets/layouts/layout/img/avatar2.jpg')}}" />--}}
{{--                                            <div class="message">--}}
{{--                                                <span class="arrow"></span>--}}
{{--                                                <a href="javascript:;" class="name">Ella Wong</a>--}}
{{--                                                <span class="datetime">20:16</span>--}}
{{--                                                <span class="body"> You are most welcome. Sorry for the delay. </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="post out">--}}
{{--                                            <img class="avatar" alt="" src="{{url('backend/assets/layouts/layout/img/avatar3.jpg')}}" />--}}
{{--                                            <div class="message">--}}
{{--                                                <span class="arrow"></span>--}}
{{--                                                <a href="javascript:;" class="name">Bob Nilson</a>--}}
{{--                                                <span class="datetime">20:17</span>--}}
{{--                                                <span class="body"> No probs. Just take your time :) </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="post in">--}}
{{--                                            <img class="avatar" alt="" src="{{url('backend/assets/layouts/layout/img/avatar2.jpg')}}" />--}}
{{--                                            <div class="message">--}}
{{--                                                <span class="arrow"></span>--}}
{{--                                                <a href="javascript:;" class="name">Ella Wong</a>--}}
{{--                                                <span class="datetime">20:40</span>--}}
{{--                                                <span class="body"> Alright. I just emailed it to you. </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="post out">--}}
{{--                                            <img class="avatar" alt="" src="{{url('backend/assets/layouts/layout/img/avatar3.jpg')}}" />--}}
{{--                                            <div class="message">--}}
{{--                                                <span class="arrow"></span>--}}
{{--                                                <a href="javascript:;" class="name">Bob Nilson</a>--}}
{{--                                                <span class="datetime">20:17</span>--}}
{{--                                                <span class="body"> Great! Thanks. Will check it right away. </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="post in">--}}
{{--                                            <img class="avatar" alt="" src="{{url('backend/assets/layouts/layout/img/avatar2.jpg')}}" />--}}
{{--                                            <div class="message">--}}
{{--                                                <span class="arrow"></span>--}}
{{--                                                <a href="javascript:;" class="name">Ella Wong</a>--}}
{{--                                                <span class="datetime">20:40</span>--}}
{{--                                                <span class="body"> Please let me know if you have any comment. </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="post out">--}}
{{--                                            <img class="avatar" alt="" src="{{url('backend/assets/layouts/layout/img/avatar3.jpg')}}" />--}}
{{--                                            <div class="message">--}}
{{--                                                <span class="arrow"></span>--}}
{{--                                                <a href="javascript:;" class="name">Bob Nilson</a>--}}
{{--                                                <span class="datetime">20:17</span>--}}
{{--                                                <span class="body"> Sure. I will check and buzz you if anything needs to be corrected. </span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="page-quick-sidebar-chat-user-form">--}}
{{--                                        <div class="input-group">--}}
{{--                                            <input type="text" class="form-control" placeholder="Type a message here...">--}}
{{--                                            <div class="input-group-btn">--}}
{{--                                                <button type="button" class="btn green">--}}
{{--                                                    <i class="icon-paper-clip"></i>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">--}}
{{--                            <div class="page-quick-sidebar-alerts-list">--}}
{{--                                <h3 class="list-heading">General</h3>--}}
{{--                                <ul class="feeds list-items">--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-info">--}}
{{--                                                        <i class="fa fa-check"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> You have 4 pending tasks.--}}
{{--                                                        <span class="label label-sm label-warning "> Take action--}}
{{--                                                            <i class="fa fa-share"></i>--}}
{{--                                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> Just now </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="javascript:;">--}}
{{--                                            <div class="col1">--}}
{{--                                                <div class="cont">--}}
{{--                                                    <div class="cont-col1">--}}
{{--                                                        <div class="label label-sm label-success">--}}
{{--                                                            <i class="fa fa-bar-chart-o"></i>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="cont-col2">--}}
{{--                                                        <div class="desc"> Finance Report for year 2013 has been released. </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col2">--}}
{{--                                                <div class="date"> 20 mins </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-danger">--}}
{{--                                                        <i class="fa fa-user"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> You have 5 pending membership that requires a quick review. </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> 24 mins </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-info">--}}
{{--                                                        <i class="fa fa-shopping-cart"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> New order received with--}}
{{--                                                        <span class="label label-sm label-success"> Reference Number: DR23923 </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> 30 mins </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-success">--}}
{{--                                                        <i class="fa fa-user"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> You have 5 pending membership that requires a quick review. </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> 24 mins </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-info">--}}
{{--                                                        <i class="fa fa-bell-o"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> Web server hardware needs to be upgraded.--}}
{{--                                                        <span class="label label-sm label-warning"> Overdue </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> 2 hours </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="javascript:;">--}}
{{--                                            <div class="col1">--}}
{{--                                                <div class="cont">--}}
{{--                                                    <div class="cont-col1">--}}
{{--                                                        <div class="label label-sm label-default">--}}
{{--                                                            <i class="fa fa-briefcase"></i>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="cont-col2">--}}
{{--                                                        <div class="desc"> IPO Report for year 2013 has been released. </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col2">--}}
{{--                                                <div class="date"> 20 mins </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <h3 class="list-heading">System</h3>--}}
{{--                                <ul class="feeds list-items">--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-info">--}}
{{--                                                        <i class="fa fa-check"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> You have 4 pending tasks.--}}
{{--                                                        <span class="label label-sm label-warning "> Take action--}}
{{--                                                            <i class="fa fa-share"></i>--}}
{{--                                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> Just now </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="javascript:;">--}}
{{--                                            <div class="col1">--}}
{{--                                                <div class="cont">--}}
{{--                                                    <div class="cont-col1">--}}
{{--                                                        <div class="label label-sm label-danger">--}}
{{--                                                            <i class="fa fa-bar-chart-o"></i>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="cont-col2">--}}
{{--                                                        <div class="desc"> Finance Report for year 2013 has been released. </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col2">--}}
{{--                                                <div class="date"> 20 mins </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-default">--}}
{{--                                                        <i class="fa fa-user"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> You have 5 pending membership that requires a quick review. </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> 24 mins </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-info">--}}
{{--                                                        <i class="fa fa-shopping-cart"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> New order received with--}}
{{--                                                        <span class="label label-sm label-success"> Reference Number: DR23923 </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> 30 mins </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-success">--}}
{{--                                                        <i class="fa fa-user"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> You have 5 pending membership that requires a quick review. </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> 24 mins </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="col1">--}}
{{--                                            <div class="cont">--}}
{{--                                                <div class="cont-col1">--}}
{{--                                                    <div class="label label-sm label-warning">--}}
{{--                                                        <i class="fa fa-bell-o"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="cont-col2">--}}
{{--                                                    <div class="desc"> Web server hardware needs to be upgraded.--}}
{{--                                                        <span class="label label-sm label-default "> Overdue </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col2">--}}
{{--                                            <div class="date"> 2 hours </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="javascript:;">--}}
{{--                                            <div class="col1">--}}
{{--                                                <div class="cont">--}}
{{--                                                    <div class="cont-col1">--}}
{{--                                                        <div class="label label-sm label-info">--}}
{{--                                                            <i class="fa fa-briefcase"></i>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="cont-col2">--}}
{{--                                                        <div class="desc"> IPO Report for year 2013 has been released. </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col2">--}}
{{--                                                <div class="date"> 20 mins </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">--}}
{{--                            <div class="page-quick-sidebar-settings-list">--}}
{{--                                <h3 class="list-heading">General Settings</h3>--}}
{{--                                <ul class="list-items borderless">--}}
{{--                                    <li> Enable Notifications--}}
{{--                                        <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>--}}
{{--                                    <li> Allow Tracking--}}
{{--                                        <input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>--}}
{{--                                    <li> Log Errors--}}
{{--                                        <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>--}}
{{--                                    <li> Auto Sumbit Issues--}}
{{--                                        <input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>--}}
{{--                                    <li> Enable SMS Alerts--}}
{{--                                        <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>--}}
{{--                                </ul>--}}
{{--                                <h3 class="list-heading">System Settings</h3>--}}
{{--                                <ul class="list-items borderless">--}}
{{--                                    <li> Security Level--}}
{{--                                        <select class="form-control input-inline input-sm input-small">--}}
{{--                                            <option value="1">Normal</option>--}}
{{--                                            <option value="2" selected>Medium</option>--}}
{{--                                            <option value="e">High</option>--}}
{{--                                        </select>--}}
{{--                                    </li>--}}
{{--                                    <li> Failed Email Attempts--}}
{{--                                        <input class="form-control input-inline input-sm input-small" value="5" /> </li>--}}
{{--                                    <li> Secondary SMTP Port--}}
{{--                                        <input class="form-control input-inline input-sm input-small" value="3560" /> </li>--}}
{{--                                    <li> Notify On System Error--}}
{{--                                        <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>--}}
{{--                                    <li> Notify On SMTP Error--}}
{{--                                        <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF"> </li>--}}
{{--                                </ul>--}}
{{--                                <div class="inner-content">--}}
{{--                                    <button class="btn btn-success">--}}
{{--                                        <i class="icon-settings"></i> Save Changes</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- END QUICK SIDEBAR -->


            @yield('content')
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2021 @ The Tailors Dev
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
            <!-- BEGIN CORE PLUGINS -->
            <script src="{{url('backend/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="{{url('backend/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="{{url('backend/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="{{url('backend/assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="{{url('backend/assets/layouts/layout4/scripts/layout.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/layouts/layout4/scripts/demo.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
            <!-- END THEME LAYOUT SCRIPTS -->

                <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="{{url('backend/assets/pages/scripts/table-datatables-fixedheader.min.js')}}" type="text/javascript"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="{{url('backend/assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
            <script src="{{url('backend/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->

            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
            <script>
            $(document).ready(function() {
                $('#content').summernote();
            });
            </script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    @include('layouts.toaster');

        @yield('js')
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>
