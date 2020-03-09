<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ !empty($title)?$title:trans('admin.title') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Theme style -->
    @if(direction() == 'ltr')
    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/dist/css/AdminLTE.min.css">
    @else
        <link rel="stylesheet" href="{{url('/')}}/public/hr/rtl/AdminLTE.css">
        <link rel="stylesheet" href="{{url('/')}}/public/hr/rtl/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="{{url('/')}}/public/hr/rtl/fonts/fonts-fa.css">
        <link rel="stylesheet" href="{{url('/')}}/public/hr/rtl/profile.css">
        <link rel="stylesheet" href="{{url('/')}}/public/hr/rtl/rtl.css">
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
    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
{{--    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/bower_components/morris.js/morris.css">--}}
    <!-- jvectormap -->
{{--    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/bower_components/jvectormap/jquery-jvectormap.css">--}}
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/hr/css/buttons.dataTables.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{url('/')}}/public/hr/css/buttons.dataTables.min.css">
{{--    <link rel="stylesheet" href="{{url('/')}}/public/hr/jstree/dist/themes/default/style.min.css">--}}
    <!-- bootstrap wysihtml5 - text editor -->
{{--    <link rel="stylesheet" href="{{url('/')}}/public/hr/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">--}}
    <link rel="stylesheet" href="{{url('/')}}/public/hr/css/select2.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/hr/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <![endif]-->
    <!-- inside the head tag of `layouts/master.blade.php` -->
    <script>
        var laravel = @json(['baseURL' => url('/')])
    </script>
    <script src="https://zulns.github.io/HijriDate.js/hijri-date.js"></script>
    <script src="https://ZulNs.github.io/Datepicker.js/datepicker.js"></script>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @stack('csrf')

    <style>
        .ui-datepicker td span,
        .ui-datepicker td a {
            padding-bottom: 1em;
        }
        .ui-datepicker-title[data-custom] {
            position: relative;
            padding-bottom: 10px;
        }
        .ui-datepicker-title[data-custom]::after {
            color: green;
            content: attr(data-custom);
            display: block;
            font-size: small;
        }
        .ui-datepicker td[title]::after {
            content: attr(title);
            display: block;
            position: relative;
            color: green;
            font-size: .8em;
            height: 1.25em;
            margin-top: -1.25em;
            text-align: right;
            padding-right: .25em;
        }

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
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!--CSS Spinner-->
{{--<div class="spinner-wrapper">--}}
    {{--<div class="spinner"></div>--}}
{{--</div>--}}
