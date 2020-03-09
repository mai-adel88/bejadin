@include('web.layouts.LogLayouts.header')
<style>
    @if(session('lang') == 'ar')
        .form-body{
        direction: rtl;
    }
    .form-content .page-links a:last-child {
        margin-right: 10px
    }
    .form-content .form-items {
        text-align: right;
    }
    .form-content input {
        text-align: right;
    }
    @endif
</style>
<div class="form-body">
        <div class="website-logo">
            <a href="index-2.html">
                <div class="logo">
                    <img class="logo-size" src="images/logo-light.svg" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder" style="padding:0 60px">
                <div class="bg"></div>
                <div class="info-holder">
                    <p>{{session_lang(setting()->description,setting()->description_ar)}}</p>
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content" style="padding: 30px 60px 0 60px">
                    <div class="form-items">
                        <div class="page-links">
                            <a href="{{ route('login') }}">{{trans('auth.Login')}}</a><a href="{{ route('register') }}" class="active">{{trans('auth.Register')}}</a>
                        </div>
                        @include('admin.layouts.message')
                        {!! Form::open(['method'=>'POST','route' => 'register']) !!}
                        <div class="form-group">
                            {{ Form::label(trans('auth.arabic_name'), null, ['class' => 'control-label']) }}
                            {{ Form::text('name', old('name'), array_merge(['class' => 'form-control'])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label(trans('auth.english_name'), null, ['class' => 'control-label']) }}
                            {{ Form::text('name_en', old('name_en'), array_merge(['class' => 'form-control'])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label(trans('auth.Addriss'), null, ['class' => 'control-label']) }}
                            {{ Form::text('addriss', old('addriss'), array_merge(['class' => 'form-control'])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label(trans('auth.phone'), null, ['class' => 'control-label']) }}
                            {{ Form::number('phone', old('phone'), array_merge(['class' => 'form-control'])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label(trans('auth.gender'), null, ['class' => 'control-label']) }}
                            {{ Form::select('gender', \App\Enums\GenderType::toSelectArray(),null, array_merge(['class' => 'form-control','placeholder'=>trans('auth.select')])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label(trans('auth.cities'), null, ['class' => 'control-label']) }}
                            {{ Form::select('city_id', $cities->pluck(session_lang('city_name_en','city_name_ar'),'id'),null, array_merge(['class' => 'form-control','placeholder'=>trans('auth.select')])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label(trans('auth.state'), null, ['class' => 'control-label']) }}
                            {{ Form::select('state_id', $stats->pluck(session_lang('state_name_en','state_name_ar'),'id'),null, array_merge(['class' => 'form-control','placeholder'=>trans('auth.select')])) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label(trans('auth.email'), null, ['class' => 'control-label']) }}
                            {{ Form::email('email', old('email'), array_merge(['class' => 'form-control'])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label(trans('auth.Password'), null, ['class' => 'control-label']) }}
                            {{ Form::password('password', array_merge(['class' => 'form-control'])) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label(trans('auth.re-password'), null, ['class' => 'control-label']) }}
                            {{ Form::password('password_confirmation', array_merge(['class' => 'form-control'])) }}
                        </div>
                        <div class="form-button">
                            {{Form::button(trans('auth.send'),['type'=>'submit','class'=>'ibtn','id'=>"submit"])}}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('web.layouts.LogLayouts.footer')
