@extends('admin.index')
@section('title',trans('admin.companies'))
@section('content')
@push('js')
    @hasrole('reader')
    <script src="{{url('/')}}/js/dataTables.buttons.min.js"></script>
    @endhasrole
@endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.companies')}}</h3>
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
@endsection