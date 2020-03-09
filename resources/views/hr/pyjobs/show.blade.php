@extends('hr.index')

@section('root_name', trans('hr.title'))
@section('content')
        @push('css')
            
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
                {{Form::model($job,['method'=>'PUT','route'=>['pyjobs.show',$job->ID_No],'class'=>'form-group','files'=>true])}}
                
                <div class="col-md-9 card text-white bg-info mb-3" style="">
                    <div class="card-header">
                        <h3 class="box-title">{{trans('hr.jobs')}}</h3>
                    </div>
                    <div class="card-body">
                        <!-- <h5 class="card-title">Info card title</h5> -->
                        <div class="col-md-12">
                            <div class="row">
                                <div>
                                </div>
                                <label class="col-md-1">{{trans('hr.numberr')}}</label>
                                <input class="col-md-1 form-control" value="{{$job->Job_No}}" name="Job_No" readonly="readonly" id="Job_No">

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4">{{trans('hr.job_name')}}</label>
                                    <input class="col-md-8 form-control" value="{{$job->Job_NmAr}}" name="Job_NmAr" disabled id="Job_NmAr" style="margin-bottom: 3px;">
                                </div>
                                <div class="row">
                                    <label class="col-md-4">En</label>
                                    <input class="col-md-8 form-control" value="{{$job->Job_NmEn}}" name="Job_NmEn" disabled id="Job_NmEn" style="margin-bottom: 3px;">
                                </div>
                                <div class="row">
                                    <label class="col-md-4">{{trans('hr.job_type')}}</label>
                                    <select class="col-md-8 form-control" name="Job_Typ" disabled id="Job_Typ" style="margin-bottom: 3px;">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <input class="col-md-2" type="checkbox" @if($job->job_cmpny == 1) checked @endif value="{{$job->job_cmpny}}" name="job_cmpny"  disabled>
                                    <label class="col-md-10" style="padding:0px;">{{trans('hr.job_cmpny')}}</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="col-md-2" @if($job->job_gov == 1) checked @endif value="{{$job->job_gov}}" type="checkbox" name="job_gov" disabled>
                                    <label class="col-md-10" style="padding:0px;">{{trans('hr.job_gov')}}</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="col-md-2" type="checkbox" @if($job->job_desc == 1)checked @endif value="{{$job->job_desc}}" name="job_desc" disabled>
                                    <label class="col-md-10" style="padding:0px;">{{trans('hr.job_desc')}}</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="col-md-2" type="checkbox" @if($job->job_tech == 1)checked @endif value="{{$job->job_tech}}" name="job_tech" disabled>
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
