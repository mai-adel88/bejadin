<script>
    $(document).ready(function(){

        $('.selecd_input').on('change',function(){

            var selecd_input = $(this).val();
            var mainCompany = '{{$mainCompany}}';
            var active = '{{$active}}';
            var notactive = '{{$notactive}}';
            var myradio = '{{$myradio}}';

            $("#loadingmessage").css("display","block");
            if (this){
                $.ajax({
                    url: '{{route('sup_report_print')}}',
                    type:'get',
                    dataType:'html',
                    data:{selecd_input : selecd_input,mainCompany:mainCompany,myradio:myradio, active:active, notactive:notactive},
                    success: function (data) {
                        $("#loadingmessage").css("display","none");
                        $('.div_print').css("display","block").html(data);

                    }
                });
            }else{
                $('.div_print').html('');
            }

        });


    });
</script>
@if($mainCompany != null)

@if($myradio == 'country')
<div class="row">
    <select class="col-md-9 form-control selecd_input" >
            <option>{{trans('admin.select')}}</option>
            <option class="" value="-1">{{trans('admin.public')}}</option>
        @foreach($country as $one)

            <option  value="{{$one->id}}">{{$one->{'country_name_'. session('lang')}   }}</option>
        @endforeach
    </select>
</div>


@elseif($myradio == 'bransh')
<div class="row">
    <select class="form-control e2 selecd_input col-md-9">
        <option  value="-1"> {{trans('admin.select')}}</option>
        @foreach($MainBranch as $one)
            <option value="{{$one->Brn_No}}">{{$one->{'Brn_Nm'.ucfirst(session('lang'))} }}
            </option>
        @endforeach
    </select>
</div>

@elseif($myradio == 'Currency')
    <div class="row">
    <select class="col-md-9 form-control selecd_input">
        <option value="-1">{{trans('admin.select')}}</option>
        @foreach($currency as $one)
            <option value="{{$one->Curncy_No}}">{{$one->{'Curncy_Nm'.ucfirst(session('lang'))} }}</option>
        @endforeach
    </select>
    </div>



@elseif($myradio == 'AstSalesman')
    <div class="row">
            <select class="col-md-9 form-control selecd_input">
                <option value="-1">{{trans('admin.select')}}</option>
                @foreach($AstSalesman as $one)
                    <option value="{{$one->Slm_No}}">{{$one->{'Slm_Nm'.ucfirst(session('lang'))} }}</option>
                    @endforeach
            </select>
    </div>

@elseif($myradio == 'ActivityTypes')
    <div class="row">
        <select class="col-md-9 selecd_input">
            <option value="-1">{{trans('admin.select')}}</option>
            @foreach($ActivityTypes as $one)
                <option value="{{$one->Actvty_No}}">{{$one->{'Name_'.ucfirst(session('lang'))} }}</option>
            @endforeach
        </select>
    </div>

@elseif($myradio == 'Astsupctg')
    <div class="row">
        <select class="col-md-9 selecd_input">
            <option value="-1">{{trans('admin.select')}}</option>
            @foreach($Astsupctg as $one)
                <option value="{{$one->Supctg_No}}">{{$one->{'Supctg_Nm'.session('lang')} }}</option>
            @endforeach
        </select>
    </div>
@endif
@endif





<div class="div_print">

</div>

<div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
    <img src="{{ url('/') }}/images/ajax-loader.gif"/>
</div>
