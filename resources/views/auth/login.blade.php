

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
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
    <link href="{{url('backend/assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('backend/assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('backend/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{url('backend/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{url('backend/assets/pages/css/login-5.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<body class=" login">
<!-- BEGIN : LOGIN PAGE 5-1 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset">
            <div class="login-bg" style="background-image:url({{url('backend/assets/pages/img/login/bg1.jpg')}})">
                <img style="    width: 168px;height: 67px;" class="login-logo" src="{{url('backend/assets/pages/img/login/logo.png')}}" />
            </div>
        </div>
        <div class="col-md-6 login-container bs-reset">
            <div class="login-content">
                <h1> Login</h1>
                <form method="POST" class="login-form" action="{{ route('login') }}">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error) <li style="list-style: none; padding-left: 0px">{{ $error }}</li> @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group @error('email') is-invalid @enderror" type="email"  placeholder="Enter Your Email" name="email" value="{{ old('email') }}"  required/>
                        </div>
                        <div class="col-xs-5">
                            <input id="show_password_input_id" class="form-control form-control-solid placeholder-no-fix form-group @error('password') is-invalid @enderror" type="password" autocomplete="off" placeholder="Enter Your Password" name="password" required/>


                        </div>

                        <div class="col-xs-1 show_pass_icon_div">
                            <i id="show_pass_icon" class="fa fa-eye fa-lg flex_style"></i>


                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="rem-password">
                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> Remember me
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-8 text-right">
                            <button class="btn green" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{url('backend/assets/global/plugins/respond.min.js')}}"></script>
<script src="{{url('backend/assets/global/plugins/excanvas.min.js')}}"></script>
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
<script src="{{url('backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{url('backend/assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{url('backend/assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{url('backend/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{url('backend/assets/pages/scripts/login-5.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->

<script>
    const show_pass_icon = document.getElementById('show_pass_icon');
    show_pass_icon.addEventListener('click',function(){
        const pass_input = document.getElementById('show_password_input_id');
        pass_input.setAttribute('type',(pass_input.type==='password') ? 'text' : 'password');
    });

</script>
</body>
</html>
