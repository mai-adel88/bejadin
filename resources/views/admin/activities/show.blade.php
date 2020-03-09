@extends('admin.index')
@section('title', trans('admin.activity_type'))
@section('content')


    @include('admin.layouts.message')

    <div class="panel panel-primary" style="width:50%; margin:auto auto;    ">
        <div class="panel-heading">
            <div class="panel-title">
                {{trans('admin.trad_actitvities')}}
            </div>
        </div>
        <div class="panel-body">
            <div class="row pull-left">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" disabled><i class="fa fa-floppy-o"></i></button>
                </div>  
            </div>
            {{-- رقم النشاط --}}
            <div class="row">
                <br><br>
                <label for="Actvty_No" class="col-md-2">{{trans('admin.Nutr_No')}}</label>
                <input type="text" name="Actvty_No" id="Actvty_No" class="form-control col-md-2" disabled value="{{$act->Actvty_No}}">
            </div>
            {{-- نهاية رقم النشاط --}}
            {{-- اسم الحساب عربى --}}
            <div class="row">
                <br>
                <label for="Name_Ar" class="col-md-2">{{trans('admin.subscriber_name_ar')}}</label>
                <input type="text" name="Name_Ar" id="Name_Ar" class="form-control col-md-9" disabled value="{{$act->Name_Ar}}">
            </div>
            {{-- نهاية اسم الحساب عربى --}}
            {{-- اسم الحساب انجليزى --}}
            <div class="row">
                <br>
                <label for="Name_En" class="col-md-2">{{trans('admin.subscriber_name_en')}}</label>
                <input type="text" name="Name_En" id="Name_En" class="form-control col-md-9" disabled value="{{$act->Name_En}}">
            </div>
            {{-- نهاية اسم الحساب انجليزى --}}
        </div>
    </div>
@endsection
