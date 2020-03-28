@extends('hr.index')

@section('title', trans('hr.show_attachment'))
@section('root_link', route('attachments.index'))
@section('root_name', trans('hr.attachments'))



@section('content')
        @push('css')
            <style>
                .p-10{padding:10px;}
                .mt-15{ margin-top:15px; }
                .mb-15{ margin-bottom:15px; }
                .pt-3{ padding-top: 3px; }
                .pl-0{padding-left:0;}
                .label-padding{padding: 6px 12px;}
                .fs-20{font-size: 20px}
                .first-row{
                    background: #fff;
                    padding: 15px;
                    box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.2);
                    border-radius: 5px;
                }
                .second-row{display:inline-block;box-shadow: 0 0 5px 0 rgba(0,0,0,.2);background: #fff;}
                .offset-1{margin-right: 9.5% !important;}
            </style>

        @endpush
    
        <div class="box">
            <div class="box-header">
            </div>
        <div class="box-body"> 
                @include('hr.layouts.message')                

                <div class="col-md-12 card text-white bg-info mb-3" style="margin-bottom: 15px;">
                    
                    <div class="card-body">
                        <!-- <h5 class="card-title">Info card title</h5> -->
                        @if(count($attachments) > 0) 
                        <div class="col-md-12 appendDiv" style="margin-bottom: 10px;margin-top:20px;">
                            <div class="form-group row first-row text-center">
                                <div class="col-md-6">
                                    <label class="label-padding col-md-3">{{trans('hr.company')}}</label>
                                    <div class="fs-20 col-md-9 form-control text-center">
                                        {{$attachments->first()->company->{'Cmp_Nm'.ucfirst(session('lang'))} }}
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="label-padding col-md-3">{{trans('hr.employee')}}</label>
                                    <div class="fs-20 col-md-9 form-control text-center">
                                        {{$attachments->first()->employee->{'Emp_Nm'.ucfirst(session('lang'))} }}
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                            @foreach($attachments as $attachment)
                            
                                <div class="col-md-4">
                                    <div class="second-row">
                                        <div class="col-md-12 mb-15 mt-15">
                                            <label class="label-padding col-md-4">{{trans('hr.numberr')}}</label>
                                            <div class="col-md-8 form-control text-center">{{$attachment->Attch_No}}</div>
                                        </div>
                                        <!-- نوع المرفق -->
                                        <div class="col-md-12 mb-15">
                                            <label class="label-padding col-md-4">{{trans('hr.attach_type')}}</label>
                                            <div class="col-md-8 form-control text-center">
                                                {{\App\Enums\Hr\HrAstAttachType::getDescription($attachment->Attch_Ty)}}
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-15">
                                            <label id="Attch_Desc" class="col-md-4 pl-0">{{trans('hr.Attch_Desc')}}</label>
                                            <div class="form-group">
                                                <div class="form-control col-md-8 text-center">{{$attachment->Attch_Desc}}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <!-- <label class="label-padding col-md-4">{{trans('hr.photo')}}</label> -->
                                            <div class="row p-10">
                                                @if($attachment->Photo != null)
                                                <img src="{{asset($attachment->Photo)}}" class="img-responsive" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            </div> <!-- end of col-md-12 mb-15-->
                        @endif
                        <!-- <div class="form-group">
                            <a id="appendNewAttachment" href="#" class="btn btn-success" style="margin-right: 10px;"><i class="fa fa-plus"></i></i></a>
                        </div> -->

                    </div>
                </div>
                {!! Form::close() !!}
            </div> {{--end of  box-body --}}
            <!-- last of day -->
        </div> {{--end of div box--}}
@endsection
