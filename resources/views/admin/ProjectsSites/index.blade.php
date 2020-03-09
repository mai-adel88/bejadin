@extends('admin.index')
@section('title', trans('admin.Data_of_projects_sites'))
@section('content')
    @hasanyrole('admin|writer')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.Data_of_projects_sites')}}</h3>
        </div>
    @include('admin.layouts.message')
    <!-- /.box-header -->
        <div class="box-body table-responsive">
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped table-hover'
            ],true) !!}
        </div>
        <!-- /.box-body -->
        <div class="Bold">
            <div class="col-md-12"></div>
        </div>
    </div>

    {{--  {{ $project->customer }}  --}}





    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush

    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole
@endsection
