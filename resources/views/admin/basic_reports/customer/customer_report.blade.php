@extends('admin.index')
@section('title',trans('admin.report_client'))
@section('content')
    @push('css')
        <style>

            .container {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;

                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Hide the browser's default checkbox */
            .container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            /* Create a custom checkbox */
            .checkmark {
                position: absolute;
                top: 0;
                left: 28px;
                height: 25px;
                width: 25px;
                background-color: #eee;
            }

            /* On mouse-over, add a grey background color */
            .container:hover input ~ .checkmark {
                background-color: #ccc;
            }

            /* When the checkbox is checked, add a blue background */
            .container input:checked ~ .checkmark {
                background-color: #2196F3;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the checkmark when checked */
            .container input:checked ~ .checkmark:after {
                display: block;
            }

            /* Style the checkmark/indicator */
            .container .checkmark:after {
                left: 9px;
                top: 5px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            .vertical-menu{
                padding-top: 46px;

            }
            .myradio__input {
                opacity: 0;
                position: absolute;
            }
            .myradio__label {
                border-radius: 9999px;
                padding: 5px 15px 5px 40px;
                cursor: pointer;
                position: relative;
                transition: all .5s;
            }
            .myradio__label::before, .myradio__label::after {
                content: "";
                border-radius: 9999px;
                width: 16px;
                height: 16px;
                margin: 3px 0;
                position: absolute;
                z-index: 1;
            }
            .myradio__label::before {
                background-color: #FFFFFF;
                border: 2px solid #DCDCDC;
                top: 4px;
                left: 10px;
                transition: all .5s;
            }
            .myradio__label::after {
                background-color: transparent;
                top: 6px;
                left: 12px;
                transition: all .2s;
                transition-timing-function: ease-out;
            }
            .myradio__label:hover::after {
                background-color: rgba(51, 170, 221, 0.08);
                transform: scale(2.5);
            }
            .myradio__input:checked ~ .myradio__label::before {
                background-color: #FFFFFF;
                border: 2px solid #33aadd;
            }
            .myradio__input:checked ~ .myradio__label::after {
                background-color: #33aadd;
                border: 2px solid transparent;
                top: 4px;
                left: 10px;
                transform: scale(0.6);
            }
            .myradio__input:checked ~ .myradio__label:hover::after {
                transform: scale(0.6);
            }
            .container {
                grid-template-rows: 1fr auto;
                text-align: center;
            }
            .form {
                margin: 0;
            }
            .form {
                font-size: 1.8rem;
                margin: 5rem 0;
            }


            .vertical-menu a ,.custom_radio{

                color: black;
                display: block;
                padding: 12px;
                text-decoration: none;
            }

            .right
            {
                float: right;
                clear: right;
                padding-right: 270px;

            }

            .left
            {
                float: left;
                clear: left;
                padding-left: 230px;
            }
        </style>
    @endpush
    <?php $to_glcc_select = null;?>
    @push('js')
        <script>
            $(document).ready(function() {

                $(".e2").select2({
                    placeholder: "{{trans('admin.select')}}",
                    // allowClear: true,
                    dir: '{{direction()}}'
                });
            });

        </script>
    @endpush

    @push('js')

        <script>
            $(document).ready(function(){

                $('.mainCompany').on('change',function(){
                    $("#loadingmessage").css("display","block");
                    $(".column_data").css("display","none");
                    var mainCompany = $('.mainCompany').val();

                    console.log(mainCompany);
                    if (this){
                        $.ajax({
                            url: '{{route('get_mainbranches')}}',
                            type:'get',
                            dataType:'html',
                            data:{mainCompany : mainCompany},
                            success: function (data) {
                                $("#loadingmessage").css("display","none");


                            }
                        });
                    }else{
                        $('.column_data').html('');
                    }


                });
            });
            $('.myradio__input').on('click',function () {
                var value = $(this).val();
                var active = $('.active:checked').val();
                var notactive = $('.notactive:checked').val();
                var mainCompany =$('.mainCompany').val();
                // var MainBranch =$('.MainBranch').val();
                //console.log(mainCompany,MainBranch,value);
                if(this){
                    $.ajax({
                        dataType: 'html',
                        data:{value:value,mainCompany:mainCompany,active:active,notactive:notactive},
                        type:'get',
                        url:'{{route('cust_report_select')}}',
                        success:function (data) {
                            $("#loadingmessage").css("display","none");
                            if (value == 'bransh'){
                                $('#AstSalesmanIn').addClass('hidden');
                                $('#ActivityTypes').addClass('hidden');
                                $('#ActivityTypesIn').addClass('hidden');
                                $('#countryIn').addClass('hidden');
                                $('#cityIn').addClass('hidden');
                                $('#AstMarketIn').addClass('hidden');
                                $('#AstsupctgIn').addClass('hidden');
                                $('#branshIn').removeClass('hidden');
                                $('#branshIn').html(data);

                            }else if(value == 'AstSalesman'){
                                $('#ActivityTypes').addClass('hidden');
                                $('#ActivityTypesIn').addClass('hidden');
                                $('#countryIn').addClass('hidden');
                                $('#cityIn').addClass('hidden');
                                $('#AstMarketIn').addClass('hidden');
                                $('#AstsupctgIn').addClass('hidden');
                                $('#branshIn').addClass('hidden');
                                $('#AstSalesmanIn').removeClass('hidden');
                                $('#AstSalesmanIn').html(data);

                            }else if(value == 'ActivityTypes'){
                                $('#AstSalesmanIn').addClass('hidden');
                                $('#ActivityTypesIn').addClass('hidden');
                                $('#countryIn').addClass('hidden');
                                $('#cityIn').addClass('hidden');
                                $('#AstMarketIn').addClass('hidden');
                                $('#AstsupctgIn').addClass('hidden');
                                $('#branshIn').addClass('hidden');
                                $('#ActivityTypesIn').removeClass('hidden');
                                $('#ActivityTypesIn').html(data);

                            }else if(value == 'country'){
                                $('#ActivityTypes').addClass('hidden');
                                $('#ActivityTypesIn').addClass('hidden');
                                $('#AstSalesmanIn').addClass('hidden');
                                $('#cityIn').addClass('hidden');
                                $('#AstMarketIn').addClass('hidden');
                                $('#AstsupctgIn').addClass('hidden');
                                $('#branshIn').addClass('hidden');
                                $('#countryIn').removeClass('hidden');
                                $('#countryIn').html(data);

                            }else if(value == 'city'){
                                $('#ActivityTypes').addClass('hidden');
                                $('#ActivityTypesIn').addClass('hidden');
                                $('#AstSalesmanIn').addClass('hidden');
                                $('#countryIn').addClass('hidden');
                                $('#AstMarketIn').addClass('hidden');
                                $('#AstsupctgIn').addClass('hidden');
                                $('#branshIn').addClass('hidden');
                                $('#cityIn').removeClass('hidden');
                                $('#cityIn').html(data);
                            }
                            else if(value == 'AstMarket'){
                                $('#ActivityTypes').addClass('hidden');
                                $('#ActivityTypesIn').addClass('hidden');
                                $('#AstSalesmanIn').addClass('hidden');
                                $('#countryIn').addClass('hidden');
                                $('#cityIn').addClass('hidden');
                                $('#AstsupctgIn').addClass('hidden');
                                $('#branshIn').addClass('hidden');
                                $('#AstMarketIn').removeClass('hidden');
                                $('#AstMarketIn').html(data);
                            }

                            else if(value == 'Astsupctg'){
                                $('#ActivityTypes').addClass('hidden');
                                $('#ActivityTypesIn').addClass('hidden');
                                $('#AstSalesmanIn').addClass('hidden');
                                $('#countryIn').addClass('hidden');
                                $('#cityIn').addClass('hidden');
                                $('#AstMarketIn').addClass('hidden');
                                $('#branshIn').addClass('hidden');
                                $('#AstsupctgIn').removeClass('hidden');
                                $('#AstsupctgIn').html(data);
                            }
                            // $('.row_input').css("display","block").html(data);
                        }

                    })
                }else
                {
                    $('.row_input').html('');

                }


            })

        </script>



    @endpush


    <div class="box">
        @include('admin.layouts.message')
        @include('admin.layouts.error')

        <div class="box-body">

            <form action="{{route('cust_report_pdf')}}" method="POST">
                {{ csrf_field() }}
                <div class="panel panel-primary" style="width:100%; margin:auto auto;">
                    <div class="panel-heading">
                        <div class="panel-title">
                            {{trans('admin.report_client')}}
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::label('mainCompany','الشركة', ['class' => 'col-md-2']) }}
                                {{ Form::select('mainCompany',$mainCompany,null, array_merge(['class' => 'form-control  mainCompany col-md-9','placeholder'=> trans('admin.select') ])) }}
                            </div>
                            <div class="col-md-2">
                                <label class="container">فعال
                                    <input class="active" name="active" value="1"  type="checkbox" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-2">
                                <label class="container">غير فعال
                                    <input class="notactive" name="notactive" value="0" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="row">

                            <div class="vertical-menu  col-md-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="custom_radio">
                                            <input  value="bransh" type="radio" name="myRadio" id="one"  class="myradio__input" >
                                            <label  for="one" class="myradio__label">الفرع</label>
                                        </div>
                                    </div>

                                    <div class="col-md-8" id="branshIn"></div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="custom_radio">
                                            <input value="AstSalesman" type="radio" name="myRadio" id="two"  class="myradio__input" >
                                            <label  for="two" class="myradio__label">المندوب</label>
                                        </div>
                                    </div>

                                    <div class="col-md-8" id="AstSalesmanIn"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="custom_radio">
                                            <input value="ActivityTypes" type="radio" name="myRadio" id="three"  class="myradio__input" >
                                            <label  for="three" class="myradio__label"> النشاط</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8" id="ActivityTypesIn"></div>

                                </div>

                            </div>


                            <div class="vertical-menu  col-md-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="custom_radio">
                                            <input value="country" type="radio" name="myRadio" id="four"  class="myradio__input" >
                                            <label for="four" class="myradio__label">الدول</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8" id="countryIn"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="custom_radio">
                                            <input value="city" type="radio" name="myRadio" id="five"  class="myradio__input" >
                                            <label for="five" class="myradio__label">المدينة</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8" id="cityIn"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="custom_radio">
                                            <input value="AstMarket" type="radio" name="myRadio" id="six"  class="myradio__input" >
                                            <label for="six" class="myradio__label">المشرف</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8" id="AstMarketIn"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="custom_radio">
                                            <input value="Astsupctg" type="radio" name="myRadio" id="seven"  class="myradio__input" >
                                            <label for="seven" class="myradio__label">تصنيف العميل</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8" id="AstsupctgIn"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row_input">

                        </div>
                    </div>


                </div>
            </form>


        </div>


    </div>


    <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
        <img src="{{ url('/') }}/images/ajax-loader.gif"/>
    </div>






    {{--<button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>--}}



@endsection
