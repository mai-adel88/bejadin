{!! Form::open(['method'=>'POST','route' => ['departmentLoc.store'], 'id' => 'edit_form','files' => true]) !!}
    {{csrf_field()}}
    {{-- Parnt_Acc --}}
    <input type="text" name="Parnt_DepmLoc" id="Parnt_Acc" value="{{$parent? $parent->DepmLoc_No : null}}" hidden>
    <input type="text" name="Cmp_No" id="Cmp_No" value="{{$parent? $parent->Cmp_No : null}}" hidden>
    <input type="text" name="Level_No" id="Level_No" value="{{$parent? $parent->Level_No +1 : null}}" hidden>
    <input type="text" name="Level_Status" id="Level_No" value="{{1}}" hidden>
    {{-- Parnt_Acc end --}}

    <div class="col-md-1 pull-left">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </div>

    {{-- رقم الاداره --}}
    <div class="row">
        <label for="DepmLoc_No" class="col-md-2">{{trans('hr.dep_number')}}:</label>
        <input type="text" name="DepmLoc_No" readonly id="DepmLoc_No" class="form-control col-md-3" value="{{$DepmLoc_No}}">
    {{-- رقم الاداره --}}

    {{-- فعال / غير فعال --}}

        <div class="form-group col-md-4">
            @foreach(\App\Enums\dataLinks\StatusTreeType::toSelectArray() as $key => $value)
                <input class="checkbox-inline" type="radio"
                    name="DepmLoc_Actv" id="Acc_Actv" value="{{$key}}"
                    style="margin: 3px;" @if($key == 1) checked @endif>
                <label>{{$value}}</label>
            @endforeach
        </div>
    </div>

    {{-- اسم الاداره عربى --}}
    <div class="form-group row">
        <label class="col-md-2" for="DepmLoc_NmAr">{{trans('admin.name_ar')}}:</label>
            <input type="text" name="DepmLoc_NmAr" id="DepmLoc_NmAr" class="col-md-9 form-control">
        </div>
    {{-- نهاية اشم الاداره عربى --}}

    {{-- اسم الاداره انجليزى --}}
    <div class="form-group row">
        <label class="col-md-2" for="DepmLoc_NmEn">En</label>
        <input type="text" name="DepmLoc_NmEn" id="DepmLoc_NmEn" class=" col-md-9 form-control">
    </div>
    {{-- نهاية اسم الاداره انجليزى --}}



{!! Form::close() !!}