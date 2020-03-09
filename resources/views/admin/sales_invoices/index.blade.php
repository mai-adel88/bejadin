@extends('admin.index')
@section('title',trans('admin.sales_invoices'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.layouts.message')
        </div>
    </div>
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">{{trans('admin.sales_invoices')}} </h3>
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

@endsection
