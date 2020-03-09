{{-- resources\views\admin\students\create1.blade.php --}}
@extends('admin.index')
@section('title',trans('admin.companies'))
@section('content')
@hasanyrole('writer|admin')
@can('create')
    @push('js')
        <script>
            $(function () {
                'use strict';
                $('.bus').select2({
                    placeholder: "{{trans('admin.Select_a_State')}}",
                    allowClear: true
                });
            });
        </script>
    @endpush
    @push('js')
        <script>
            $(function () {
                'use strict';

            });
        </script>
        <script>
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $(input).next('img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".upld").change(function () {
                readURL(this);
            });
        </script>

    @endpush

    <div class="box">
        @include('admin.layouts.message')
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{trans('admin.delete')}}</h4>
                    </div>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['companies.destroy',$cmp->ID_No],'Cmp_No'=>'modal-delete']) !!}
                    <div class="modal-body">
                        <p>{{trans('admin.You_Want_You_Sure_Delete_This_Record')}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" value="delete">{{trans('admin.close')}}</button>
                        {!! Form::submit('delete', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['route'=> ['companies.update', $cmp->ID_No],'files' => true]) !!}
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="col-md-5 pull-left" style="display: flex; flex-direction: row; justify-content: flex-end">
                <div class="box-header">
                    {{-- <h3 class="box-title">{{$title}}</h3> --}}
                </div>
                <div>
                    {!! Form::button( '<i class="fa fa-floppy-o"></i> ' . trans('admin.save'), ['type' => 'submit','class' => 'btn btn-primary', 'name' => 'submitbutton', 'value' => 'save'])!!}
                    <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"></i> {{trans('admin.delete')}}</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    {{-- ثوابت الشركه --}}
                    <li class="active"><a href="#busowner" data-toggle="tab"><i class="fa fa-user"></i> {{trans('admin.company_fixed_data')}}</a></li>
                    {{-- الترحيل للحسابات --}}
                    <li><a href="#activity" data-toggle="tab"><i class="fa fa-info"></i> {{trans('admin.accounting_posting')}}</a></li>
                    {{-- النماذج الخاصه و الطابعات --}}
                    <li><a href="#menu5" data-toggle="tab"><i class="fa fa-photo"></i> {{trans('admin.docs_and_printers')}}</a></li>
                    {{-- اعدادات عامه --}}
                    <li><a href="#menu4" data-toggle="tab"><i class="fa fa-photo"></i> {{trans('admin.general_setting')}}</a></li>
                </ul>
                <div class="tab-content">
                    @include('admin.companies.create.fixed_company_data')
                    @include('admin.companies.create.accounting_posting')
                    @include('admin.companies.create.docs_and_printers')
                    @include('admin.companies.create.general_setting')
                </div>

            <!-- /.tab-content -->
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    @endcan
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

    @endhasanyrole

    <form action="" method="POST" class="remove-record-model">
        <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width:55%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="custom-width-modalLabel">{{trans('admin.Delete_Record')}}</h4>
                    </div>
                    <div class="modal-body">
                        <h4>{{trans('admin.You_Want_You_Sure_Delete_This_Record')}}</h4>
                    </div>
                    {{Form::hidden('Cmp_No',$cmp->Cmp_No)}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{trans('admin.close')}}</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">{{trans('admin.delete')}}</button>
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection
