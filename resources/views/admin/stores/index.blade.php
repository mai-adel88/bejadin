@extends('admin.index')
@section('title',trans('admin.'))
@section('content')
    @hasrole('admin')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.admin_datatable')}} </h3>
        </div>
        <div class="col-md-12">
            @include('admin.layouts.message')
        </div>
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
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole
@endsection
