<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{trans('admin.login')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public/adminlte/plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">


<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Info</b>SAS</a>
    </div>

@include('admin.layouts.message')

    <!-- /.login-logo -->
    <div class="login-box-body">
        {!! Form::open(['method'=>'post','action'=>'Admin\AdminAuth@dologin']) !!}
            <div class="form-group has-feedback">
                <label for="Actvty_No">{{trans('admin.activity_type')}}</label>
                <select name="Actvty_No" id="Actvty_No" class="form-control">
                    <option value="">{{trans('admin.select')}}</option>
                    @if(count($acts) > 0)
                        <option value={{-1}}>{{trans('admin.allactivities')}}</option>
                        @foreach($acts as $act)
                            <option value="{{$act->Actvty_No}}">{{$act->{'Name_'.ucfirst(session('lang'))} }}</option>
                        @endforeach
                    @else
                        <option value={{-1}}>{{trans('admin.allactivities')}}</option>
                    @endif
                </select>
            </div>
            <div class="form-group has-feedback">
                <label for="Cmp_No">{{trans('admin.cmp_no')}}</label>
                <select name="Cmp_No" id="Cmp_No" class="form-control">
                    <option value="">{{trans('admin.select')}}</option>
                    <option value={{-1}}>{{trans('admin.allCompanies')}}</option>
                </select>
            </div>
            <div class="form-group has-feedback">
                {{ Form::email('email',null,['class'=>'form-control','placeholder'=>trans('admin.email')]) }}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {{ Form::password('password',['class'=>'form-control','placeholder'=>trans('admin.password')]) }}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remmberme"> {{trans('admin.Remember_Me')}}
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    {{ Form::submit(trans('admin.login'),['class'=>'btn btn-primary btn-block btn-flat']) }}
                </div>
        {!! Form::close() !!}
                <!-- /.col -->
            </div>
        <!-- /.social-auth-links -->

        <a href="{{aurl('forgetPassword')}}">{{trans('admin.forget_password')}}</a><br>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('public/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<script>

    $(document).ready(function(){
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });

        $('#Actvty_No').change(function(){
            $.ajax({
                url: "{{route('getCompanies')}}",
                type: "POST",
                dataType: 'html',
                data: {"_token": "{{ csrf_token() }}", Actvty_No: $(this).val() },
                success: function(data){
                    $('#Cmp_No').html(data);
                }
            });
        });
    });
</script>
</body>
</html>
