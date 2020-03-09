<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta  name="csrf-token" content='{{csrf_token()}}'>
    <title>{{ !empty($title)?$title:trans('admin.title') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('public/css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">


    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    @if(direction() == 'ltr')
    <link rel="stylesheet" href="{{asset('public/adminlte/dist/css/AdminLTE.min.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('public/rtl/AdminLTE.css')}}">
        <link rel="stylesheet" href="{{asset('public/rtl/bootstrap-rtl.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/rtl/fonts/fonts-fa.css')}}">
        <link rel="stylesheet" href="{{asset('public/rtl/profile.css')}}">
        <link rel="stylesheet" href="{{asset('public/rtl/rtl.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900&amp;subset=arabic" rel="stylesheet">
        <style>
            {{--@font-face{font-family:'Droid Arabic Kufi';font-style:normal;font-weight:400;src:url('{{url('/')}}/rtl/fonts/DroidKufi-Regular.eot');src:url('{{url('/')}}/rtl/fonts/DroidKufi-Regular.eot?#iefix') format('embedded-opentype'),url('{{url('/')}}/rtl/fonts/DroidKufi-Regular.woff') format('woff'),url('{{url('/')}}/rtl/fonts/DroidKufi-Regular.woff2') format('woff2'),url('{{url('/')}}/rtl/fonts/DroidKufi-Regular.ttf') format('truetype'),url('{{url('/')}}/rtl/fonts/DroidKufi-Regular.svg#Droid Arabic Kufi') format('svg')}--}}
            {{--@font-face{font-family:'Droid Arabic Kufi';font-style:normal;font-weight:700;src:url('{{url('/')}}/rtl/fonts/DroidKufi-Bold.eot');src:url('{{url('/')}}/rtl/fonts/DroidKufi-Bold.eot?#iefix') format('embedded-opentype'),url('{{url('/')}}/rtl/fonts/DroidKufi-Bold.woff') format('woff'),url('{{url('/')}}/rtl/fonts/DroidKufi-Bold.woff2') format('woff2'),url('{{url('/')}}/rtl/fonts/DroidKufi-Bold.ttf') format('truetype'),url('{{url('/')}}/rtl/fonts/DroidKufi-Bold.svg#Droid Arabic Kufi') format('svg')}--}}
            html,body{
                font-family: 'Cairo', sans-serif;
            }
            .select2-container--default .select2-selection--single .select2-selection__rendered{
                direction: rtl;
            }
            .date-in-invoices{float:left !important}
        </style>
    @endif
        <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('public/adminlte/dist/css/skins/_all-skins.min.css')}}">

    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/buttons.dataTables.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('public/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/jstree/dist/themes/default/style.min.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('public/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.css">  --}}
    {{--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">  --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <!-- inside the head tag of `layouts/master.blade.php` -->
    <script>
        var laravel = @json(['baseURL' => url('/')])
    </script>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @stack('csrf')

    <style>
        .spinner-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #222222;
            z-index: 99999999999;
        }

        .spinner {
            width: 40px;
            height: 40px;
            background-color: #3c8dbc;
            position: absolute;
            top: 48%;
            left: 48%;
            -webkit-animation: sk-rotateplane 1.2s infinite ease-in-out;
            animation: sk-rotateplane 1.2s infinite ease-in-out;
        }

        @-webkit-keyframes sk-rotateplane {
            0% { -webkit-transform: perspective(120px) }
            50% { -webkit-transform: perspective(120px) rotateY(180deg) }
            100% { -webkit-transform: perspective(120px) rotateY(180deg)  rotateX(180deg) }
        }

        @keyframes sk-rotateplane {
            0% {
                transform: perspective(120px) rotateX(0deg) rotateY(0deg);
                -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg)
            } 50% {
                  transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
                  -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg)
              } 100% {
                    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
                    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
                }
        }
        body{
            padding-right: 0 !important;
        }
        .info-box-content  .info-box-text
        {
            font-weight: 700;
            white-space: normal;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!--CSS Spinner-->
{{--<div class="spinner-wrapper">--}}
    {{--<div class="spinner"></div>--}}
{{--</div>--}}
<div class="wrapper">
