@extends('hr.index')
@section('title', trans('hr.attachments'))


@section('title', trans('hr.attachments'))
@section('root_link', route('emp_data'))
@section('root_name', trans('hr.employees'))

@section('content')
    @hasanyrole('admin|writer')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.attachments')}}</h3>
        </div>
    @include('admin.layouts.message')
    <!-- /.box-header -->
        <div class="box-body table-responsive">
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped table-hover'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

    @else
        <div class="alert alert-danger">{{trans('hr.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole
@endsection