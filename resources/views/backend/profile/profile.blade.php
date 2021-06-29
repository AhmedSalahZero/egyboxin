@extends('layouts.admin')

@section('css')
    <link href="{{asset('backend/assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    @include('layouts.toaster')

    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="min-height:1236px">


            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet bordered">
                            <!-- SIDEBAR USERPIC -->
{{--                            <div class="profile-userpic">--}}
{{--                                <img src="{{asset('storage/'.$currentUser->image)}}" class="img-responsive" alt=""> --}}
{{--                            </div>--}}
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> {{$currentUser->name}} </div>
                                <div class="profile-usertitle-job"> {{$currentUser->type}}  </div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
{{--                            <div class="profile-userbuttons">--}}
{{--                                <button type="button" class="btn btn-circle green btn-sm">Follow</button>--}}
{{--                                <button type="button" class="btn btn-circle red btn-sm">Message</button>--}}
{{--                            </div>--}}
                            <!-- END SIDEBAR BUTTONS -->
                            <!-- SIDEBAR MENU -->
{{--                            <div class="profile-usermenu">--}}
{{--                                <ul class="nav">--}}
{{--                                    <li>--}}
{{--                                        <a href="page_user_profile_1.html">--}}
{{--                                            <i class="icon-home"></i> Overview </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="active">--}}
{{--                                        <a href="page_user_profile_1_account.html">--}}
{{--                                            <i class="icon-settings"></i> Account Settings </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="page_user_profile_1_help.html">--}}
{{--                                            <i class="icon-info"></i> Help </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                        <!-- PORTLET MAIN -->
{{--                        <div class="portlet light bordered">--}}
{{--                            <!-- STAT -->--}}
{{--                            <div class="row list-separated profile-stat">--}}
{{--                                <div class="col-md-4 col-sm-4 col-xs-6">--}}
{{--                                    <div class="uppercase profile-stat-title"> 37 </div>--}}
{{--                                    <div class="uppercase profile-stat-text"> Projects </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4 col-sm-4 col-xs-6">--}}
{{--                                    <div class="uppercase profile-stat-title"> 51 </div>--}}
{{--                                    <div class="uppercase profile-stat-text"> Tasks </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4 col-sm-4 col-xs-6">--}}
{{--                                    <div class="uppercase profile-stat-title"> 61 </div>--}}
{{--                                    <div class="uppercase profile-stat-text"> Uploads </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- END STAT -->--}}
{{--                            <div>--}}
{{--                                <h4 class="profile-desc-title">About Marcus Doe</h4>--}}
{{--                                <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>--}}
{{--                                <div class="margin-top-20 profile-desc-link">--}}
{{--                                    <i class="fa fa-globe"></i>--}}
{{--                                    <a href="http://www.keenthemes.com">www.keenthemes.com</a>--}}
{{--                                </div>--}}
{{--                                <div class="margin-top-20 profile-desc-link">--}}
{{--                                    <i class="fa fa-twitter"></i>--}}
{{--                                    <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>--}}
{{--                                </div>--}}
{{--                                <div class="margin-top-20 profile-desc-link">--}}
{{--                                    <i class="fa fa-facebook"></i>--}}
{{--                                    <a href="http://www.facebook.com/keenthemes/">keenthemes</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- END PORTLET MAIN -->
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                            </li>
{{--                                            <li>--}}
{{--                                                <a href="#tab_1_2" data-toggle="tab">Change Profile Image</a>--}}
{{--                                            </li>--}}
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                            </li>
{{--                                            <li>--}}
{{--                                                <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>--}}
{{--                                            </li>--}}
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                <form role="form" action="{{Route('save.account.info')}}" method="post" >
                                                    @csrf

                                                    <div class="form-group">
                                                        <label class="control-label">Name</label>
                                                        <input type="text" placeholder="John" class="form-control" value="{{$currentUser->name}}" readonly>
                                                    </div>
{{--                                                    <div class="form-group">--}}
{{--                                                        <label class="control-label">Last Name</label>--}}
{{--                                                        <input type="text" placeholder="Doe" class="form-control"> </div>--}}
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" class="form-control" value="{{$currentUser->email}}" readonly> </div>
{{--                                                    <div class="form-group">--}}
{{--                                                        <label class="control-label">Position</label>--}}
{{--                                                        <input type="text" placeholder="Design, Web etc." class="form-control" > </div>--}}
                                                    <div class="form-group">
                                                        <label class="control-label">Occupation</label>
                                                        <input type="text" placeholder="Web Developer" class="form-control" value="{{$currentUser->type}}" readonly>
                                                    </div>
                                                   @can('update',Request()->user())
                                                        <div class="form-group">
                                                            <label class="control-label">Identification Number</label>
                                                            <input name="id_number" type="number" placeholder="Please Enter Your Identification Number" class="form-control" value="{{($currentUser->id_number) }}" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Bank Account </label>
                                                            <input  type="number" name="bank_account"  placeholder="Please Enter Your Bank Account " class="form-control" value="{{$currentUser->bank_account}}" >
                                                        </div>
                                                        <div style="width: 50%;margin: auto" class="text-center">
                                                            <button type="submit" class="btn btn-success btn-small" style="display: inline-block;">
                                                                Save
                                                            </button>
                                                        </div>
                                                    @endcan


{{--                                                    <div class="form-group">--}}
{{--                                                        <label class="control-label">About</label>--}}
{{--                                                        <textarea class="form-control" rows="3" placeholder="We are KeenThemes!!!"></textarea>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label class="control-label">Website Url</label>--}}
{{--                                                        <input type="text" placeholder="http://www.mywebsite.com" class="form-control"> </div>--}}
{{--                                                    <div class="margiv-top-10">--}}
{{--                                                        <a href="javascript:;" class="btn green"> Save Changes </a>--}}
{{--                                                        <a href="javascript:;" class="btn default"> Cancel </a>--}}
{{--                                                    </div>--}}
                                                </form>
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->
{{--                                            <div class="tab-pane" id="tab_1_2">--}}
{{--                                                --}}{{--                                        <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum--}}
{{--                                                --}}{{--                                            eiusmod. </p>--}}
{{--                                                <form action="{{Route('user.account.change.image')}}" role="form" method="post" enctype="multipart/form-data">--}}
{{--                                                    @csrf--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <div class="fileinput fileinput-new" data-provides="fileinput">--}}
{{--                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">--}}
{{--                                                                <img id="blah" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""--}}
{{--                                                                     style="width: 186px; height: 140px;"--}}


{{--                                                                >--}}
{{--                                                            </div>--}}

{{--                                                            <div>--}}
{{--                                                                        <span class="btn default btn-file">--}}
{{--                                                                            <input id="image" type="file" name="image">--}}

{{--                                                                        </span>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        --}}{{--                                                <div class="clearfix margin-top-10">--}}
{{--                                                        --}}{{--                                                    <span class="label label-danger">NOTE! </span>--}}
{{--                                                        --}}{{--                                                    <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>--}}
{{--                                                        --}}{{--                                                </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="margin-top-10">--}}
{{--                                                        <input type="submit" class="btn green" value="Submit">--}}
{{--                                                        <a href="javascript:;" class="btn default">Cancel</a>--}}
{{--                                                    </div>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}

                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <form action="{{Route('user.account.change.password')}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="control-label">Current Password </label>
                                                        <input type="password" class="form-control" name="old_password"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">New Password </label>
                                                        <input type="password" class="form-control" name="new_password"> </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Confirm New Password </label>
                                                        <input type="password" class="form-control" name="confirm_new_password"> </div>
                                                    <div class="margin-top-10">
                                                        <input type="submit" class="btn green" value="Save">
                                                        <input type="reset" class="btn default" value="Clear">
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->
                                            <!-- PRIVACY SETTINGS TAB -->
{{--                                            <div class="tab-pane" id="tab_1_4">--}}
{{--                                                <form action="#">--}}
{{--                                                    <table class="table table-light table-hover">--}}
{{--                                                        <tbody><tr>--}}
{{--                                                            <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>--}}
{{--                                                            <td>--}}
{{--                                                                <div class="mt-radio-inline">--}}
{{--                                                                    <label class="mt-radio">--}}
{{--                                                                        <input type="radio" name="optionsRadios1" value="option1"> Yes--}}
{{--                                                                        <span></span>--}}
{{--                                                                    </label>--}}
{{--                                                                    <label class="mt-radio">--}}
{{--                                                                        <input type="radio" name="optionsRadios1" value="option2" checked=""> No--}}
{{--                                                                        <span></span>--}}
{{--                                                                    </label>--}}
{{--                                                                </div>--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>--}}
{{--                                                            <td>--}}
{{--                                                                <div class="mt-radio-inline">--}}
{{--                                                                    <label class="mt-radio">--}}
{{--                                                                        <input type="radio" name="optionsRadios11" value="option1"> Yes--}}
{{--                                                                        <span></span>--}}
{{--                                                                    </label>--}}
{{--                                                                    <label class="mt-radio">--}}
{{--                                                                        <input type="radio" name="optionsRadios11" value="option2" checked=""> No--}}
{{--                                                                        <span></span>--}}
{{--                                                                    </label>--}}
{{--                                                                </div>--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>--}}
{{--                                                            <td>--}}
{{--                                                                <div class="mt-radio-inline">--}}
{{--                                                                    <label class="mt-radio">--}}
{{--                                                                        <input type="radio" name="optionsRadios21" value="option1"> Yes--}}
{{--                                                                        <span></span>--}}
{{--                                                                    </label>--}}
{{--                                                                    <label class="mt-radio">--}}
{{--                                                                        <input type="radio" name="optionsRadios21" value="option2" checked=""> No--}}
{{--                                                                        <span></span>--}}
{{--                                                                    </label>--}}
{{--                                                                </div>--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                        <tr>--}}
{{--                                                            <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>--}}
{{--                                                            <td>--}}
{{--                                                                <div class="mt-radio-inline">--}}
{{--                                                                    <label class="mt-radio">--}}
{{--                                                                        <input type="radio" name="optionsRadios31" value="option1"> Yes--}}
{{--                                                                        <span></span>--}}
{{--                                                                    </label>--}}
{{--                                                                    <label class="mt-radio">--}}
{{--                                                                        <input type="radio" name="optionsRadios31" value="option2" checked=""> No--}}
{{--                                                                        <span></span>--}}
{{--                                                                    </label>--}}
{{--                                                                </div>--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                        </tbody></table>--}}
{{--                                                    <!--end profile-settings-->--}}
{{--                                                    <div class="margin-top-10">--}}
{{--                                                        <a href="javascript:;" class="btn red"> Save Changes </a>--}}
{{--                                                        <a href="javascript:;" class="btn default"> Cancel </a>--}}
{{--                                                    </div>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
                                            <!-- END PRIVACY SETTINGS TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>


{{--    <div class="page-content-wrapper">--}}
{{--        <!-- BEGIN CONTENT BODY -->--}}
{{--        <div class="page-content">--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <!-- BEGIN PROFILE SIDEBAR -->--}}
{{--            <div class="profile-sidebar">--}}
{{--                <!-- PORTLET MAIN -->--}}
{{--                <div class="portlet light profile-sidebar-portlet ">--}}
{{--                    <!-- SIDEBAR USERPIC -->--}}
{{--                    <div class="profile-userpic">--}}

{{--                        <img src="{{asset('storage/'.$currentUser->image)}}" class="img-responsive hoverZoomLink" alt="" style="width: 250px;height: 250px"> </div>--}}

{{--                    <!-- END SIDEBAR USERPIC -->--}}
{{--                    <!-- SIDEBAR USER TITLE -->--}}
{{--                    <div class="profile-usertitle">--}}
{{--                        <div class="profile-usertitle-name"> {{$currentUser->name }}</div>--}}
{{--                        <div class="profile-usertitle-job"> {{$currentUser->type}} </div>--}}



{{--                    </div>--}}
{{--                    <!-- END SIDEBAR USER TITLE -->--}}
{{--                    <!-- SIDEBAR BUTTONS -->--}}

{{--                    <!-- END SIDEBAR BUTTONS -->--}}
{{--                    <!-- SIDEBAR MENU -->--}}

{{--                    <!-- END MENU -->--}}
{{--                </div>--}}
{{--                <!-- END PORTLET MAIN -->--}}
{{--                <!-- PORTLET MAIN -->--}}

{{--                <!-- END PORTLET MAIN -->--}}
{{--            </div>--}}
{{--            <!-- END BEGIN PROFILE SIDEBAR -->--}}
{{--            <!-- BEGIN PROFILE CONTENT -->--}}
{{--            <div class="profile-content">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="portlet light ">--}}
{{--                            <div class="portlet-title tabbable-line">--}}
{{--                                <div class="caption caption-md">--}}
{{--                                    <i class="icon-globe theme-font hide"></i>--}}
{{--                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Info </span>--}}
{{--                                </div>--}}
{{--                                <ul class="nav nav-tabs">--}}
{{--                                    <li class="active">--}}
{{--                                        <a href="#tab_1_1" data-toggle="tab">Person Info</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="#tab_1_2" data-toggle="tab">Profile Image </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="portlet-body">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <!-- PERSONAL INFO TAB -->--}}
{{--                                    <div class="tab-pane active" id="tab_1_1">--}}
{{--                                        <form role="form"  method="post">--}}
{{--                                            @csrf--}}

{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label">Name</label>--}}
{{--                                                <input type="text" placeholder="Your Name " class="form-control" name="name" value="{{Auth()->user()->name}}" required readonly>--}}
{{--                                            </div>--}}

{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label">Email</label>--}}
{{--                                                <input type="email" placeholder="@lang('lang.your_email')" class="form-control" name="email" value="{{Auth()->user()->email}}" required readonly> </div>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label">Type</label>--}}
{{--                                                <input type="text" placeholder="@lang('lang.your_address')" class="form-control" name="address" value="{{Auth()->user()->type}}" required readonly> </div>--}}

{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label">@lang('lang.Mobile Number')</label>--}}
{{--                                                <input type="number" placeholder="@lang('lang.Your Mobile Number')" class="form-control" name="phone" value="{{Auth()->user()->phone}}" required readonly>--}}
{{--                                            </div>--}}



{{--                                                                                        <div class="form-group">--}}
{{--                                                                                            <label class="control-label">About</label>--}}
{{--                                                                                            <textarea class="form-control" rows="3" placeholder="We are KeenThemes!!!"></textarea>--}}
{{--                                                                                        </div>--}}
{{--                                                                                        <div class="form-group">--}}
{{--                                                                                            <label class="control-label">Website Url</label>--}}
{{--                                                                                            <input type="text" placeholder="http://www.mywebsite.com" class="form-control"> </div>--}}

{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                    <!-- END PERSONAL INFO TAB -->--}}
{{--                                    <!-- CHANGE AVATAR TAB -->--}}
{{--                                    <div class="tab-pane" id="tab_1_2">--}}
{{--                                                                                <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum--}}
{{--                                                                                    eiusmod. </p>--}}
{{--                                        <form action="{{Route('user.account.change.image',App()->getLocale())}}" role="form" method="post" enctype="multipart/form-data">--}}
{{--                                            @csrf--}}
{{--                                            <div class="form-group">--}}
{{--                                                <div class="fileinput fileinput-new" data-provides="fileinput">--}}
{{--                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">--}}
{{--                                                        <img id="blah" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""--}}
{{--                                                             style="width: 186px; height: 140px;"--}}


{{--                                                        >--}}
{{--                                                    </div>--}}
{{--                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>--}}
{{--                                                    <div>--}}
{{--                                                                        <span class="btn default btn-file">--}}
{{--                                                                            <span class="fileinput-new"> @lang('lang.Select image') </span>--}}
{{--                                                                            <span class="fileinput-exists"> @lang('lang.Change') </span>--}}
{{--                                                                            <input id="image" type="file" name="image">--}}

{{--                                                                        </span>--}}
{{--                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> @lang('lang.remove') </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                                                                <div class="clearfix margin-top-10">--}}
{{--                                                                                                    <span class="label label-danger">NOTE! </span>--}}
{{--                                                                                                    <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>--}}
{{--                                                                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="margin-top-10">--}}
{{--                                                <input type="submit" class="btn green" value="@lang('lang.Submit')">--}}
{{--                                                <a href="javascript:;" class="btn default"> @lang('lang.Cancel') </a>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                    <!-- END CHANGE AVATAR TAB -->--}}
{{--                                    <!-- CHANGE PASSWORD TAB -->--}}
{{--                                    <div class="tab-pane" id="tab_1_3">--}}
{{--                                        <form action="{{Route('user.account.change.password')}}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label">Current Password </label>--}}
{{--                                                <input type="password" class="form-control" name="old_password"> </div>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label">New Password</label>--}}
{{--                                                <input type="password" class="form-control" name="new_password"> </div>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label">Confirm New Password</label>--}}
{{--                                                <input type="password" class="form-control" name="confirm_new_password"> </div>--}}
{{--                                            <div class="margin-top-10">--}}
{{--                                                <input type="submit" class="btn green" value="@lang('lang.Change Password')">--}}
{{--                                                <input type="reset" class="btn default" value="@lang('lang.clear')">--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                    <!-- END CHANGE PASSWORD TAB -->--}}
{{--                                    <!-- PRIVACY SETTINGS TAB -->--}}

{{--                                    <!-- END PRIVACY SETTINGS TAB -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- END PROFILE CONTENT -->--}}
{{--        </div>--}}
{{--    </div>--}}

{{--        </div>--}}
{{--    </div>--}}

@endsection

@section('js')

    <script src="{{asset('backend/assets/pages/scripts/profile.min.js')}}" type="text/javascript"></script>


    {{--    <script>--}}
    {{--        $(document).on('click', '#sub_create_account_btn', function (e) {--}}
    {{--            e.preventDefault();--}}


    {{--            let lang = "{{App()->getLocale()}}"--}}
    {{--            $.ajax({--}}


    {{--                type: 'POST',--}}
    {{--                url: `/admin/categories`,--}}
    {{--                data: {--}}
    {{--                    '_token':"{{csrf_token()}}",--}}
    {{--                    'title_en':$("#title_en").val(),--}}
    {{--                    'title_ar':$("#title_ar").val(),--}}
    {{--                    'icon_url':$("#icon_url").val(),--}}
    {{--                    'description_en':CKEDITOR.instances.description_en.getData(),--}}
    {{--                    'description_ar':CKEDITOR.instances.description_ar.getData(),--}}
    {{--                    'sub_of':$('#sub_of').val()--}}
    {{--                },--}}
    {{--                success: function (data) {--}}
    {{--                    if(data.status===true)--}}
    {{--                    {--}}
    {{--                        $('.insert_success').show();--}}
    {{--                        if(data.appear ==true)--}}
    {{--                        {--}}


    {{--                            $('.categories_options').append(`<option value="${data.account_id}">${data.account_title_en}</option>`)--}}
    {{--                        }--}}

    {{--                        setTimeout(function(){--}}
    {{--                            $('.insert_success').hide();--}}
    {{--                        },2000)--}}
    {{--                    }--}}
    {{--                    else{--}}
    {{--                        $('.alert-danger').show();--}}
    {{--                        $('#fail_message_id').append(`${data.message}`).css('display','block');--}}
    {{--                        setTimeout(function(){--}}
    {{--                            $('.alert-danger').hide();--}}
    {{--                            $('#fail_message_id').hide().empty();--}}
    {{--                        },2500)--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}


    {{--    </script>--}}
    <script>
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                console.log('entered');
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function(){

            readURL(this);
        });


    </script>



    <script src="{{asset('backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>

    <script>
        $('#sub_of').on('change',function(){
            $('#icon_url_div').show();
            if ($(this).val() !== 'none')
            {
                $('#icon_url_div').hide();
            }

        })
    </script>
    {{--    <script>--}}
    {{--        $(document).on('click', '#sub_edit_account_btn', function (e) {--}}
    {{--            e.preventDefault();--}}
    {{--            let lang = "{{App()->getLocale()}}";--}}
    {{--            let id = $(e.target).attr('account_id');--}}
    {{--            $.ajax({--}}
    {{--                type: 'put',--}}
    {{--                url: `/admin/categories/${id}`,--}}
    {{--                data: {--}}
    {{--                    '_token':"{{csrf_token()}}",--}}
    {{--                    'title_en':$("#title_en").val(),--}}
    {{--                    'title_ar':$("#title_ar").val(),--}}
    {{--                    'icon_url':$("#icon_url").val(),--}}
    {{--                    'description_en':CKEDITOR.instances.description_en.getData(),--}}
    {{--                    'description_ar':CKEDITOR.instances.description_ar.getData(),--}}
    {{--                    'sub_of':$('#sub_of').val()--}}
    {{--                },--}}
    {{--                success: function (data) {--}}
    {{--                    if(data.status===true)--}}
    {{--                    {--}}
    {{--                        $('.updated_success').show();--}}

    {{--                        setTimeout(function(){--}}
    {{--                            $('.updated_success').hide();--}}
    {{--                        },2000)--}}
    {{--                    }--}}
    {{--                    else{--}}
    {{--                        $('.alert-danger').show();--}}
    {{--                        $('#fail_message_id').append(`${data.message}`).css('display','block');--}}
    {{--                        setTimeout(function(){--}}
    {{--                            $('.alert-danger').hide();--}}
    {{--                            $('#fail_message_id').hide().empty();--}}
    {{--                        },2500)--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}


    {{--    </script>--}}
    {{--    <script src="{{url('ckeditor/ckeditor.js')}}" type="text/javascript"></script>--}}
    {{--    <script>--}}

    {{--        CKEDITOR.replace( 'description_en', {--}}
    {{--            height: 300,--}}
    {{--            filebrowserUploadUrl: "{{Route('upload.image',App()->getLocale())}}"--}}
    {{--        });--}}
    {{--        CKEDITOR.replace( 'description_ar', {--}}
    {{--            height: 300,--}}
    {{--            filebrowserUploadUrl: "{{Route('upload.image',App()->getLocale())}}",--}}
    {{--            filebrowserUploadMethod: 'form'--}}
    {{--        });--}}
    {{--    </script>--}}

@endsection

