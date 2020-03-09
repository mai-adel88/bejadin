<div class="tab-pane fade show active in" id="cat_data" role="tabpanel" aria-labelledby="home-tab">
    <div class="col-md-11" id="chart_form">
        <div class="row">
            <div class="panel panel-default col-md-12">
                <div class="panel-body">
                    <div style="display: flex">
                        @php
                            $lastItem = \App\Models\Admin\MtsItmmfs::where('Itm_Parnt', null)->orderByDesc('ID_No')->latest()->first();
                        @endphp
                        <div style="display: flex">
                            <label style="width: 26%" for="Itm_No">{{trans('admin.item_no')}}</label>
                            <input style="width: 41%; background: #fff" type="text" name="Itm_No" id="Itm_No" value="@if($itemToEdit){{$itemToEdit->Itm_No}}@elseif($lastItem){{$lastItem->Itm_No+1}} @else{{1}}@endif" class="Itm_No form-control" readonly>

                            <label style="width: 20%; margin-right: 3px" for="Level_No">{{trans('admin.level_no')}}</label>
                            <input style="width: 17%; background: #fff" type="text" name="Level_No" id="Level_No" value="@if($itemToEdit){{$itemToEdit->Level_No}}@elseif($lastItem){{$lastItem->Level_No}} @else{{1}}@endif" class="Level_No form-control" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="parent">{{trans('admin.parent_cat')}}</label>
                            <input id="parent" checked type="radio" name="Level_Status" class="Level_Status" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="child">{{trans('admin.sub_cat')}}</label>
                            <input id="child" type="radio" name="Level_Status" class="Level_Status" value="1">
                        </div>
                        <div class="col-md-6" style="display: flex; justify-content: space-between">
                            <div class="selles">
                                <input id="sells" type="checkbox" name="Sale_Active" class="Sale_Active" value="1">
                                <label for="sells">{{trans('admin.sells')}}</label>
                            </div>
                            <div style="margin-left: 3px">
                                <input type="checkbox" name="Itm_Active" id="Itm_Active" class="Itm_Active" value="1" checked>
                                <label for="Itm_Active">{{trans('admin.active_item')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="col-md-12" style="display: flex; margin-top: 10px">
                                <label style="margin-left: 5px" for="Itm_NmAr">Ar</label>
                                <input type="text" id="Itm_NmAr" name="Itm_NmAr" class="form-control Itm_NmAr" value="@if($itemToEdit){{$itemToEdit->Itm_NmAr}}@endif">
                            </div>
                            <div class="col-md-12" style="display: flex; margin-top: 10px">
                                <label style="margin-left: 5px" for="Itm_NmEn">En</label>
                                <input type="text" id="Itm_NmEn" name="Itm_NmEn" class="form-control Itm_NmEn" value="@if($itemToEdit){{$itemToEdit->Itm_NmEn}}@endif">
                            </div>
                            <div class="col-md-12" style="display: flex; margin-top: 10px">
                                <label for="Sup_No">{{trans('admin.Suppliers')}}</label>
                                <select class="form-control col-md-8 Sup_No" name="Sup_No" id="Sup_No" style="margin-right: 4px">
                                    <option value="" >{{trans('admin.select')}}</option>
                                    @foreach($suppliers as $suppliers)
                                        <option @if($itemToEdit && $itemToEdit->Sup_No == $suppliers->ID_No) selected @endif value="{{$suppliers->ID_No}}" >{{$suppliers->{'Sup_Nm'.ucfirst(session('lang'))} }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control col-md-3 Sup_No_show" id="Sup_No_show">
                            </div>
                            <div class="col-md-12" style="display: flex; margin-top: 10px">
                                <div style="display: flex">
                                    <label style="width: 100%" for="bounce">{{trans('admin.bounce')}}</label>
                                    <input min="1" type="number" name="Prct_SalBouns" class="Prct_SalBouns form-control col-md-12" id="bounce">
                                </div>
                                <div style="display: flex">
                                    <label style="width: 100%" for="additional_ax">{{trans('admin.additional_tax')}}</label>
                                    <input min="1" type="number" name="Taxp_Extra" class="Taxp_Extra form-control col-md-12" id="additional_ax">
                                </div>
                                <div style="display: flex">
                                    <label style="width: 100%" for="request_limit">{{trans('admin.request_limit')}}</label>
                                    <input min="1" type="number" name="Req_Limit" class="Req_Limit form-control col-md-12" id="request_limit">
                                </div>
                            </div>

                            <div class="col-md-12" style="display: flex; justify-content: space-between; margin-top: 10px">
                                <div style="display: flex">
                                    <input type="checkbox" name="Prct_Discount" class="Prct_Discount checkbox-inline" id="discount" value="1">
                                    <label style="width: 100%" for="discount">{{trans('admin.discount')}}</label>
                                </div>
                                <div style="display: flex">
                                    <label style="width: 100%" for="max_sells_quantity">{{trans('admin.max_sells_quantity')}}</label>
                                    <input type="text" name="MaxQty_SaL" class="MaxQty_SaL form-control" id="max_sells_quantity">
                                </div>
                            </div>
                            <div class="col-md-12" style="display: flex; justify-content: space-between; margin-top: 10px">
                                <div style="display: flex">
                                    <input type="checkbox" name="Chk_Qty2" class="Chk_Qty2 checkbox-inline" id="Chk_Qty2" value="1">
                                    <label style="width: 100%" for="Chk_Qty2">{{trans('admin.u2_q_a')}}</label>
                                </div>
                                <div style="display: flex">
                                    <input type="checkbox" name="Chk_Qty3" class="Chk_Qty3 checkbox-inline" id="Chk_Qty3" value="1">
                                    <label style="width: 100%" for="Chk_Qty3">{{trans('admin.u3_q_a')}}</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3" style="margin-bottom: 10px; float: left">
                            <div class="col-md-12" style="border: 1px groove; border-radius: 5px; background: #3c8dbc; color: #fff; padding: 6px">
                            <div style="margin-left: 3px">
                                <input type="checkbox" name="Invt_Active" class="Invt_Active" id="stored" value="1">
                                <label for="stored">{{trans('admin.stored')}}</label>
                            </div>
                            <div style="margin-left: 3px">
                                <input type="checkbox" name="Itm_Req" class="Itm_Req" id="request" value="1">
                                <label for="request">{{trans('admin.request')}}</label>
                            </div>
                            <div style="margin-left: 3px">
                                <input type="checkbox" name="Itm_Relation" class="Itm_Relation" id="linked" value="1">
                                <label for="linked">{{trans('admin.linked')}}</label>
                            </div>
                        </div>
                        <div class="col-md-12" style="border: 1px groove; border-radius: 5px; background: #3c8dbc; color: #fff; padding: 6px">
                            <div style="margin-left: 3px">
                                <input type="radio" name="Measure_Grp" class="Measure_Grp" id="general" value="0">
                                <label for="general">{{trans('admin.general')}}</label>
                            </div>
                            <div style="margin-left: 3px">
                                <input type="radio" name="Measure_Grp" class="Measure_Grp" id="product_collect"value="1">
                                <label for="product_collect">{{trans('admin.product_collect')}}</label>
                            </div>
                            <div style="margin-left: 3px">
                                <input type="radio" name="Measure_Grp" class="Measure_Grp" id="pure_material" value="2">
                                <label for="pure_material">{{trans('admin.pure_material')}}</label>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
            </div>
            <div class="panel panel-default col-md-12">
                <div class="panel-body">
                    <div class="row">
                        <table class="table table-responsive text-center">
                            <tr style="display: flex">
                                <td style="width: 10%;"><b>{{trans('admin.main')}}</b></td>
                                <td>
                                    <select name="Unit_No" id="Unit_No" class="form-control col-md-6 Unit_No">
                                        <option value="">{{trans('admin.select')}}</option>
                                        @foreach ($units as $unit)
                                            <option value="{{$unit->ID_No}}">{{$unit->{'Unit_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control col-md-3">
                                </td>
                                <td style="width: 15%;"><b>{{trans('admin.sells_1')}}</b></td>
                                <td><input type="text" name="Itm_Sal1" id="Itm_Sal1" data-sal="#Unit_Sal1" class="form-control col-md-12 Itm_Sal1"></td>
                            </tr>
                            <tr style="display: flex">
                                <td style="width: 10%;"><b>{{trans('admin.buy')}}</b></td>
                                <td>
                                    <select name="UnitPur_No" id="UnitPur_No" class="form-control col-md-6 UnitPur_No">
                                        <option value="">{{trans('admin.select')}}</option>
                                        @foreach ($units as $unit)
                                            <option value="{{$unit->ID_No}}">{{$unit->{'Unit_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control col-md-3">
                                </td>
                                <td style="width: 15%;"><b>{{trans('admin.sells_2')}}</b></td>
                                <td><input type="text" name="Itm_Sal2" id="Itm_Sal2" class="form-control col-md-12 Itm_Sal2"></td>
                            </tr>
                            <tr style="display: flex">
                                <td style="width: 10%;"><b>{{trans('admin.sell')}}</b></td>
                                <td>
                                    <select name="UnitSaL_No" id="UnitSaL_No" class="form-control col-md-6 UnitSaL_No">
                                        <option value="">{{trans('admin.select')}}</option>
                                        @foreach ($units as $unit)
                                            <option value="{{$unit->ID_No}}">{{$unit->{'Unit_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control col-md-3">
                                </td>
                                <td style="width: 15%;"><b>{{trans('admin.buy_price')}}</b></td>
                                <td><input type="text" name="Itm_Pur" id="Itm_Pur" data-sal="#Unit_Pur1" class="form-control col-md-12 Itm_Pur"></td>
                            </tr>
                            <tr style="display: flex">
                                <td style="width: 10%;"><b>{{trans('admin.refno')}}</b></td>
                                <td><input name="Ref_No" id="Ref_No" type="text" class="form-control col-md-11 Ref_No"></td>
                                <td style="width: 20%"></td>
                                <td><b>{{trans('admin.coast')}}</b></td>
                                <td><input type="text" name="Itm_COst" id="Itm_COst" data-sal="#Unit_Cost1" class="form-control col-md-12 Itm_COst"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default col-md-12">
                <div class="panel-body">
                    <div class="row">
                        <table class="table table-hover table-responsive text-center">
                            <tr>
                                <th style="width: 1%"></th>
                                <th style="width: 10%;"></th>
                                <th style="width: 8%">{{trans('admin.number')}}</th>
                                <th style="width: 7%">{{trans('admin.package')}}</th>
                                <th style="width: 9%">{{trans('admin.sells_price')}}</th>
                                <th style="width: 9%">{{trans('admin.buy_price')}}</th>
                                <th style="width: 9%">{{trans('admin.coast')}}</th>
                                <th style="width: 15%">{{trans('admin.factory_barcode')}}</th>
                                <th style="width: 10%;">{{trans('admin.barcode_size')}}</th>
                            </tr>
                            <tbody>
                            <tr>
                                <td>{{trans('admin.main_unit')}}</td>
                                <td>
                                    <select class="form-control Unit_No_1" name="ItmUnit_No[]"   style="background: #fff">
                                        <option value="">{{trans('admin.select')}}</option>
                                        @foreach ($units as $unit)
                                            <option disabled value="{{$unit->ID_No}}">{{$unit->{'Unit_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input class="form-control" id="Unit_No_1" type="text" readonly style="background: #fff"></td>
                                <td ><input class="form-control Unit_Ratio_1" id="Unit_Ratio_1" type="text" name="Unit_Ratio[]" value="1" readonly style="background: #fff"></td>
                                <td><input class="form-control Unit_Sal1" id="Unit_Sal1" name="Unit_Sal1[]" type="text" readonly style="background: #fff"></td>
                                <td><input class="form-control Unit_Pur1" id="Unit_Pur1" name="Unit_Pur[]" type="text" readonly style="background: #fff"></td>
                                <td><input class=" form-control Unit_Cost1" id="Unit_Cost1" name="Unit_Cost[]" type="text" readonly style="background: #fff"></td>
                                <td><input class="form-control Fctry_Barcode1" id="Fctry_Barcode1" name="Fctry_Barcode" type="text"></td>
                                <td>
                                    <select class="form-control Label_No1" name="Label_No[]">
                                        <option value="">{{trans('admin.select')}}</option>
                                        @foreach (\App\Enums\BarCodeSize::toSelectArray() as $key => $barCode)
                                            <option value="{{$key}}">{{$barCode}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>{{trans('admin.unit_1')}}</td>
                                <td>
                                    <select class="form-control Unit_No_2" name="ItmUnit_No[]">
                                        <option value="">{{trans('admin.select')}}</option>
                                        @foreach ($units as $unit)
                                            <option value="{{$unit->ID_No}}">{{$unit->{'Unit_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input class="form-control" id="Unit_No_2" type="text" readonly style="background: #fff"></td>
                                <td ><input class="form-control Unit_Ratio_2" id="Unit_Ratio_2" data-unit-sal="#Unit_Sal2" data-unit-pure="#Unit_Pur2" data-unit-cost="#Unit_Cost2" type="text" name="Unit_Ratio[]"></td>
                                <td><input class="form-control Unit_Sal2" id="Unit_Sal2" name="Unit_Sal1[]" type="text"></td>
                                <td><input class="form-control Unit_Pur2" id="Unit_Pur2" name="Unit_Pur[]" type="text"></td>
                                <td><input class=" form-control Unit_Cost2" id="Unit_Cost2" name="Unit_Cost[]" type="text"></td>
                                <td><input class="form-control Fctry_Barcode2" id="Fctry_Barcode2" name="Fctry_Barcode2" type="text"></td>
                                <td>
                                    <select class="form-control Label_No2" name="Label_No[]">
                                        <option value="">{{trans('admin.select')}}</option>
                                        @foreach (\App\Enums\BarCodeSize::toSelectArray() as $key => $barCode)
                                            <option value="{{$key}}">{{$barCode}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>{{trans('admin.unit_2')}}</td>
                                <td>
                                    <select class="form-control Unit_No_3" name="ItmUnit_No[]">
                                        <option value="">{{trans('admin.select')}}</option>
                                        @foreach ($units as $unit)
                                            <option value="{{$unit->ID_No}}">{{$unit->{'Unit_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input class="form-control" id="Unit_No_3" type="text" readonly style="background: #fff"></td>
                                <td ><input class="form-control Unit_Ratio_3" id="Unit_Ratio_3" data-unit-sal="#Unit_Sal3" data-unit-pure="#Unit_Pur3" data-unit-cost="#Unit_Cost3" type="text" name="Unit_Ratio[]"></td>
                                <td><input class="form-control Unit_Sal3" id="Unit_Sal3" name="Unit_Sal1[]" type="text"></td>
                                <td><input class="form-control Unit_Pur3" id="Unit_Pur3" name="Unit_Pur[]" type="text"></td>
                                <td><input class=" form-control Unit_Cost3" id="Unit_Cost3" name="Unit_Cost[]" type="text"></td>
                                <td><input class="form-control Fctry_Barcode3" id="Fctry_Barcode3" name="Fctry_Barcode3" type="text"></td>
                                <td>
                                    <select class="form-control Label_No3" name="Label_No[]">
                                        <option value="">{{trans('admin.select')}}</option>
                                        @foreach (\App\Enums\BarCodeSize::toSelectArray() as $key => $barCode)
                                            <option value="{{$key}}">{{$barCode}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

