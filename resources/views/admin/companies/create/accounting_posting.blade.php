@push('js')
  <script>
         $(document).ready(function () {
            $('#JVPst_InvCost').change(function(){
                if($('#JVPst_InvCost').prop('checked')){
                    $('#JVPst_TrnsferVch').attr('checked', 'checked');
                    $('#JVPst_AdjustVch').attr('checked', 'checked');
                }
                else{
                    $('#JVPst_TrnsferVch').removeAttr('checked');
                    $('#JVPst_AdjustVch').removeAttr('checked');
                }
            });

            $('#JVPst_InvSal').change(function(){
                if($('#JVPst_InvSal').prop('checked')){
                    $('#JVPst_TrnsferVch').attr('checked', 'checked');
                    $('#JVPst_AdjustVch').attr('checked', 'checked');
                }
                else{
                    $('#JVPst_TrnsferVch').removeAttr('checked');
                    $('#JVPst_AdjustVch').removeAttr('checked');
                }
            });
         });

    </script>
@endpush

<div class="tab-pane fade in" id="activity">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='JVPst_SalCash' id='JVPst_SalCash' 
                        value="{{2}}" @if ( $cmp->{\App\Enums\AccountPostingType::getKey(2)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\AccountPostingType::getKey(2))}}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='JVPst_NetSalCrdt' id='JVPst_NetSalCrdt' 
                        value="{{4}}" @if ( $cmp->{\App\Enums\AccountPostingType::getKey(4)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\AccountPostingType::getKey(4))}}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='JVPst_TrnsferVch' id='JVPst_TrnsferVch' 
                        value="{{6}}" @if ( $cmp->{\App\Enums\AccountPostingType::getKey(6)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\AccountPostingType::getKey(6))}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='JVPst_PurCash' id='JVPst_PurCash' 
                        value="{{3}}" @if ( $cmp->{\App\Enums\AccountPostingType::getKey(3)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\AccountPostingType::getKey(3))}}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='JVPst_NetPurCrdt' id='JVPst_NetPurCrdt' 
                        value="{{5}}" @if ( $cmp->{\App\Enums\AccountPostingType::getKey(5)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\AccountPostingType::getKey(5))}}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='JVPst_AdjustVch' id='JVPst_AdjustVch' 
                        value="{{7}}" @if ( $cmp->{\App\Enums\AccountPostingType::getKey(7)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\AccountPostingType::getKey(7))}}</label>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row" style="text-align:center;">
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='JVPst_InvCost' id='JVPst_InvCost' 
                        value="{{8}}" @if ( $cmp->{\App\Enums\AccountPostingType::getKey(8)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\AccountPostingType::getKey(8))}}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px" 
                        type="checkbox" name='JVPst_InvSal' id='JVPst_InvSal' 
                        value="{{9}}" @if ( $cmp->{\App\Enums\AccountPostingType::getKey(9)} ) checked @endif>
                        <label for="">{{trans('admin.'.\App\Enums\AccountPostingType::getKey(9))}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
