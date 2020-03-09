@extends('admin.index')
@section('title', trans('admin.Contractors_contracts_data'))
@section('content')
    @hasanyrole('admin|writer')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.Contractors_contracts_data')}}</h3>
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

    {{--  {{ $project->customer }}  --}}





    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole
@endsection
