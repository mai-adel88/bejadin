@extends('admin.index')
@section('title',trans('admin.dashboard_setting'))
@section('content')
    <div class="box">
        {!! Form::open(['route'=>'setting.save','files' => true]) !!}
            <div class="box-header">
                <h3 class="box-title">{{trans('admin.dashboard_setting')}} </h3>
                {{Form::submit(trans('admin.save'),['class'=>'btn btn-primary pull-left'])}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('admin.layouts.message')
                <div class="form-group">
                    {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Cmp_NmAr', setting()->sitename_ar, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Cmp_NmEn', setting()->sitename_en, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.email'), null, ['class' => 'control-label']) }}
                    {{ Form::email('Cmp_Email', setting()->email, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.addriss'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Cmp_Adrs', setting()->addriss, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.phone'), null, ['class' => 'control-label']) }}
                    {{ Form::text('Cmp_Tel', setting()->phone, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.facebook'), null, ['class' => 'control-label']) }}
                    {{ Form::text('facebook', setting()->facebook, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.twitter'), null, ['class' => 'control-label']) }}
                    {{ Form::text('twitter', setting()->twitter, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.googel'), null, ['class' => 'control-label']) }}
                    {{ Form::text('googel', setting()->googel, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.linkedin'), null, ['class' => 'control-label']) }}
                    {{ Form::text('linkedin', setting()->linkedin, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.image'), null, ['class' => 'control-label']) }}
                    {{ Form::file('logo', array_merge(['class' => 'form-control'])) }}
                    @if(!empty(setting()->logo))
                        <img src="{{asset('storage/'.setting()->logo)}}" style="width: 50px; margin-top: 20px" class="img-responsive" >
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.icon'), null, ['class' => 'control-label']) }}
                    {{ Form::file('icon', array_merge(['class' => 'form-control'])) }}
                    @if(!empty(setting()->icon))
                        <img src="{{asset('storage/'.setting()->icon)}}" style="width: 50px; margin-top: 20px" class="img-responsive" >
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.main_lang'), null, ['class' => 'control-label']) }}
                    {{ Form::select('main_lang',['ar'=>trans('admin.ar'),'en'=>trans('admin.en')] , setting()->main_lang ,array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.currency'), null, ['class' => 'control-label']) }}
                    {{ Form::select('currancy',\App\Enums\CurrencyType::toSelectArray() , setting()->currancy ,array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                @if(session('lang') == 'en')
                <div class="form-group">
                    {{ Form::label(trans('admin.description'), null, ['class' => 'control-label']) }}
                    {{ Form::textarea('description', setting()->description, array_merge(['class' => 'form-control'])) }}
                </div>
                    @else
                    <div class="form-group">
                        {{ Form::label(trans('admin.description'), null, ['class' => 'control-label']) }}
                        {{ Form::textarea('description_ar', setting()->description_ar, array_merge(['class' => 'form-control'])) }}
                    </div>
                @endif
                @if(session('lang') == 'en')
                <div class="form-group">
                    {{ Form::label(trans('admin.contact_description'), null, ['class' => 'control-label']) }}
                    {{ Form::textarea('contact_description', setting()->contact_description, array_merge(['class' => 'form-control'])) }}
                </div>
                    @else
                    <div class="form-group">
                        {{ Form::label(trans('admin.contact_description'), null, ['class' => 'control-label']) }}
                        {{ Form::textarea('contact_description_ar', setting()->contact_description_ar, array_merge(['class' => 'form-control'])) }}
                    </div>
                @endif
                <div class="form-group">
                    {{ Form::label(trans('admin.keyword'), null, ['class' => 'control-label']) }}
                    {{ Form::textarea('keyword', setting()->keyword, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.status'), null, ['class' => 'control-label']) }}
                    {{ Form::select('status',['open'=>trans('admin.open_status'),'close'=>trans('admin.close_status')] , setting()->status ,array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
                <div class="form-group">
                    {{ Form::label(trans('admin.message_Maintenance'), null, ['class' => 'control-label']) }}
                    {{ Form::textarea('message_maintenance' , setting()->message_maintenance ,array_merge(['class' => 'form-control','placeholder'=>trans('admin.select')])) }}
                </div>
            </div>
            <!-- /.box-body -->
        {!! Form::close() !!}
    </div>







@endsection