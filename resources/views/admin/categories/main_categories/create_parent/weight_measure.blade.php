<div class="tab-pane fade" id="weight_measure" role="tabpanel" aria-labelledby="home-tab">
    <div class="panel panel-default col-md-11 weight_measure_panel">
        <div class="panel-body">
            <div class="panel panel-primary col-md-6">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('admin.iron_measure')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group" style="display: flex">
                        <label style="width: 20%" for="">{{trans('admin.length')}}</label>
                        <input type="text" name="Itm_LengthSteel" id="Itm_LengthSteel" class="form-control Itm_LengthSteel" style="width: 100%">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 20%" for="">{{trans('admin.width')}}</label>
                        <input type="text" name="Itm_WidthSteel" id="Itm_WidthSteel" class="form-control Itm_WidthSteel" style="width: 100%">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 20%" for="">{{trans('admin.durability')}}</label>
                        <input type="text" name="Itm_Durability" id="Itm_Durability" class="form-control Itm_Durability" style="width: 100%">
                    </div>

                </div>
            </div>
            <div class="panel panel-primary col-md-6">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('admin.paper_measure')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group" style="display: flex">
                        <label style="width: 20%" for="">{{trans('admin.length')}}</label>
                        <input name="Itm_LengthPaper" id="Itm_LengthPaper" type="text" class="form-control Itm_LengthPaper" style="width: 100%" >
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 20%" for="">{{trans('admin.width')}}</label>
                        <input type="text" name="Itm_WidthPaper" id="Itm_WidthPaper" class="form-control Itm_WidthPaper" style="width: 100%">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 20%" for="">{{trans('admin.weight')}}</label>
                        <input name="Itm_WghtPaper" id="Itm_WghtPaper" type="text" class="form-control Itm_WghtPaper" style="width: 100%">
                    </div>

                </div>
            </div>
            <div class="panel panel-primary col-md-6">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('admin.medicine')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group" style="display: flex">
                        <label style="width: 30%" for="">{{trans('admin.medical_group_1')}}</label>
                        <input style="width: 100%" type="text" name="Mdcn_Grup1" class="form-control Mdcn_Grup1">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 30%" for="">{{trans('admin.medical_group_2')}}</label>
                        <input style="width: 100%" type="text" name="Mdcn_Grup2" class="form-control Mdcn_Grup2">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 30%" for="">{{trans('admin.medical_group_3')}}</label>
                        <input style="width: 100%" type="text" name="Mdcn_Grup3" class="form-control Mdcn_Grup3">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 30%" for="">{{trans('admin.alternative_item_1')}}</label>
                        <input style="width: 100%" type="text" name="ItmRplc_No1" class="form-control ItmRplc_No1">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 30%" for="">{{trans('admin.alternative_item_2')}}</label>
                        <input style="width: 100%" type="text" name="ItmRplc_No2" class="form-control ItmRplc_No2">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 30%" for="">{{trans('admin.alternative_item_3')}}</label>
                        <input style="width: 100%" type="text" name="ItmRplc_No3" class="form-control ItmRplc_No3">
                    </div>
                    <div class="form-group" style="display: flex">
                        <label style="width: 30%" for="">{{trans('admin.store_place')}}</label>
                        <input name="Shelf_No" id="Shelf_No"  type="text" class="form-control Shelf_No" style="width: 100%">
                    </div>

                </div>
            </div>
            <div class="panel panel-primary col-md-6">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="Itm_Picture"><span class="btn btn-success"> <i class="fa fa-photo"></i> <b>{{trans('admin.choose_pic')}}</b></span></label>
                        <input type="file" name="Itm_Picture" id="Itm_Picture" class="Itm_Picture hidden">
                    </div>

                    <div class="img_content" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center">
                        <img style="width:100%" src="{{asset('public/images/cover_img_2.jpg')}}" alt="{{trans('item_img')}}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group" style="display: flex">
                    <label style="width: 12%" for="Itm_Othr1">{{trans('admin.note_1')}}</label>
                    <textarea name="Itm_Othr1" id="Itm_Othr1" class="form-control Itm_Othr1"></textarea>
                </div>
                <div class="form-group" style="display: flex">
                    <label style="width: 12%" for="Itm_Othr2">{{trans('admin.note_2')}}</label>
                    <textarea name="Itm_Othr2" id="Itm_Othr2" class="form-control Itm_Othr2"></textarea>
                </div>
            </div>

        </div>
    </div>
</div>
