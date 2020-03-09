

<div class="tab-pane fade in" id="menu4">
    <div class="panel">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwItm_RepatVch' id='AllwItm_RepatVch'
                                    value="{{2}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(2)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(2))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwItmLoc_ZroBlnc' id='AllwItmLoc_ZroBlnc'
                                    value="{{3}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(3)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(3))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwBatch_No' id='AllwBatch_No'
                                    value="{{17}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(17)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(17))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwExpt_Dt' id='AllwExpt_Dt'
                                    value="{{18}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(18)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(18))}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwItmQty_CostCalc' id='AllwItmQty_CostCalc'
                                    value="{{4}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(4)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(4))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwDisc1Pur_Dis1Sal' id='AllwDisc1Pur_Dis1Sal'
                                    value="{{5}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(5)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(5))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwDisc2Pur_Dis2Sal' id='AllwDisc2Pur_Dis2Sal'
                                    value="{{6}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(6)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(6))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwStock_Minus' id='AllwStock_Minus'
                                    value="{{7}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(7)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(7))}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwTrnf_Cost' id='AllwTrnf_Cost'
                                    value="{{14}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(14)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(14))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwTrnf_Disc1' id='AllwTrnf_Disc1'
                                    value="{{15}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(15)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(15))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwTrnf_Bouns' id='AllwTrnf_Bouns'
                                    value="{{16}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(16)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(16))}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwPur_Disc1' id='AllwPur_Disc1'
                                    value="{{8}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(8)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(8))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwPur_Disc2' id='AllwPur_Disc2'
                                    value="{{9}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(9)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(9))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwPur_Bouns' id='AllwPur_Bouns'
                                    value="{{10}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(10)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(10))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='TabOrder_SaL' id='TabOrder_SaL'
                                    value="{{22}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(22)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(22))}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwSal_Disc1' id='AllwSal_Disc1'
                                    value="{{11}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(11)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(11))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwSal_Disc2' id='AllwSal_Disc2'
                                    value="{{12}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(12)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(12))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='AllwSal_Bouns' id='AllwSal_Bouns'
                                    value="{{13}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(13)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(13))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='TabOrder_SaL' id='TabOrder_SaL'
                                    value="{{23}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(23)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(23))}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='ActvDnv_No' id='ActvDnv_No'
                                    value="{{19}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(19)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(19))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='ActvSRV_No' id='ActvSRV_No'
                                    value="{{20}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(20)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(20))}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                                    type="checkbox" name='ActvTrnf_No' id='ActvTrnf_No'
                                    value="{{21}}" @if ( $cmp->{\App\Enums\AllowedType::getKey(21)} ) checked @endif>
                                    <label for="">{{trans('admin.'.\App\Enums\AllowedType::getKey(21))}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input class="checkbox-inline"
                                   type="checkbox" name='Accredit_expens' id='Accredit_expens'
                                   value="" @if ( $cmp->Accredit_expens == 1 ) checked @endif>
                            <label for="Accredit_expens">{{trans('admin.Accredit_expens')}}</label>
                        </div>
                    </div>
                    <div class="col-md-12 ma2">
                        <div class="form-group">
                            <input class="checkbox-inline"
                                   type="checkbox" name='Alw_slmacc' id='Alw_slmacc'
                                   value="1" @if ( $cmp->Alw_slmacc == 1 ) checked @endif>
                            <label for="Alw_slmacc">{{trans('admin.Alw_slmacc')}}</label>
                        </div>
                    </div>
                    <div class="panel panel-default col-md-3">
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="checkbox" name='Foreign_Curncy' id='Foreign_Curncy'
                                           value="1" @if ( $cmp->Foreign_Curncy == 1 ) checked @endif>
                                    <label for="Foreign_Curncy">{{trans('admin.Foreign_Curncy')}}</label>
                                </div>
                                <div class="form-group">
                                    <select name="L_Curncy_No" id="L_Curncy_No" class="form-control col-md-">
                                        <option value="{{null}}">{{trans('admin.L_Curncy_No')}}</option>
                                        @foreach($crncy as $crn)
                                            <option @if ( $cmp->L_Curncy_No == $crn->Curncy_No ) selected @endif value="{{$crn->Curncy_No}}">{{ $crn->{'Curncy_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
