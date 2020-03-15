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

    <div class="col-md-3 pull-left">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <button type="submit" class="btn btn-danger" id="delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
    </div>

    {{-- رقم الحساب --}}
    <div class="form-group row">
        <label for="DepmLoc_No" class="col-md-2">{{trans('admin.account_number')}}:</label>
        <input type="text" name="DepmLoc_No" id="Costcntr_No" class="form-control col-md-2" value="{{$chart_item->DepmLoc_No}}">
    </div>
    {{-- نهاية تصنيف الحساب --}}

    {{-- رقم الشركه --}}
    <input type="text" name="Cmp_No" id="Cmp_No" value="{{$chart_item->Cmp_No}}" hidden>


    {{-- اسم الحساب عربى --}}
        <div class="form-group row">
            <label class="col-md-2" for="DepmLoc_NmAr">{{trans('admin.account_name')}}:</label>
            <input type="text" name="DepmLoc_NmAr" id="Acc_NmAr" class="col-md-9 form-control" value="{{$chart_item->DepmLoc_NmAr? $chart_item->DepmLoc_NmAr : null}}">
        </div>
    {{-- نهاية اشم الحساب عربى --}}

    {{-- اسم الحساب انجليزى --}}
    <div class="form-group row">
        <label class="col-md-2" for="DepmLoc_NmEn">{{trans('admin.account_name_en')}}:</label>
        <input  type="text" name="DepmLoc_NmEn" id="Costcntr_Nmen" class=" col-md-9 form-control"
            value="{{$chart_item->DepmLoc_NmEn? $chart_item->DepmLoc_NmEn : null}}">
    </div>


{!! Form::close() !!}
<form action="{{route('departmentLoc.destroy', $chart_item->DepmLoc_No? $chart_item->DepmLoc_No : null)}}" method="POST" id="delete_form">
    {{csrf_field()}}
    {{method_field('DELETE')}}
</form>
