<tr>
    <td class="delete_row bg-red"><span>{{$row}}</span><input type="hidden" name="Ln_No" value="{{$row}}"></td>
    <td><input id="itm_no_input_{{$row}}" class="itm_no_input text-center" type="text"></td>
    <td>
        <select name="Itm_No" id="Itm_No_{{$row}}" class="Itm_No" >
            <option value="">{{trans('admin.select')}}</option>
            @foreach($items as $item)
                <option value="{{$item->Itm_No}}">{{$item->{'Itm_Nm'.ucfirst(session('lang'))} }}</option>
            @endforeach
        </select>
    </td>
    <td style="width: 9%">
        <select name="Unit_No" id="Unit_No_{{$row}}" class="Unit_No" >
            <option value="">{{trans('admin.select')}}</option>
{{--            @foreach($units as $unit)--}}
{{--                <option value="{{$unit->Unit_No}}">{{$unit->{'Unit_Nm'.ucfirst(session('lang'))} }}</option>--}}
{{--            @endforeach--}}
        </select>
    </td>
    <td><input type="text" name="Loc_No" id="Loc_No_{{$row}}" class="Loc_No"></td>
    <td><input type="number" min="1" name="Qty" id="Qty_{{$row}}" class="Qty"></td>
    <td><input type="number" min="1" name="Itm_Sal" id="Itm_Sal_{{$row}}" class="Itm_Sal"></td>
    <td><input type="text" name="Titm_Sal" id="Titm_Sal_{{$row}}" class="Titm_Sal"></td>
    <td><input type="date" name="Exp_Date" id="Exp_Date_{{$row}}" class="Exp_Date datepicker" style="padding: 0; border-radius: 0"></td>
    <td><input type="text" name="Batch_No" class="Batch_No" id="Batch_No_{{$row}}"></td>
    <td><input type="text" name="Disc1_Prct" value="0" id="Disc1_Prct_{{$row}}" class="Disc1_Prct"></td>
    <td><input type="text" name="Disc1_Val" value="0" id="Disc1_Val_{{$row}}" class="Disc1_Val"></td>
    <td><input type="text" name="Taxp_ExtraDtl" value="5" id="Taxp_ExtraDtl_{{$row}}" class="Taxp_ExtraDtl"></td>
    <td><input type="text" name="Taxv_ExtraDtl" value="0" id="Taxv_ExtraDtl_{{$row}}" class="Taxv_ExtraDtl"></td>
</tr>
