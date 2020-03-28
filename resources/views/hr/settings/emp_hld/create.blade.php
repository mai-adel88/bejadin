
@extends('hr.index')
@section('title', trans('hr.hlds'))
@section('root_name', trans('hr.hlds'))
@section('content')
    @can('create')
        @push('css')
        <style>
            .input_text{
                    max-width: 100%;
                    height: 35px;
                    margin-bottom: 2px;
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
                .mb-5{
                    margin-bottom:10px;
                }
        </style>
        @endpush
        @push('js')

        <script>
         $(document).ready(function () {

            $('.select2').select2({
                dir: "{{direction()}}",
                width: "100%"
            });

            ////// الموظف بناء على الشركه /////
            $('.Cmp_No').change(function(){
                var Cmp_No = $(this).val();
                $.ajax({
                    url : "{{route('getEmployeess')}}",
                    type : 'get',
                    dataType:'html',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: Cmp_No},
                    success : function(data){
                        $('.Emp_No').html(data)
                    }
                });
            });


         });
         ////// رقم الموظف ////
        $(document).on('change', '.Emp_No', function(){
            var Emp_No = $(this).val();
            $('.emp_no').val(Emp_No);

            ////// القسم للموظف //////
            $.ajax({
                url : "{{route('getdepartmenthlds')}}",
                type : 'get',
                dataType:'json',
                data: {"_token": "{{ csrf_token() }}", Emp_No: Emp_No },
                success : function(data){
                    $('.SubCmp_No').val(data)
                }
            });
            /////// الراتب /////
            $.ajax({
                url : "{{route('getSalaryhlds')}}",
                type : 'get',
                dataType:'json',
                data: {"_token": "{{ csrf_token() }}", Emp_No: Emp_No },
                success : function(data){
                    $('#salary').val(data)
                }
            });
        });
        </script>
        @endpush
        <div class="box">

            <div class="box-body">
            @include('hr.layouts.message')
                {{ Form::open(['method'=>'post', 'route' => 'dependents.store','files'=>true]) }}
                <div style="padding-bottom: 42px;">
                    {{Form::submit(trans('hr.save'), ['class'=>'btn btn-outline-success pull-left','style'=>'background-color: #4d6672;color:#fff;'])}}
                </div>

                    <!-- First panel -->
                    <div class="panel panel-default">
                        <div class="panel-body" style="background-color: #34515fe0;color: #fff;">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="col-md-8">
                                        <label class="col-md-2" style="padding:0px;">{{trans('admin.company')}}</label>
                                        <select name="Cmp_No" class="Cmp_No col-md-10 input_text form-control">
                                            <option disabled selected>{{trans('admin.select')}}</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->Cmp_No}}">{{$company->Cmp_NmAr}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="col-md-2" style="padding:0px;">{{trans('admin.The_employee')}}</label>
                                        <select name="Emp_No" class="Emp_No col-md-7 input_text form-control">
                                            <option disabled selected>{{trans('admin.select')}}</option>

                                        </select>
                                        <input type="text" class="emp_no col-md-3 input_text form-control">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="col-md-2" style="padding:0px;">{{trans('admin.dep')}}</label>
                                        <input type="text" readonly name="SubCmp_No" value="" class="SubCmp_No col-md-10 input_text form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="col-md-3">{{trans('hr.it_date')}}</label>
                                        <input type="text" readonly class="col-md-7 input_text form-control datepicker">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-3">{{trans('hr.salary')}}</label>
                                        <input type="text" readonly id="salary" class="col-md-7 input_text form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-3">{{trans('hr.jobb')}}</label>
                                        <input type="text" readonly class="col-md-7 input_text form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body" style="background-color: #fff;color: #4d6672;">
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-4">
                                            <div class="col-md-12">
                                                <label class="col-md-5" style="padding:0px;">{{trans('hr.vacations_merit_types')}}</label>
                                                {{ Form::select('Hld_Ern',\App\Enums\Hr\AstcHldyEarn::toSelectArray() ,null,
                                                    array_merge(['class' => 'col-md-6 input_text form-control', 'placeholder'=>trans('admin.select')])) }}
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-5" style="padding:0px;">{{trans('hr.Hld_Ern_Prod')}}</label>
                                                <input type="text" name="Hld_Ern_Prod" class="col-md-6 input_text form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-5" style="padding:0px;">{{trans('hr.Open_Balnc')}}</label>
                                                <input type="text" name="Open_Balnc" class="col-md-6 input_text form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-12">
                                                <label style="margin-bottom: 20px;">
                                                    <input type="checkbox" name="Unpad_Nxtyer">{{trans('hr.Unpad_Nxtyer')}}
                                                </label>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-6" style="padding:0px;">{{trans('hr.due_to_date')}}</label>
                                                <input type="text" name="" class="col-md-6 input_text form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-6" style="padding:0px;">{{trans('hr.Last_Ret_Dt')}}</label>
                                                <input type="text" name="" class="col-md-6 input_text form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-12">
                                                <label class="col-md-6" style="padding:0px;">{{trans('hr.date_of_hiring')}}</label>
                                                <input type="text" name="" class="col-md-6 input_text form-control datepicker">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-6" style="padding:0px;">{{trans('hr.actual_days')}}</label>
                                                <input type="text" name="" class="col-md-6 input_text form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-6" style="padding:0px;">{{trans('hr.Blnc_Paid')}}</label>
                                                <input type="text" name="Blnc_Paid" class="col-md-6 input_text form-control">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="col-md-6" style="padding:0px;">{{trans('hr.Blnc_UnPaid')}}</label>
                                                <input type="text" name="Blnc_UnPaid" class="col-md-6 input_text form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body" style="background-color: #fff;color: #4d6672;">
                                    <ul class="nav nav-tabs nav-justified" id="myTab1" role="tablist">
                                        <li class="nav-item active">
                                            <a class="nav-link" id="home-tab1" data-toggle="tab" href="#yearly" role="tab" aria-controls="home"
                                            aria-selected="true">{{trans('hr.annual_increase')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="home-tab1" data-toggle="tab" href="#vacancies" role="tab" aria-controls="home"
                                            aria-selected="true">{{trans('hr.last_vacation_data')}}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent1">
                                        <!-- first tab -->
                                        <div class="tab-pane fade show active in" id="yearly" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="col-md-12">
                                                        <input type="radio" value="1" name="Inc_Typ" class="col-md-2 radio-inline">
                                                        <label class="col-md-10 pl-0 p-0">{{trans('hr.no_bonus')}}</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="radio" value="2" name="Inc_Typ" class="col-md-2 radio-inline">
                                                        <label class="col-md-10 pl-0 p-0">{{trans('hr.fix_bonus')}}</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="radio" value="3" name="Inc_Typ" class="col-md-2 radio-inline">
                                                        <label class="col-md-10 pl-0 p-0">{{trans('hr.ch_bonus')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="col-md-12">
                                                        <label class="col-md-7">{{trans('hr.bonus_year')}}</label>
                                                        <input type="number" min="0" name="Inc_Yer" class="col-md-5 input_text form-control">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="col-md-7">{{trans('hr.no_days')}}</label>
                                                        <input type="number" min="0" name="Inc_days" class="col-md-5 input_text form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- second tab -->
                                        <div class="tab-pane fade" id="vacancies" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-2" style="margin-top: 35px;">
                                                    <label style="padding:0px;">{{trans('hr.hld_year')}}</label>
                                                    <label style="padding:0px;margin-top: 10px;">{{trans('hr.Hld_No2')}}</label>
                                                    <label style="padding:0px;margin-top: 10px;">{{trans('hr.hld_emergency')}}</label>
                                                    <label style="padding:0px;margin-top: 10px;">{{trans('hr.Hld_No3')}}</label>
                                                    <label style="padding:0px;margin-top: 10px;">{{trans('hr.Hld_No5')}}</label>
                                                </div>
                                                <div class="col-md-2" style="padding: 2px;">
                                                    <label>{{trans('hr.star_date')}}</label>
                                                    <input type="text" name="Hld_Stdt1" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Stdt2" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Stdt4" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Stdt3" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Stdt5" class="input_text form-control datepicker">
                                                </div>
                                                <div class="col-md-2" style="padding: 2px;">
                                                    <label>{{trans('hr.finishing_d')}}</label>
                                                    <input type="text" name="Hld_Endt1" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Endt2" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Endt4" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Endt3" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Endt5" class="input_text form-control datepicker">
                                                </div>
                                                <div class="col-md-2" style="padding: 2px;">
                                                    <label>{{trans('hr.Hld_Rtdt1')}}</label>
                                                    <input type="text" name="Hld_Rtdt1" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Rtdt2" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Rtdt4" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Rtdt3" class="input_text form-control datepicker">
                                                    <input type="text" name="Hld_Rtdt5" class="input_text form-control datepicker">
                                                </div>
                                                <div class="col-md-1" style="padding: 2px;">
                                                    <label>{{trans('hr.Hld_Prod1')}}</label>
                                                    <input type="text" name="Hld_Prod1" class="input_text form-control">
                                                    <input type="text" name="Hld_Prod2" class="input_text form-control">
                                                    <input type="text" name="Hld_Prod4" class="input_text form-control">
                                                    <input type="text" name="Hld_Prod3" class="input_text form-control">
                                                    <input type="text" name="Hld_Prod5" class="input_text form-control">
                                                </div>
                                                <div class="col-md-2" style="padding: 2px;">
                                                    <label>{{trans('hr.Isu_Bln1')}}</label>
                                                    <input type="text" name="Isu_Bln1" class="input_text form-control">
                                                    <input type="text" name="Isu_Bln2" class="input_text form-control">
                                                    <input type="text" name="Isu_Bln4" class="input_text form-control">
                                                    <input type="text" name="Isu_Bln3" class="input_text form-control">
                                                    <input type="text" name="Isu_Bln5" class="input_text form-control">
                                                </div>
                                                <div class="col-md-1" style="padding: 2px;">
                                                    <label>{{trans('hr.Hld_No1')}}</label>
                                                    <input type="text" name="Hld_No1" class="input_text form-control">
                                                    <input type="text" name="Hld_No2" class="input_text form-control">
                                                    <input type="text" name="Hld_No4" class="input_text form-control">
                                                    <input type="text" name="Hld_No3" class="input_text form-control">
                                                    <input type="text" name="Hld_No5" class="input_text form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                {{Form::close()}}
            </div>
        </div>
    @endcan
@endsection
