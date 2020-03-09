
<div class="tab-pane fade in" id="menu5">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">
                {{trans('admin.docs')}}
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='Spcrpt_Rcpt' id='Spcrpt_Rcpt' 
                        value="{{2}}" @if ( $cmp->{\App\Enums\FormsType::getKey(2)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\FormsType::getKey(2))}}</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='Spcrpt_Sal' id='Spcrpt_Sal' 
                        value="{{4}}" @if ( $cmp->{\App\Enums\FormsType::getKey(4)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\FormsType::getKey(4))}}</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='Spcrpt_Trnf' id='Spcrpt_Trnf' 
                        value="{{6}}" @if ( $cmp->{\App\Enums\FormsType::getKey(6)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\FormsType::getKey(6))}}</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='Spcrpt_SRV' id='Spcrpt_SRV' 
                        value="{{8}}" @if ( $cmp->{\App\Enums\FormsType::getKey(8)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\FormsType::getKey(8))}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='Spcrpt_Pymt' id='Spcrpt_Pymt' 
                        value="{{3}}" @if ( $cmp->{\App\Enums\FormsType::getKey(3)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\FormsType::getKey(3))}}</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='Spcrpt_Pur' id='Spcrpt_Pur' 
                        value="{{5}}" @if ( $cmp->{\App\Enums\FormsType::getKey(5)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\FormsType::getKey(5))}}</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='Spcrpt_Adjust' id='Spcrpt_Adjust' 
                        value="{{7}}" @if ( $cmp->{\App\Enums\FormsType::getKey(7)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\FormsType::getKey(7))}}</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='Spcrpt_DNV' id='Spcrpt_DNV' 
                        value="{{9}}" @if ( $cmp->{\App\Enums\FormsType::getKey(9)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\FormsType::getKey(9))}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">
                {{trans('admin.printers')}}
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:5px; width: 15px; height: 15px" 
                                type="checkbox" name='PrintOrder_DNV' id='PrintOrder_DNV' 
                                value="{{2}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(2)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(2))}}</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:5px; width: 15px; height: 15px" 
                                type="checkbox" name='PrintOrder_SRV' id='PrintOrder_SRV' 
                                value="{{3}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(3)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(3))}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">   
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                type="checkbox" name='SelctNorm_Prntr1' id='SelctNorm_Prntr1' 
                                value="{{4}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(4)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(4))}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                type="checkbox" name='SelctNorm_Prntr2' id='SelctNorm_Prntr2' 
                                value="{{5}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(5)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(5))}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                type="checkbox" name='SelctNorm_Prntr3' id='SelctNorm_Prntr3' 
                                value="{{6}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(6)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(6))}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">   
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                type="checkbox" name='SelctBarCod_Prntr1' id='SelctBarCod_Prntr1' 
                                value="{{7}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(7)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(7))}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                type="checkbox" name='SelctBarCod_Prntr2' id='SelctBarCod_Prntr2' 
                                value="{{8}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(8)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(8))}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                type="checkbox" name='SelctBarCod_Prntr3' id='SelctBarCod_Prntr3' 
                                value="{{9}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(9)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(9))}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">   
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                type="checkbox" name='SelctPosSlip_Prntr1' id='SelctPosSlip_Prntr1' 
                                value="{{10}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(10)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(10))}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                type="checkbox" name='SelctPosSlip_Prntr2' id='SelctPosSlip_Prntr2' 
                                value="{{11}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(11)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(11))}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                                type="checkbox" name='SelctPosSlip_Prntr12' id='SelctPosSlip_Prntr12' 
                                value="{{12}}" @if ( $cmp->{\App\Enums\PrintersType::getKey(12)} ) checked @endif>
                                <label for="">{{trans('admin.'.\App\Enums\PrintersType::getKey(12))}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>