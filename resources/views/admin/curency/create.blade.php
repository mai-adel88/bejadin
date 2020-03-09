@extends('admin.index')
@section('title', trans('admin.add_curency'))
@section('content')


    @include('admin.layouts.message')

    <form action="{{route('curencies.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="panel panel-primary" style="width:50%; margin:auto auto;    ">
            <div class="panel-heading">
                <div class="panel-title">
                    {{trans('admin.add_curency')}}
                </div>
            </div>
            <div class="panel-body">
                <div class="row pull-left">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i></button>
                    </div>  
                </div>
                {{-- رقم العمله --}}
                <div class="row">
                    <br><br>
                    <label for="Curncy_No" class="col-md-2">{{trans('admin.Curncy_No')}}</label>
                    <input type="text" name="Curncy_No" id="Curncy_No" class="form-control col-md-2" readonly value="{{$Curncy_No}}">
                </div>
                {{-- نهاية رقم العمله --}}
                {{-- اسم العمله عربى --}}
                <div class="row">
                    <br>
                    <label for="Curncy_NmAr" class="col-md-2">{{trans('admin.arabic_name')}}</label>
                    <input type="text" name="Curncy_NmAr" id="Curncy_NmAr" class="form-control col-md-9">
                </div>
                {{-- نهاية اسم العمله عربى --}}
                {{-- اسم العمله انجليزى --}}
                <div class="row">
                    <br>
                    <label for="Curncy_NmEn" class="col-md-2">{{trans('admin.subscriber_name_en')}}</label>
                    <input type="text" name="Curncy_NmEn" id="Curncy_NmEn" class="form-control col-md-9">
                </div>
                {{-- نهاية اسم العمله انجليزى --}}
                {{-- سعر الصرف --}}
                <div class="row">
                    <br>
                    <label for="Curncy_Rate" class="col-md-2">{{trans('admin.exchange_rate')}}</label>
                    <input type="text" name="Curncy_Rate" id="Curncy_Rate" class="form-control col-md-5">
                </div>
                {{-- نهاية سعر الصرف --}}
            </div>
        </div>
    </form>
@endsection
