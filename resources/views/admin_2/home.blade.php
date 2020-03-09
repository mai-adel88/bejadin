@extends('admin.index')

@section('content')
    @push('js')
        <script>
            $(function () {
                'use strict';

                $(document).on('change','.branche',function () {
                    var branche = $('.branche option:selected').val();
                    var dateToday = new Date();
                    $("#loadingmessage-2").css("display","block");
                    $(".column-branche-form").css("display","none");
                    console.log(branche);
                    if (branche > 0){
                        $.ajax({
                            url: '{{aurl('reportbranche/show')}}',
                            type:'get',
                            dataType:'html',
                            data:{branche : branche},
                            success: function (data) {
                                $("#loadingmessage-2").css("display","none");
                                $('.column-branche-form').css("display","block").html(data);
                                $('.datepicker').datepicker({
                                    format: 'yyyy-mm-dd',
                                    rtl: true,
                                    language: '{{session('lang')}}',
                                    inline:true,
                                    minDate: 0,
                                    autoclose:true,
                                    minDateTime: dateToday

                                });


                            }
                        });
                    }else{
                        $('.column-branche-form').html('');
                    }
                });


            });
        </script>

    @endpush

    @push('js')
        <script>
            $(function () {
                'use strict';

                $(document).on('change','.subscriber',function () {
                    var subscriber = $('.subscriber option:selected').val();
                    var dateToday = new Date();
                    $("#loadingmessage-5").css("display","none");
                    $('.column-form').css("display","block");
                    console.log(subscriber);
                    if (subscriber > 0){
                        $.ajax({
                            url: '{{aurl('subscriber/show')}}',
                            type:'get',
                            dataType:'html',
                            data:{subscriber : subscriber},
                            success: function (data) {
                                $("#loadingmessage-5").css("display","none");
                                $('.column-form').css("display","block").html(data);

                                $('.datepicker').datepicker({
                                    format: 'yyyy-mm-dd',
                                    rtl: true,
                                    language: '{{session('lang')}}',
                                    inline:true,
                                    minDate: 0,
                                    autoclose:true,
                                    minDateTime: dateToday

                                });


                            }
                        });
                    }else{
                        $('.column-form').html('');
                    }
                });


            });
        </script>

    @endpush


    @push('js')

        <script>
            $(document).ready(function() {

                $(".date").select2({
                    placeholder: "{{trans('admin.select')}}",
                    allowClear: true,
                    dir: '{{direction()}}'
                });
                $(".branche").select2({
                    placeholder: "{{trans('admin.select')}}",
                    allowClear: true,
                    dir: '{{direction()}}'
                });
            });
        </script>


    @endpush
    @push('css')
        <style>

            .subbadgit{
                padding: 30px 10px;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice{
                background-color: #333;
            }
            @if(session('lang') == 'ar')
                .wysihtml5-sandbox .wysihtml5-editor{
                direction: rtl;
            }
            .fi-img{
                text-align: right;
                direction: rtl;
            }
            @endif
        </style>

    @endpush

    <!-- Small boxes (Stat box) -->
    <div class="row">

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$users->count()}}</h3>

                    <p>{{trans('admin.User_Registrations')}}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('users.index')}}" class="small-box-footer">{{trans('admin.More_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    @if (auth()->guard('admin')->user()->branches_id != null)
                        @if (auth()->guard('admin')->user()->branches_id == \App\Branches::all()->first()->id)
{{--                            <h3>{{$subscription->count()}}</h3>--}}
                        @else
                            <h3>{{count(\App\Branches::find(auth()->guard('admin')->user()->branches_id)->subscribers)}}</h3>
                        @endif
                    @else
                        <h3>0</h3>
                    @endif
                    <p>{{trans('admin.Subscribers')}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{route('subscribers.index')}}" class="small-box-footer">{{trans('admin.More_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    @if (auth()->guard('admin')->user()->branches_id != null)
                        @if (auth()->guard('admin')->user()->branches_id == \App\Branches::all()->first()->id)
{{--                            <h3>{{$drivers->count()}}</h3>--}}
                        @else
                            <h3>{{count(\App\Branches::find(auth()->guard('admin')->user()->branches_id)->drivers)}}</h3>
                        @endif
                    @else
                        <h3>0</h3>
                    @endif

                    <p>{{trans('admin.employees')}}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-id-card"></i>
                </div>
                <a href="{{route('employees.index')}}" class="small-box-footer">{{trans('admin.More_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            {{--subscriber subscription--}}

            {{--end subscriber subscription--}}
            {{--driver report--}}

            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-envelope"></i>

                    <h3 class="box-title">{{trans('admin.Quick_Email')}}</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                title="{{trans('admin.Remove')}}">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                {!! Form::open(['route'=>'admin.sendmail','class'=>'form-group']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <input type="email" class="form-control" name="emailto" placeholder="{{trans('admin.Email_to')}} :">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="{{trans('admin.Subject')}}">
                    </div>
                    <div>

                  <textarea class="textarea" name="contents" placeholder="{{trans('admin.Message')}}"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                </div>
                <div class="box-footer clearfix">

                    {!! Form::button(trans('admin.send') . ' <i class="fa fa-arrow-circle-'.trans('admin.dirsendarrow').'"></i>',['class'=>'pull-right btn btn-default','type'=>'submit']) !!}

                </div>
                {!! Form::close() !!}
            </div>
            <!-- Map box -->
            <div class="box box-solid bg-light-blue">
                <div class="box-header">
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                                data-toggle="tooltip" title="{{trans('admin.Collapse')}}" style="margin-right: 5px;">
                            <i class="fa fa-minus"></i></button>
                    </div>
                    <!-- /. tools -->

                    <i class="fa fa-map-marker"></i>

                    <h3 class="box-title">
                        {{trans('admin.Visitors')}}
                    </h3>
                </div>
                <div class="box-body">
                    <div id="visitor"  style="height: 250px; width: 100%;direction: ltr">
                        {!! $lava->render("GeoChart","Popularity","visitor")!!}
                    </div>
                </div>
                <!-- /.box-body-->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">



        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->


@endsection