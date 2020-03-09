@extends('admin.index')
@section('title',trans('admin.create_new_state'))
@section('content')
    @hasrole('writer')
    @can('create')
    @push('js')
        <script>
            $(function () {
                'use strict';
                @if(old('country_id'))
                $.ajax({
                    url: '{{aurl('state/create')}}',
                    type:'get',
                    dataType:'html',
                    data:{country_id : '{{old('country_id')}}',select:'{{old('city_id')}}'},
                    success: function (data) {
                        $('.city').html(data);
                    }
                });
                @endif
                $(document).on('change','.country_id',function () {
                    var country = $('.country_id option:selected').val();
                    if (country > 0){
                        $.ajax({
                            url: '{{aurl('state/create')}}',
                            type:'get',
                            dataType:'html',
                            data:{country_id : country,select:''},
                            success: function (data) {
                                $('.city').html(data);
                            }
                        });
                    }else{
                        $('.city').html('');
                    }
                });

            });
        </script>

    @endpush
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'state.store']) !!}
            <div class="form-group">
                {{ Form::label(trans('admin.arabic_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('state_name_ar', old('state_name_ar'), array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.english_name'), null, ['class' => 'control-label']) }}
                {{ Form::text('state_name_en', old('state_name_en'), array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.country'), null, ['class' => 'control-label']) }}
                {{ Form::select('country_id', $country,old('country_id'), array_merge(['class' => 'form-control country_id','placeholder'=>trans('admin.select')])) }}
            </div>
            <div class="form-group">
                {{ Form::label(trans('admin.city'), null, ['class' => 'control-label']) }}
                <span class="city"></span>
            </div>
            {{Form::submit(trans('admin.create'),['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
        @endcan
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole







@endsection