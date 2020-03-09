{{-- resources\views\admin\students\create\basicinformation.blade.php --}}
@inject('branches', \App\Models\Admin\MainBranch)

@push('js')

    <script>
        $(document).ready(function () {

        })
    </script>
@endpush

<div class="tab-pane fade in active" id="busowner">
    @include('admin.layouts.message')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        {{trans('admin.company_data')}}
                    </div>
                </div>
                <div class="row">
                    <div class="panel-body">
                        {{-- نوع النشاط --}}
                        <div class="col-md-12">
                            <label for="Actvty_No">{{trans('admin.activity_type')}}</label>
                            <select name="Actvty_No" id="Actvty_No" class="form-control">
                                <option value="{{null}}">{{trans('admin.select')}}</option>
                                @if(count($acts) > 0)  
                                    @foreach($acts as $act)
                                        <option value="{{$act->Actvty_No}}" @if($act->Actvty_No == $cmp->Actvty_No) selected @endif>{{$act->{'Name_'.ucfirst(session('lang'))} }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        {{-- نهاية نوع النشاط --}}
                        {{-- رقم الشركه --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Cmo_No">{{trans('admin.Cmp_Number')}}</label>
                                <input type="text" name="Cmp_No" id="Cmp_No" value="{{$cmp->Cmp_No}}" class="form-control" disabled>
                            </div>
                        </div>
                        {{-- نهاية رقم الشركه  --}}

                        {{-- اللغه الاساسيه --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Local_Lang">{{trans('admin.main_lang')}}</label>
                                <select name="Local_Lang" id="Local_Lang" class="form-control">
                                    <option value="{{null}}">{{trans('admin.select')}}</option>
                                    @foreach(\App\Enums\LangType::toSelectArray() as $index => $flag)
                                    <option value="{{$index}}"
                                        @if($index == $cmp->Local_Lang) selected @endif>
                                        {{\App\Enums\LangType::getDescription($index)}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- نهاية اللغه الاساسيه --}}
    
                        {{-- النظام المستخدم --}}
                        <div class="col-md-4">
                            <label for="Sys_SetupNo">{{trans('admin.Sys_SetupNo')}}</label>
                            <select name="Sys_SetupNo" id="Sys_SetupNo" class="form-control">
                                <option value="">{{trans('admin.select')}}</option>
                            </select>
                        </div>
                        {{-- نهاية النظام المستخدم --}}

                        {{-- الاسم عربى --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Cmp_NmAr">{{trans('admin.arabic_name')}}</label>
                                <input type="text" name="Cmp_NmAr" id="Cmp_NmAr" value="{{$cmp->Cmp_NmAr}}" class="form-control">
                            </div>
                        </div>
                        {{-- نهاية الاسم عربى --}}

                        {{-- الاسم عربى  2--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Cmp_NmAr2">{{trans('admin.arabic_name_2')}}</label>
                                <input type="text" name="Cmp_NmAr2" id="Cmp_NmAr2" value="{{$cmp->Cmp_NmAr2}}" class="form-control">
                            </div>
                        </div>
                        {{-- نهاية الاسم عربى  2--}}

                        {{-- الاسم انجليزى --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Cmp_NmEn">{{trans('admin.english_name')}}</label>
                                <input type="text" name="Cmp_NmEn" id="Cmp_NmEn" value="{{$cmp->Cmp_NmEn}}" class="form-control">
                            </div>
                        </div>
                        {{-- نهاية الاسم انجليزى --}}

                        {{-- الاسم انجليزى  2--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Cmp_NmEn2">{{trans('admin.english_name_2')}}</label>
                                <input type="text" name="Cmp_NmEn2" id="Cmp_NmEn2" value="{{$cmp->Cmp_NmEn2}}" class="form-control">
                            </div>
                        </div>
                        {{-- نهاية الاسم انجليزى  2--}}

                        {{-- عنوان الشركه عربى --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Cmp_AddAr">{{trans('admin.Cmp_AddAr')}}</label>
                                <input type="text" name="Cmp_AddAr" id="Cmp_AddAr" value="{{$cmp->Cmp_AddAr}}" class="form-control">
                            </div>
                        </div>
                        {{-- نهاية عنوان الشركه عربى --}}

                        {{--عنوان الشركه انجليزى--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Cmp_AddEn">{{trans('admin.Cmp_AddEn')}}</label>
                                <input type="text" name="Cmp_AddEn" id="Cmp_AddEn" value="{{$cmp->Cmp_AddEn}}" class="form-control">
                            </div>
                        </div>
                        {{-- نهاية عنوان الشركه انجليزى--}}

                        {{-- التليفون - الفاكس - الايميل - الاسم المختصر للشركه --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Cmp_Tel">{{trans('admin.phone')}}</label>
                                <input type="text" name="Cmp_Tel" id="Cmp_Tel" value="{{$cmp->Cmp_Tel}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Cmp_Fax">{{trans('admin.fax')}}</label>
                                <input type="text" name="Cmp_Fax" id="Cmp_Fax" value="{{$cmp->Cmp_Fax}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Cmp_Email">{{trans('admin.email')}}</label>
                                <input type="text" name="Cmp_Email" id="Cmp_Email" value="{{$cmp->Cmp_Email}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Cmp_ShrtNm">{{trans('admin.Cmp_ShrtNm')}}</label>
                                <input type="text" name="Cmp_ShrtNm" id="Cmp_ShrtNm" value="{{$cmp->Cmp_ShrtNm}}" class="form-control">
                            </div>
                        </div>
                        {{-- نهاية التليفون - الفاكس - الايميل - الاسم المختصر للشركه --}}

                         {{-- شعار الشركه --}}
                       <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label(trans('admin.Picture'), null, ['class' => 'control-label']) }}
                                {{ Form::file('Picture', array_merge(['class' => 'form-control upld'])) }}
                                <img style="width: 100px;" class="img-responsive" id="blah" src='' />
                            </div>
                            <br><br>
                       </div>
                        {{-- نهاية شعار الشركه --}}

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    {{-- بدايه و نهاية السنه الماليه ميلادى و هجرى --}}
                    <div class="row">
                        <div class="col-md-6">
                            <h4>{{trans('admin.financial_year_en')}}</h4>
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="Start_Month" id="Start_Month" value="{{$cmp->Start_Month}}" 
                                        class="form-control" placeholder="{{trans('admin.Start_Month')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="Start_Year" id="Start_Year" value="{{$cmp->Start_Year}}" 
                                        class="form-control" placeholder="{{trans('admin.Start_year')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="End_Month" id="End_Month" value="{{$cmp->End_Month}}" 
                                        class="form-control" placeholder="{{trans('admin.End_Month')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="End_Year" id="End_Year" value="{{$cmp->End_Year}}" 
                                        class="form-control" placeholder="{{trans('admin.End_Year')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>{{trans('admin.financial_year_ar')}}</h4>
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="Start_MonthHij" id="Start_MonthHij" value="{{$cmp->Start_MonthHij}}" 
                                        class="form-control" placeholder="{{trans('admin.Start_Month')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="Start_YearHij" id="Start_YearHij" value="{{$cmp->Start_YearHij}}" 
                                        class="form-control" placeholder="{{trans('admin.Start_year')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="End_MonthHij" id="End_MonthHij" value="{{$cmp->End_MonthHij}}" 
                                        class="form-control" placeholder="{{trans('admin.End_Month')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="End_YearHij" id="End_YearHij" value="{{$cmp->End_YearHij}}" 
                                        class="form-control" placeholder="{{trans('admin.End_Year')}}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{--  نهاية بدايه و نهاية السنه الماليه ميلادى و هجرى --}}
                </div>
            </div>
            
            {{-- مستندات الشركه --}}
            <div class="panel panel-primary">
                <div class="panel-body">  
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="CR_No">{{trans('admin.CR_No')}}</label>
                                <input type="text" name="CR_No" id="CR_No" value="{{$cmp->CR_No}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="CC_No">{{trans('admin.CC_No')}}</label>
                                <input type="text" name="CC_No" id="CC_No" value="{{$cmp->CC_No}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="License_No">{{trans('admin.License_No')}}</label>
                                <input type="text" name="License_No" id="License_No" value="{{$cmp->License_No}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="Tax_No">{{trans('admin.Tax_No')}}</label>
                                <input type="text" name="Tax_No" id="Tax_No" value="{{$cmp->Tax_No}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="TaxExtra_Prct">{{trans('admin.TaxExtra_Prct')}}</label>
                                <input type="text" name="TaxExtra_Prct" id="TaxExtra_Prct" value="{{$cmp->TaxExtra_Prct}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- نهاية مستندات الشركه --}}

            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row">
                        @foreach(\App\Enums\OptionsType::toArray() as $index => $flag)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                    type="checkbox" name='{{\App\Enums\OptionsType::getKey($flag)}}' id='{{\App\Enums\OptionsType::getKey($flag)}}' 
                                    value="{{$flag}}" @if ( $cmp->{\App\Enums\OptionsType::getKey($flag)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\OptionsType::getKey($flag))}}</label>
                                </div>
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
