@extends('hr.index')

@section('root_name', trans('hr.title'))
@section('content')
        @push('css')
            <style>
                .p-0{ padding:0px; }
            </style>

        @endpush
        @push('js')
            <script>

            </script>

        @endpush
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {!! Form::open(['method'=>'POST','route' => 'pyjobs.store','files'=> true]) !!}

                <div class="col-md-9 card text-white bg-info mb-3" style="margin-bottom: 15px;">
                    <div class="card-header">
                        <h3 class="box-title">{{trans('hr.jobs')}}
                        {{Form::submit(trans('admin.create'),['class'=>'btn', 'style'=>'background-color: #538a9e;color:#fff;float:left;'])}}
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- <h5 class="card-title">Info card title</h5> -->
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <div class="row">
                                <div>
                                </div>
                                <label class="col-md-1">{{trans('hr.numberr')}}</label>
                                <input class="col-md-1 form-control" value="{{$last}}" name="Job_No" readonly="readonly" id="Job_No">

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4">{{trans('hr.job_name')}}</label>
                                    <input class="col-md-8 form-control" name="Job_NmAr" id="Job_NmAr" style="margin-bottom: 3px; text-align: center;">
                                </div>
                                <div class="row">
                                    <label class="col-md-4">En</label>
                                    <input class="col-md-8 form-control" name="Job_NmEn" id="Job_NmEn" style="margin-bottom: 3px; text-align: center;">
                                </div>
                                <div class="row">
                                    <label class="col-md-4">{{trans('hr.job_type')}}</label>
                                    <select class="col-md-8 form-control" name="Job_Typ" id="Job_Typ" style="margin-bottom: 3px;">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <div class="col-md-6">
                                    <input class="col-md-2" type="checkbox" value="1" name="job_cmpny">
                                    <label class="col-md-10" style="padding:0px;">{{trans('hr.job_cmpny')}}</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="col-md-2" type="checkbox" value="1" name="job_gov">
                                    <label class="col-md-10" style="padding:0px;">{{trans('hr.job_gov')}}</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="col-md-2" type="checkbox" value="1" name="job_desc">
                                    <label class="col-md-10" style="padding:0px;">{{trans('hr.job_desc')}}</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="col-md-2" type="checkbox" value="1" name="job_tech">
                                    <label class="col-md-10" style="padding:0px;">{{trans('hr.job_tech')}}</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div> {{--end of  box-body --}}
            <!-- last of day -->
        </div> {{--end of div box--}}
@endsection
