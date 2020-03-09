@extends('admin.index')
@section('title',trans('admin.edit_contract'))
@section('content')
    {{-- @push('js')

        <script>
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                rtl: true,
                language: '{{session('lang')}}',
                inline:true,
                minDate: 0,
                autoclose:true,
                minDateTime: dateToday

            });
        </script>
    @endpush --}}
@hasanyrole('writer|admin')
@can('create')
    <div class="box">
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        {{--  @include('admin.layouts.message')  --}}
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.edit_contract')}}</h3>
        </div>
        <div class="box-body">
            <div id="append" class="hidden">
                <div class="form-group row">
                    <div class="col-md-6">
                        {{ Form::label('responsible_people',trans('admin.responsible_people') , ['class' => 'control-label']) }}
                        {{ Form::text('responsible_people[]',null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.responsible_people')])) }}
                        @if ($errors->has('responsible_people'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('responsible_people') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('email',trans('admin.email') , ['class' => 'control-label']) }}
                        {{ Form::text('email[]',null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.email')])) }}
                        @if ($errors->has('email'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{ Form::label('phone1',trans('admin.phone1'), ['class' => 'control-label']) }}
                        {{ Form::number('phone1[]',null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.phone1')])) }}
                        @if ($errors->has('phone1'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('phone1') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('phone2',trans('admin.phone2') , ['class' => 'control-label']) }}
                        {{ Form::number('phone2[]',null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.phone2')])) }}
                        @if ($errors->has('phone2'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('phone2') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('mobile',trans('admin.mobile') , ['class' => 'control-label']) }}
                        {{ Form::number('mobile[]',null, array_merge(['class' => 'form-control','placeholder'=>trans('admin.mobile')])) }}
                        @if ($errors->has('mobile'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('mobile') }}</div>
                        @endif
                    </div>
                </div>
                <hr>
            </div>
            {!! Form::model($contractor,['method'=>'PUT','route' => ['contractors.update',$contractor->id]]) !!}
            <div class="form-group row">
                <div class="col-md-6">
                    {{ Form::label('name_ar', trans('admin.Name_of_Contractor_in_Arabic'), ['class' => 'control-label']) }}
                    {{ Form::text('name_ar', $contractor->name_ar, array_merge(['class' => 'form-control','placeholder'=>trans('admin.arabic_name')])) }}
                    @if ($errors->has('name_ar'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('name_ar') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    {{ Form::label('name_en', trans('admin.Name_of_Contractor_in_English'), ['class' => 'control-label']) }}
                    {{ Form::text('name_en', $contractor->name_en, array_merge(['class' => 'form-control','placeholder'=>trans('admin.english_name')])) }}
                    @if ($errors->has('name_en'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('name_en') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    {{ Form::label('contractor_type_id', trans('admin.Type_of_Contractor'), ['class' => 'control-label']) }}
                    {{ Form::select('contractor_type_id',$contractortype , $contractor->contractor_type_id , array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                    @if ($errors->has('contractor_type_id'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('contractor_type_id') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    {{ Form::label('address', trans('admin.address'), ['class' => 'control-label']) }}
                    {{ Form::text('address', $contractor->address, array_merge(['class' => 'form-control','placeholder'=>trans('admin.address')])) }}
                    @if ($errors->has('address'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('address') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label('country_id', trans('admin.country'), ['class' => 'control-label']) }}
                    {{ Form::select('country_id',$country, $contractor->country_id, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                    @if ($errors->has('country_id'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('country_id') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    {{ Form::label('currency', trans('admin.currency'), ['class' => 'control-label']) }}
                    {{ Form::select('currency',\App\Enums\CurrencyType::toSelectArray(), $contractor->currency, array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                    @if ($errors->has('currency'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('currency') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    {{ Form::label('credit_limit',trans('admin.Credit_limit') , ['class' => 'control-label']) }}
                    {{ Form::text('credit_limit', $contractor->credit_limit, array_merge(['class' => 'form-control','placeholder'=>trans('admin.Credit_limit')])) }}
                    @if ($errors->has('credit_limit'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('credit_limit') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    {{ Form::label('account_number',trans('admin.account_number') , ['class' => 'control-label']) }}
                    {{ Form::number('account_number', $contractor->account_number, array_merge(['class' => 'form-control','placeholder'=>trans('admin.account_number')])) }}
                    @if ($errors->has('account_number'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('account_number') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    {{ Form::label('debtor',trans('admin.debtor') , ['class' => 'control-label']) }}
                    {{ Form::text('debtor', $contractor->debtor, array_merge(['class' => 'form-control','placeholder'=>trans('admin.debtor')])) }}
                    @if ($errors->has('debtor'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('debtor') }}</div>
                    @endif
                </div>
                <div class="col-md-4">
                    {{ Form::label('creditor',trans('admin.creditor') , ['class' => 'control-label']) }}
                    {{ Form::text('creditor', $contractor->creditor, array_merge(['class' => 'form-control','placeholder'=>trans('admin.creditor')])) }}
                    @if ($errors->has('creditor'))
                        <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('creditor') }}</div>
                    @endif
                </div>
            </div>
            <hr>
            <div class="box-header">
                <h3 class="box-title">{{trans('admin.Add_the_responsible_person')}}</h3>
            </div>

            <div id="append2">
                @foreach ($responsiblePerson as $person)
                <div class="form-group row">
                    <div class="col-md-6">
                        {{ Form::label('responsible_people',trans('admin.responsible_people') , ['class' => 'control-label']) }}
                        {{ Form::text('responsible_people[]', $person->responsible_people, array_merge(['class' => 'form-control','placeholder'=>trans('admin.responsible_people')])) }}
                        @if ($errors->has('responsible_people'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('responsible_people') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        {{ Form::label('email',trans('admin.email') , ['class' => 'control-label']) }}
                        {{ Form::text('email[]', $person->email, array_merge(['class' => 'form-control','placeholder'=>trans('admin.email')])) }}
                        @if ($errors->has('email'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{ Form::label('phone1',trans('admin.phone2'), ['class' => 'control-label']) }}
                        {{ Form::number('phone1[]', $person->phone1, array_merge(['class' => 'form-control','placeholder'=>trans('admin.phone2')])) }}
                        @if ($errors->has('phone1'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('phone1') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('phone2',trans('admin.phone2') , ['class' => 'control-label']) }}
                        {{ Form::number('phone2[]', $person->phone2, array_merge(['class' => 'form-control','placeholder'=>trans('admin.phone2')])) }}
                        @if ($errors->has('phone2'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('phone2') }}</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('mobile',trans('admin.mobile') , ['class' => 'control-label']) }}
                        {{ Form::number('mobile[]', $person->mobile, array_merge(['class' => 'form-control','placeholder'=>trans('admin.mobile')])) }}
                        @if ($errors->has('mobile'))
                            <div class="alert alert-danger" style="margin-top: 10px">{{ $errors->first('mobile') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group text-right">
                    <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#exampleModal{{$person->id}}"><i class="fa fa-trash-o fa-lg"></i> Delete</a>
                    <div class="modal fade" id="exampleModal{{$person->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                هل انت متاكد من حذف {{$person->responsible_people}} ؟
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href={{route('resposibleperson.delete',$person->id)}} class="btn btn-danger">{{ trans('admin.delete') }}</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            <a class="btn btn-primary" id="addperson" style="display:block;@if (app()->getLocale() == 'ar') float:left @elseif (app()->getLocale() == 'en') float:right @endif">{{trans('admin.Add_a_new_administrator')}} +</a>

            {{Form::submit(trans('admin.edit_contract'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    @endcan
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

@endhasanyrole







@endsection
