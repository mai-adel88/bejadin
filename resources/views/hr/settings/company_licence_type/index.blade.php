@extends('hr.index')
@section('title',trans('hr.com_license_types'))
@section('root_title',trans('hr.com_fixed'))
@section('content')

    @push('js')
    @endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('hr.com_license_types')}}</h3>
        </div>
        <div class="box-body table-responsive">
            @include('hr.layouts.message')
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped table-hover'
             ],true) !!}
        </div>
    </div>
@push('js')
    {!! $dataTable->scripts() !!}
@endpush
@endsection
