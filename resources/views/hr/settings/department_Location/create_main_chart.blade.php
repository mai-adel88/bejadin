{!! Form::open(['method'=>'POST','route' => ['departmentLoc.store'], 'id' => 'edit_form', 'files' => true]) !!}
    {{csrf_field()}}
    {{-- Parnt_Acc --}}
    <input type="text" name="Parnt_DepmLoc" id="Parnt_Acc" value="{{0}}" hidden>
    <input type="text" name="Level_No" id="Level_No" value="{{1}}" hidden>
    <input type="text" name="Level_Status" id="Level_No" value="{{0}}" hidden>
    <input type="text" name="Cmp_No" id="Select_Cmp_No" value="{{session('Chart_Cmp_No')}}" hidden>

    {{-- Parnt_Acc ebd --}}

    <div class="row">
        <div class="col-md-1 pull-left">
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>

        {{-- رقم الاداره --}}
        <label for="DepmLoc_No" class="col-md-2">{{trans('hr.dep_number')}}:</label>
        <input type="text" readonly name="DepmLoc_No" readonly id="Acc_No" class="form-control col-md-1" value="{{$DepmLoc_No}}">
        {{-- رقم الاداره --}}
    </div>
<br>
    {{-- اسم الاداره عربى --}}
    <div class="form-group row">
        <label class="col-md-2" for="DepmLoc_NmAr">{{trans('admin.name_ar')}}</label>
            <input type="text" name="DepmLoc_NmAr" class="col-md-9 form-control">
        </div>
    {{-- نهاية اسم   الاداره عربى --}}

    {{-- اسم الاداره انجليزى --}}
    <div class="form-group row">
        <label class="col-md-2" for="DepmLoc_NmEn">En</label>
        <input type="text" name="DepmLoc_NmEn" id="DepmLoc_NmEn" class=" col-md-9 form-control">
    </div>
    {{-- نهاية اسم الاداره انجليزى --}}

{!! Form::close() !!}
