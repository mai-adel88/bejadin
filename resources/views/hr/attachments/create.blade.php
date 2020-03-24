@extends('hr.index')

@section('title', trans('hr.add_new_attachment'))
@section('root_link', route('attachments.index'))
@section('root_name', trans('hr.attachments'))



@section('content')
        @push('css')
            <style>
                .p-0{ padding:0px; }
                .mp-0{ padding:0px;margin:0; }
                .mt-15{ margin-top:15px; }
                .pt-3{ padding-top: 3px; }
                .color-red{ color:red; }
                .br-4{ border-radius: 4px;}
            </style>

        @endpush
        @push('js')
            <script>

            // employees from selected company
            $(".Cmp_No").change(function () {
                    $.ajax({
                        url : "{{route('getemployees')}}",
                        type : 'get',
                        dataType:'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success : function(data){
                            // alert();
                            $('.Emp_No').html(data)
                        }
                    });
                });
                // employees type from selected employee
                $(document).on('change', '.Emp_No', function(){
                        // alert('hh');
                        $.ajax({
                            url : "{{route('getemployeeType')}}",
                            type : 'get',
                            dataType:'json',
                            data: {"_token": "{{ csrf_token() }}", Emp_No: $(this).val() },
                            success : function(data){
                                // alert();
                                $('#Emp_Type').val(data)
                            }
                        });
                    });

                $('.select2').select2({
                    dir: "{{direction()}}",
                    width: "100%"
                });

                // preview image before upload
                function readURL(input){
                    if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){

                    $('#preview').removeClass('d-none');
                    $('#preview img').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                    }
                }
                $(document).on('change','input[type="file"]',function(){
                    readURL(this);
                });



        // add another new attachment
        $(document).ready(function () {
            $('#appendNewAttachment').click(function (e) {
                
                e.preventDefault();
                let parentDiv = $('.appendDiv');
                parentDiv.append(`
                    <div class="form-group">
                    
                        <!-- نوع المرفق -->
                        <div class="row">
                            <div class="col-md-2">
                                <label class="col-md-6">{{trans('hr.numberr')}}</label>
                                <input class="col-md-6 form-control" value="{{$last}}" name="Attch_No" readonly="readonly" id="Attch_No">
                            </div>

                            <div class="col-md-3">
                                <label class="col-md-4 p-0">{{trans('hr.attach_type')}}</label>
                                <div class="col-md-8 p-0">
                                    {{ Form::select('Attch_Ty',\App\Enums\Hr\HrAstAttachType::toSelectArray() ,null,
                                    array_merge(['class' => 'form-control Attch_Ty p-5'])) }}
                                </div>
                            </div>

                            <!-- photo -->
                            <div class="col-md-2">
                                <div class="form-group mt-15">
                                    <input type="file" name="Photo" id="Photo" class="Photo">
                                </div>
                            </div>
                            <div id="preview" class="form-group">
                                <img src="" class="Photo img-responsive" alt="">
                            </div>
                            <!-- photo -->
                        </div>
                        <a style="margin-right: 10px" id="deleteLink" onclick="$(this).parent().remove()" class="btn btn-danger" href="#"><i class="fa fa-close"></i></a>
                        
                   </div>
                `);
            });
        })

            </script>

        @endpush
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {!! Form::open(['method'=>'POST','route' => 'attachments.store','files'=> true]) !!}

                <div class="col-md-12 card text-white bg-info mb-3" style="margin-bottom: 15px;">
                    <div class="card-header">
                        <!-- <h3 class="box-title">{{trans('hr.attachments')}} -->
                            {{Form::submit(trans('admin.create'),['class'=>'btn mt-15', 'style'=>'background-color: #538a9e;color:#fff;float:left;'])}}
                        <!-- </h3> -->
                    </div>
                    <div class="card-body">
                        <!-- <h5 class="card-title">Info card title</h5> -->
                        <div class="col-md-2 mt-15">
                            <label class="col-md-6">{{trans('hr.numberr')}}</label>
                            <input class="col-md-6 form-control" value="{{$last}}" name="Attch_No" readonly="readonly" id="Attch_No">
                        </div>

                        <div class="col-md-12 appendDiv" style="margin-bottom: 10px;margin-top:20px;">
                            <div class="form-group row">

                                <div class="col-md-5">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label class="col-md-3">{{trans('hr.company')}} <span class="color-red"> * </span> </label>
                                            <div class="col-md-9 p-0">
                                                <select name="Cmp_No" class="select2 Cmp_No form-control">
                                                    <option disabled selected>{{trans('admin.select')}}</option>
                                                    @foreach($companies as $mainCompany)
                                                        <option value="{{$mainCompany->Cmp_No}}">{{$mainCompany->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label class="col-md-3">{{trans('hr.employee')}}<span class="color-red"> * </span></label>
                                            <div class="col-md-9 p-0">
                                                <select name="Emp_No" class="Emp_No select2 form-control">
                                                    <option disabled selected>{{trans('admin.select')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label id="Attch_Desc" class="col-md-3">{{trans('hr.Attch_Desc')}}</label>
                                            <div class="form-group">
                                                {{Form::text('Attch_Desc', '',['for'=>'Attch_Desc','class' => 'br-4 col-md-9 form-control Attch_Desc', 'placeholder' => trans('hr.Attch_Desc')])}}
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end of first right row col-md-5 -->
                            
                                <div class="col-md-3">
                                    <!-- تصنيف العمالة -->
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label class="col-md-6 p-0">{{trans('hr.emp_type')}} <span class="color-red"> * </span></label>
                                            <div class="col-md-6 p-0">
                                            <input id="Emp_Type" readonly value="" name="emp_type" class="br-4 form-control emp_type" type="text" placeholder="{{ trans('hr.emp_type')}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- photo -->
                                    <div class="col-md-12">
                                        <label id="photo" class="col-md-4 p-0">{{trans('hr.photo')}}<span class="color-red"> * </span></label>
                                        <input for="photo" type="file" name="Photo" id="Photo" class="p-0 col-md-8 Photo">
                                    </div>
                                    <div id="preview" class="form-group">
                                        <img src="" class="Photo img-responsive" alt="">
                                    </div>
                                    <!-- photo -->
                                </div> <!-- end of col-md-3 -->
                                <div class="col-md-4">
                                    <!-- نوع المرفق -->
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label class="col-md-4 p-0">{{trans('hr.attach_type')}} <span class="color-red"> * </span></label>
                                            <div class="col-md-8 p-0">
                                                {{ Form::select('Attch_Ty',\App\Enums\Hr\HrAstAttachType::toSelectArray() ,null,
                                                array_merge(['class' => 'br-4 form-control Attch_Ty p-5 pt-3'])) }}
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end of col-md-4 -->
                            </div> <!-- end of form-group row row -->
                            
                        </div> <!-- end of col-md-12-->

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
