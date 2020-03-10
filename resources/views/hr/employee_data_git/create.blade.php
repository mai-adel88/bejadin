@extends('hr.index')

@section('root_name', trans('hr.title'))
@section('content')
        @push('css')
            <style>
            
                .datepicker{direction: rtl;}
                .nav-tabs.nav-justified>.active>a, .nav-tabs.nav-justified>.active>a:focus, .nav-tabs.nav-justified>.active>a:hover{
                    border-top: 1px groove black;
                    background: #8e8e8e5c;
                    border-radius: 0;
                    font-weight: bold;
                }

                .input_number{
                    max-width: 100%;
                    height: 30px;
                    font-size: 14px;
                    line-height: 1.42857143;
                    text-align: center;
                    color: #555;
                    background-color: #fff;
                    background-image: none;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
                    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                }
                .mr-lr-2{
                    margin: 0 5px;
                }
                .n-mp{
                    margin:0;
                    padding: 0;
                }
                .p-0{
                    padding:0;
                }
                .m-0{
                    margin:0;
                }
                .ptb-initial{
                    padding-top: initial;
                    padding-bottom: initial;
                    padding-left: 0;
                    padding-right: 0;
                }
                .pl-0{
                    padding-left:0;
                }
                .pr-5{
                    padding-right:5px;
                }
                .pr-3 {
                    padding-right:3px;
                }
                .mr-5{
                    margin-right:5px;
                }
                .pl-0{
                    padding-left:0px;
                }
                .mt-5
                {
                    padding-top:5px;
                    margin-top: 5px;
                }
                .ml-5{
                    margin-left: 5px;
                }
                .pr-0{
                    padding-right:0;
                }
                .fourth__first__row{
                    margin-right: 0;
                    padding-right: 0;
                }
                .fs-12{
                    font-size: 12px;
                }
                .fs-13{
                    font-size: 13px;
                }
                .mb-15{
                    margin-bottom:15px;
                }
                .p-lr-15{
                    padding-left: 15px;
                    padding-right: 15px;
                }
                .select__vacancypadding{
                    padding: : 3px 6px;
                    border-radius: 4px;
                }
                .vacancy__select-single .select2-container--default .select2-selection--single{
                    padding: 3px 0 !important;
                }

                .select__p-0 .select2-container--default .select2-selection--single,
                .select2-container[dir="rtl"] .select2-selection--single .select2-selection__rendered{
                    padding: 0;
                }
                .passport__col_border{
                    border: 1px solid #ccc;
                    margin: 0 7px;
                }

                fieldset
                {
                    border: 1px solid #ddd !important;
                    margin: 0;
                    min-width: 0;
                    padding: 10px;
                    position: relative;
                    border-radius:4px;
                    background-color:#f5f5f5;
                    padding-left:10px!important;
                }

                legend
                {
                    font-size:14px;
                    font-weight:bold;
                    margin-bottom: 0px;
                    width: 100%;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    padding: 5px 5px 5px 10px;
                    background-color: #ffffff;
                }
                .br-5{
                    border-radius: 5px;
                }
                .mr-10{
                    margin-right: 10px;
                }
                .pl-pr-15{
                    padding-left: 15px;
                    padding-right: 15px;
                }
                .mr-15{
                    margin-right: 15px;
                }
                .p-7-2{
                    padding: 7px 2px;
                }
                .mt-15{
                    margin-top:15px;
                }

                .Professional_license,
                .nav-tabs.nav-justified>.active>a,
                .nav-tabs.nav-justified>.active>a:focus,
                .nav-tabs.nav-justified>.active>a:hover{
                    font-weight: 500;
                }
                .head__first_row{
                    border: 1px solid rgb(204, 204, 204);
                    background: #ddd;
                    padding: 10px 0;
                    margin: 0px 0px 20px;
                }
            </style>
        @endpush
        @push('js')
       
            <script>
            

                $('.datepicker').datepicker();

                $(document).ready(function () {

                    /***************************التعاقد****************************/
                    //تاريخ بداية التعاقد
                    $('input.Cnt_Stdt').change(function () {
                        let Hijri = $(this).val();
                        $.ajax({
                            url: "{{route('hijri')}}",
                            type: 'get',
                            data:{Hijri: Hijri} ,
                            dataType: 'json',
                            success: function (data) {
                                $('.Cnt_StdtHij').val(data);
                            }
                        });
                    });

                    //تاريخ نهاية التعاقد
                    $('input.Cnt_Endt').change(function () {
                        let Hijri = $(this).val();
                        $.ajax({
                            url: "{{route('hijri')}}",
                            type: 'get',
                            data:{Hijri: Hijri} ,
                            dataType: 'json',
                            success: function (data) {
                                $('.Cnt_EndtHij').val(data);
                            }
                        })
                    });
                    //تاريخ تجديد التعاقد
                    $('input.Cnt_Nwdt').change(function () {
                        let Hijri = $(this).val();
                        $.ajax({
                            url: "{{route('hijri')}}",
                            type: 'get',
                            data:{Hijri: Hijri} ,
                            dataType: 'json',
                            success: function (data) {
                                $('.Cnt_NwdtHij').val(data);
                            }
                        })
                    });

                    //حساب اجمالي الراتب
                    $(document).on('keyup', '#Bsc_Salary ,#Add_Alw, #Hous_Alw,#Wrk_Hour, #Trnsp_Alw, #Food_Alw, #ALw2, #ALw1, #ALw4, #ALw3, #Other_Alw, #ALw5', function() {
                        var Bsc_Salary  = $('#Bsc_Salary').val();
                        var Add_Alw     = $('#Add_Alw').val();
                        var Hous_Alw    = $('#Hous_Alw').val();
                        var Trnsp_Alw   = $('#Trnsp_Alw').val();
                        var Food_Alw    = $('#Food_Alw').val();
                        var ALw2        = $('#ALw2').val();
                        var ALw1        = $('#ALw1').val();
                        var ALw4        = $('#ALw4').val();
                        var ALw3        = $('#ALw3').val();
                        var Other_Alw   = $('#Other_Alw').val();
                        var ALw5        = $('#ALw5').val();

                        var Total = (Number(Bsc_Salary) + Number(Add_Alw)+ Number(Hous_Alw)+ Number(Trnsp_Alw)
                                    + Number(Food_Alw)+ Number(ALw2)+Number(ALw1)+ Number(ALw4)+ Number(ALw3)+ Number(Other_Alw)+ Number(ALw5));
                        $('#Gross_Salary').val(Total);


                    });

                    //حساب تكلفة الساعه[الثابت]
                    $(document).on('change', '#Bsc_Salary, #Wrk_Hour', function () {
                        var Wrk_Hour    = $('#Wrk_Hour').val(); //عدد ساعات العمل
                        var Bsc_Salary  = $('#Bsc_Salary').val();
                        if(Wrk_Hour != 0){
                            var hourly_cost =( ((Number(Bsc_Salary) / 30)) / Number(Wrk_Hour) );

                            $('#Wrk_CostHour').val(hourly_cost.toFixed(2));
                        }
                    });

                    //حساب تكلفة الساعه[الاجمالي]
                    $(document).on('change', '#Wrk_Hour', function () {
                        var Wrk_Hour    = $('#Wrk_Hour').val(); //عدد ساعات العمل
                        var Gross_Salary= $('#Gross_Salary').val();
                        if(Wrk_Hour != 0){
                            var hourly_cost =( ((Number(Gross_Salary) / 30)) / Number(Wrk_Hour) );

                            $('#Total_Wrk_CostHour').val(hourly_cost.toFixed(2));
                        }
                    });

                    //حساب الراتب بالبونص
                    $(document).on('change', '#Bouns_Prct', function () {
                        var Bouns = $(this).val();
                        var Bsc_Salary  = $('#Bsc_Salary').val();
                        var percentage = Number(Bsc_Salary)*(Number(Bouns) /100);
                        var res = Number(percentage) + Number(Bsc_Salary);

                        $('#Gross_Salary').val(res);
                    });

                    /***************************نهاية التعاقد****************************/

                    $('.select_com_td select').select2({
                        dir: "{{direction()}}",
                        width: "100%"
                    });
                    $('.select2').select2({
                        dir: "{{direction()}}",
                        width: "100%"
                    });

                    $('input[type=checkbox].all_com').each(function () {
                        if($(this).attr('checked') === 'checked'){
                            $(this).parent('td').next('td.select_com_td').children('.select2-container').css({
                                visibility: 'hidden'
                            });
                        }
                        $(this).click(function () {
                            if ($(this).is(':checked')) {
                                $(this).parent('td').next('td.select_com_td').children('.select2-container').css({
                                    visibility: 'hidden'
                                });
                                $(this).parent('td').next('td.select_com_td').children('select').val('null');

                            } else {
                                $(this).parent('td').next('td.select_com_td').children('.select2-container').css({
                                    visibility: 'visible'
                                })
                            }
                        })
                    });
                })

                // تاريخ التعيين
                $('input.Start_Date').change(function () {
                    let Hijri = $(this).val();
                    $.ajax({
                        url: "{{route('hijri')}}",
                        type: 'get',
                        data:{Hijri: Hijri} ,
                        dataType: 'json',
                        success: function (data) {
                            $('.Start_DateHij').val(data);
                        }
                    })
                });
                
                // تاريخ مباشره العمل
                $('input.On_WorkDt').change(function () {
                    let Hijri = $(this).val();
                    $.ajax({
                        url: "{{route('hijri')}}",
                        type: 'get',
                        data:{Hijri: Hijri} ,
                        dataType: 'json',
                        success: function (data) {
                            $('.On_WorkDtHij').val(data);
                        }
                    })
                });
                // انهاء التجربة
                $('input.End_Tstdt').change(function () {
                    let Hijri = $(this).val();
                    $.ajax({
                        url: "{{route('hijri')}}",
                        type: 'get',
                        data:{Hijri: Hijri} ,
                        dataType: 'json',
                        success: function (data) {
                            $('.End_TstdtHij').val(data);
                        }
                    })
                });
                // تاريخ استحقاق الاجازة
                $('input.DueDt_Hldy').change(function () {
                    let Hijri = $(this).val();
                    $.ajax({
                        url: "{{route('hijri')}}",
                        type: 'get',
                        data:{Hijri: Hijri} ,
                        dataType: 'json',
                        success: function (data) {
                            $('.DueDt_HldyHij').val(data);
                        }
                    })
                });
                // تاريخ استحقاق التذكرة
                $('input.DueDt_Tkt').change(function () {
                    let Hijri = $(this).val();
                    $.ajax({
                        url: "{{route('hijri')}}",
                        type: 'get',
                        data:{Hijri: Hijri} ,
                        dataType: 'json',
                        success: function (data) {
                            $('.DueDt_TktHij').val(data);
                        }
                    })
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
                // deparment for company
                $(".Cmp_No").change(function () {
                    $.ajax({
                        url : "{{route('getdepartment')}}",
                        type : 'get',
                        dataType:'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success : function(data){
                            // alert();
                            $('.SubCmp_No').html(data)
                        }
                    });
                });

                //رقم الموظف بالقسم
                $(document).on('change', '.SubCmp_No', function(){
                    // alert('hh');
                    $.ajax({
                        url : "{{route('createEmpSubNo')}}",
                        type : 'get',
                        dataType:'json',
                        data: {"_token": "{{ csrf_token() }}", SubCmp_No: $(this).val() },
                        success : function(data){
                            // alert();
                            $('#Emp_SubNo').val(data)
                        }
                    });
                });
            </script>

        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.employee_basic_data')}}</h3>
            </div>
            <div class="box-body">
                @include('admin.layouts.message')
                {!! Form::open(['method'=>'POST','route' => 'employeeData.store','files'=> true]) !!}
                <div class="col-md-12 mb-15">
                    {{Form::submit(trans('admin.create'),['class'=>'btn', 'style'=>'background-color: #538a9e;color:#fff;float:left;'])}}

                </div>

                <br>
                <!-- tap container -->
                
                <!-- last of day -->
                <div class="col-md-12">
                    <div class="col-md-12 well">

                        <div class="row form-group">
                                <div class="col-md-5">
                                    <label class="col-md-3">{{trans('hr.company')}}</label>
                                    <div class="col-md-9 p-0">
                                        <select name="Cmp_No" class="Cmp_No form-control">
                                            <option value="" disabled selected>{{trans('admin.select')}}</option>
                                            @foreach($companies as $mainCompany)
                                                <option value="{{$mainCompany->Cmp_No}}">{{$mainCompany->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- القسم -->
                                <div class="col-md-4 p-0">
                                    <label class="col-md-4 ">{{trans('hr.dep')}}</label>
                                    <div class="col-md-8">
                                        <select name="SubCmp_No" class="SubCmp_No form-control">
                                            <option value="">{{trans('admin.select')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- رقم الموظف بالقسم -->
                                <div class="col-md-3">
                                    <label for="Emp_SubNo" class="col-md-6 p-0">{{trans('hr.dep_no')}}</label>
                                    <input id="Emp_SubNo" readonly value="" name="Emp_SubNo" class="Emp_SubNo form-control col-md-6" type="text">
                                </div>
                        </div> <!-- end of first row -->

                        <div class="row form-group mt-15">
                            <!-- تصنيف العمالة -->
                            <div class="col-md-5">
                                <label class="col-md-4 p-0">{{trans('hr.emp_class')}}</label>
                                <div class="col-md-8 p-0">
                                    {{ Form::select('Emp_Type',\App\Enums\CompanyEmployeeClass::toSelectArray() ,null,
                                    array_merge(['class' => 'form-control Emp_Type'])) }}
                                </div>
                            </div>
                            <!-- الحاسب الالى -->
                            <div class="col-md-3">
                                <label for="computer" class="col-md-6 p-0">{{trans('hr.computer')}}</label>
                                <input id="computer" readonly name="" class="form-control col-md-6" type="text">
                            </div>
                        </div> <!-- end of second row -->

                    </div>
                    <div class="col-md-12 row form-group">
                        <div class="first__row">
                            <div class="col-md-1 text-center">
                                <label for="Emp_No">{{trans('hr.number')}}</label>
                                <input id="Emp_No" name="Emp_No" value="{{$last}}" placeholder="{{$last}}" readonly type="number" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="col-sm-12 col-md-2" for="Emp_NmAr">{{trans('hr.name')}}</label>
                                <!-- <input id="Emp_NmAr" name="Emp_NmAr" value="" class="Emp_NmAr col-sm-6 col-md-8 input_number" type="text"> -->
                                <input name="Emp_NmAr1" class="Emp_NmAr1 col-sm-6 col-md-2 input_number mr-lr-2" type="text">
                                <input name="Emp_NmAr2" class="Emp_NmAr2 col-sm-6 col-md-2 input_number mr-lr-2" type="text" >
                                <input name="Emp_NmAr3" class="Emp_NmAr3 col-sm-6 col-md-2 input_number mr-lr-2" type="text" >
                                <input name="Emp_NmAr4" class="Emp_NmAr4 col-sm-6 col-md-2 input_number " type="text" >
                            </div>
                            <!-- PyCntry الجنسية -->
                            <div class="col-md-2 n-mp">
                                <label for="Cntry_No" class="col-md-6">{{trans('hr.Cntry_No')}}</label>
                                <div class="select_com_td col-md-6 n-mp">
                                    <select id="Cntry_No" name="Cntry_No" class="Cntry_No select2 form-control">
                                    <option value="" disabled selected>{{trans('admin.select')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->country_name_ar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Birth_Date تاريخ الميلاد -->
                            <div class="col-md-3">
                                <label class="col-md-5 p-0" for="Birth_Date">{{trans('hr.birth_date')}}</label>
                                <input type="text" name="Birth_Date" id="Birth_Date" class="Birth_Date p-0 col-md-7 datepicker form-control">
                            </div>
                        </div><!-- end of first row -->
                        <div class="second__row">

                            <div class="col-md-6 col-sm-12 mt-5">
                                <label class="col-sm-12 col-md-2 p-0" for="Emp_NmEn">{{trans('hr.english_name')}}</label>
                                <!-- <input id="Emp_NmEn" hidden name="Emp_NmEn" value="nameEn" class="Emp_NmEn col-sm-6 col-md-8 input_number " type="text"> -->
                                <input name="Emp_NmEn1" class="col-sm-6 col-md-2 input_number mr-lr-2" type="text">
                                <input name="Emp_NmEn2" class="col-sm-6 col-md-2 input_number mr-lr-2" type="text" >
                                <input name="Emp_NmEn3" class="col-sm-6 col-md-2 input_number mr-lr-2" type="text" >
                                <input name="Emp_NmEn4" class="col-sm-6 col-md-2 input_number " type="text" >
                            </div>
                            <!-- // الديانة Reljan -->
                            <div class="col-md-2 n-mp mt-5">
                                <label class="col-md-6">{{trans('hr.religion')}}</label>
                                <div class="col-md-6 n-mp">
                                    {{ Form::select('Reljan',\App\Enums\ReligionType::toSelectArray() ,null,
                                    array_merge(['class' => 'Reljan form-control','placeholder'=>trans('admin.select')])) }}
                                </div>
                            </div>
                            <!-- Birth_Plac مكان الميلاد -->
                            <div class="col-md-3 mt-5">
                                <label class="col-md-5 p-0" for="Birth_Plac">{{trans('hr.birth_place')}}</label>
                                <input id="Birth_Plac" type="text" name="Birth_Plac" class="Birth_Plac input_number col-md-7 p-0 form-control">
                            </div>
                        </div> <!-- end of second second row -->
                    </div>
                    <div class="row form-group col-md-10">
                        <div class="col-md-12 p-0 m-0">
                            <!-- خارجى -->
                            <div class="col-md-1 p-0">
                                <input id="Int_Ext_1" type="radio" value="1" name="Int_Ext" class="Int_Ext col-md-2 radio-inline">
                                <label for="Int_Ext_1" class="col-md-10 pl-0 p-0">{{trans('hr.external')}}</label>
                            </div>
                            <!-- داخلى -->
                            <div class="col-md-1 p-0">
                                <input id="Int_Ext_2" type="radio" value="2" name="Int_Ext" class="Int_Ext p-0 col-md-6 radio-inline">
                                <label for="Int_Ext_2" class="col-md-6 p-0 pr-5">{{trans('hr.internal')}}</label>
                            </div>
                            <div class="col-md-2 P-0">
                                <input id="Under_Test" type="checkbox" value="1" name="Under_Test" class="Under_Test col-md-2 radio-inline">
                                <label for="Under_Test" class="col-md-10 p-0">{{trans('hr.under_exp')}}</label>
                            </div>
                            <div class="row form-group" style="margin-right: 69px;">
                            @foreach(\App\Enums\GenderType::toSelectArray() as $key => $value)
                                <input id="{{$value}}" class="checkbox-inline" type="radio"
                                        name="Gender" value="{{$key}}"
                                        style="" @if($key == 1) checked @endif>
                                <label for="{{$value}}">{{$value}}</label>
                            @endforeach
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label class="col-sm-3 p-0" for="Start_Date">{{trans('hr.Start_Date')}}</label>
                                    <input type="text" name="Start_Date" id="Start_Date" class="Start_Date col-sm-4 form-control datepicker" style="margin-bottom: 5px;">
                                    <input type="text" name="Start_DateHij" class="Start_DateHij mr-5 col-sm-4 form-control">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="Residn_Chld" class="col-md-5 form-control" placeholder="{{trans('hr.Residn_Chld')}}" style="text-align: center; margin-left: 5px;margin-right: -28px;">
                                    <input type="text" style="text-align: center;" name="Blood_Type" class="col-md-6 form-control" placeholder="{{trans('hr.blood')}}">
                                </div>
                            </div>
                        </div> <!-- end of third row col-md-12 -->

                        <div class="fourth__row">
                            <div class="row col-md-12">
                                <div class="row col-md-6 p-0 ml-5">
                                    <div class="col-md-12 form-group row n-mp">
                                        <label class="col-sm-4 p-0 mb-5" for="On_WorkDt_g">{{trans('hr.work_date')}}</label>
                                        <input type="text" style="margin-bottom: 5px;" name="On_WorkDt" id="On_WorkDt_g" class="On_WorkDt col-sm-4 form-control datepicker">
                                        <input type="text" name="On_WorkDtHij" class="On_WorkDtHij mr-5 col-sm-3 form-control">
                                    </div>
                                    <div class="col-md-12 form-group row n-mp" style="margin-bottom: 5px;">
                                        <label class="col-sm-4 p-0 " for=""> انهاء التجربة </label>
                                        <input type="text" name="End_Tstdt" id="" class="End_Tstdt col-sm-4 form-control Doc_Dt datepicker">
                                        <input type="text" name="End_TstdtHij" id="" class="End_TstdtHij mr-5 col-sm-3 form-control Doc_Dt">
                                    </div>
                                    <div class="form-group row p-0">
                                        <label class="col-md-4" style=""> الحالة</label>
                                        {{ Form::select('Job_Stu',\App\Enums\JobStatus::toSelectArray() ,null,
                                        array_merge(['class' => 'form-control col-md-7','placeholder'=>trans('admin.select')])) }}
                                    </div>

                                    <div class="col-md-12 form-group row n-mp">
                                        <label for="Job_Date" class="col-sm-4 p-0 " for=""> {{trans('hr.Job_Date')}}  </label>
                                        <input type="text" name="Job_Date" id="Job_Date" class="col-sm-7 form-control Job_Date datepicker">

                                    </div>
                                </div> <!-- end of first col-md-4-->
                                <div class="col-md-5">
                                    <!-- Depm_No الادارة HrAstDeprtmnt -->
                                    <div class="col-md-12 form-group">
                                        <label class="col-md-4">{{trans('hr.Depm_No')}}</label>
                                        <div class="col-md-8">
                                            <select name="Depm_No" class="Depm_No form-control">
                                            <option>{{trans('admin.select')}}</option>
                                            @foreach($administrations as $admin)
                                                <option value="{{$admin->Class_No}}">{{$admin->{'Class_Nm'.ucfirst(session('lang'))} }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--   القسم بالادارة-->
                                    <div class="col-md-12 form-group">
                                        <label class="col-md-6">القسم بالادارة</label>
                                        <div class="col-md-6">
                                            <select name="" class="form-control">
                                                <option value=""></option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- jobs الوظائف --}}
                                    <div class="col-md-12 form-group">
                                        <label for="Job_No" class="col-md-4">{{trans('hr.Job_No')}}</label>
                                        <div class="col-md-8">
                                            <select id="Job_No" name="Job_No" class="form-control">
                                                @foreach($jobs as $job)
                                                <option value="{{$job->Job_No}}" name="Job_No">{{$job->{'Job_Nm'.ucfirst(session('lang'))} }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="col-md-4">{{trans('hr.Ownr_No')}}</label>
                                        <div class="col-md-8">
                                            <select name="Ownr_No" class="Ownr_No form-control" id="Ownr_No">
                                                <option value=""></option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-12">

                                    <!-- Status_Type الحالة الاجتماعية -->
                                    <div class="col-md-4 form-group">
                                        <label for="Status_Type" class="col-md-6 p-0">{{trans('hr.Status_Type')}}</label>
                                        <div id="Status_Type" class="col-md-6 p-0">
                                            {{ Form::select('Status_Type',\App\Enums\SocialType::toSelectArray() ,null,
                                                array_merge(['id'=>'Status_Type', 'class' => 'Status_Type form-control'])) }}
                                        </div>
                                    </div>
                                    <!-- EducationType الحالة التعليمية -->
                                    <div class="col-md-4 form-group">
                                            <label class="col-md-6 p-0">{{trans('hr.Educt_Type')}}</label>
                                            <div class="col-md-6 p-0">
                                                {{ Form::select('Educt_Type',\App\Enums\Hr\EducationType::toSelectArray() ,null,
                                                    array_merge(['id'=>'Educt_Type', 'class' => 'Educt_Type form-control ','placeholder'=>trans('admin.select')])) }}
                                            </div>
                                    </div>
                                    <!-- EmpType_No فئات الموظفين -->
                                    <div class="col-md-4 form-group">
                                        <label class="col-md-6 p-0">{{ trans('admin.EmpType_No')}}</label>
                                        <div class="col-md-6 p-0">
                                            {{ Form::select('EmpType_No',\App\Enums\Hr\EmployeeClass::toSelectArray() ,null,
                                                array_merge(['class' => 'form-control EmpType_No','placeholder'=>trans('admin.select')])) }}
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end of second col-md-4 -->

                        </div>
                        
                    </div>
                        <div id="preview" class="col-md-2">
                        <img name="Photo[]" src="" class="Photo img-responsive" alt="">
                        </div>
                        <div class="col-md-2 mt-15">
                            <input type="file" name="Photo[]" id="Photo" class="Photo">
                        </div>
                    </div>
                     <!-- end of third row col-md-10 -->

                  <!--end of head__first_row-->

                <div class="tail__second_row">
                    <ul class="nav nav-tabs nav-justified" id="myTab1" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#vacancies" role="tab" aria-controls="home"
                            aria-selected="true">{{trans('hr.vacancies')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab1" data-toggle="tab" href="#contract" role="tab" aria-controls="profile"
                            aria-selected="false">{{trans('hr.contract')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#titles" role="tab" aria-controls="profile"
                            aria-selected="false">{{trans('hr.titles')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="Professional_license nav-link" id="profile-tab2" data-toggle="tab" href="#Professional_license" role="tab" aria-controls="profile"
                            aria-selected="false">{{trans('hr.Professional_license')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#Passport_data" role="tab" aria-controls="profile"
                            aria-selected="false">{{trans('hr.Passport_data')}}</a>
                        </li>
                        <li class="nav-item">
                        <a href="#identity" aria-controls="profile" role="tab" data-toggle="tab">{{trans('hr.identity')}}</a>
                        </li>

                    </ul>
                    <!-- tap container -->
                    <div class="tab-content" id="myTabContent1">
                        <!-- first tap -->
                        <div class="tab-pane fade show active in" id="vacancies" role="tabpanel" aria-labelledby="home-tab">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row p-0">
                                        <div class="row col-md-3 fourth__first__row ml-5">
                                        <!-- HLdy_Ty استحقاق الاجازة -->
                                            <div class="vacancy__select-single col-md-12 form-group">
                                                <label class="col-md-6 ptb-initial fs-12">{{ trans('admin.HLdy_Ty')}}</label>
                                                <div class=" col-md-6 ptb-initial">
                                                    {{ Form::select('HLdy_Ty',\App\Enums\Hr\AstcHldyEarn::toSelectArray() ,null,
                                                    array_merge(['class' => 'form-control', 'placeholder'=>trans('admin.select')])) }}
                                                </div>
                                            </div>
                                            <!-- DueDt_Hldy تاريخ استحقاق الاجازة -->
                                            <div class="col-md-12 form-group">
                                                <label class="col-sm-6 p-0 fs-12" for="DueDt_Hldy"> {{trans('hr.DueDt_Hldy')}} </label>
                                                <input type="text" name="DueDt_Hldy" id="DueDt_Hldy" class="DueDt_Hldy col-sm-6 form-control datepicker">
                                            </div>
                                            <!-- تاريخ استحقاق التذكرة  -->
                                            <div class="col-md-12 form-group">
                                                <label class="col-sm-6 p-0 fs-12" for="DueDt_Tkt">{{trans('hr.DueDt_Tkt')}}  </label>
                                                <input type="text" name="DueDt_Tkt" id="DueDt_Tkt" class="col-sm-6 form-control DueDt_Tkt datepicker">
                                            </div>
                                        </div> <!-- end of first col-md-4-->
                                        <div class="col-md-3 row p-0">
                                            <div class="col-md-12 p-0">
                                                <div class="form-group row">
                                                    <div class="col-md-6 p-0">
                                                        <label class="col-md-5 p-0"> مدة الاجازة</label>
                                                        <input type="text" name="HLd_Period" class="p-0 col-md-4 form-control">
                                                    </div><!-- end third col-md-2 -->
                                                    <div class="col-md-6 row p-0">
                                                        <label class="col-md-8 p-0">  مدة العقد / سنة</label>
                                                        <input type="text" name="Cnt_Period" class="p-0 col-md-4 form-control">
                                                    </div> <!-- end third col-md-2 -->
                                                </div>
                                                <div class="form-group row">
                                                <!-- DueDt_HldyHij تاريخ استحقاق الاجازة هجرى -->
                                                    <div class="form-group p-lr-15">
                                                        <label class="col-md-2 p-0 fs-12" for="DueDt_HldyHij">{{trans('hr.hijri')}}</label>
                                                        <input type="text" name="DueDt_HldyHij" id="DueDt_HldyHij" class="hijri-date-input mb-15 col-md-9 form-control DueDt_HldyHij ">
                                                    </div>
                                                    <div class="form-group p-lr-15">
                                                        <label class="col-md-2 p-0 fs-12" for="DueDt_TktHij">{{trans('hr.hijri')}}</label>
                                                        <input type="text" name="DueDt_TktHij" id="DueDt_TktHij" class="mb-15 col-md-9 form-control DueDt_TktHij ">
                                                    </div>
                                                    <div class="form-group p-lr-15">
                                                        <label class="col-md-7 p-0 fs-12" for="Start_Paid"> {{trans('hr.Start_Paid')}} </label>
                                                        <input type="text" name="Start_Paid" id="Start_Paid" class="Start_Paid mb-15 col-md-2 form-control">
                                                    </div>
                                                    <div class="form-group p-lr-15">
                                                        <label class="col-md-7 p-0 fs-12" for="Start_UnPaid"> {{trans('hr.Start_UnPaid')}}  </label>
                                                        <input type="text" name="Start_UnPaid" id="Start_UnPaid" class="Start_UnPaid mb-15 col-md-2 form-control ">
                                                    </div>

                                                </div>
                                            </div>
                                        </div> <!-- end col-md-4 -->
                                        <div class="col-md-6 row p-0">

                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-md-1"></label>
                                                    <label class="col-md-2">وسيلة السفر</label>
                                                    <label class="col-md-2">عدد التذاكر</label>
                                                    <label class="col-md-3">الدرجة</label>
                                                    <label class="col-md-4">اتجاة التذكرة</label>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="The_employee" class="col-md-1 p-0">{{trans('hr.The_employee')}}</label>
                                                    <div class="col-md-2">
                                                    {{ Form::select('HldTrnsp_No',\App\Enums\Hr\HrTransType::toSelectArray() ,null,
                                                        array_merge(['id'=>'HldTrnsp_No', 'class' => 'select2 form-control HldTrnsp_No','placeholder'=>trans('admin.select')])) }}
                                                    
                                                    </div>
                                                    <!-- Tkt_No عدد التذاكر  -->
                                                    <div class="col-md-2">
                                                        <input type="text" name="Tkt_No" class="input_number">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input name="Tkt_Class" type="text" class="input_number">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="Tkt_Sector" class="input_number">
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-1 p-0">{{trans('hr.husband')}}</label>
                                                    <div class="col-md-2">
                                                    {{ Form::select('HldTrnsp_No1',\App\Enums\Hr\HrTransType::toSelectArray() ,null,
                                                        array_merge(['id'=>'HldTrnsp_No1', 'class' => 'select2 form-control HldTrnsp_No1','placeholder'=>trans('admin.select')])) }}
                                                    
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="Tkt_No1" class="input_number">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="Tkt_Class1" class="input_number">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="Tkt_Sector1" class="input_number">
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-1 p-0">{{trans('hr.boys')}}</label>
                                                    <div class="col-md-2">
                                                    {{ Form::select('HldTrnsp_No2',\App\Enums\Hr\HrTransType::toSelectArray() ,null,
                                                        array_merge(['id'=>'HldTrnsp_No2', 'class' => 'select2 form-control HldTrnsp_No2','placeholder'=>trans('admin.select')])) }}
                                                    
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="Tkt_No2" class="input_number">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="Tkt_Class2" min="1" class="input_number">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="Tkt_Sector2" min="1" class="input_number">
                                                    </div>

                                                </div>
                                            </div>

                                        </div> <!-- end of col-md-6 -->
                                    </div> <!-- end of row -->
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <fieldset id="tableFilter">
                                                    <legend>وقت استحقاق التذاكر</legend>
                                                    <!-- عند الاستقدام -->
                                                    <div class="row">
                                                        <input id="Tkt_Ty1" type="checkbox" value="1" name="Tkt_Ty1" class="Tkt_Ty1 col-md-2 radio-inline">
                                                        <label for="Tkt_Ty1" class="col-md-10 p-0">{{ trans('admin.Tkt_Ty1') }}</label>
                                                    </div>
                                                    <!-- عند الاجازة السنوية -->
                                                    <div class="row">
                                                        <input id="Tkt_Ty2" type="checkbox" value="1" name="Tkt_Ty2" class="Tkt_Ty2 col-md-2 radio-inline">
                                                        <label for="Tkt_Ty2" class="col-md-10 p-0 fs-13">{{ trans('admin.Tkt_Ty2') }}</label>
                                                    </div>
                                                    <!-- عند نهاية العقد -->
                                                    <div class="row">
                                                        <input id="Tkt_Ty3" type="checkbox" value="1" name="" class="Tkt_Ty3 col-md-2 radio-inline">
                                                        <label for="Tkt_Ty3" class="Tkt_Ty3 col-md-10 p-0">{{ trans('admin.Tkt_Ty3') }}</label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-10">
                                                <fieldset id="tableFilter">
                                                    <legend>شروط استحقاق التذاكر</legend>
                                                    <!-- لا يتم تعويض التذكرة ان لم يكن الضفر فعلى -->
                                                    <div class="row">
                                                        <input id="Tkt_Ty4" type="checkbox" value="1" name="Tkt_Ty4" class="Tkt_Ty4 col-md-2 radio-inline">
                                                        <label FOR="Tkt_Ty4" class="col-md-10 p-0">{{trans('hr.Tkt_Ty4')}}</label>
                                                    </div>
                                                    <!-- نصف تذكرة فى حالة السفر بالبر او البحر -->
                                                    <div class="row">
                                                        <input id="Tkt_Ty5" type="checkbox" value="1" name="Tkt_Ty5" class="Tkt_Ty5 col-md-2 radio-inline">
                                                        <label FOR="Tkt_Ty5" class="col-md-10 p-0 fs-13">{{trans('hr.Tkt_Ty5')}}</label>
                                                    </div>
                                                    <!-- يحق لنا اختيار ارخص الخطوط سواء مباشرة او غير مياشرة -->
                                                    <div class="row">
                                                        <input id="Tkt_Ty6" type="checkbox" value="1" name="Tkt_Ty6" class="Tkt_Ty6 col-md-2 radio-inline">
                                                        <label FOR="Tkt_Ty6" class="col-md-10 p-0">{{trans('hr.Tkt_Ty6')}}</label>
                                                    </div>
                                                    <!-- السفر اتلفعلى لمحرم المتقاعد -->
                                                    <div class="row">
                                                        <input id="Tkt_Ty7" type="checkbox" value="1" name="Tkt_Ty7" class="Tkt_Ty7 col-md-2 radio-inline">
                                                        <label FOR="Tkt_Ty7" class="col-md-10 p-0">{{trans('hr.Tkt_Ty7')}}</label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- second tap -->
                        <div class="tab-pane fade" id="contract" role="tabpanel" aria-labelledby="home-tab">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="row" style="background-color: #538a9e;color: #fff;margin-top: 10px;">
                                            <div class="col-md-2 p-0 mt-15">
                                                <label class="col-md-8 p-0" style="padding: 0 7px;">{{trans('hr.duration_contract')}}</label>
                                                <input name="Cnt_Period" type="text" class="col-md-4 form-control">
                                            </div>
                                            <div class="col-md-3 p-0 mt-15">
                                                <label class="col-md-6 p-0">{{trans('hr.Huspym_No')}}</label>
                                                <div class="select_com_td col-md-6 p-0">
                                                {{ Form::select('Huspym_No',\App\Enums\HrHousePaymentType::toSelectArray() ,null,
                                                    array_merge(['id'=>'Huspym_No', 'class' => 'select2 form-control Huspym_No','placeholder'=>trans('admin.select')])) }}
                                            
                                                </div>
                                            </div>
                                            <div class="col-md-3 p-0 mt-15">
                                                <label class="col-md-6">{{trans('hr.work_type')}}</label>
                                                <div class="select_com_td col-md-6 p-0">
                                                {{ Form::select('Shift_Type',\App\Enums\ShiftTypes::toSelectArray() ,null,
                                                    array_merge(['id'=>'Shift_Type', 'class' => 'select2 form-control Shift_Type','placeholder'=>trans('admin.select')])) }}
                    
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-15 p-0">
                                                <label class="col-md-6 p-0">{{trans('hr.Salary_Class_No')}}</label>
                                                <div class="select_com_td col-md-6 p-0">
                                                {{ Form::select('Salary_Class_No',\App\Enums\SalaryClassNo::toSelectArray() ,null,
                                                    array_merge(['id'=>'Salary_Class_No', 'class' => 'select2 form-control Salary_Class_No','placeholder'=>trans('admin.select')])) }}
                    
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-15 p-0">
                                                <label class="col-md-6 p-0">طريقة دفع الراتب</label>
                                                <div class="select_com_td col-md-6 p-0">
                                                {{ Form::select('Pymnt_No',\App\Enums\SalaryPaymentWay::toSelectArray() ,null,
                                                    array_merge(['id'=>'Pymnt_No', 'class' => 'select2 form-control Pymnt_No','placeholder'=>trans('admin.select')])) }}
                    
                                                </div>
                                            </div>
                                        </div> <!-- end of first row -->
                                        <div class="row mt-15">
                                            <div class="col-md-2 pr-0">
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.basic_salary')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" type="text" id="Bsc_Salary" name="Bsc_Salary">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.Add_Alw')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" type="text" id="Add_Alw" name="Add_Alw">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.Hous_Alw')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" type="text" id="Hous_Alw" name="Hous_Alw">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.ALw1')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" type="text" id="ALw1" name="ALw1">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.Trnsp_Alw')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" type="text" id="Trnsp_Alw" name="Trnsp_Alw">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.Food_Alw')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" id="Food_Alw" type="text" name="Food_Alw">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.ALw2')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" id="ALw2" type="text" name="ALw2">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.ALw4')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" id="ALw4" type="text" name="ALw4">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.ALw3')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" id="ALw3" type="text" name="ALw3">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.Other_Alw')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" id="Other_Alw" type="text" name="Other_Alw">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.ALw5')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" id="ALw5" type="text" name="ALw5">
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-md-5 pl-0 pr-3 fs-12">{{trans('hr.Gross_Salary')}}</label>
                                                    <input class="col-md-7 br-5 form-control p-7-2" id="Gross_Salary" readonly="readonly" type="text" name="Gross_Salary">
                                                </div>

                                            </div> <!-- end of col-md-3 second row -->

                                            <!-- place of need -->

                                            <div class="col-md-10">
                                                <div class="col-md-3">
                                                    <label class="col-md-4">{{trans('hr.OvrTime_HR3')}}</label>
                                                    <input type="text" name="Wrk_Hour" id="Wrk_Hour" class="col-md-4 form-control">
                                                    <label class="col-md-3">{{trans('hr.hours')}}</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="OvrTime_HR3" class="col-md-3 form-control">
                                                    <label class="col-md-5">{{trans('hr.hours_week')}}</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="col-md-10">{{trans('hr.Start_Paid')}}</label>
                                                    <input type="text" name="Start_Paid" class="col-md-2 form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-10" style="margin-top: 15px;">
                                                <div class="col-md-3">
                                                    <label class="col-md-4">{{trans('hr.OvrTime_HR3')}}</label>
                                                    <input type="text" name="OvrTime_HR1" class="col-md-4 form-control">
                                                    <label class="col-md-3">{{trans('hr.hours')}}</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="OvrTime_HR2" class="col-md-3 form-control">
                                                    <label class="col-md-5">{{trans('hr.hours_week')}}</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="col-md-10">{{trans('hr.Start_UnPaid')}}</label>
                                                    <input type="text" name="Start_UnPaid" class="col-md-2 form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <br>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                    <label class="col-md-5">{{trans('hr.HusTyp_No')}}</label>
                                                    {{ Form::select('HusTyp_No',\App\Enums\Hr\HousingClassification::toSelectArray() ,null,
                                                            array_merge(['class' => 'form-control col-md-5'])) }}
                                                    </div> <br>
                                                    <div class="row">
                                                        <label class="col-md-5">{{trans('hr.bonus')}}</label>
                                                        <input type="text" name="Bouns_Prct" id="Bouns_Prct" class="col-md-2 form-control">
                                                    </div> <br>
                                                    <div class="row">
                                                        <label class="col-md-5">{{trans('hr.hour_r')}}</label>
                                                        <input type="text" name="Wrk_CostHour" id="Wrk_CostHour" placeholder="ثابت" style="margin-left: 20px;" class="col-md-2 form-control">
                                                        <input type="text" name="Total_Wrk_CostHour" id="Total_Wrk_CostHour" placeholder="الاجمالي" class="col-md-2 form-control">
                                                    </div> <br>
                                                    <div class="row">
                                                        <label class="col-md-5">{{trans('hr.Dection_ExpireDt')}}</label>
                                                        <input type="text" name="Dection_ExpireDt" class="col-md-5 form-control datepicker">
                                                    </div> <br> <br>
                                                </div>
                                                <div class="col-md-7">
                                
                                <div class="row well">
                                    <div class="row">
                                        <label class="col-md-3">{{trans('hr.Cnt_Stdt')}}</label>
                                        <input type="text" id="Cnt_Stdt" name="Cnt_Stdt" class="col-md-3 Cnt_Stdt form-control datepicker">
                                        <label class="col-md-2">{{trans('hr.Cnt_Stdt_Hi')}}</label>
                                        <input type="text" id="Cnt_StdtHij" name="Cnt_StdtHij" class="col-md-4 Cnt_StdtHij form-control">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-3">{{trans('hr.Cnt_Endt')}}</label>
                                        <input type="text" id="Cnt_Endt" name="Cnt_Endt" class="col-md-3 Cnt_Endt form-control datepicker">
                                        <label class="col-md-2">{{trans('hr.Cnt_Stdt_Hi')}}</label>
                                        <input type="text" id="Cnt_EndtHij" name="Cnt_EndtHij" class="col-md-4 Cnt_EndtHij form-control">
                                    </div> <br>
                                    <div class="row">
                                        <label class="col-md-3">{{trans('hr.Cnt_Nwdt')}}</label>
                                        <input type="text" id="Cnt_Nwdt" name="Cnt_Nwdt" class="col-md-3 Cnt_Nwdt form-control datepicker">
                                        <label class="col-md-2">{{trans('hr.Cnt_Stdt_Hi')}}</label>
                                        <input type="text" id="Cnt_NwdtHij" name="Cnt_NwdtHij" class="col-md-4 Cnt_NwdtHij form-control">
                                    </div>
                                </div>
                                    <div class="row well" style="padding: 6px;">
                                        <div class="col-md-3">
                                            <input class="col-md-3" type="checkbox" value="1" name="Wrk_OvrTime">
                                            <label class="col-md-4">{{trans('hr.addition')}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8">{{trans('hr.add_rate')}}</label>
                                            <input class="col-md-4 form-control" style="padding: 0px;" type="text" name="OvrTime_Rate">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="col-md-9">{{trans('hr.Lunch_hour')}}</label>
                                            <input class="col-md-3 form-control" style="padding: 0;" type="text" name="Lunch_hour">
                                        </div>
                                    </div>
                                    </div>
                                            </div>

                                            <!-- place of need -->

                                        </div> <!-- end of second row -->
                                    </div> <!-- end of col-md-12-->
                                </div> <!-- end of panel body-->
                            </div><!-- end of panel default-->
                        </div><!-- end of tab-pane fade-->
                        <!-- THIRD tap -->
                        <div class="tab-pane fade" id="titles" role="tabpanel" aria-labelledby="home-tab">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                <div class="row">
                                        <div class="form-group ">
                                            <div class="col-md-6">
                                                <fieldset id="tableFilter">
                                                    <legend>داخل المملكة</legend>
                                                    <div class="row form-group">
                                                        <label class="col-md-2">اسم المدينة</label>
                                                        <select name="Emp_City" class="col-md-4 form-control">
                                                        <option value="">{{trans('hr.select')}}</option>
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}">{{$city->city_name_ar}}</option>
                                                            @endforeach
                                                        </select>

                                                        <label class="col-md-2">المنطقه</label>
                                                        <select name="Stat_No" class="col-md-3 form-control">
                                                        <option value="">{{trans('hr.select')}}</option>
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}">{{$city->city_name_ar}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-md-2">هاتف</label>
                                                        <input type="text" name="Emp_Phon" class="form-control col-md-4">
                                                        <label class="col-md-2">الموبايل</label>
                                                        <input type="text" name="Emp_Mobile" class="form-control col-md-3 br-5">
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-md-2 ">العنوان</label>
                                                        <input class="col-md-9 br-5 form-control" id="Emp_Street" type="text" name="Emp_Street" >
                                                    </div>

                                                    <div class="row form-group">
                                                        <label class="col-md-2">شخص للرجوع اليه</label>
                                                        <input type="text" name="RefPerson_Nm" class="form-control col-md-4">
                                                        <label class="col-md-2">هاتف</label>
                                                        <input type="text" name="RefPerson_Mobile" class="form-control col-md-3 br-5">
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-md-2">الايميل</label>
                                                        <input class="col-md-9 br-5 form-control" id="E_Email" type="email" name="E_Email" >
                                                    </div>
                                                </fieldset>
                                            </div> <!-- end of col-md-6 داخل المملكة-->
                                            <div class="col-md-6">
                                                <fieldset id="tableFilter">
                                                    <legend>خارج المملكة</legend>
                                                    <div class="row form-group">
                                                        <label class="col-md-2">الدولة</label>
                                                            <select name="Cntry_No" class="col-md-4 form-control">
                                                                <option value="">{{trans('admin.select')}}</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{$country->id}}">{{$country->country_name_ar}}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-md-2">هاتف</label>
                                                        <input type="text" name="Phon_Cntry" class="form-control col-md-4">
                                                        <!-- <label class="col-md-2">نوع الاعادة</label>
                                                        <input type="text" name="" class="form-control col-md-3 br-5"> -->
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-md-2 ">العنوان</label>
                                                        <input class="col-md-9 br-5 form-control" id="Emp_Adrs" type="text" name="Emp_Adrs" >
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-md-2 ">احد الاقارب</label>
                                                        <input class="col-md-4 br-5 form-control" id="Name_Nerst" type="text" name="Name_Nerst">

                                                        <label class="col-md-2">الهاتف</label>
                                                        <input class="col-md-3 br-5 form-control" id="Phon_nerst" type="text" name="Phon_nerst">
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-md-2 ">العنوان</label>
                                                        <input class="col-md-9 br-5 form-control" id="Adrs_Nerst" type="text" name="Adrs_Nerst">
                                                    </div>


                                                    <div class="row form-group">
                                                        <label class="col-md-2">ملاحظات</label>
                                                        <input class="col-md-9 br-5 form-control" id="Notes" type="text" name="Notes">
                                                    </div>
                                                </fieldset>
                                            </div> <!-- end of col-md-6 خارج المملكة-->

                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <!-- fourth tap -->
                        <div class="tab-pane fade" id="Professional_license" role="tabpanel" aria-labelledby="home-tab">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <label class="col-md-5 pl-0">{{trans('hr.licence_number')}}</label>
                                                <input class="Rcrd_LicNo col-md-7 br-5 form-control p-7-2" type="text" name="Rcrd_LicNo">
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-md-5 pl-0">{{trans('hr.Jobknd_No')}}</label>
                                                <div class="select_com_td col-md-7 p-0">
                                                    <select name="Jobknd_No" class="Jobknd_No select2 form-control">
                                                        <option value=""></option>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <!-- State_NmAr -->
                                            <div class="row form-group">
                                                <label class="col-md-5">{{trans('hr.JobPLc_No')}}</label>
                                                <div class="select_com_td col-md-7 p-0">
                                                
                                                    <select name="JobPLc_No" class="JobPLc_No select2 form-control">
                                                        @foreach($licences as $licence) 
                                                            <option value="{{$licence->State_No}}">{{ $licence->{'State_Nm'.ucfirst(session('lang'))} }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- التخصص  -->
                                            <div class="row form-group">
                                                <label class="col-md-5 pl-0">{{trans('hr.JobCtg_No')}}</label>
                                                <div class="select_com_td col-md-7 p-0">
                                                    <select name="JobCtg_No" class="select2  form-control">
                                                        @foreach($job_techs as $job_tech) 
                                                            <option value="{{$job_tech->Job_No}}">{{ $job_tech->{'Job_Nm'.ucfirst(session('lang'))} }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- الفئة Rcrd_LicTyp -->
                                            <div class="row form-group">
                                                <label class="col-md-5 pl-0">{{trans('hr.JobCtg_No1')}}</label>
                                                <input name="Rcrd_LicTyp" class="Rcrd_LicTyp col-md-7 br-5 form-control p-7-2" type="text">
                                            </div>
                                        </div> <!-- end of col-md-4 -->
                                        <div class="col-md-3">
                                        <!-- Rcrd_Stdt  تاريخ الاصدار -->
                                            <div class="row form-group">
                                                <label class="col-md-4 p-0">{{trans('hr.Release_Date')}}</label>
                                                <input name="Rcrd_Stdt" class="Rcrd_Stdt col-md-7 br-5 form-control datepicker" type="text">
                                            </div>
                                            <!-- Rcrd_Rnwdt تاريخ التجديد -->
                                            <div class="row form-group">
                                                <label class="col-md-4 p-0">{{trans('hr.Renewal_date')}}</label>
                                                <input class="Rcrd_Rnwdt col-md-7 br-5 form-control datepicker" type="text" name="Rcrd_Rnwdt">
                                            </div>
                                            <!-- تاريح الانهاء  Rcrd_Endt -->
                                            <div class="row form-group">
                                                <label class="col-md-4 p-0">{{trans('hr.expiry_date')}}</label>
                                                <input class="Rcrd_Endt col-md-7 br-5 form-control datepicker" type="text" name="Rcrd_Endt">
                                            </div>
                                        </div> <!-- end of col-md-3 -->

                                        <div class="col-md-5">
                                            <fieldset id="tableFilter">
                                                <legend>بطاقة التسجيل المهنى</legend>
                                                <!-- رقم التسجيل المهنى -->
                                                <div class="row form-group pl-pr-15">
                                                    <label class="col-md-6">{{trans('hr.Rcrd_LicNo1')}}</label>
                                                    <input class="col-md-6 br-5 form-control" id="" type="text" name="Rcrd_LicNo1" >
                                                </div>
                                                <!-- تاريخ الانتهاء -->
                                                <!-- <div class="row form-group pl-pr-15">
                                                    <label class="col-md-6"></label>
                                                    <input class="col-md-6 br-5 form-control" id="" type="text" name="" >
                                                </div> -->
                                                <div class="row form-group pl-pr-15">
                                                    <label class="col-md-6">التخصص</label>
                                                    <div class="select_com_td col-md-6 p-0">
                                                        <select name="JobCtg_No1" class="select2  form-control">
                                                            @foreach($job_techs as $job_tech) 
                                                                <option value="{{$job_tech->Job_No}}">{{ $job_tech->{'Job_Nm'.ucfirst(session('lang'))} }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group pl-pr-15">
                                                    <label class="col-md-6 ">الفئة</label>
                                                    <input class="Rcrd_LicTyp1 col-md-6 br-5 form-control" id="Rcrd_LicTyp1" type="text" name="Rcrd_LicTyp1" >
                                                </div>
                                            </fieldset>
                                        </div> <!-- end of col-md-6 خارج المملكة-->


                                    </div> <!-- end of row -->
                                    <!-- <div class="row">
                                        <div class="row form-group">
                                            <label class="col-md-1">الاسم</label>
                                            <input class="col-md-3 br-5 form-control" type="text" name="ALw3">
                                            <input class="col-md-3 br-5 form-control mr-10" type="text" name="ALw3">
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- fifth tap -->
                        <div class="tab-pane fade" id="Passport_data" role="tabpanel" aria-labelledby="home-tab">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="row form-group">
                                                <label for="Pasprt_No" class="col-md-5 pl-0">{{trans('hr.Pasprt_No')}}</label>
                                                <input id="Pasprt_No" class="Pasprt_No col-md-7 br-5 form-control p-7-2" type="text" name="Pasprt_No">
                                            </div>
                                            <div class="row form-group">
                                                <label for="Pasprt_Ty" class="col-md-5 pl-0">{{trans('hr.Pasprt_Ty')}}</label>
                                                <div class="select_com_td col-md-7 p-0 p-7-2">
                                                    {{ Form::select('Pasprt_Ty',\App\Enums\Hr\PassportType::toSelectArray() ,null,
                                                    array_merge(['id'=>'Pasprt_Ty', 'class' => 'select2 form-control Pasprt_Ty','placeholder'=>trans('admin.select')])) }}
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="Pasprt_Plc" class="col-md-5 pl-0">{{trans('hr.Pasprt_Plc')}} </label>
                                                <input id="Pasprt_Plc" class="Pasprt_Plc col-md-7 br-5 form-control p-7-2" type="text" name="Pasprt_Plc">
                                            </div>
                                            <div class="row form-group">
                                                <label for="Pasprt_Sdt" class="col-md-5 pl-0">{{trans('hr.Pasprt_Sdt')}}</label>
                                                <input id="Pasprt_Sdt" class="Pasprt_Sdt col-md-7 br-5 form-control p-7-2 datepicker" type="text" name="Pasprt_Sdt">
                                            </div>
                                            <div class="row form-group">
                                                <label for="Pasprt_Edt" class="col-md-5 pl-0">{{trans('hr.Pasprt_Edt')}}</label>
                                                <input id="Pasprt_Edt" class="col-md-7 br-5 form-control p-7-2 datepicker" type="text" name="Pasprt_Edt">
                                            </div>
                                            <div class="row form-group">
                                                <label for="Pasprt_Nt" class="col-md-5 pl-0">{{trans('hr.Pasprt_Nt')}} </label>
                                                <input class="Pasprt_Nt col-md-7 br-5 form-control p-7-2" type="text" name="Pasprt_Nt">
                                            </div>
                                        </div> <!-- end of col-md-4 1st col  -->

                                        <div class="col-md-3 mr-15">
                                            <!-- وظيفة تاشيرة القدوم -->
                                            <div class="row form-group">
                                                <label for="In_Job" class="col-md-6 pl-0 p-0">{{trans('hr.In_Job')}}</label>
                                                <div class="select_com_td col-md-6 p-0 p-7-2">
                                                    <select id="In_Job" name="In_Job" class="In_Job select2 form-control">
                                                        <option>{{trans('admin.select')}}</option>
                                                        @foreach($job_gov as $gov)
                                                            <option value="{{$gov->Job_No}}">{{$gov->Job_NmAr}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <label for="In_VisaNo" class="col-md-6 p-0">{{trans('hr.In_VisaNo')}}</label>
                                                <input id="In_VisaNo" class="In_VisaNo col-md-6 br-5 form-control" type="number" name="In_VisaNo">
                                            </div>
                                            <div class="row form-group">
                                                <label for="In_VisaDt" class="col-md-6 p-0">{{trans('hr.In_VisaDt')}}</label>
                                                <input id="In_VisaDt" class="In_VisaDt col-md-6 br-5 form-control p-0 datepicker" type="text" name="In_VisaDt">
                                            </div> 
                                            <!-- not yet -->
                                            <div class="row form-group">
                                                <label for="In_Port" class="col-md-6 p-0 pl-0">{{trans('hr.In_Port')}}</label>
                                                <div class="select_com_td col-md-6 p-0 p-7-2">
                                                    <select name="In_Port" class="In_Port select2 form-control">
                                                        <option value=""></option>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="In_Date" class="col-md-6 p-0">{{trans('hr.In_Date')}}</label>
                                                <input id="In_Date" class="In_Date col-md-6 br-5 form-control p-0 datepicker" type="text" name="In_Date">
                                            </div>
                                            <!-- الرقم المحدد -->
                                            <div class="row form-group">
                                                <label for="In_EntrNo" class="col-md-6 p-0">{{trans('hr.In_EntrNo')}}</label>
                                                <input id="In_EntrNo" class="In_EntrNo col-md-6 br-5 form-control" type="number" name="In_EntrNo">
                                            </div>
                                        </div> <!-- end of col-md-4 -->
                                        <div class="col-md-3 mr-15">
                                            <div class="row form-group">
                                                <label for="Out_VisaNo" class="col-md-6 pl-0 p-0">{{trans('hr.Out_VisaNo')}}</label>
                                                <input id="Out_VisaNo" class="Out_VisaNo col-md-6 br-5 form-control" type="number" name="Out_VisaNo">
                                            </div>

                                            <div class="row form-group">
                                                <label for="Out_VisaDt" class="col-md-6 p-0">{{trans('hr.Out_VisaDt')}}</label>
                                                <input id="Out_VisaDt" class="Out_VisaDt col-md-6 br-5 form-control datepicker" type="text" name="Out_VisaDt">
                                            </div>
                                            <div class="row form-group">
                                                <label for="Out_Date" class="col-md-6 p-0">{{trans('hr.Out_Date')}}</label>
                                                <input id="Out_Date" class="p-0 Out_Date col-md-6 br-5 form-control datepicker" type="text" name="Out_Date">
                                            </div>
                                            <div class="row form-group">
                                                <label for="Out_Port" class="col-md-6 p-0 pl-0">{{trans('hr.Out_Port')}}</label>
                                                <div class="select_com_td col-md-6 p-0 p-7-2">
                                                    <select id="Out_Port" name="Out_Port" class="Out_Port select2 form-control">
                                                        <option value=""></option>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label for="Trnsfer_Dt" class="col-md-6 p-0">{{trans('hr.Trnsfer_Dt')}}</label>
                                                <input id="Trnsfer_Dt" class="Trnsfer_Dt col-md-6 br-5 form-control datepicker" type="text" name="Trnsfer_Dt">
                                            </div>
                                            <div class="row form-group">
                                                <label for="Trnsfer_OLdNm" class="col-md-6 p-0">{{trans('hr.Trnsfer_OLdNm')}}</label>
                                                <input id="Trnsfer_OLdNm" class="Trnsfer_OLdNm col-md-6 br-5 form-control" type="text" name="Trnsfer_OLdNm">
                                            </div>
                                        </div> <!-- end of col-md-3 -->
                                        <div class="col-md-2 passport__col_border">
                                            <div class="text-center">
                                            <label>{{trans('hr.Psprt_Rcv')}}</label>
                                            <div class="col-md-6 p-0">
                                                <label for="Psprt_Rcv_2" class="col-md-6">{{trans('hr.no')}}</label>
                                                <input id="Psprt_Rcv_2" type="radio" value="2" name="Psprt_Rcv" class="Psprt_Rcv col-md-6 radio-inline">`
                                            </div>
                                            <div class="col-md-6 p-0">
                                                <label for="Psprt_Rcv_1" class="col-md-6">{{trans('hr.yes')}}</label>
                                                <input id="Psprt_Rcv_1" type="radio" value="1" name="Psprt_Rcv" class="Psprt_Rcv col-md-6 radio-inline">
                                            </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- sixth tap -->
                        <div class="tab-pane fade" id="identity" role="tabpanel" aria-labelledby="home-tab">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-md-12" style="border-radius: 3px;padding-left: 0;margin-bottom: 5px;
                                        padding-right: 0;background-color:#3A3767;color: #fff;margin-top: 10px;">
                                            <div class="col-md-3 mt-15 mb-15">
                                                <label class="col-md-6 p-0" style="padding: 0 7px;">{{trans('hr.Cnt_Endt')}}</label>
                                                <input name="Cnt_Period" type="text" class="col-md-5 form-control datepicker">
                                            </div>
                                            <div class="col-md-3 mt-15">
                                                <label class="col-md-6">{{trans('hr.office_file')}}</label>
                                                <input name="Work_Lic" type="text" class="Work_Lic col-md-5 form-control">
                                            </div>
                                            <div class="col-md-3 mt-15">
                                                <label class="col-md-8">{{trans('hr.social_number')}}</label>
                                                <input name="Ensurans_No" type="text" class="Ensurans_No col-md-3 form-control">
                                            </div>
                                            <div class="col-md-3 mt-15">
                                                @foreach(\App\Enums\SpecialNeeds::toSelectArray() as $key => $value)
                                                    <input class="checkbox-inline" type="radio"
                                                        name="Specl_Need" value="{{$key}}"
                                                        style="margin: 3px;" @if($key == 1) checked @endif>
                                                    <label>{{$value}}</label>
                                                @endforeach
                                            </div>
                                    </div> <!-- end of first row -->

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-8">
                                            <div class="col-md-12">
                                                <label class="col-md-2" style="padding-left: 0;">{{trans('hr.residence_data')}}</label>
                                                <input name="Residn_No" type="text" placeholder="{{trans('hr.numberr')}}" class="col-md-3 form-control">
                                                <input name="Residn_Sdt" type="text" placeholder="{{trans('hr.version')}}" style="margin-left: 2px;" class="col-md-3 datepicker form-control">
                                                <input name="Residn_Edt" type="text" placeholder="{{trans('hr.finishing')}}" class="col-md-3 form-control datepicker">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-4"></label>
                                                <label class="col-md-4">{{trans('hr.type')}}</label>
                                                <label class="col-md-4">{{trans('hr.version_pla')}}</label>
                                            </div>
                                            <div class="col-md-12" style="margin-bottom: 11px;">
                                                <label class="col-md-2" style="padding-left: 0;"></label>
                                                <div class="col-md-4">
                                                    {{ Form::select('Residn_Ty',\App\Enums\Hr\IDType::toSelectArray() ,null,
                                                    array_merge(['id'=>'Residn_Ty', 'class' => 'select2 form-control Residn_Ty','placeholder'=>trans('admin.select')])) }}
                                                </div>
                                                    <select name="Residn_Plc" class="col-md-5 form-control">
                                                    @foreach($residencelicences as $residencelicence) 
                                                    <option value="{{$residencelicence->State_No}}">{{$residencelicence->{'State_Nm'.ucfirst(session('lang'))} }}</option>
                                                    @endforeach
                                                    </select>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="col-md-2" style="padding-left: 0;">{{trans('hr.Civil_No')}}</label>
                                                <input name="Civl_No" type="text" placeholder="{{trans('hr.numberr')}}" style="margin-left: 4px;" class="col-md-2 form-control">
                                                <input name="CivL_StDt" type="text" placeholder="{{trans('hr.version')}}" class="datepicker col-md-2 form-control">
                                                <label class="col-md-3">{{trans('hr.use_required')}}</label>
                                                <select name="Civl_Plc" id="Civl_Plc" class="col-md-2 form-control">
                                                    @foreach($civilcelicences as $civilcelicence) 
                                                    <option value="{{$civilcelicence->State_No}}">{{$civilcelicence->{'State_Nm'.ucfirst(session('lang'))} }}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-2" style="padding-left: 0;">{{trans('hr.work_permit')}}</label>
                                                <input name="Work_Lic" type="text" placeholder="{{trans('hr.numberr')}}" style="margin-left: 2px;" class="col-md-3 form-control">
                                                <input name="Work_StDt" type="text" placeholder="{{trans('hr.version')}}" style="margin-left: 2px;" class="col-md-3  datepicker form-control">
                                                <input name="Work_Endt" type="text" placeholder="{{trans('hr.finishing')}}" class="col-md-3 form-control datepicker">
                                            </div>
                                            {{-- /// --}}
                                            <div class="col-md-12">
                                                <label class="col-md-4"></label>
                                                <label class="col-md-4">{{trans('hr.type')}}</label>
                                                <label class="col-md-4">{{trans('hr.version_pla')}}</label>
                                            </div>
                                            <div class="col-md-12" style="margin-bottom: 11px;">
                                                <label class="col-md-2" style="padding-left: 0;"></label>
                                                <!-- النوع -->
                                                <select type="text" style="margin-left: 4px;" class="col-md-4 form-control"></select>
                                                <!-- مكان الاصدار -->
                                                <select name="Work_PLC" class="col-md-5 form-control"></select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-2" style="padding-left: 0;">{{trans('hr.driving_license')}}</label>
                                                <input name="Lic_No" type="text" placeholder="{{trans('hr.numberr')}}" style="margin-left: 2px;" class="col-md-3 form-control">
                                                <input name="Lic_Sdt" type="text" placeholder="{{trans('hr.version')}}" style="margin-left: 2px;" class="col-md-3 form-control datepicker">
                                                <input name="Lic_Edt" type="text" placeholder="{{trans('hr.finishing')}}" class="col-md-3 form-control datepicker">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-4"></label>
                                                <label class="col-md-4">{{trans('hr.type')}}</label>
                                                <label class="col-md-4">{{trans('hr.version_pla')}}</label>
                                            </div>
                                            <div class="col-md-12" style="margin-bottom: 11px;">
                                                <label class="col-md-2" style="padding-left: 0;"></label>
                                                
                                                {{ Form::select('Lic_Typ',\App\Enums\Hr\DriveLicenceType::toSelectArray() ,null,
                                                    array_merge(['id'=>'Lic_Typ', 'class' => 'form-control Lic_Typ col-md-4','placeholder'=>trans('admin.select')])) }}

                                                <select name="Lic_Plc" type="text" class="col-md-5 form-control">
                                                @foreach($drivelicences as $drivelicence) 
                                                <option value="{{$drivelicence->State_No}}">{{$drivelicence->{'State_Nm'.ucfirst(session('lang'))} }}</option>
                                                @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <!-- الوظيفه بالشئون -->
                                            <div class="row" style="margin-bottom: 15px;">
                                                <label class="col-md-5">{{trans('hr.business_affairs')}}</label>
                                                <select name="MJob_No" type="text" class="MJob_No col-md-6 form-control">
                                                    @foreach($job_gov as $gov)
                                                        <option value="{{$gov->Job_No}}">{{$gov->Job_NmAr}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- مدة الاقامه MBudg_typ -->
                                            <div class="row" style="margin-bottom: 15px;">
                                                <label class="col-md-5">{{trans('hr.duration_stay')}}</label>
                                                <div class="col-md-6 p-0">
                                                {{ Form::select('MBudg_typ',\App\Enums\Hr\MBudg_typ::toSelectArray() ,null,
                                                    array_merge(['id'=>'MBudg_typ', 'class' => 'select2 form-control MBudg_typ','placeholder'=>trans('admin.select')])) }}
                                                </div>

                                                <!-- <select name="MBudg_typ" type="text" class="col-md-6 form-control"></select> -->
                                            </div>
                                            <!-- الراتب بالشركه -->
                                            <div class="row" style="margin-bottom: 15px;">
                                                <label class="col-md-5">{{trans('hr.company_salary')}}</label>
                                                <input name="Month_Salry" type="text" class="col-md-4 form-control">
                                            </div>
                                            <!-- الراتب بالشئون  راتب رسمي  -->
                                            <div class="row">
                                                <label class="col-md-5">{{trans('hr.salary_affairs')}}</label>
                                                <input name="MMonth_Salry" type="text" class="col-md-4 form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--end of  tail__second_row-->
                {!! Form::close() !!}
            </div> <!--end of  box-body -->
        </div> <!--end of div box-->
@endsection
