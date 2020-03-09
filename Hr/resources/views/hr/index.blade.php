@include('hr.layouts.header')
@include('hr.layouts.navbar')
<div class="wrapper" id="app">
@include('hr.layouts.menu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @yield('title')
            <small>{{trans('admin.Control_panel')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="@yield('root_link', route('hr.home'))"><i class="fa fa-dashboard"></i> @yield('root_name', trans('hr.dashboard'))</a></li>
            <li class="active">@yield('title')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @yield('content')
    </section>

</div>
</div>
@include('hr.layouts.footer')
