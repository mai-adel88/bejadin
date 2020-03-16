<script>
    $(document).ready(function(){
        $('#delete_button').click(function(e){
            e.preventDefault();
            $('#delete_form').submit()
        });
    });



</script>


{!! Form::open(['method'=>'POST','route' => ['departmentLoc.update', $chart_item->DepmLoc_No? $chart_item->DepmLoc_No : null], 'id' => 'edit_form','files' => true]) !!}
    {{csrf_field()}}
    {{method_field('PUT')}}

    <div class="row col-md-12 pull-left">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="submit" class="btn btn-danger pull-left" id="delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
    </div>

    {{-- رقم الاداره --}}
    <div class="row">
        <label for="DepmLoc_No" class="col-md-4">{{trans('hr.dep_number')}}:</label>
        <input type="text" name="DepmLoc_No" readonly id="Costcntr_No" class="form-control col-md-2" value="{{$chart_item->DepmLoc_No}}">
    
    {{-- الاداره   --}}

    {{-- رقم الشركه --}}
    <input type="text" name="Cmp_No" id="Cmp_No" value="{{$chart_item->Cmp_No}}" hidden>

    {{-- تصنيف الاداره --}}
        <div class="col-md-6">
            @foreach(\App\Enums\dataLinks\TypeAccountType::toSelectArray() as $key => $value)
                <input class="checkbox-inline" type="radio"
                    name="Level_Status" id="Level_Status" value="{{$key}}"
                    style="margin: 3px;" disabled
                    @if ($chart_item->Level_Status == $key) checked @endif>
                <label>{{$value}}</label>
            @endforeach
        </div>
    </div>
    <br>
    {{-- نهاية تصنيف الاداره --}}

    {{-- اسم الاداره عربى --}}
        <div class="form-group row">
            <label class="col-md-4" for="DepmLoc_NmAr">{{trans('admin.name_ar')}}</label>
            <input type="text" name="DepmLoc_NmAr" id="Acc_NmAr" class="col-md-8 form-control" value="{{$chart_item->DepmLoc_NmAr? $chart_item->DepmLoc_NmAr : null}}">
        </div>
    {{-- نهاية اسم الاداره عربى --}}

    {{-- اسم الاداره انجليزى --}}
    <div class="form-group row">
        <label class="col-md-4" for="DepmLoc_NmEn">En</label>
        <input  type="text" name="DepmLoc_NmEn" id="Costcntr_Nmen" class=" col-md-8 form-control"
            value="{{$chart_item->DepmLoc_NmEn? $chart_item->DepmLoc_NmEn : null}}">
    </div>
    
    {{-- الكفيل --}}
    <div class="form-group row">
        <label class="col-md-4" for="Ownr_No">{{trans('hr.Ownr_No')}}</label>
        <select name="Ownr_No" id="Ownr_No" class=" col-md-8 form-control">
            <option disables selected>{{trans('admin.select')}}</option>
        </select>
    </div>
    {{--    الكفيل --}}


{!! Form::close() !!}
<form action="{{route('departmentLoc.destroy', $chart_item->DepmLoc_No? $chart_item->DepmLoc_No : null)}}" method="POST" id="delete_form">
    {{csrf_field()}}
    {{method_field('DELETE')}}
</form>
