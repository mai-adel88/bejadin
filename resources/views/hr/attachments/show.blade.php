@extends('hr.index')

@section('title', trans('hr.show_attachment'))
@section('root_link', route('attachments.index'))
@section('root_name', trans('hr.attachments'))



@section('content')
        @push('css')
            <style>
                .p-0{ padding:0px; }
                .mp-0{ padding:0px;margin:0; }
                .mt-15{ margin-top:15px; }
                .mb-15{ margin-bottom:15px; }
                .pt-3{ padding-top: 3px; }
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
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label class="col-md-3">{{trans('hr.company')}}</label>
                                    <div class="col-md-9 p-0">
                                        <select disabled name="Cmp_No" class="select2 Cmp_No form-control">
                                            <option disabled selected>{{trans('admin.select')}}</option>
                                            @foreach($companies as $mainCompany)
                                            <option @if($attachemployee->Cmp_No == $mainCompany->Cmp_No) selected @endif value="{{$mainCompany->Cmp_No}}">{{$mainCompany->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                                <!-- <option value="{{$mainCompany->Cmp_No}}">{{$mainCompany->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option> -->
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="col-md-3">{{trans('hr.employee')}}</label>
                                    <div class="col-md-9 ">
                                        <select disabled name="Emp_No" class="Emp_No select2 form-control">
                                            <option disabled selected>{{trans('admin.select')}}</option>
                                            @foreach($employees as $employee)
                                            <option @if($attachemployee->Emp_No == $employee->Emp_No) selected @endif value="{{$employee->Emp_No}}">{{$employee->{'Emp_Nm'.ucfirst(session('lang'))} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        
                            @foreach($attachments as $attachment)
                                <div class="col-md-3">
                                    <div class="col-md-12 mb-15 mt-15 p-0">
                                        <label class="col-md-6 p-0">{{trans('hr.numberr')}}</label>
                                        <input class="col-md-6 form-control" value="{{$attachment->Attch_No}}" name="Attch_No" readonly="readonly" id="Attch_No">
                                    </div>
                                    <!-- نوع المرفق -->
                                    <div class="col-md-12 mb-15 p-0">
                                        <label class="col-md-4 p-0">{{trans('hr.attach_type')}}</label>
                                        <div class="col-md-8 p-0">
                                            
                                            {{ Form::select('Attch_Ty',\App\Enums\Hr\HrAstAttachType::toSelectArray($attachment->Attch_Ty) ,$attachment->Attch_Ty,
                                            array_merge(['disabled'=>'disabled','class' => 'form-control Attch_Ty p-5'])) }} 

                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-15 p-0">
                                        <label id="Attch_Desc" class="col-md-3 p-0">{{trans('hr.Attch_Desc')}}</label>
                                        <div class="form-group">
                                            <div disabled class="form-control col-md-9">{{$attachment->Attch_Desc}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-15 p-0">
                                        <label class="col-md-4">{{trans('hr.photo')}}</label>
                                        <div class="form-group mt-15">
                                            @if($attachment->Photo != null)
                                            <img src="{{asset($attachment->Photo)}}" class="img-responsive" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
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
