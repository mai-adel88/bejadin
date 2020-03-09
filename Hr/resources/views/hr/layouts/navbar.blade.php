<style>
    .read{
        background: #CCCCCC;
    }
</style>
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>INFO</b>SAS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
{{--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                        <i class="fa fa-bell-o"></i>--}}
{{--                        <span class="label label-warning count">{{auth()->guard('hr')->user()->unreadNotifications->where('type','App\Notifications\subscriber')->count()}}</span>--}}
{{--                    </a>--}}
                    <ul class="dropdown-menu">
                        <li class="header">{{trans('admin.You_have')}} {{auth()->guard('hr')->user()->unreadNotifications->where('type','App\Notifications\subscriber')->count()}} {{trans('admin.Notifications')}}</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach(auth()->user()->notifications->where('type','App\Notifications\subscriber')->take(30) as $notify)
                                    <li class="@if($notify->read_at != null) read  @endif">
                                        <a href="#" style="white-space: initial !important;">
                                            <i class="fa fa-user text-aqua"></i> {{trans('admin.new_subscriber_added')}} :{{session_lang($notify->data['name_ar'],$notify->data['name_en'])}} {{trans('admin.created_at')}} {{$notify->created_at}}</span>
                                            <?php $notify->markAsRead(); ?>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        {{--<li class="footer"><a href="#">View all</a></li>--}}
                    </ul>

                </li>
                <li class="dropdown notifications-menu">
{{--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                        <i class="fa fa-flag-o"></i>--}}
{{--                        <span class="label label-warning count">{{auth()->guard('hr')->user()->unreadNotifications->where('type','App\Notifications\TransformExpired')->count()}}</span>--}}
{{--                    </a>--}}
                    <ul class="dropdown-menu">
                        <li class="header">{{trans('admin.You_have')}} {{auth()->guard('hr')->user()->unreadNotifications->where('type','App\Notifications\TransformExpired')->count()}} {{trans('admin.Notifications')}}</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach(auth()->user()->notifications->where('type','App\Notifications\TransformExpired')->take(30) as $notify)
                                    <li class="@if($notify->read_at != null) read  @endif">
                                        <a href="#" style="white-space: initial !important;">
                                            <i class="fa fa-user text-aqua"></i> {{trans('admin.travel_damage')}} :{{$notify->data['branche']}} {{$notify->data['bus']}}{{trans('admin.date')}}: {{$notify->data['date']}}{{trans('admin.schedules')}} : {{$notify->data['schedule']}}{{trans('admin.created_at')}} {{$notify->created_at}}</span>
                                            <?php $notify->markAsRead(); ?>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        {{--<li class="footer"><a href="#">View all</a></li>--}}
                    </ul>

                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-globe"></i>
                        <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-6 text-center">
                                    <a href="{{hrUrl('lang/ar')}}">عربي</a>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <a href="{{hrUrl('lang/en')}}">English</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="@if(hr()->user()->image !== null){{asset(hr()->user()->image)}}@else {{url('/')}}/public/hr/adminlte/previewImage.png @endif" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{hr()->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="@if(hr()->user()->image !== null){{asset(hr()->user()->image)}}@else {{url('/')}}/public/hr/adminlte/previewImage.png @endif" class="img-circle" alt="User Image">

                            <p>
                                {{hr()->user()->name}}@if(hr()->user()->hasAnyRole(\Spatie\Permission\Models\Role::all())) -  {{hr()->user()->getRoleNames()[0]}}@endif
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                                <a href="{{hrUrl('logout')}}" class="btn btn-default btn-flat">{{trans('admin.Sign_out')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
