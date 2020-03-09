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

<script src="{{asset('public/js/app.js?v=2.4.1')}}"></script>
<!-- jQuery 3 -->
<script src="{{asset('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/adminlte/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
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
<script src="{{asset('public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@hasanyrole('admin|writer')
<script src="{{asset('public/js/dataTables.buttons.min.js')}}"></script>
@endhasanyrole
<!-- Morris.js charts -->
<script src="{{asset('public/adminlte/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('public/adminlte/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('public/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('public/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('public/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('public/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('public/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('public/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('public/js/bootstrap-datepicker.ar.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('public/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('public/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('public/adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('public/js/select2.full.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/adminlte/dist/js/pages/dashboard.js')}}"></script>
{{--Date Hijri--}}


{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>--}}

<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/adminlte/dist/js/demo.js')}}"></script>
<script src="{{asset('public/vendor/datatables/buttons.server-side.js')}}"></script>
<script src="{{asset('public/jstree/dist/jstree.min.js')}}"></script>
<script src="http://cdn.datatables.net/plug-ins/1.10.19/sorting/enum.js"></script>
<script src="{{asset('public/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/js/additional-methods.min.js')}}"></script>
<script src="{{asset('public/js/messages_ar.min.js')}}"></script>
<script src="{{asset('public/js/dropzone.min.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
<script data-require="angular.js@1.5.0" data-semver="1.5.0" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.js"></script>
<script data-require="moment.js@2.10.2" data-semver="2.10.2" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{url('/')}}/public/adminlte/dateHijri/dist/js/bootstrap-hijri-datepicker.min.js"></script>

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
        $("#addperson").click(function(){
            /*$("#append").append()*/
            /*$("#append").append($("#append2"));*/
            var x = $('#append').html();
            $(x).appendTo('#append2');
        });
        $('#history_date').change(function(){
            var x = $(this).val();
            var formatter = new Intl.DateTimeFormat("en-GB-u-ca-islamicc");
            $('.higri_date').val(formatter.format(new Date(x)))
        })
        $('#history_date_project').change(function(){
            var x = $(this).val();
            var formatter = new Intl.DateTimeFormat("en-GB-u-ca-islamicc");
            $('.higri_date_project').val(formatter.format(new Date(x)))
        })
        //$('#contract_end').change(function(){
          //  var date_diff_indays = function(date1, date2) {
            //    dt1 = new Date(date1);
              //  dt2 = new Date(date2);
               // var data = Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 3600 * 24));
                //        return data + ' يوم';
               // }
               // $('#contract_period').val(date_diff_indays($('#contract_start').val(), $('#contract_end').val()))
               // console.log(date_diff_indays($('#contract_start').val(), $('#contract_end').val()));
                //console.log(date_diff_indays('12/02/2014', '11/04/2014'));
        //})
    });

</script>

</body>
</html>
