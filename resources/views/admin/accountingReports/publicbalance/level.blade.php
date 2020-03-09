<?php
$level = App\levels::where('type','1')->pluck('levelId','id');
?>

@if($department ==1 || $department == 2 ||$department == 3 ||$department == 4)

{{ Form::select('level',$level, null, array_merge(['class' => 'form-control level','placeholder'=>  trans('admin.select')])) }}
@elseif($department == 50||$department == 56||$department ==5 || $department == 6 ||$department == 7 ||$department == 8||$department == 9||$department == 10||$department == 11||$department == 12||$department == 13||$department == 14)



    <select class="form-control level">

        <option >{{trans('admin.select')}}</option>
        @for($start =2 ; $start<= count($level);$start ++)

        <option value="{{$start}}">{{$start}}</option>
        @endfor
    </select>
@else
    <select class="form-control level">

        <option >{{trans('admin.select')}}</option>
        @for($start =2 ; $start<= count($level);$start ++)

            <option value="{{$start}}">{{$start}}</option>
        @endfor
    </select>
@endif



{{--if($department ==15 || $department == 18 ||$department == 35 ||$department == 61||$department == 69||--}}
{{--$department == 72||$department == 74||$department == 76||$department == 80--}}
{{--||$department == 82||$department == 83||$department == 84||$department == 85--}}
{{--||$department == 86||$department == 87||$department == 88||$department == 89||--}}
{{--$department == 96||$department == 98||$department == 99||$department == 128||$department == 145--}}
{{--||$department == 145--}}
{{--)--}}