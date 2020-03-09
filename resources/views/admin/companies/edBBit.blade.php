@extends('admin.index')
@section('title',trans('admin.companies'))
@section('content')
    <div class="box">
        {!! Form::open(['route'=> ['companies.update', $cmp->ID_No],'files' => true]) !!}
        {{csrf_field()}}
        {{method_field('PUT')}}
            <div class="box-header">
                <h3 class="box-title">{{trans('admin.company_fixed_data')}} </h3>
                {{Form::submit(trans('admin.save'),['class'=>'btn btn-primary pull-left'])}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.message')
                <div class="form-group">
                    {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Cmp_NmAr', $cmp->Cmp_NmAr, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Cmp_NmEn', $cmp->Cmp_NmEn, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.email'), null, ['class' => 'control-label']) }}
                    {{ Form::email('Cmp_Email', $cmp->Cmp_Email, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.addriss'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Cmp_Adrs', $cmp->Cmp_Adrs, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.phone'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Cmp_Tel', $cmp->Cmp_Tel, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.facebook'), null, ['class' => 'control-label']) }}
                    {{ Form::text('facebook', $cmp->facebook, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.twitter'), null, ['class' => 'control-label']) }}
                    {{ Form::text('twitter', $cmp->twitter, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.googel'), null, ['class' => 'control-label']) }}
                    {{ Form::text('googel', $cmp->googel, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.linkedin'), null, ['class' => 'control-label']) }}
                    {{ Form::text('linkedin', $cmp->linkedin, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.image'), null, ['class' => 'control-label']) }}
                    {{ Form::file('logo', array_merge(['class' => 'form-control'])) }}
                    @if(!empty(setting()->logo))
                        <img src="{{asset('storage/'.$cmp->logo)}}" style="width: 50px; margin-top: 20px" class="img-responsive" >
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.icon'), null, ['class' => 'control-label']) }}
                    {{ Form::file('icon', array_merge(['class' => 'form-control'])) }}
                    @if(!empty(setting()->icon))
                        <img src="{{asset('storage/'.$cmp->icon)}}" style="width: 50px; margin-top: 20px" class="img-responsive" >
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.main_lang'), null, ['class' => 'control-label']) }}
                    {{ Form::select('main_lang',['ar'=>trans('admin.ar'),'en'=>trans('admin.en')] , setting()->main_lang ,array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.currency'), null, ['class' => 'control-label']) }}
                    {{ Form::select('currancy',\App\Enums\CurrencyType::toSelectArray() , $cmp->currancy ,array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>

                @if(session('lang') == 'en')
                <div class="form-group">
                    {{ Form::label(trans('admin.description'), null, ['class' => 'control-label']) }}
                    {{ Form::textarea('description', $cmp->description, array_merge(['class' => 'form-control'])) }}
                </div>
                    @else
                    <div class="form-group">
                        {{ Form::label(trans('admin.description'), null, ['class' => 'control-label']) }}
                        {{ Form::textarea('description_ar', $cmp->description_ar, array_merge(['class' => 'form-control'])) }}
                    </div>
                @endif
                
                @if(session('lang') == 'en')
                <div class="form-group">
                    {{ Form::label(trans('admin.contact_description'), null, ['class' => 'control-label']) }}
                    {{ Form::textarea('contact_description', $cmp->contact_description, array_merge(['class' => 'form-control'])) }}
                </div>
                    @else
                    <div class="form-group">
                        {{ Form::label(trans('admin.contact_description'), null, ['class' => 'control-label']) }}
                        {{ Form::textarea('contact_description_ar', $cmp->contact_description_ar, array_merge(['class' => 'form-control'])) }}
                    </div>
                @endif
                
                <div class="form-group">
                    {{ Form::label(trans('admin.keyword'), null, ['class' => 'control-label']) }}
                    {{ Form::textarea('keyword', $cmp->keyword, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.status'), null, ['class' => 'control-label']) }}
                    {{ Form::select('status',['open'=>trans('admin.open_status'),'close'=>trans('admin.close_status')] , $cmp->status ,array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.message_Maintenance'), null, ['class' => 'control-label']) }}
                    {{ Form::textarea('message_maintenance' , $cmp->message_maintenance ,array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
            </div>
            <!-- /.box-body -->
        {!! Form::close() !!}
    </div>







@endsection