@extends('admin.index')
@section('title',trans('admin.create_new_suppliers'))
@section('content')

    @push('js')
        <script>
            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })

            $("#branches").change(function () {
            $.ajax({
            url : "{{route('createSupNo')}}",
            type : 'post',
            dataType:'json',
            data: {"_token": "{{ csrf_token() }}", Brn_No: $(this).val() },
            success : function(res){
            // alert();
            $('#Sup_No').val(res)
            }
            });
            });

        </script>

    @endpush

    @push('css')
        <style>
            fieldset {
                display: block;
                margin-left: 2px;
                margin-right: 2px;
                padding-top: 0.35em;
                padding-bottom: 0.625em;
                padding-left: 0.75em;
                padding-right: 0.75em;
                border: 2px solid #ccc;
            }
            legend{
                display: block;
                padding: 0;
                margin-bottom: 20px;
                font-size: 18px;
                line-height: inherit;
                color: #333;
                width: 152px;
                border-bottom: none;
            }
        </style>
    @endpush
@hasrole('writer')
@can('create')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'suppliers.store']) !!}
            {{ Form::button('<i class="fa fa-save"></i>', ['type' => 'submit', 'class' => 'btn btn-primary','style' => 'float:left;display:inline-block'] )  }}

            <br>
           <br>
            <ul class="nav nav-tabs" role="tablist">
                <li class="col-md-6" role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">البيانات الاساسية</a></li>
                <li class="col-md-6" role="presentation"><a href="#responsible_persons" aria-controls="profile" role="tab" data-toggle="tab">{{trans('admin.responsible_persons')}}</a></li>            </ul>


            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="col-md-7">

                        <div class="form-group row">
                            <br>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    {{ Form::label(trans('admin.companies'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::select('Cmp_No', $company,null, array_merge(['class' => 'form-control company','placeholder'=>trans('admin.select')])) }}
                                </div>
                            </div>

                        </div>


                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="col-md-3">
                                    {{ Form::label(trans('admin.Branches'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    @if(auth()->guard('admin')->user()->branch_id == '-1')
                                        {{ Form::select('Brn_No', $branches,null, array_merge(['class' => 'form-control branche','id' => 'branches','placeholder'=>trans('admin.select')])) }}
                                    @else
                                        {{ Form::text('Brn_No', $branches,null, array_merge(['class' => 'form-control branche','id' => 'branches','placeholder'=>trans('admin.select')])) }}
                                    @endif
                                </div>
                            </div>

                            <div class = "col-md-4">
                                <div class="col-md-4">
                                    {{ Form::label(trans('admin.numb_sup'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-8">
                                    {{ Form::text('Sup_No',null, array_merge(['class' => 'form-control ','id' => 'Sup_No','readonly'])) }}
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::text('Sup_NmAr', old('Sup_NmAr'), array_merge(['class' => 'form-control'])) }}
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::text('Sup_NmEn', old('Sup_NmEn'), array_merge(['class' => 'form-control'])) }}
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    {{ Form::label(trans('admin.addriss'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::text('Sup_Adr', old('Sup_Adr'), array_merge(['class' => 'form-control'])) }}
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    {{ Form::label(trans('admin.mail_box'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-8">
                                    {{ Form::text('Cstm_POBox', old('Cstm_POBox'), array_merge(['class' => 'form-control'])) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label(trans('admin.mail_num'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::text('Cstm_ZipCode', old('Cstm_ZipCode'), array_merge(['class' => 'form-control'])) }}
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">

                            <div class="col-md-12">
                                <div class="col-md-2">
                                    {{ Form::label(trans('admin.phone'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::text('Sup_Tel1', old('Sup_Tel1'), array_merge(['class' => 'form-control']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                </div>
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    {{ Form::label(trans('admin.mob'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::text('Mobile', old('Mobile'), array_merge(['class' => 'form-control']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    {{ Form::label(trans('admin.mobMain'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-8">
                                    {{ Form::text('Mobile',old('Mobile'), array_merge(['class' => 'form-control']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-3">
                                    {{ Form::label(trans('admin.fax'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-9">
                                    {{ Form::text('Sup_Fax',old('Sup_Fax'), array_merge(['class' => 'form-control']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    {{ Form::label(trans('admin.email'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::email('Sup_Email', old('Sup_Email'), array_merge(['class' => 'form-control']), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                </div>
                            </div>
                        </div>

                        <hr style="margin-top: 20px; margin-bottom: 20px;border: 0;border-top: 1px solid #eee">





                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    {{ Form::label(trans('admin.note'), null, ['class' => 'control-label']) }}
                                </div>
                                <div class="col-md-10">
                                    {{ Form::textarea('note',old('note'), array_merge(['class' => 'form-control'])) }}
                                </div>
                            </div>
                        </div>

{{--                       // {{Form::submit(trans('admin.send'),['class'=>'btn btn-primary'])}}--}}

                    </div>

                    <br>
                    <div class="form-group row">
                        <div class="col-md-5">

                            <div class="form-group row" >
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        {{ Form::label(trans('admin.active'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-9">
                                        {{ Form::checkbox('Sup_Active', '1', null, ['class' => 'control-label']) }}
                                    </div>
                                </div>
                            </div >



                            <div class="form-group row" >
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend>{{trans('admin.last_bill')}}</legend>
                                        <div class="col-md-12">
                                            <div class="col-md-3">{!!Form::label('Linv_No', trans('admin.Linv_No'))!!}</div>
                                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('Linv_No', null, ['class'=>'form-control'])!!}</div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3">{!!Form::label('Linv_Dt', trans('admin.Linv_Dt'))!!}</div>
                                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::date('Linv_Dt', null, ['class'=>'form-control'])!!}</div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3">{!!Form::label('Linv_Net', trans('admin.Linv_Net'))!!}</div>
                                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('Linv_Net', null, ['class'=>'form-control'])!!}</div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>{{trans('admin.last_mo')}}</legend>
                                        <div class="col-md-12">
                                            <div class="col-md-3">{!!Form::label('LRcpt_No', trans('admin.LRcpt_No'))!!}</div>
                                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('LRcpt_No', null, ['class'=>'form-control'])!!}</div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3">{!!Form::label('LRcpt_Dt', trans('admin.LRcpt_Dt'))!!}</div>
                                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::date('LRcpt_Dt', null, ['class'=>'form-control'])!!}</div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-3">{!!Form::label('LRcpt_Db', trans('admin.LRcpt_Db'))!!}</div>
                                            <div class="col-md-9" style="margin-bottom: 10px;">{!!Form::text('LRcpt_Db', null, ['class'=>'form-control'])!!}</div>
                                        </div>
                                    </fieldset>
                                </div>

                            </div>


                            <div class="form-group row" >
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        {{ Form::label(trans('admin.SupCtg_No'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-9">
                                        {{ Form::select('SupCtg_No', $astsupctg,null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        {{ Form::label(trans('admin.country'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-9">
                                        {{ Form::select('Cntry_No', $countries,old('Cntry_No'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                    </div>
                                </div>


                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        {{ Form::label(trans('admin.currency'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-9">
                                        {{ Form::select('Curncy_No', \App\Enums\CurrencyType::toSelectArray(),old('Curncy_No'), array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        {{ Form::label(trans('admin.Credit_limit'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::text('Credit_Value',old('Credit_Value'), array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="col-md-4">
                                        {{ Form::label(trans('admin.credit_limit_day'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-5">
                                        {{ Form::text('Credit_Days',old('Credit_Days'), array_merge(['class' => 'form-control'])) }}
                                    </div>

                                    <div class="col-md-3">
                                        {{ Form::label(trans('admin.day'), null, ['class' => 'control-label']) }}
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">

                            </div>




                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        {{ Form::label(trans('admin.account_number'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-9">
                                        {{ Form::text('Acc_No',old('Acc_No'), array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        {{ Form::label(trans('admin.creditor'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-9">
                                        {{ Form::text('Fbal_CR',null , array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>
                            </div>

                             <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        {{ Form::label(trans('admin.debtor'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-9">
                                        {{ Form::text('Fbal_Db',null, array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>
                            </div>




                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="col-md-4">
                                        {{ Form::label(trans('admin.tax_number'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-8">
                                        {{ Form::text('Tax_No',old('Tax_No'), array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-4">
                                        {{ Form::label(trans('admin.reference_number'), null, ['class' => 'control-label']) }}
                                    </div>
                                    <div class="col-md-8">
                                        {{ Form::text('Sup_Refno', old('Sup_Refno'), array_merge(['class' => 'form-control'])) }}
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="responsible_persons">
                    <div>
                        <div class="box-body">
                                <div class="form-group row col-md-3">
                                    <div class="col-md-12">
                                        {!!Form::label('Cntct_Prsn1', trans('admin.person_dep_1'))!!}
                                        {!!Form::text('Cntct_Prsn1', old('Cntct_Prsn1'), ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('Cntct_Prsn2', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('Cntct_Prsn3', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('Cntct_Prsn4', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('Cntct_Prsn5', null, ['class'=>'form-control'])!!}
                                    </div>
                                </div>
                                <div class="form-group row col-md-3">
                                    <div class="col-md-12">
                                        {!!Form::label('TitL1', trans('admin.Title_1'))!!}
                                        {!!Form::text('TitL1', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('TitL2', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('TitL3', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('TitL4', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('TitL5', null, ['class'=>'form-control'])!!}
                                    </div>
                                </div>
                                <div class="form-group row col-md-3">
                                    <div class="col-md-12">
                                        {!!Form::label('Mobile1', trans('admin.mobile_1'))!!}
                                        {!!Form::text('Mobile1', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('Mobile2', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('Mobile3', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('Mobile4', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::text('Mobile5', null, ['class'=>'form-control'])!!}
                                    </div>
                                </div>
                                <div class="form-group row col-md-3">
                                    <div class="col-md-12">
                                        {!!Form::label('Email1', trans('admin.email_1'))!!}
                                        {!!Form::email('Email1', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::email('Email2', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::email('Email3', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::email('Email4', null, ['class'=>'form-control'])!!}
                                    </div>
                                    <div class="col-md-12">
                                        {!!Form::email('Email5', null, ['class'=>'form-control'])!!}
                                    </div>
                                </div>
                        </div>


            </div>

                    {!! Form::close() !!}
                </div>
        @endcan
        @else
            <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>
            @endhasrole
    </div>
    </div>


@endsection
