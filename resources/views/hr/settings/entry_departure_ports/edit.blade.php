@extends('hr.index')
@section('title', trans('hr.edit_entry_and_departure_ports'))
@section('root_link', route('entryDeparturePorts.index'))
@section('root_name', trans('hr.entry_and_departure_ports'))
@section('content')
    @can('create')
        @push('css')
        @endpush
        @push('js')
        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.edit_entry_and_departure_ports')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {{ Form::model($HrAstPorts, ['method'=>'PUT', 'route' => ['entryDeparturePorts.update',$HrAstPorts->ID_NO]]) }}

                {{--tap container--}}
                <div class="tab-content" id="myTabContent1">
                    {{--First tap--}}
                    <div class="tab-pane fade show active in" id="basic_information" role="tabpanel" aria-labelledby="home-tab">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-control">{{$HrAstPorts->Ports_No}}</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('Ports_NmAr', old('Ports_NmAr'),['class' => 'form-control Ports_NmAr', 'placeholder'=>trans('hr.entry_and_departure_ports_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {{Form::text('Ports_NmEn', old('Ports_NmEn'),['class' => 'form-control Ports_NmEn', 'placeholder' => trans('hr.entry_and_departure_ports_name_en')])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Second tap--}}
                </div>
                {{Form::submit(trans('hr.save'), ['class'=>'btn btn-info btn-block'])}}
                {{Form::close()}}
            </div>
        </div>
    @endcan
@endsection
