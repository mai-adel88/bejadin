@extends('hr.index')
@section('title',trans('hr.hr_datatable'))
@section('content')
    @hasrole('hr')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.hr_datatable')}} </h3>
        </div>
    @include('hr.layouts.message')
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
        <div class="alert alert-danger">{{trans('hr.access_denied')}}</div>

        @endhasrole
@endsection
