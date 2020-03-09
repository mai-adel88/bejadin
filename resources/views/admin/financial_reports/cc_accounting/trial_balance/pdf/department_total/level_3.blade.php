
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: 'dejavu sans', sans-serif;
        direction:rtl;
        text-align:right;
        padding:0;
        margin: 0;
    }
    .el-date{
        float: right;
        width: 40%
    }
    .el-date p{
        font-size: 12px;
        margin: 0 20px -25px;
        padding: 15px 0;
    }
    .el-no3{
        width:100%;
        display:block;
        margin:0 auto;
        text-align:center;
    }
    .el-no3 span{
        padding: 5px 20px !important;
        font-weight: bold;
        font-size: 12px;
    }
    .clearfix{
        clear:both;
    }
    table{
        width: 100%;
        text-align: center;
        font-size: 10px;
        margin-top: 20px;
    }
    .table th{
        background-color: #f3f3f3;
        text-align: center;
        font-size: 11px;
    }
    .table td{
        text-align: right;
    }
    table td, table th {
        padding: .5rem;
        vertical-align: middle;
        border: 1px solid #000000 !important;
    }
    table .th-empty{
        border: none !important;
        background: none
    }
</style>
<body>
<div style="display: none">
    {{$allCredit = 0}}
    {{$allDebtor = 0}}</div>
<div>
    <div style="float:right;font-weight:bold;width:50%">{{setting()->sitename_ar}}</div>
    <div style="float:left;font-weight:bold;width:50%;text-align:left">{{setting()->sitename_en}}</div>
</div>
<div style="text-align:center">
    <img src="{{asset('storage/'. setting()->icon)}}" style="max-width:70px;margin:15px 0">
</div>

<div class="el-no3">
    <span>تقرير بارصدة الشركات ومراكز التكلفة</span>
</div>

<div class="clearfix"></div>
<div class="el-date">
    <p>من تاريخ : {{$from}}</p>
    <p>الى تاريخ : {{$to}}</p>
</div>


<div class="clearfix"></div>
<div class="table-responsive">
    <table style="border: none" class="table table-bordered table-striped table-hover text-center">
        <tr>
            <th colspan="2">{{trans('admin.cc_account_name')}}</th>
            <th colspan="2">{{trans('admin.first_date')}}</th>
            <th colspan="2">{{trans('admin.motion')}}</th>
            <th colspan="2">{{trans('admin.last_date')}}</th>
        </tr>
        <tr>
            <th style="width:20px">الرقم</th>
            <th>{{trans('admin.description')}}</th>
            <th>{{trans('admin.debtor')}}</th>
            <th>{{trans('admin.creditor')}}</th>
            <th>{{trans('admin.debtor')}}</th>
            <th>{{trans('admin.creditor')}}</th>
            <th>{{trans('admin.debtor')}}</th>
            <th>{{trans('admin.creditor')}}</th>
        </tr>
        <div style="display: none">{{ $i = 1 }}
            {{$balance = 0}}
            {{$sum = 0}}
            {{$dataDebtor = 0}}
            {{$dataCredit = 0}}
            {{$dataCredity = 0}}
            {{$dataDebtory = 0}}
            {{$creditorx = 0}}
            {{$debtorx = 0}}
            {{$creditor1x = 0}}
            {{$debtor1x = 0}}
            {{$dataDebtor1 = 0}}
            {{$dataDebtor1y = 0}}
            {{$dataCredit1 = 0}}
            {{$dataCredit1y = 0}}
            {{$dataDebtor2 = 0}}
            {{$dataDebtor2y = 0}}
            {{$dataCredit2 = 0}}
            {{$debtor2y = 0}}
            {{$creditor2y = 0}}
            {{$dataCredit2y = 0}}
            {{$alldeby = 0}}
            {{$alldeb2y = 0}}
            {{$creditor2x = 0}}
            {{$debtor2x = 0}}
            {{$alldeb  = 0}}
            {{$balance_creditor = 0}}
            {{$balance_debtor = 0}}
        </div>


        {{--        <div style="display: none">--}}
            {{--            @if($depart->type == '0')--}}
            {{--                {{$creditor = glcc_first_blance($depart->id,'creditor')+cc_first_balance_public($depart->id,$from,$to,'creditor','<')}}--}}
            {{--                {{$debtor =glcc_first_blance($depart->id,'debtor')+ cc_first_balance_public($depart->id,$from,$to,'debtor','<')}}--}}
            {{--                {{$value_debtor2 = move_cc($depart->id,$from,$to,'debtor','>=')}}--}}
            {{--                {{$value_creditor2 = move_cc($depart->id,$from,$to,'creditor','>=')}}--}}
            {{--                {{$value_creditor2 = move_cc($depart->id,$from,$to,'creditor','>=')}}--}}

            {{--            @else--}}
            {{--                {{$creditor =  $depart->creditor +cc_first_individual($depart->id,$from,$to,'creditor','<')}}--}}
            {{--                {{$debtor = $depart->debtor + cc_first_individual($depart->id,$from,$to,'debtor','<')}}--}}
            {{--                {{$value_debtor2 = move_cc_individual($depart->id,$from,$to,'debtor','>=')}}--}}
            {{--                {{$value_creditor2 = move_cc_individual($depart->id,$from,$to,'creditor','>=')}}--}}

            {{--            @endif--}}
            {{--            {{ $balance_creditor = ($creditor + $value_creditor2) - ($debtor + $value_debtor2)}}--}}
            {{--            {{ $balance_debtor = ($debtor + $value_debtor2) - ($creditor + $value_creditor2)}}--}}
            {{--        </div>--}}


        <tr>
            <td>

                {{$depart->Costcntr_No}}
            </td>
            <td>
                {{session_lang($depart->Costcntr_Nmen,$depart->Costcntr_Nmar)}}

            </td>
            <td class="depratment_first_debter">

                <div style="display:none">

                    {{ $debtor = $depart->Fbal_DB  +
                    CC_Trial_Balance_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','<')  }}

                    {{ $creditor =  $depart->Fbal_CR  +

                    CC_Trial_Balance_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','<')}}




                    @if(($debtor - $creditor) > 0)
                    {{ $dataDebtor += $debtor - $creditor}}
                    @else
                    {{$dataDebtor += 0}}
                    @endif
                </div>


                @if(($debtor - $creditor) > 0)
                {{ $value_debtor = $debtor - $creditor}}
                @else
                {{$value_debtor = 0}}
                @endif

            </td>
            <td class="depratment_first_creditor">
                <div style="display:none">


                    {{ $debtor1 = $depart->Fbal_DB  +
                    CC_Trial_Balance_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','<')  }}

                    {{ $creditor1 =  $depart->Fbal_CR  +

                    CC_Trial_Balance_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','<')}}




                    @if(($creditor1 - $debtor1) > 0)
                    {{ $dataCredit +=  $creditor1 - $debtor1}}
                    @else
                    {{$dataCredit += 0}}
                    @endif


                </div>

                @if(( $creditor1 -$debtor1) > 0)
                {{ $value_creditor =  $creditor1-  $debtor1 }}
                @else
                {{$value_creditor = 0}}
                @endif

            </td>
            <td class="depratment_move_debter">


                {{$value_debtor2 = CC_Trial_Balance_getTrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','>=')}}
                <div style="display:none">
                    {{$dataDebtor1 += CC_Trial_Balance_getTrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','>=')}}
                </div>
            </td>
            <td class="depratment_move_creditor">
                {{$value_creditor2 =CC_Trial_Balance_getTrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','>=')}}
                <div style="display:none">
                    {{$dataCredit1 += CC_Trial_Balance_getTrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','>=')}}
                </div>
            </td>
            <td class="depratment_end_debt">
                @if(($value_debtor2 + $value_debtor) - ($value_creditor2 + $value_creditor) > 0)
                {{($value_debtor2 + $value_debtor) - ($value_creditor2 + $value_creditor)}}
                @else
                0
                @endif

                <div style="display:none">
                    @if(($value_debtor2 + $value_debtor) - ($value_creditor + $value_creditor2) > 0)
                    {{$dataDebtor2 += ($value_debtor2 + $value_debtor) - ($value_creditor + $value_creditor2)}}
                    @else
                    {{$dataDebtor2 += 0}}
                    @endif
                </div>
            </td>
            <td class="depratment_end_creditor">
                @if(($value_creditor2 + $value_creditor) - ($value_debtor + $value_debtor2) > 0)
                {{($value_creditor2 + $value_creditor) - ($value_debtor + $value_debtor2)}}
                @else
                0
                @endif
                <div style="display:none">
                    @if(($value_creditor2 + $value_creditor) - ($value_debtor + $value_debtor2) > 0)
                    {{$dataCredit2 += ($value_creditor2 + $value_creditor) - ($value_debtor + $value_debtor2)}}
                    @else
                    {{$dataCredit2 += 0}}
                    @endif
                </div>
            </td>
        </tr>


        @foreach($data as $key => $depart)

        {{--            <div style="display: none">--}}
            {{--                @if($depart->type == '0')--}}
            {{--                    {{$creditor = glcc_first_blance($depart->id,'creditor')+ cc_first_balance_public($depart->id,$from,$to,'creditor','<')}}--}}
            {{--                    {{$debtor =  glcc_first_blance($depart->id,'debtor')+cc_first_balance_public($depart->id,$from,$to,'debtor','<')}}--}}
            {{--                    {{$value_debtor2 = move_cc($depart->id,$from,$to,'debtor','>=')}}--}}
            {{--                    {{$value_creditor2 = move_cc($depart->id,$from,$to,'creditor','>=')}}--}}

            {{--                @else--}}
            {{--                    {{$creditor =$depart->creditor +  cc_first_individual($depart->id,$from,$to,'creditor','<')}}--}}
            {{--                    {{$debtor =$depart->debtor +  cc_first_individual($depart->id,$from,$to,'debtor','<')}}--}}
            {{--                    {{$value_debtor2 = move_cc_individual($depart->id,$from,$to,'debtor','>=')}}--}}
            {{--                    {{$value_creditor2 = move_cc_individual($depart->id,$from,$to,'creditor','>=')}}--}}

            {{--                @endif--}}
            {{--                {{ $balance_creditor = ($creditor + $value_creditor2) - ($debtor + $value_debtor2)}}--}}
            {{--                {{ $balance_debtor = ($debtor + $value_debtor2) - ($creditor + $value_creditor2)}}--}}
            {{--            </div>--}}


        <tr>
            <td>

                {{$depart->Costcntr_No}}
            </td>
            <td>
                {{session_lang($depart->Costcntr_Nmen,$depart->Costcntr_Nmar)}}

            </td>
            <td class="cc_first_debt">
                <div style="display:none">
                    @if($depart->Level_Status == '0')

                    {{ $debtor = $depart->Fbal_DB  +
                    CC_Trial_Balance_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','<')  }}

                    {{ $creditor =  $depart->Fbal_CR  +

                    CC_Trial_Balance_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','<')}}

                    @else
                    {{$creditor =$depart->Fbal_CR +
                    CC_Trial_Balance_One_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','<')}}
                    {{$debtor =$depart->Fbal_DB +
                    CC_Trial_Balance_One_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','<')}}

                    @endif

                    @if(($debtor - $creditor) > 0)
                    {{ $dataDebtory += $debtor - $creditor}}


                    @else
                    {{$dataDebtory += 0}}
                    @endif

                </div>

                @if(($debtor - $creditor) > 0)
                {{ $value_debtor = $debtor - $creditor}}
                @else
                {{$value_debtor = 0}}
                @endif


            </td>
            <td class="cc_first_creditor">


                <div style="display:none">
                    @if($depart->Level_Status == '0')
                    {{ $debtor1 = $depart->Fbal_DB  +
                    CC_Trial_Balance_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','<')  }}

                    {{ $creditor1 =  $depart->Fbal_CR  +

                    CC_Trial_Balance_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','<')}}
                    @else
                    {{$creditor1 =$depart->Fbal_CR +
                    CC_Trial_Balance_One_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','<')}}
                    {{$debtor1 =$depart->Fbal_DB +
                    CC_Trial_Balance_One_Fbalance($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','<')}}

                    @endif
                    @if(($creditor1 - $debtor1) > 0)
                    {{$dataCredity += $creditor1 - $debtor1}}

                    @else

                    {{$dataCredity += 0}}
                    @endif
                </div>
                @if(($creditor1- $debtor1) > 0)
                {{ $value_creditor = $creditor1 - $debtor1}}
                @else
                {{$value_creditor = 0}}
                @endif

            </td>
            <td class="cc_move_debtor">

                @if($depart->Level_Status == '0')
                {{$value_debtor2 =  CC_Trial_Balance_One_gettrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','=>')}}

                <div style="display:none">
                    {{$dataDebtor1y +=  CC_Trial_Balance_getTrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','=>')  }}

                </div>
                @else
                {{$value_debtor2 =  CC_Trial_Balance_One_gettrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','=>')}}
                <div style="display:none">

                    {{$dataDebtor1y += CC_Trial_Balance_One_gettrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Db','=>')}}
                </div>
                @endif

            </td>
            <td class="cc_move_creditor">
                @if($depart->Level_Status == '0')
                {{$value_creditor2 =  CC_Trial_Balance_One_gettrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','=>')}}

                <div style="display:none">
                    {{$dataCredit1y +=  CC_Trial_Balance_getTrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','=>')  }}

                </div>
                @else
                {{$value_creditor2 =  CC_Trial_Balance_One_gettrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','=>')}}
                <div style="display:none">

                    {{$dataCredit1y += CC_Trial_Balance_One_gettrans($depart->ID_No,$depart->Cmp_No,$depart->Costcntr_No,$from,$to,'Tr_Cr','=>')}}
                </div>
                @endif


            </td>
            <td class="cc_end_debtor">

                @if(($value_debtor + $value_debtor2) - ($value_creditor + $value_creditor2) > 0)
                {{($value_debtor + $value_debtor2) - ($value_creditor + $value_creditor2)}}
                @else
                0
                @endif
                <div style="display:none">
                    @if(($value_debtor + $value_debtor2) - ($value_creditor + $value_creditor2) > 0)
                    {{$dataDebtor2y += ($value_debtor + $value_debtor2) - ($value_creditor + $value_creditor2)}}

                    @else

                    {{$dataDebtor2y += 0}}
                    @endif
                </div>
            </td>
            <td class="cc_end_creditor">

                @if(($value_creditor + $value_creditor2) - ($value_debtor + $value_debtor2) > 0)
                {{($value_creditor + $value_creditor2) - ($value_debtor + $value_debtor2)}}
                @else
                0
                @endif
                <div style="display:none">
                    @if(($value_creditor + $value_creditor2) - ($value_debtor + $value_debtor2) > 0)
                    {{$dataCredit2y += ($value_creditor + $value_creditor2) - ($value_debtor + $value_debtor2)}}

                    @else
                    {{$dataCredit2y += 0}}
                    @endif
                </div>
            </td>
        </tr>

        @endforeach

        <tr>

            <th class="th-empty"></th>
            <th>{{trans('admin.Total_motion')}}</th>
            <th>{{$dataDebtory}} </th>
            <th>{{$dataCredity}} </th>
            <th>{{$dataDebtor1y}} </th>
            <th>{{$dataCredit1y}} </th>
            <th>{{$dataDebtor2y}} </th>
            <th>{{$dataCredit2y}} </th>
        </tr>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rLQihCFPSNPkwLNBTbVZHUAnYc5iRYaWz9em+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTLT1Kqob5UDEML61gCyjnAcfMXgkdP3wGcg45XN0VxHd" crossorigin="anonymous"></script>
</body>
</html>
