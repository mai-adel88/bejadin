<footer class="main-footer">
    <strong>Copyright &copy; 2018-2019 <a href="https://www.infosasics.com">infosas</a>.</strong> All rights
    reserved.
    <div class="pull-left hidden-xs">
        <b> Version</b> 1.0.4
    </div>

</footer>


<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{url('/public/hr/js/app.js?v=2.4.1')}}"></script>

<script src="https://unpkg.com/vuejs-datepicker"></script>
<script src="{{url('/')}}/public/hr/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('/')}}/public/hr/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script>
    window.trans = <?php
    // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
    $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
    $trans = [];
    foreach ($lang_files as $f) {
        $filename = pathinfo($f)['filename'];
        $trans[$filename] = trans($filename);
    }
    echo json_encode($trans);
    ?>;
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('/')}}/public/hr/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/public/hr/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/public/hr/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@hasanyrole('hr|writer')
<script src="{{url('/')}}/public/hr/js/dataTables.buttons.min.js"></script>
@endhasanyrole
<!-- Morris.js charts -->
{{--<script src="{{url('/')}}/public/hr/adminlte/bower_components/raphael/raphael.min.js"></script>--}}
{{--<script src="{{url('/')}}/public/hr/adminlte/bower_components/morris.js/morris.min.js"></script>--}}
<!-- Sparkline -->
<script src="{{url('/')}}/public/hr/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
{{--<script src="{{url('/')}}/public/hr/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>--}}
{{--<script src="{{url('/')}}/public/hr/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}
<!-- jQuery Knob Chart -->
<script src="{{url('/')}}/public/hr/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('/')}}/public/hr/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="{{url('/')}}/public/hr/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{url('/')}}/public/hr/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="{{url('/')}}/public/hr/js/bootstrap-datepicker.ar.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('/')}}/public/hr/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{{url('/')}}/public/hr/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{url('/')}}/public/hr/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- public/hr/adminlte App -->
<script src="{{url('/')}}/public/hr/adminlte/dist/js/adminlte.min.js"></script>
<script src="{{url('/')}}/public/hr/js/select2.full.min.js"></script>
<!-- public/hr/adminlte dashboard demo (This is only for demo purposes) -->
<script src="{{url('/')}}/public/hr/adminlte/dist/js/pages/dashboard.js"></script>
<!-- public/hr/adminlte for demo purposes -->
<script src="{{url('/')}}/public/hr/adminlte/dist/js/demo.js"></script>
<script src="{{url('/')}}/public/hr/vendor/datatables/buttons.server-side.js"></script>
<script src="{{url('/')}}/public/hr/jstree/dist/jstree.min.js"></script>
<script src="http://cdn.datatables.net/plug-ins/1.10.19/sorting/enum.js"></script>
<script src="{{url('/')}}/public/hr/js/jquery.validate.min.js"></script>
<script src="{{url('/')}}/public/hr/js/additional-methods.min.js"></script>
<script src="{{url('/')}}/public/hr/js/messages_ar.min.js"></script>
<script src="{{url('/')}}/public/hr/js/messages_ar.min.js"></script>


<script src="{{url('/')}}/public/hr/js/ckeditor/ckeditor.js"></script>


    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            rtl: true,
            language: '{{session('lang')}}',
            autoclose:true,
            todayBtn:true,
            clearBtn:true,

        });
    </script>


@stack('js')
@stack('css')
@can('edit')
    {{null}}
    @else
<style>
    .edit{
        display: none;
    }
</style>
<script>
        $(function () {
            'use strict'
            $('.edit').remove();
        })
    </script>
@endcan
@can('delete')
    {{null}}
    @else
<style>
    .remove-record{
        display: none;
    }
</style>
<script>
        $(function () {
            'use strict'
            $('.remove-record').remove();
        })
    </script>
@endcan
@can('create')
    {{null}}
    @else
<style>
    .create{
        display: none;
    }
</style>
<script>
        $(function () {
            'use strict'
            $('.create').remove();
        })
    </script>
@endcan

<script>
    $(document).ready(function() {
//Preloader
        $(window).on("load", function() {
            preloaderFadeOutTime = 500;
            function hidePreloader() {
                var preloader = $('.spinner-wrapper');
                preloader.fadeOut(preloaderFadeOutTime);
            }
            hidePreloader();
        });
    });
</script>

</body>
</html>
